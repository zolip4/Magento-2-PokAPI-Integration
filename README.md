## Magento2 PokeAPi integration

Allows you to anonymize product data on the front end.

## Features

# How to configure this module

1. Stores > Configuration > Onion > PokeApi 
    1.1 Enable module
    1.2 Use Base Api Url from example (https://pokeapi.co/api/v2/)
    1.3 Choose How Many Pokemon you want to import
    1.4 Save configuration and Import Data
    Result https://i.imgur.com/1JDPMn6.png
2. Catalog > Products (Choose product in which you want replace to Pokemon)
    2.1 On the product edit page choose Pokemon name https://i.imgur.com/TS7bvYL.png
    Result:
        Product Page: https://i.imgur.com/XGi8RSM.png
        Catalog Page: https://i.imgur.com/2Nmfjj2.png
        Home Page: https://i.imgur.com/jkapdCR.png

## Installation

* In Magento root folder run commands:

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
