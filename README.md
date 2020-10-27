# Laravel 7 NovaPoshta API 2.0

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/daaner/novaposhta/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/daaner/novaposhta/?branch=master)
[![Laravel Support](https://img.shields.io/badge/Laravel-7-8+-brightgreen.svg)]()
[![PHP Support](https://img.shields.io/badge/PHP-7.2.5+-brightgreen.svg)]()
[![Official Site](https://img.shields.io/badge/official-site-blue.svg)](https://daaner.github.io/NovaPoshta/)

[![Latest Stable Version](https://poser.pugx.org/daaner/novaposhta/v)](//packagist.org/packages/daaner/novaposhta)
[![Total Downloads](https://poser.pugx.org/daaner/novaposhta/downloads)](//packagist.org/packages/daaner/novaposhta)
[![License](https://poser.pugx.org/daaner/novaposhta/license)](//packagist.org/packages/daaner/novaposhta)



Управление отправками NovaPoshta ([novaposhta.ua](https://novaposhta.ua/)) с помощью Laravel 7+ framework ([Laravel](https://laravel.com)).

Удобный пакет для отправки и проверки ТТН через сервис NovaPoshta.ua


__ВНИМАНИЕ__

```php

// Пока нет нормального релиза (я не доделал и не оттестил все модели)
// используйте ветку `dev-master`
// В ней все самое последнее. Документацию стараюсь не затягивать
```



#### Laravel > 7, PHP >= 7.2.5
Минимальная версия Laravel `7.0`, для более низкой версии нужно использовать `guzzle/guzzle`

Работает на Laravel 7+


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
- `getResponse($model, $calledMethod, $methodProperties, $auth = true)` - кастомная отправка данных, если добавятся новые методы
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



## Официально не документированный ф-ционал
- [x] [Получение данных по бонусной карте](/docs/LoyaltyUser.md#getLoyaltyInfoByApiKey)
- [x] [Обновить описание реестра](/docs/ScanSheet.md#updateScanSheet)
- [x] [Краткий список накладных реестра](/docs/ScanSheet.md#getScanSheetDocuments)
- [x] [Получение данных об Контрагенте по номеру телефона](Counterparty.md#getCatalogCounterparty)



## Статус обертки над API новой почты
[Официальная документация API Новой почты](https://devcenter.novaposhta.ua/docs/services/)


### [API Адреса](https://devcenter.novaposhta.ua/docs/services/556d7ccaa0fe4f08e8f7ce43)
#### Работа с адресами
- [x] [Онлайн поиск в справочнике населенных пунктов](/docs/Address.md#searchSettlements)
- [x] [Онлайн поиск улиц в справочнике населенных пунктов](/docs/Address.md#searchSettlementStreets)
- [x] [Создать адрес контрагента (отправитель/получатель)](/docs/Address.md#)
- [x] [Редактировать адрес контрагента (отправитель/получатель)](/docs/Address.md#)
- [x] [Удалить адрес контрагента (отправитель/получатель)](/docs/Address.md#)
- [x] [Справочник городов компании](/docs/Address.md#getCities)
- [x] [Справочник населенных пунктов Украины](/docs/Address.md#getSettlements)
- [x] [Справочник географических областей Украины](/docs/Address.md#getAreas)
- [x] [Справочник отделений и типов отделений](/docs/Address.md#getWarehouses)
- [x] [Справочник улиц компании](/docs/Address.md#getStreet)


### [API Контрагенты](https://devcenter.novaposhta.ua/docs/services/557eb8c8a0fe4f02fc455b2d)
#### Работа с данными Контрагента
- [x] [Создать Контрагента](Counterparty.md#save)
- [ ] Создать контактное лицо Контрагента
- [x] [Создать Контрагента с типом (юридическое лицо) организация](Counterparty.md#save)
- [x] [Создать Контрагента с типом третьего лица](Counterparty.md#save)
- [x] [Загрузить список адресов Контрагентов](Counterparty.md#getCounterpartyAddresses)
- [x] [Загрузить параметры Контрагента](Counterparty.md#getCounterpartyOptions)
- [x] [Загрузить список контактных лиц Контрагента](Counterparty.md#getCounterpartyContactPerson)
- [x] [Загрузить список контрагентов](Counterparty.md#getCounterparties)
- [ ] Обновить данные Контрагента
- [ ] Обновить данные контактного лица Контрагента
- [ ] Удалить Контрагента получателя
- [ ] Удалить Контактное лицо Контрагента


### [API Печатные формы](https://devcenter.novaposhta.ua/docs/services/556d7280a0fe4f08e8f7ce40)
#### Это коллекция методов для получения печатных форм документов.
- [ ] Маркировки - печатная форма
- [ ] Реестры - печатная форма
- [ ] Экспресс-накладная - печатные формы


### [API Реестры](https://devcenter.novaposhta.ua/docs/services/55662bd3a0fe4f10086ec96e)
#### Работа с реестрами экспресс-накладных
- [ ] Добавить экспресс-накладные
- [x] [Загрузить информацию по одному реестру](/docs/ScanSheet.md#getScanSheet)
- [x] [Загрузить список реестров](/docs/ScanSheet.md#getScanSheetList)
- [x] [Обновить описание реестра](/docs/ScanSheet.md#updateScanSheet)
- [x] [Краткий список накладных реестра](/docs/ScanSheet.md#getScanSheetDocuments)
- [ ] Удалить (расформировать) реестр отправлений
- [x] [Удалить экспресс-накладные из реестра](/docs/ScanSheet.md#removeDocuments)


### [API Справочники](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed)
#### Работа со справочниками.
- [x] [Виды временных интервалов](/docs/Common.md#getTimeIntervals)
- [x] [Виды груза](/docs/Common.md#getCargoTypes)
- [x] [Виды обратной доставки груза](/docs/Common.md#getBackwardDeliveryCargoTypes)
- [x] [Виды паллет](/docs/Common.md#getPalletsList)
- [x] [Виды плательщиков](/docs/Common.md#getTypesOfPayers)
- [x] [Виды плательщиков обратной доставки](/docs/Common.md#getTypesOfPayersForRedelivery)
- [x] [Виды упаковки](/docs/Common.md#getPackList)
- [x] [Виды шин и дисков](/docs/Common.md#getTiresWheelsList)
- [x] [Описания груза](/docs/Common.md#getCargoDescriptionList)
- [x] [Перечень ошибок](/docs/CommonGeneral.md#getMessageCodeText)
- [x] [Технологии доставки](/docs/Common.md#getServiceTypes)
- [x] [Типы контрагентов](/docs/Common.md#getTypesOfCounterparties)
- [x] [Формы оплаты](/docs/Common.md#getPaymentForms)
- [x] [Формы собственности](/docs/Common.md#getOwnershipFormsList)


### [API Услуга возврат отправления](https://devcenter.novaposhta.ua/docs/services/58ad7185eea27006cc36d649)
#### Возможность самостоятельного оформления Клиентом услуги «Возврат отправления» при использовании API. Услуга доступна только для клиентов отправителей.
- [ ] Проверка возможности создания заявки на возврат
- [ ] Получение списка причин возврата
- [ ] Получение списка подтипов причины возврата
- [ ] Создание заявки на возврат
- [ ] Получение списка заявок на возврат
- [ ] Удаление заявки на возврат


### [API Услуга Изменение данных](https://devcenter.novaposhta.ua/docs/services/59eef733ff2c200ce4f6f904)
#### Возможность самостоятельного оформления Клиентом услуги «Изменение данных» при использовании API.
- [ ] Проверка возможности создания заявки по изменению данных
- [ ] Создание заявки по изменению данных
- [ ] Удаление заявки
- [ ] Получение списка заявок


### [API Услуга переадресация отправления](https://devcenter.novaposhta.ua/docs/services/58f722b3ff2c200c04673bd1)
#### Возможность самостоятельного оформления Клиентом услуги «Переадресация» при использовании API. Услуга доступна для клиентов отправителей и получателей.
- [ ] Проверка возможности создания заявки на переадресацию отправления
- [ ] Создание заявки переадресация отправления (отделение/адрес)
- [ ] Удаление заявки
- [ ] Получение списка заявок


### [API Экспресс-накладная](https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e)
#### Работа с экспресс-накладными
- [ ] Рассчитать стоимость услуг
- [ ] Прогноз даты доставки груза
- [ ] Создать экспресс-накладную
- [ ] Создать экспресс-накладную на адрес
- [ ] Создать экспресс-накладную на отделение
- [ ] Создать экспресс-накладную на почтомат "Нова пошта"
- [ ] Создать экспресс-накладную с обратной доставкой
- [ ] Редактировать экспресс-накладную
- [x] Трекинг
- [ ] Получить список ЭН
- [ ] Удалить экспресс-накладную
- [ ] Формирование запроса для получения полного отчета по накладным
- [ ] Формирование запросов на создание ЭН с дополнительными услугами
- [ ] Формирование запросов на создание ЭН с различными видами груза


***

### Пропущенный функционал (не вижу потребности или не могу проверить)
- Создание Контрагента с типом юрлицо или третье лицо
  - не добавлена возможность указывать `CityRef`


***

## Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.


## Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


## Credits
- [Daan](https://github.com/daaner)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
