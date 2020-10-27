# Counterparty

```php
use Daaner\NovaPoshta\Models\Counterparty;
```

## Содержание
- [x] [Загрузить список контрагентов](Counterparty.md#getCounterparties)
- [x] [Загрузить список контактных лиц Контрагента](Counterparty.md#getCounterpartyContactPerson)
- [x] [Создать Контрагента](Counterparty.md#save)
- [x] [Загрузить параметры Контрагента](Counterparty.md#getCounterpartyOptions)
- [x] [Загрузить список адресов Контрагентов](Counterparty.md#getCounterpartyAddresses)
- [x] [Получение данных об Контрагенте по номеру телефона](Counterparty.md#getCatalogCounterparty)

## Все методы модели
- [getCounterparties($find = null)](#getCounterparties)
- [getCounterpartyContactPerson($ref)](#getCounterpartyContactPerson)
- [save($firstName, $lastName = null, $middleName = null, $phone = null, $email = null)](#save)
- [getCounterpartyOptions($ref)](#getCounterpartyOptions)
- [getCounterpartyAddresses($ref)](#getCounterpartyAddresses)
- [getCatalogCounterparty($phone, $lastName)](#getCatalogCounterparty)

---

### `getCounterparties()`
[Получение](https://devcenter.novaposhta.ua/docs/services/557eb8c8a0fe4f02fc455b2d/operations/557fd789a0fe4f105c08760f) списка Контрагентов отправителей/получателей/третье лицо
```php
$cp = new Counterparty;

//если список менее 100 человек - пагинация не обязательна
$cp->setPage(2);
$cp->setLimit(100);

//если значение не указано - по умолчанию будет `Recipient`
$cp->setCounterpartyProperty('Sender');
$agent = $cp->getCounterparties();

//с поиском (поиск не ищет вхождения. "Турфирма" найдется по "турф", но не найдется по "фирма")
$agent = $cp->getCounterparties('Талісман');

dd($agent);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getCounterpartyContactPerson()`
[Загрузить](https://devcenter.novaposhta.ua/docs/services/557eb8c8a0fe4f02fc455b2d/operations/557fe424a0fe4f105c087612) список контактных лиц Контрагента
```php
$cp = new Counterparty;

//если список менее 100 человек - пагинация не обязательна
$cp->setPage(1);
$cp->setLimit(100);

$agent = $cp->getCounterpartyContactPerson('5953fb16-08d8-11e4-8958-0025909b4e33');

dd($agent);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `save()`
[Создать](https://devcenter.novaposhta.ua/docs/services/557eb8c8a0fe4f02fc455b2d/operations/557ebbd3a0fe4f02fc455b2e) Контрагента
[Создать](https://devcenter.novaposhta.ua/docs/services/557eb8c8a0fe4f02fc455b2d/operations/5761559da0fe4f19fcad6546) Контрагента с типом (юридическое лицо) или организацию
[Создать](https://devcenter.novaposhta.ua/docs/services/557eb8c8a0fe4f02fc455b2d/operations/576156f6a0fe4f19fcad6547) Контрагента с типом третьего лица (данные подтягиваются из информации кода ЕДРПОУ)
```php
$cp = new Counterparty;

//Для создания физического лица (PrivatePerson) обязательные параметры:
//$firstName, $lastName, $phone.
//Параметры $middleName и $email - опциональные

//Тип контрагента
$cp->setCounterpartyType('PrivatePerson');
//либо
$cp->setCounterpartyType('Organization');

//Свойства контрагента
$cp->setCounterpartyProperty('Recipient');
//либо
$cp->setCounterpartyProperty('Sender');

//PrivatePerson
//$firstName, $lastName = null, $middleName = null, $phone = null, $email = null
$agent = $cp->save("Иван", "Иванов", "Иванович", "380675554433", "ivanov@gmail.com");

//Для создания контрагента с юридическим лицом обязательно указать OwnershipForm
//CounterpartyType установится насильно и этот параметр указывать не обязательно
//обязательные параметры OwnershipForm и FirstName
//а параметры MiddleName, LastName, Email и Phone - игнорируются

//Organization
$cp->setCounterpartyProperty('Recipient');
$cp->setOwnershipForm('7f0f351d-2519-11df-be9a-000c291af1b3');
$agent = $cp->save("ФірмаТурбо");

//ThirdPerson обязательно указание EDRPOU
// $cp->setCounterpartyProperty('ThirdPerson'); // не обязательно указывать
$cp->setEDRPOU('99999999');
$agent = $cp->save("Тут неважно какой текст");

//при указании setEDRPOU($number) насильно ставится setCounterpartyProperty('ThirdPerson')

dd($agent);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getCounterpartyOptions()`
[Загрузить](https://devcenter.novaposhta.ua/docs/services/557eb8c8a0fe4f02fc455b2d/operations/55801976a0fe4f105c087614) параметры Контрагента
```php
$cp = new Counterparty;

$agent = $cp->getCounterpartyOptions("16b39437-c037-11ea-8513-b88303659df5");

dd($agent);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getCounterpartyAddresses()`
[Загрузить](https://devcenter.novaposhta.ua/docs/services/557eb8c8a0fe4f02fc455b2d/operations/557fdcb4a0fe4f105c087611) список адресов Контрагентов
```php
$cp = new Counterparty;
//по умолчанию Recipient
$cp->setCounterpartyProperty('Sender'); // или насильно Recipient
$agent = $cp->getCounterpartyOptions("16b39437-c037-11ea-8513-b88303659df5");

dd($agent);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***


### `getCatalogCounterparty()`
__НЕ ДОКУМЕНТИРОВАНО В ОФИЦИАЛЬНОЙ ДОКУМЕНТАЦИИ__

Получение данных об Контрагенте по номеру телефона (ФИО и прочее)

```php
$cp = new Counterparty;

//обязателен телефон в формате и минимум три символа фамилии
$fullname = $cp->getCatalogCounterparty("0965775815", 'іва');

dd($fullname);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***
