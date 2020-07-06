# Counterparty

```php
use Daaner\NovaPoshta\Models\Counterparty;
```

### `getCounterparties($counterpartyProperty = null, $find = null)` - [получение](https://devcenter.novaposhta.ua/docs/services/557eb8c8a0fe4f02fc455b2d/operations/557fd789a0fe4f105c08760f) данных контрагента
```php
$cp = new Counterparty;

//если список менее 100 человек - пагинация не обязательна
$cp->setPage(2);
$cp->setLimit(100);

//если значение не указано - по умолчанию будет `Sender`
$agent = $cp->getCounterparties(); //Sender
//или
$agent = $cp->getCounterparties('Recipient'); //Recipient соответственно

//с поиском
$agent = $cp->getCounterparties(null, 'Талісман');
// либо
$agent = $cp->getCounterparties('Sender', 'Талісман');

dd($agent);
```


### `getCounterpartyContactPerson($ref)` - [загрузить](https://devcenter.novaposhta.ua/docs/services/557eb8c8a0fe4f02fc455b2d/operations/557fe424a0fe4f105c087612) список контактных лиц Контрагента
```php
$cp = new Counterparty;

//если список менее 100 человек - пагинация не обязательна
$cp->setPage(1);
$cp->setLimit(100);

$agent = $cp->getCounterpartyContactPerson('5953fb16-08d8-11e4-8958-0025909b4e33');

dd($agent);
```
