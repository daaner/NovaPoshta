# InternetDocument

```php
use Daaner\NovaPoshta\Models\InternetDocument;
```

## Содержание


## Все методы модели
- [getDocumentList()](#getDocumentList)

---

### `getDocumentList()`
[Получение](https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/557eb417a0fe4f02fc455b2c) списка всех ЭН
```php

$np = new InternetDocument;

// НЕ обязательные параметры
$np->setLimit(5);
$np->setPage(2);
//выборка по конкретной дате (выборка за период тогда не работает)
$np->setDateTime('10-05-2020');
//или выборка за период
$np->setDateTimeFrom('11-07-2020'); //eсли не указано `setDateTimeFrom` - значение будет таким же, как `setDateTimeTo`
$np->setDateTimeTo('11-07-2020'); //eсли не указано `setDateTimeTo` - значение будет сегодняшним числом
$np->showFullList(); // отобразить полный список (игнорируется лимит и постраничная разбивка)
$np->showRedeliveryMoney(); // отобразить полный список ЭН с обратной доставкой. Требуется указание даты DateTimeFrom и DateTimeTo
$np->showUnassembledCargo(); // отобразить полный список всех актуальных ЭН (по которым не написано заявление на возврат или утилизацию) не забранных получателями посылок. Требуется указание даты DateTimeFrom и DateTimeTo


$lists = $np->getDocumentList();

dd($lists);

```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
***
