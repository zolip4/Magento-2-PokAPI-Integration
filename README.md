## Magento2 PokeAPi integration

Allows you to anonymize product data on the front end.

## Features

# How to configure this module

* Stores > Configuration > Onion > PokeApi 
  * Enable module
  * Use Base Api Url from example (https://pokeapi.co/api/v2/)
  * Choose How Many Pokemon you want to import
  * Save configuration and Import Data
  * Result https://i.imgur.com/1JDPMn6.png
* Catalog > Products (Choose product in which you want replace to Pokemon)
  * On the product edit page choose Pokemon name https://i.imgur.com/TS7bvYL.png
  * Result:
    * Product Page: https://i.imgur.com/XGi8RSM.png
    * Catalog Page: https://i.imgur.com/2Nmfjj2.png
    * Home Page: https://i.imgur.com/jkapdCR.png

## Installation

* In Magento root folder run commands:

```
composer require zolip4/poke-api:dev-main
```

```
$ php bin/magento setup:upgrade
```

```
$ php bin/magento module:enable Onion_PokeApi
```

* Enjoy!

## License

[Open Software License](https://opensource.org/licenses/osl-3.0.php)

## Autor

zolip4toxa@gmail.com
