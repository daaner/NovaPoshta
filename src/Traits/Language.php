<?php

namespace Daaner\NovaPoshta\Traits;

trait Language
{
    protected $language;

    /**
     * Установка языка.
     * С недавних пор русский язык выпилили.
     * Часть английских названий приходит вместе с украинскими в другом ключе.
     *
     * @deprecated Уже не доступна
     *
     * @param  string  $lang
     * @return $this
     */
    public function setLanguage(string $lang): self
    {
        $this->language = $lang;

        return $this;
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
