# AdditionalService

```php
use Daaner\NovaPoshta\Models\AdditionalService;
```

## Зміст
- [x] [Перевірка можливості створення заявки на повернення](AdditionalService.md#CheckPossibilityCreateReturn)
- [x] [Отримання списку причин повернення](AdditionalService.md#getReturnReasons)
- [x] [Отримання списку підтипів причини повернення](AdditionalService.md#getReturnReasonsSubtypes)
- [x] [Отримання списку заявок на повернення](AdditionalService.md#getReturnOrdersList)
- [x] [Перевірка можливості створення заявки на переадресацію відправлення](AdditionalService.md#checkPossibilityForRedirecting)
- [x] [Створення заявки на повернення](AdditionalService.md#save)
- [x] [Створення заявки на переадресацію](AdditionalService.md#saveRedirecting)
- [x] [Отримання списку заявок на переадресацію відправлень](AdditionalService.md#getRedirectionOrdersList)
- [x] [Видалення заявки на послуги](AdditionalService.md#delete)
- [x] [Перевірка можливості продовження зберігання](AdditionalService.md#CheckPossibilityTermExtension)
- [x] [Перевірка можливості змін у ТТН](AdditionalService.md#CheckPossibilityChangeEW)
- [x] [Продовження зберігання посилки](AdditionalService.md#saveAddTerm)
- [x] [Зміна/зняття накладеного платежу](AdditionalService.md#saveChangeCash)
- [x] [Зміна/зняття контролю оплати](AdditionalService.md#saveChangeAfterpaymentType)


## Усі методи моделі
- [CheckPossibilityCreateReturn($ttn)](#CheckPossibilityCreateReturn)
- [getReturnReasons()](#getReturnReasons)
- [getReturnReasonsSubtypes($ref = null)](#getReturnReasonsSubtypes)
- [getReturnOrdersList()](#getReturnOrdersList)
- [checkPossibilityForRedirecting($ttn)](#checkPossibilityForRedirecting)
- [save($ttn, $ownerDocumentType = null)](#save)
- [saveRedirecting($ttn)](#saveRedirecting)
- [getRedirectionOrdersList()](#getRedirectionOrdersList)
- [CheckPossibilityTermExtension($ttn)](#CheckPossibilityTermExtension)
- [CheckPossibilityChangeEW($ttn)](#CheckPossibilityChangeEW)
- [saveAddTerm($ttn)](#saveAddTerm)
- [saveChangeCash($ttn, $RedeliveryString)](#saveChangeCash)

---


### `CheckPossibilityCreateReturn()`
[Перевірка](https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a778f519-8512-11ec-8ced-005056b2dbe1) можливості створення заявки на повернення


```php
$np = new AdditionalService;
// Ключ вказується, якщо його немає в конфігу або він відрізняється від цього значення
$np->setAPI('3e6****367****0000****2d87****da');
$ttn = '20450520287825';

$addition = $np->CheckPossibilityCreateReturn($ttn);

dd($addition);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `getReturnReasons()`
[Отримання](https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a778f519-8512-11ec-8ced-005056b2dbe1) списку причин повернення


```php
$np = new AdditionalService;

$addition = $np->getReturnReasons();

dd($addition);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `getReturnReasonsSubtypes()`
[Отримання](https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a7cb69ee-8512-11ec-8ced-005056b2dbe1) списку підтипів причини повернення


```php
$np = new AdditionalService;

$addition = $np->getReturnReasonsSubtypes();
//або, якщо інші причини (у конфігу значення за замовчуванням), можна передати Ref
$addition = $np->getReturnReasonsSubtypes($ref);

dd($addition);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `getReturnOrdersList()`
[Отримання](https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a82d087c-8512-11ec-8ced-005056b2dbe1) списку заявок на повернення


```php
$np = new AdditionalService;

//НЕОБОВ'ЯЗКОВІ параметри
$np->setLimit(10);
$np->setPage(1);
$serv->setDateBegin('dd.mm.yyyy');
$serv->setDateEnd('dd.mm.yyyy');

$addition = $np->getReturnOrdersList();

dd($addition);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `checkPossibilityForRedirecting()`
[Перевірка](https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a8d29fc2-8512-11ec-8ced-005056b2dbe1) можливості створення заявки на переадресацію відправлення

```php
$np = new AdditionalService;
$ttn = '20450520287825';

$addition = $np->checkPossibilityForRedirecting($ttn);

dd($addition);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `save()`
Створення заявки на повернення посилки.

[Повернення](https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a7fb4a3a-8512-11ec-8ced-005056b2dbe1) на адресу відправника

[Повернення](https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/5a64f960-e7fa-11ec-a60f-48df37b921db) на нову адресу відділення

[Повернення](https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/175baec3-8f0d-11ec-8ced-005056b2dbe1) на нову адресу з адресною доставкою


```php
$np = new AdditionalService;
$ttn = '206004560074695';
$np->setApi('...');

// у відділення не зі списку відправника (з довідника відділень)
$np->setRecipientWarehouse('137db83c-e6a9-11e5-899e-005056887b8d');

// або на адресу відправника (адресу для повернення брати з відповіді методу CheckPossibilityCreateReturn)
$np->setReturnAddressRef('00000000-0000-0000-0000-000000000000');

// або на нову адресу, вказану масивом
$newAddress = [
    'settlement' => '00000000-0000-0000-0000-000000000000', //Ref населеного пункту
    'street' => '00000000-0000-0000-0000-000000000000', //Ref вулиці
    'building' => '4', //Номер будинку
    'other' => '2', //Квартира або інший опис
];
$np->setRecipientSettlement($newAddress);

// ДОДАТКОВО! Додано для простоти оформлення.
// Якщо не вказано жодного пункту (ні setRecipientWarehouse, ні setReturnAddressRef, ні setRecipientSettlement),
// повернення оформлюється у відділення, Ref якого береться з конфігу `config('novaposhta.ref_return_warehouse')`

// НЕОБОВ'ЯЗКОВІ ПОЛЯ, що відрізняються від значень у конфігу
$np->setReason('00000000-0000-0000-0000-000000000000'); //Ref причини з довідника
$np->setSubtypeReason('00000000-0000-0000-0000-000000000000'); //Ref підтипу причини з довідника
$np->setNote('Повернення замовлення'); //Примітка до повернення

$addition = $np->save($ttn);
// або
$addition = $np->save($ttn, 'orderCargoReturn');

dd($addition);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `saveRedirecting()`
[Створення](https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/98acb0f6-8f0b-11ec-8ced-005056b2dbe1) заявки на переадресацію посилки.

Аліас для методу `save($ttn, 'orderRedirecting')`, має ті самі можливості, що й метод `save`

```php
$np = new AdditionalService;
$ttn = '206004560074695';
$np->setApi('...');

// у відділення не зі списку відправника (з довідника відділень)
$np->setRecipientWarehouse('137db83c-e6a9-11e5-899e-005056887b8d');

// або на адресу відправника (адресу для повернення брати з відповіді методу CheckPossibilityCreateReturn)
$np->setReturnAddressRef('00000000-0000-0000-0000-000000000000');

// або на нову адресу, вказану масивом
$newAddress = [
    'settlement' => '00000000-0000-0000-0000-000000000000', //Ref населеного пункту
    'street' => '00000000-0000-0000-0000-000000000000', //Ref вулиці
    'building' => '4', //Номер будинку
    'other' => '2', //Квартира або інший опис
];
$np->setRecipientSettlement($newAddress);

$np->setNote('Переадресація замовлення'); //Примітка

//
/**
 * ========
 * Відмінності від методу save()
 * ========
 */
// Платник за пересилання (за замовчуванням з конфігу)
// Врахуйте, що для оплати пересилання відправником - у нього має бути можливість автоматичного списання оплати
$np->setPayerType('Recipient'); // необов'язковий параметр

//Замовник переадресації (одержувачу не дозволено змінювати дані одержувача). За замовчуванням `Sender`
$np->setCustomer('Recipient'); // необов'язковий параметр,

//Тип послуги (DoorsWarehouse, WarehouseWarehouse)
//Будьте обережні при пересиланні з адресної доставки, вказуйте правильно
$np->setServiceType('WarehouseWarehouse'); //за замовчуванням з конфігу (service_type)

// Зміна одержувача. Ігнорується, якщо оформлює НЕ відправник
$recipientData = [
    'Recipient' => '00000000-0000-0000-0000-000000000000', // можна НЕ вказувати, якщо не знаєте
    'RecipientContactName' => 'Іванов Іван Іванович',
    'RecipientPhone' => '380681111111',
];
$np->changeRecipientData($recipientData);


$addition = $np->saveRedirecting($ttn);
// або ж
$addition = $np->save($ttn, 'orderRedirecting');

dd($addition);
```

[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `getRedirectionOrdersList()`
[Отримання](https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a8faa2e6-8512-11ec-8ced-005056b2dbe1) списку заявок на переадресацію відправлень


```php
$np = new AdditionalService;
$np->setApi('...');

// Доступні НЕОБОВ'ЯЗКОВІ методи:
$np->setLimit(3);
$np->setPage(2);
$np->setNumber('102-00010160'); //номер заявки на переадресацію
$np->setRef('00000000-0000-0000-0000-000000000000'); //Ідентифікатор заявки на переадресацію (особисто в мене не фільтрує)
$np->setDateBegin('2020-11-3'); // дата майже в будь-якому форматі, головне, щоб не плутались місяці й дні
$np->setDateEnd('9/22/2022');

$addition = $np->getRedirectionOrdersList();

dd($addition);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `delete()`
[Видалення](https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a85bb34b-8512-11ec-8ced-005056b2dbe1) заявки
Метод "delete" дає змогу видалити:

- заявку на повернення

- заявку на зміну даних (видалити можна лише заявку зі статусом «Прийнято»)

– заявку на переадресацію


```php
$np = new AdditionalService;
$np->setApi('...');
$ref = '00000000-0000-0000-0000-000000000000';
$addition = $np->delete($Ref);

dd($addition);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `CheckPossibilityTermExtension()`
Перевірка можливості продовження зберігання

__НЕ ЗАДОКУМЕНТОВАНО__

Дослідним шляхом встановлено, що послуга недоступна юридичним особам, у яких підключене автоповернення.

```php
$np = new AdditionalService;
$np->setApi('...');
$ttn = '20450600000001';
$term = $np->CheckPossibilityTermExtension($ttn);

dd($term);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `CheckPossibilityChangeEW()`
[Перевірка](https://developers.novaposhta.ua/view/model/a7682c1a-8512-11ec-8ced-005056b2dbe1/method/a886b776-8512-11ec-8ced-005056b2dbe1) можливості змін у ТТН

```php
$np = new AdditionalService;
$np->setApi('...');
$ttn = '20450600000001';
$term = $np->CheckPossibilityChangeEW($ttn);

dd($term);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `saveAddTerm()`
Продовження зберігання посилки.

Аліас для методу `save($ttn, 'orderRedirecting')`.

```php
$np = new AdditionalService;
$np->setApi('...');
$ttn = '20450600000001';

// Дата, до якої зберігати посилку.
// Береться виключно з методу CheckPossibilityTermExtension($ttn) і приймається лише в такому форматі
$np->setStorageFinalDate('15.11.2022');

// Спосіб оплати продовження
// Можна пропустити, за замовчуванням береться значення з config('novaposhta.term_payment_method')
$np->PaymentMethod('Cash');

// Хто оплачує продовження.
// Можна пропустити, за замовчуванням береться значення з config('novaposhta.payer_type')
$np->PaymentMethod('Recipient');

$term = $np->saveAddTerm($ttn);
//або
$term = $np->save($ttn, 'orderTermExtension');

dd($term);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `saveChangeCash()`
Зміна/зняття накладеного платежу.

Аліас для методу `save($ttn, 'orderChangeEW')`, але із зазначенням суми

Якщо викликати `save($ttn, 'orderChangeEW')` - накладений платіж буде знято, як і при `saveChangeCash($ttn, 0)`

```php
$np = new AdditionalService;
$np->setApi('...');
$ttn = '20450600000001';

$cash = $np->saveChangeCash($ttn, 100);

//для зняття накладеного платежу
$cash = $np->saveChangeCash($ttn, null);
//або
$cash = $np->saveChangeCash($ttn, 0);
//або
$cash = $np->save($ttn, 'orderChangeEW');

dd($cash);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***


### `saveChangeAfterpaymentType()`
Зміна/зняття контролю оплати. Працює лише за наявності підписаного договору

```php
$np = new AdditionalService;
$np->setApi('...');
$ttn = '20450600000001';

$cash = $np->saveChangeAfterpaymentType($ttn, 100);

//для зняття контролю оплати
$cash = $np->saveChangeAfterpaymentType($ttn, 0);


dd($cash);
```
[Зміст](#Зміст) [Методи моделі](#Усі-методи-моделі)
***
