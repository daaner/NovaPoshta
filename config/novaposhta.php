<?php

return [

    // GENERAL
    /*
     | Base URL NovaPoshta
     | @see https://developers.novaposhta.ua/
     */
    'base_uri' => 'https://api.novaposhta.ua/v2.0/',

    /*
     | End Point
     | @see https://developers.novaposhta.ua/
     |
     | Supported: "json", "xml" (XML - еще не поддерживается и вряд ли будет)
     */
    'point' => env('NP_POINT', 'json'),

    // OTHER
    /*
     | Ключ API из личного кабинета.
     */
    'api_key' => env('NP_API_KEY', 'api_key'),

    /*
     | Режим отладки запросов.
     | Добавляет во все ответы полное тело ответа в переменную `dev` в массив.
     */
    'dev' => env('NP_DEV', false),

    /*
    | Лимит списка по умолчанию.
    | Максимальное значение для всего 500, для улиц - 1500.
     */
    'page_limit' => 500,

    /*
    |--------------------------------------------------------------------------
    | Значения по умолчанию для отправки посылок
    |--------------------------------------------------------------------------
    |
    | Используется для задания общих отправок и для уменьшения кода
    | при создании ТТН-ок
    |
    | Значения берутся из справочников. Строго по документации Новой почты.
    */

    /*
    |--------------------------------------------------------------------------
    | Отправитель
    |--------------------------------------------------------------------------
    |
    | Если отправителей несколько - укажите одного, а других передавайте перед сохранением
    |
    */

    /*
     | Идентификатор отправителя по умолчанию.
     */
    'sender' => '5ace4a2e-13ee-11e5-add9-005056887b8d',

    /*
    | Идентификатор города отправителя по умолчанию.
    */
    'city_sender' => '8d5a980d-391c-11dd-90d9-001a92567626',

    /*
    | Идентификатор адреса отправителя по умолчанию.
    */
    'sender_address' => 'd492290b-55f2-11e5-ad08-005056801333',

    /*
    | Идентификатор контактного лица отправителя по умолчанию.
    */
    'contact_sender' => '613b77c4-1411-11e5-ad08-005056801333',

    /*
    | Телефон отправителя в формате: +380660000000, 380660000000, 0660000000 по умолчанию.
    */
    'senders_phone' => '380991234567',

    /*
    | RecipientType по умолчанию
    | Если получатель юридическое лицо - нужно указывать дополнительные данные.
    | @see https://developers.novaposhta.ua/view/model/a90d323c-8512-11ec-8ced-005056b2dbe1/method/f74a0918-8f18-11ec-8ced-005056b2dbe1
    |
    | 'PrivatePerson', 'Organization'
    */
    'recipient_type' => 'PrivatePerson',

    /*
    | ServiceType по умолчанию.
    |
    | 'DoorsDoors', 'DoorsWarehouse', 'WarehouseWarehouse', 'WarehouseDoors'
    */
    'service_type' => 'WarehouseWarehouse',

    /*
    | CargoType по умолчанию.
    |
    | 'Cargo', 'Documents', 'TiresWheels', 'Pallet', 'Parcel'
    */
    'cargo_type' => 'Parcel',

    /*
    | PaymentMethod по умолчанию.
    |
    | 'Cash', 'NonCash'
    */
    'payment_method' => 'Cash',

    /*
    | PayerType по умолчанию.
    |
    | 'Sender', 'Recipient', 'ThirdPerson'
    */
    'payer_type' => 'Recipient',

    /*
    | PayerType для BackwardDeliveryData по умолчанию
    | Sender - отправитель посылки платит за возврат документов или денег
    | Recipient - получатель посылки платит за возврат документов или денег
    | Третья особа НЕ может выступать плательщиком
    |
    | 'Sender', 'Recipient'
    */
    'back_delivery_payer_type' => 'Recipient',

    /*
    | CargoType для BackwardDeliveryData по умолчанию: 'Money' - деньги
    | Для некоторых типов нужны дополнительные параметры (не реализовано). Смотрите документацию.
    | @see https://developers.novaposhta.ua/view/model/a90d323c-8512-11ec-8ced-005056b2dbe1/method/c7c8aaf5-8f40-11ec-8ced-005056b2dbe1
    |
    | 'Money', 'CreditDocuments', 'SignedDocuments', 'Trays' (пока не доступна в НП),
    | 'Documents', 'Other'
    */
    'back_delivery_cargo_type' => 'Money',

    /*
    | Description по умолчанию (описание посылки).
    */
    'description' => 'Товары',

    /*
    | Целое число, количество мест отправления по умолчанию.
    */
    'seats_amount' => 1,

    /*
    | Целое число, объявленная стоимость по умолчанию.
    */
    'cost' => 300,

    /*
    | Вес посылки по умолчанию.
    */
    'weight' => 1,

    /*
    | Параметры груза по умолчанию.
    |
    | Массив коробок для быстрого выбора объемного груза
    | Объемный вес (кг) = (Длина(см) × Ширина(см) × Высота(см)) / 4 000
    | Если выбрать значение не из массива - примется значение 1кг.
    */
    'options_seat' => [
        '1' => [
            'volumetricVolume' => '1',
            'volumetricWidth' => '24',
            'volumetricLength' => '17',
            'volumetricHeight' => '10',
            'weight' => '1',
        ],
        '2' => [
            'volumetricVolume' => '2',
            'volumetricWidth' => '34',
            'volumetricLength' => '24',
            'volumetricHeight' => '10',
            'weight' => '2',
        ],
        '3' => [
            'volumetricVolume' => '3',
            'volumetricWidth' => '24',
            'volumetricLength' => '24',
            'volumetricHeight' => '21',
            'weight' => '3',
        ],
        '5' => [
            'volumetricVolume' => '4',
            'volumetricWidth' => '40',
            'volumetricLength' => '24',
            'volumetricHeight' => '21',
            'weight' => '5',
        ],
        '10' => [
            'volumetricVolume' => '9.8',
            'volumetricWidth' => '40',
            'volumetricLength' => '35',
            'volumetricHeight' => '28',
            'weight' => '10',
        ],
    ],

    /*
    | Тонкая настройка HTTP client.
    |
    | http_response_timeout - maximum number of seconds to wait for a response
    | http_retry_max_time - the maximum number of times the request should be attempted
    | http_retry_delay - the number of milliseconds that Laravel should wait in between attempts
    */
    'http_response_timeout' => 3,
    'http_retry_max_time' => 2,
    'http_retry_delay' => 500,

    /*
    | Идентификатор возврата по умолчанию.
    | ref_return_reasons - "Відмова від доставки"
    | ref_return_reasons_sub - "Відправлення не відповідає замовленню, не підійшло"
    */
    'ref_return_reasons' => '49754eb2-a9e1-11e3-9fa0-0050568002cf',
    'ref_return_reasons_sub' => '49754ec8-a9e1-11e3-9fa0-0050568002cf',

    /*
    | Идентификатор отделения для возврата посылок по умолчанию.
    | Ref из справочника отделений.
    | Киев-30 - '4049833d-e1c2-11e3-8c4a-0050568002cf'
    */
    'ref_return_warehouse' => '',

    /*
    | Заметка для возвратов и переадресаций по умолчанию.
    */
    'return_note' => 'Возврат посылки',
    'redirecting_note' => 'Переадресация посылки',

    /*
    | Формат возврата по умолчанию Cash/NonCash. (нал / безнал)
    */
    'return_cash_method' => 'Cash',

    /*
    | Формат оплаты продления хранения Cash/NonCash. (нал / безнал)
    */
    'term_payment_method' => 'Cash',

    /*
    | Формат печати по умолчанию
    | Document_new, Marking_85x85, Marking_100x100
    */
    'print_form' => 'Marking_100x100',

    /*
    | Ориентация PDF реестра по умолчанию
    | 'portrait' или 'landscape'
    */
    'scan_sheet_orientation' => 'portrait',

];
