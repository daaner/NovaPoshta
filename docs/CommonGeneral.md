# CommonGeneral - API Справочники
```php
use Daaner\NovaPoshta\Models\CommonGeneral;
```

## Содержание
- [x] [Виды временных интервалов](Common.md#getTimeIntervals)
- [x] [Виды груза](Common.md#getCargoTypes)
- [x] [Виды обратной доставки груза](Common.md#getBackwardDeliveryCargoTypes)
- [x] [Виды паллет](Common.md#getPalletsList)
- [x] [Виды плательщиков](Common.md#getTypesOfPayers)
- [x] [Виды плательщиков обратной доставки](Common.md#getTypesOfPayersForRedelivery)
- [x] [Виды упаковки](Common.md#getPackList)
- [x] [Виды шин и дисков](Common.md#getTiresWheelsList)
- [x] [Описания груза](Common.md#getCargoDescriptionList)
- [x] [Перечень ошибок](CommonGeneral.md#getMessageCodeText)
- [x] [Технологии доставки](Common.md#getServiceTypes)
- [x] [Типы контрагентов](Common.md#getTypesOfCounterparties)
- [x] [Формы оплаты](Common.md#getPaymentForms)
- [x] [Формы собственности](Common.md#getOwnershipFormsList)


## Все методы модели
- [getMessageCodeText()](#getMessageCodeText)


---

### `getMessageCodeText()`
[Получение](https://devcenter.novaposhta.ua/docs/services/55702570a0fe4f0cf4fc53ed/operations/58f0730deea270153c8be3cd) справочника перечня ошибок
```php
$cg = new CommonGeneral;
$lg = $cg->getMessageCodeText();

dd($lg);
```
[Содержание](#Содержание) [Методы модели](#Все-методы-модели)
