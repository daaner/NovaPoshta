<?php

return [

    // GENEGAL
    /**
     * @see https://devcenter.novaposhta.ua/
     */
    'base_uri' => 'https://api.novaposhta.ua/v2.0/',

    /**
     * @see https://devcenter.novaposhta.ua/
     * Supported: "json", "xml" (XML - еще не поддерживается и вряд ли будет)
     */
    'point' => env('NP_POINT', 'json'),

    // OTHER
    /**
     * Ключ API из личного кабинета.
     */
    'api_key' => env('NP_API_KEY', 'api_key'),

    /**
     * Режим отладки запросов
     * Добавляет во все ответы полное тело ответа в переменную `dev` в массив.
     */
    'dev' => false,

    /**
     * Лимит списка по умолчанию
     * максимальное значение для всего 500, для улиц - 1500.
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
    | Значения берутся из справочников. Строго по документации Новой почты
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Отправитель
    |--------------------------------------------------------------------------
    |
    | Если отправителей несколько - укажите одного, а других передавайте перед сохранением
    |
    */

    /**
     * Идентификатор отправителя по умолчанию.
     */
    'sender' => '5ace4a2e-13ee-11e5-add9-005056887b8d',

    /**
     * Идентификатор города отправителя по умолчанию.
     */
    'city_sender' => '8d5a980d-391c-11dd-90d9-001a92567626',

    /**
     * Идентификатор адреса отправителя по умолчанию.
     */
    'sender_address' => 'd492290b-55f2-11e5-ad08-005056801333',

    /**
     * Идентификатор контактного лица отправителя по умолчанию.
     */
    'contact_sender' => '613b77c4-1411-11e5-ad08-005056801333',
    /**
     * Телефон отправителя в формате: +380660000000, 380660000000, 0660000000 по умолчанию.
     */
    'senders_phone' => '380991234567',

    /**
     * RecipientType по умолчанию
     * Если получатель юридическое лицо - нужно указывать дополнительные данные.
     * @see https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/56261f14a0fe4f1e503fe187
     *
     * 'PrivatePerson', 'Organization'
     */
    'recipient_type' => 'PrivatePerson',

    /**
     * ServiceType по умолчанию.
     *
     * 'DoorsDoors', 'DoorsWarehouse', 'WarehouseWarehouse', 'WarehouseDoors'
     */
    'service_type' => 'WarehouseWarehouse',

    /**
     * CargoType по умолчанию.
     *
     * 'Cargo', 'Documents', 'TiresWheels', 'Pallet', 'Parcel'
     */
    'cargo_type' => 'Parcel',

    /**
     * PaymentMethod по умолчанию.
     *
     * 'Cash', 'NonCash'
     */
    'payment_method' => 'Cash',

    /**
     * PayerType по умолчанию.
     *
     * 'Sender', 'Recipient', 'ThirdPerson'
     */
    'payer_type' => 'Recipient',

    /**
     * PayerType для BackwardDeliveryData по умолчанию
     * Sender - отправитель посылки платит за возврат документов или денег
     * Recipient - получатель посылки платит за возврат документов или денег
     * Третья особа НЕ может выступать плательщиком
     *
     * 'Sender', 'Recipient'
     */
    'back_delivery_payer_type' => 'Recipient',

    /**
     * CargoType для BackwardDeliveryData по умолчанию: 'Money' - деньги
     * Для некоторых типов нужны дополнительные параметры (не реализовано). Смотрите документацию.
     * @see https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/575fe852a0fe4f0aa0754760
     *
     * 'Money', 'CreditDocuments', 'SignedDocuments', 'Trays' (пока не доступна в НП),
     * 'Documents', 'Other'
     */
    'back_delivery_cargo_type' => 'Money',

    /**
     * Description по умолчанию (описание посылки).
     */
    'description' => 'Груз',

    /**
     * Целое число, количество мест отправления по умолчанию.
     */
    'seats_amount' => 1,

    /**
     * Целое число, объявленная стоимость по умолчанию.
     */
    'cost' => 300,

    /**
     * Вес посылки по умолчанию.
     */
    'weight' => 1,

    /**
     * Параметры груза по умолчанию.
     *
     * Массив коробок для быстрого выбора обхемного груза
     * Объемный вес (кг) = (Длина(см) × Ширина(см) × Высота(см)) / 4 000
     * Если выбрать значение не из массива - примется значение 1кг. Оставляйте его
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

];
