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
- Скопируйте `Ключ API` в настройках безопасности в разделе `Мои ключи API` и добавьте в соответствующий параметр в `config/novaposhta.php`


## Использование и API

### API
#### TrackingDocument
```php
use Daaner\NovaPoshta\Models\TrackingDocument;
```
- `getStatusDocuments($documents)` - кастомное использовение по документации сайта
```php
$doc = array();

//в массиве одна или несколько ТТН с отдельными телефонами
array_push($doc, ['DocumentNumber' => 'ttn1', 'Phone' => 'phone1']);
array_push($doc, ['DocumentNumber' => 'ttn2', 'Phone' => 'phone2']);

$np = new TrackingDocument;
$getStatusDocuments = $np->getStatusDocuments($doc);

dd($getStatusDocuments);
array:3 [▼
  "success" => true
  "result" => array:2 [▼
    0 => array:13 [▶]
    1 => array:75 [▶]
  ]
  "info" => array:1 [▶]
]
```




## Поддержка моделей / методов
#### Address
- searchSettlements


### Добавить
-


## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Daan](https://github.com/daaner)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
