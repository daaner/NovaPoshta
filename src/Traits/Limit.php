<?php

namespace Daaner\NovaPoshta\Traits;

trait Limit
{
    protected $limit;
    protected $page;

    /**
     * @param int $limit
     * @return $this
     */
    public function setLimit(int $limit)
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * @param int $page
     * @return $this
     */
    public function setPage(int $page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @return $this
     */
    public function addLimit()
    {
        if ($this->limit) {
            $this->methodProperties['Limit'] = $this->limit;
        }

        // nit: Daan
        // подумать, нужно ли по умолчанию лимит передавать из конфига
        // if (! $this->limit) {
        //     $this->limit = config('novaposhta.page_limit');
        // }

        return $this;
    }

    /**
     * @return $this
     */
    public function getPage()
    {
        if ($this->page) {
            $this->methodProperties['Page'] = $this->page;
        }

        return $this;
    }
}
