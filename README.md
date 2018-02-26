# Installation

`composer require hbliang/shippingManager`

# Configuration

The defaults are set in `config/shippingManager.php`.

`php artisan vendor:publish --provider="Hbliang\ShippingManager\ServiceProvider"`

# Usage

```PHP


```

# Test

create a `.env.testing` file to your project root path and write your settings:
```
FEDEX_API_KEY=key
FEDEX_API_PASSWORD=password
FEDEX_API_ACCOUNT=account
FEDEX_API_METER=meter
FEDEX_DEBUG=true
```