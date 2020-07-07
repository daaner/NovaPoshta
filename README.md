# Laravel 7 NovaPoshta API 2.0

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/daaner/novaposhta/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/daaner/novaposhta/?branch=master)
[![Laravel Support](https://img.shields.io/badge/Laravel-7+-brightgreen.svg)]()
[![PHP Support](https://img.shields.io/badge/PHP-7.2.5+-brightgreen.svg)]()

[![Latest Stable Version](https://poser.pugx.org/daaner/novaposhta/v)](//packagist.org/packages/daaner/novaposhta)
[![Total Downloads](https://poser.pugx.org/daaner/novaposhta/downloads)](//packagist.org/packages/daaner/novaposhta)
[![License](https://poser.pugx.org/daaner/novaposhta/license)](//packagist.org/packages/daaner/novaposhta)


Управление отправками NovaPoshta ([novaposhta.ua](https://novaposhta.ua/)) с помощью Laravel 7+ framework ([Laravel](https://laravel.com)).

Удобный пакет для отправки и проверки ТТН через сервис NovaPoshta.ua


#### Laravel > 7, PHP >= 7.2.5
Минимальная версия Laravel `7.0`, для более низкой версии нужно использовать `guzzle/guzzle`


## Установка
Установите пакет через композер.

``` bash
composer require daaner/novaposhta
```


Если вы НЕ используете autodiscover - добавьте сервис провайдер в конфигурационный файл `config/app.php`.

```php
Daaner\NovaPoshta\NovaPoshtaServiceProvider::class,
```


Добавьте фасад `NovaPoshta` в массив в `config/app.php`:

```php
'NovaPoshta' => Daaner\NovaPoshta\Facades\NovaPoshta::class,
```


Выполните публикацию конфига и локализационных файлов командой:

``` bash
php artisan vendor:publish --provider="Daaner\NovaPoshta\NovaPoshtaServiceProvider"
```

## Конфигураци

После публикации ресурсов поправьте файл `config/novaposhta.php` и заполните `.env` новыми полями.

- Создайте аккаунт на сайте [novaposhta.ua](https://novaposhta.ua)
- Скопируйте `Ключ API` в настройках безопасности в разделе `Мои ключи API` и добавьте в соответствующий параметр в `config/novaposhta.php` либо в .env файл
- `point` поддерживается только `json` (вряд ли добавится `xml`)
- `dev` режим отладки запросов. Включает в каждом ответе весь респонс от запроса (не оставляйте на продакшене)



## Использование и API
- `setAPI($apiKey)` - установка API ключа, отличного от значения по умолчанию
```php
$cp = new Counterparty;
$cp->setAPI('391e241b2c********************e7');
```
- `getResponse($model, $calledMethod, $methodProperties, $auth = true)` - кастомная отправка данных, если добавится новые методы
```php
use NovaPoshta;
$model = 'TrackingDocument'; //нужная модель
$calledMethod = 'getStatusDocuments'; //нужный метод
$methodProperties = [
  //данные по документации
];
$np = new NovaPoshta;
$data = $np->getResponse($model, $calledMethod, $methodProperties, $auth = true);
```

## Использование API по конкретным моделям
[Статус](STATUS.md) обертки над API новой почты

#### CommonGeneral (требует ключа API) [(подробнее)](/docs/CommonGeneral.md) - API Справочники
```php
use Daaner\NovaPoshta\Models\CommonGeneral;
```
- `getMessageCodeText()` - справочник перечня ошибок


#### Common (требует ключа API) [(подробнее)](/docs/Common.md) - API Справочники
```php
use Daaner\NovaPoshta\Models\Common;
```
- `getTimeIntervals($recipientCityRef, $dateTime = null)` - справочник видов временных интервалов (не требует API ключа)
- `getCargoTypes()` - справочник видов груза
- `getBackwardDeliveryCargoTypes()` - справочник видов обратной доставки груза
- `getPalletsList()` - справочник видов паллет
- `getTypesOfPayers()` - справочник видов плательщиков доставки
- `getTypesOfPayersForRedelivery()` - справочник видов плательщиков обратной доставки
- `getPackList()` - справочник видов упаковки
- `getTiresWheelsList()` - справочник видов шин и дисков
- `getCargoDescriptionList($find = null)` - справочник описаний груза
- `getServiceTypes()` - справочник технологий доставки
- `getTypesOfCounterparties()` справочник типов контрагентов
- `getPaymentForms()` справочник форм оплаты
- `getOwnershipFormsList()` справочник форм собственности



#### TrackingDocument (не требует ключа API) [(подробнее)](/docs/TrackingDocument.md)
```php
use Daaner\NovaPoshta\Models\TrackingDocument;
```
- `getStatusDocuments($documents)` - получение полной информации по ТТН / массиву (свой телефон для каждой ТТН) (по официальной документации)
- `checkTTN($ttns, $phone = null)` - проверка одной/массива накладных с необязательным указанием общего телефона (не официальный ф-ционал)
- `getStatusTTN($ttns, $phone = null)` - получение статуса и обратной ТТН (ТТН пересылки) для одной/массива накладных с необязательным указанием общего телефона (не официальный ф-ционал)


#### Address (требует ключа API) [(подробнее)](./docs/Address.md)
```php
use Daaner\NovaPoshta\Models\Address;
```
- `getAreas()` - получение списка областей
- `getCities()` - получение списка городов либо выборка (поиском или Ref)
- `getWarehouses($cityName)` - получение списка отделений по городу
- `getWarehouseTypes($cityName)` - получение типов отделений в населенном пункте
- `getWarehouseSettlements($settlementRef)` - получение списка отделений по населенному пункту из справочника Settlements
- `searchSettlements($search)` - поиск населенных пунктов из справочника Settlements
- `searchSettlementStreets($ref, $street)` - поиск улиц в населенных пунктах
- `getStreet($city, $find = null)` - поиск улиц в городе по CityRef


#### Counterparty (требует ключа API) [(подробнее)](./docs/Counterparty.md)
```php
use Daaner\NovaPoshta\Models\Counterparty;
```
- `getCounterpartyContactPerson($ref)` - загрузить список контактных лиц Контрагента



#### ContactPerson (требует ключа API) [(подробнее)](./docs/ContactPerson.md)
```php
use Daaner\NovaPoshta\Models\ContactPerson;
```






## Поддержка моделей / методов
#### Хелперы (более детальные хелперы можно увидеть в документации к модели)
Хелперы вызываются до главного метода обращения:
```php
$foo = new Common;
$foo->setLanguage('ru');
$list = $foo->getPaymentForms();

$bar = new Address;
$bar->setLimit(5)->setPage(2);
$cities = $bar->getCities();
```

- `setLanguage('ru')` - переключает локализацию (только `ru` и `ua`), по умолчанию локализация украинская.
Очень много моделей имеют в ответе дубляж на русском. В некоторых справочниках нет русской локализации.
- `setLimit(100)` - лимит запроса записей
- `setPage(3)` - пагинация при лимите



## Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.


## Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


## Credits
- [Daan](https://github.com/daaner)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
