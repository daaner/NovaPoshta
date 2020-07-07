# CommonGeneral - API Справочники
```php
use Daaner\NovaPoshta\Models\CommonGeneral;
```
<a name="content"></a>
## Содержание
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


<a name="content-method"></a>
## Все методы модели
- [getMessageCodeText()](#getMessageCodeText)


---

<a name="getMessageCodeText"></a>
### `getMessageCodeText()` - [получение](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/58f0730deea270153c8be3cd){:target="np"} справочника перечня ошибок
```php
$cg = new CommonGeneral;
$lg = $cg->getMessageCodeText();

dd($lg);
```
[Содержание](#content) [Методы модели](#content-method)
