<?php

namespace Daaner\NovaPoshta\Traits;

trait Limit
{
    protected $limit;
    protected $page;

    /**
     * Установка лимита записей.
     *
     * @param  int  $limit  Лимит записей
     * @return void
     */
    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    /**
     * Установка страницы.
     *
     * @param  int  $page  Номер страницы данных
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
