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
     * @return $this
     */
    public function setLimit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * Установка страницы.
     *
     * @param  int  $page  Номер страницы данных
     * @return $this
     */
    public function setPage(string $page): self
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @return void
     */
    public function getLimit(): void
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
