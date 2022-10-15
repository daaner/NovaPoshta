<?php

namespace Daaner\NovaPoshta\Traits;

trait Language
{
    protected $language;

    /**
     * Установка языка.
     *
     * @deprecated Уже не доступна
     *
     * @param  string  $lang
     * @return void
     */
    public function setLanguage(string $lang): void
    {
        $this->language = $lang;
    }

    /**
     * @return void
     */
    public function getLanguage(): void
    {
        if ($this->language && $this->language !== 'ua') {
            $this->methodProperties['Language'] = $this->language;
        }
    }
}
