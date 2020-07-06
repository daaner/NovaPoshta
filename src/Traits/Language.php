<?php

namespace Daaner\NovaPoshta\Traits;

trait Language
{
    protected $language;

    /**
     * @return this
     */
    public function setLanguage($lang)
    {
        $this->language = $lang;

        return $this;
    }

    /**
     * @return this
     */
    public function getLanguage()
    {
        if ($this->language && $this->language !== 'ua') {
            $this->methodProperties['Language'] = $this->language;
        }

        return $this;
    }
}
