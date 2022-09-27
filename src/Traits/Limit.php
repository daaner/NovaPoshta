<?php

namespace Daaner\NovaPoshta\Traits;

trait Limit
{
    protected $limit;
    protected $page;

    /**
     * @param  int  $limit
     * @return void
     */
    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    /**
     * @param  int  $page
     * @return void
     */
    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    /**
     * @return void
     */
    public function addLimit(): void
    {
        if ($this->limit) {
            $this->methodProperties['Limit'] = $this->limit;
        }

        // nit: Daan
        // подумать, нужно ли по умолчанию лимит передавать из конфига
        // if (! $this->limit) {
        //     $this->limit = config('novaposhta.page_limit');
        // }
    }

    /**
     * @return void
     */
    public function getPage(): void
    {
        if ($this->page) {
            $this->methodProperties['Page'] = $this->page;
        }
    }
}
