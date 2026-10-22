# Counterparty

```php
use Daaner\NovaPoshta\Models\Counterparty;
```

## Зміст
- [x] [Завантажити список контрагентів](Counterparty.md#getCounterparties)
- [x] [Завантажити список контактних осіб Контрагента](Counterparty.md#getCounterpartyContactPerson)
- [x] [Створити Контрагента](Counterparty.md#save)
- [x] [Завантажити параметри Контрагента](Counterparty.md#getCounterpartyOptions)
- [x] [Завантажити список адрес Контрагентів](Counterparty.md#getCounterpartyAddresses)
- [x] [Отримання даних про Контрагента за номером телефону](Counterparty.md#getCatalogCounterparty)

## Усі методи моделі
- [getCounterparties($find = null)](#getCounterparties)
- [getCounterpartyContactPerson($ref)](#getCounterpartyContactPerson)
- [save($firstName, $lastName = null, $middleName = null, $phone = null, $email = null)](#save)
- [getCounterpartyOptions($ref)](#getCounterpartyOptions)
- [getCounterpartyAddresses($ref)](#getCounterpartyAddresses)
- [getCatalogCounterparty($phone, $lastName)](#getCatalogCounterparty)

---

### `getCounterparties()`
[Отримання](https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/a37a06df-8512-11ec-8ced-005056b2dbe1) списку Контрагентів відправників/одержувачів/третьої особи

```php
$cp = new Counterparty;

//якщо у списку менше 100 осіб - пагінація не обов'язкова
$cp->setPage(2);
$cp->setLimit(100);

//якщо значення не вказано - за замовчуванням буде `Recipient`
$cp->setCounterpartyProperty('Sender');
$agent = $cp->getCounterparties();

//з пошуком (пошук не шукає входження. "Турфірма" знайдеться за "турф", але не знайдеться за "фірма")
$agent = $cp->getCounterparties('Талісман');

dd($agent);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `getCounterpartyContactPerson()`
[Завантажити](https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/a3575a67-8512-11ec-8ced-005056b2dbe1) список контактних осіб Контрагента

```php
$cp = new Counterparty;

//якщо у списку менше 100 осіб - пагінація не обов'язкова
$cp->setPage(1);
$cp->setLimit(100);

$agent = $cp->getCounterpartyContactPerson('5953fb16-08d8-11e4-8958-0025909b4e33');

dd($agent);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `save()`
[Створити](https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/0ae5dd75-8a5f-11ec-8ced-005056b2dbe1) Контрагента

[Створити](https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/bc3c44c7-8a8a-11ec-8ced-005056b2dbe1) Контрагента з типом (юридична особа) або організацію

[Створити](https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/b0fdf818-8a8e-11ec-8ced-005056b2dbe1) Контрагента з типом третьої особи (дані підтягуються з інформації за кодом ЄДРПОУ)

```php
$cp = new Counterparty;

//Для створення фізичної особи (PrivatePerson) обов'язкові параметри:
//$firstName, $lastName, $phone.
//Параметри $middleName і $email - необов'язкові

//Тип контрагента
$cp->setCounterpartyType('PrivatePerson');
//або
$cp->setCounterpartyType('Organization');

//Властивості контрагента
$cp->setCounterpartyProperty('Recipient');
//або
$cp->setCounterpartyProperty('Sender');

//PrivatePerson
//$firstName, $lastName = null, $middleName = null, $phone = null, $email = null
$agent = $cp->save("Іван", "Іванов", "Іванович", "380675554433", "ivanov@gmail.com");

//Для створення контрагента-юридичної особи обов'язково вказати OwnershipForm
//CounterpartyType встановиться примусово, тому цей параметр вказувати не обов'язково
//обов'язкові параметри OwnershipForm і FirstName,
//а параметри MiddleName, LastName, Email і Phone - ігноруються

//Organization
$cp->setCounterpartyProperty('Recipient');
$cp->setOwnershipForm('7f0f351d-2519-11df-be9a-000c291af1b3');
$agent = $cp->save("ФірмаТурбо");

//ThirdPerson - обов'язково вказати EDRPOU
// $cp->setCounterpartyProperty('ThirdPerson'); // вказувати не обов'язково
$cp->setEDRPOU('99999999');
$agent = $cp->save("Тут неважливо, який текст");

//при виклику setEDRPOU($number) примусово ставиться setCounterpartyProperty('ThirdPerson')

dd($agent);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `getCounterpartyOptions()`
[Завантажити](https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/a332efbf-8512-11ec-8ced-005056b2dbe1) параметри Контрагента

```php
$cp = new Counterparty;

$agent = $cp->getCounterpartyOptions("16b39437-c037-11ea-8513-b88303659df5");

dd($agent);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `getCounterpartyAddresses()`
[Завантажити](https://developers.novaposhta.ua/view/model/a28f4b04-8512-11ec-8ced-005056b2dbe1/method/a30dbb7c-8512-11ec-8ced-005056b2dbe1) список адрес Контрагентів

```php
$cp = new Counterparty;
//за замовчуванням Recipient
$cp->setCounterpartyProperty('Sender'); // або примусово Recipient
$agent = $cp->getCounterpartyOptions("16b39437-c037-11ea-8513-b88303659df5");

dd($agent);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `getCatalogCounterparty()`
Отримання даних про Контрагента за номером телефону (ПІБ тощо)

```php
$cp = new Counterparty;

//обов'язкові телефон у форматі та щонайменше три символи прізвища
$fullName = $cp->getCatalogCounterparty("0965775815", 'іва');

dd($fullName);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***
