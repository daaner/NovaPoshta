# Новая Почта для Laravel 7+

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/daaner/novaposhta/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/daaner/novaposhta/?branch=master)
[![Laravel Support](https://img.shields.io/badge/Laravel-7+-brightgreen.svg)]()
[![PHP Support](https://img.shields.io/badge/PHP-7.2.5+-brightgreen.svg)]()
[![Official Site](https://img.shields.io/badge/official-site-blue.svg)](https://daaner.github.io/NovaPoshta/)

[![Latest Stable Version](https://poser.pugx.org/daaner/novaposhta/v)](//packagist.org/packages/daaner/novaposhta)
[![Total Downloads](https://poser.pugx.org/daaner/novaposhta/downloads)](//packagist.org/packages/daaner/novaposhta)
[![License](https://poser.pugx.org/daaner/novaposhta/license)](//packagist.org/packages/daaner/novaposhta)

***

Управление отправками NovaPoshta ([novaposhta.ua](https://novaposhta.ua/)) с помощью Laravel 7+ framework ([Laravel](https://laravel.com)).

***

## Поддержка
Поддерживается Laravel 7+ (HTTP фасад)
PHP >= 7.2.5

## Установка
``` bash
composer require daaner/novaposhta
```

Для последней не релизной версии обновите ваш `composer.json`
```bash
"daaner/novaposhta": "dev-master"
# и выполните
composer update daaner/novaposhta
```

Выполните публикацию конфига и локализационных файлов командой:
``` bash
php artisan vendor:publish --provider="Daaner\NovaPoshta\NovaPoshtaServiceProvider"
```

##

## Поддерживаемые модели

* [Модель Address](Address.md)
* [Модель AdditionalService](AdditionalService.md)
* [Модель CarCallGeneral](CarCallGeneral.md)
* [Модель Common](Common.md)
* [Модель CommonGeneral](CommonGeneral.md)
* [Модель Counterparty](Counterparty.md)
* [Модель InternetDocument](InternetDocument.md)
* [Модель InventoryGeneral](InventoryGeneral.md)
* [Модель LoyaltyUser](LoyaltyUser.md)
* [Модель Payment](Payment.md)
* [Модель ScanSheet](ScanSheet.md)
* [Модель TrackingDocument](TrackingDocument.md)

