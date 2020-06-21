<?php

return [

    // GENEGAL
    /**
     * @see https://devcenter.novaposhta.ua/
     *
     */
    'base_uri' => 'https://api.novaposhta.ua/v2.0/',

    /**
     * @see https://devcenter.novaposhta.ua/
     * Supported: "json", "xml" (XML - еще не поддерживается)
     *
     */
    'point' => env('NP_POINT', 'json'),


    // OTHER
    /**
     * Ключ API из личного кабинета
     */
    'api_key' => env('NP_API_KEY', 'api_key'),

    /**
     * Режим отладки запросов
     * Добавляет во все ответы полное тело ответа в переменную `dev` в массив
     */
    'dev' => false,

];
