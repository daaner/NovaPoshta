# Laravel 7 NovaPoshta API 2.0

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
### TrackingDocument (не требует ключа API) ['подробнее'](/docs/TrackingDocument.md)
```php
use Daaner\NovaPoshta\Models\TrackingDocument;
```
- `getStatusDocuments($documents)` - получение полной информации по ТТН / массиву (свой телефон для каждой ТТН) (по официальной документации)
- `checkTTN($ttns, $phone = null)` - проверка одной/массива накладных с необязательным указанием общего телефона (не официальный ф-ционал)
- `getStatusTTN($ttns, $phone = null)` - получение статуса и обратной ТТН (ТТН пересылки) для одной/массива накладных с необязательным указанием общего телефона (не официальный ф-ционал)


### Address (требует ключа API) ['подробнее'](./docs/Address.md)
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






## Поддержка моделей / методов
### Хелперы
- `setLimit(100)` - лимит запроса записей (вызывать до главного метода `$np->setLimit(5)->getCities()`)
- `setPage(3)` - смена страницы при лимите (вызывать до главного метода `$np->setLimit(5)->setPage(2)->getCities()`)


## Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.


## Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


## Credits
- [Daan](https://github.com/daaner)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
