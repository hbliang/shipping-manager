<?php

namespace Hbliang\ShippingManager\Carriers\FedEx\Services\Address;

use Hbliang\ShippingManager\Entities\Address as AddressEntity;
use Hbliang\ShippingManager\Carriers\FedEx\Client;
use Hbliang\ShippingManager\Carriers\FedEx\RequestOptions\Version;

class Address extends Client implements \Hbliang\ShippingManager\Carriers\Fedex\Contracts\Address
{
    protected function init()
    {
        $this->requestOptions['Version'] = $this->container['config']['version']['address'] ?? null;
    }

    public function setVersion(Version $version)
    {
        $this->requestOptions['Version'] = $version->toArray();
        return $this;
    }

    public function validate(array $addresses, $options = [])
    {
        $options['AddressesToValidate'] = array_map(function($address) {
            if (!($address instanceof AddressEntity)) {
                throw new \Exception('variable address is not instance of AddressEntity.');
            }

            return [
                'ClientReferenceId' => $address->getId(),
                'Address' => [
                    'StreetLines' => [$address->getStreet()],
                    'City' => $address->getCity(),
                    'StateOrProvinceCode' => $address->getState(),
                    'PostalCode' => $address->getPostalCode(),
                    'CountryCode' => $address->getCountry(),
                ],
            ];
        }, $addresses);

        $response = $this->soapClient->addressValidation($this->wrapRequestOptions($options));

        if ($response->HighestSeverity != 'FAILURE' && $response->HighestSeverity != 'ERROR') {
            foreach ($response->AddressResults as $addressResult) {
                /**
                 * @see https://www.fedex.com/us/developer/WebHelp/ws/2017/html/WebServicesHelp/WSDVG_US_CA/index.htm#wsdvg/About_This_Guide.htm
                 * If the address returned includes the address state of "Standardized"
                 * and also if the attributes of Resolved = True,
                 * DPV = True are present,
                 * then the address is likely a valid one.
                 */
                $isValid = false;
                if ($addressResult->State === 'STANDARDIZED' && !empty($addressResult->Attributes)) {
                    $attributes = array_filter($addressResult->Attributes, function($attribute) {
                         if ($attribute->Name === 'Resolved' && $attribute->Value === "true") {
                             return true;
                         }
                        if ($attribute->Name === 'DPV' && $attribute->Value === "true") {
                            return true;
                        }
                        return false;
                    });
                    

                    if (count($attributes) === 2) {
                        $isValid = true;
                    }
                }

                foreach ($addresses as $address) {
                    if ($address->getId() === $addressResult->ClientReferenceId) {
                        if ($isValid) {
                            $address->setValid();
                        } else {
                            $address->setInvalid();
                        }
                    }
                }
            }

            return null;
        }

        $this->container->logger->error('Error Request', [
            'response' => $this->soapClient->__getLastRequest(),
            'request' => $this->soapClient->__getLastRequest(),
        ]);

        return $response->Notifications->Message;
    }


}