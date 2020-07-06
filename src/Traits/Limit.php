<?php

namespace Daaner\NovaPoshta\Traits;

trait Limit
{
    /**
     * @see
     */
    protected $limit;
    protected $page;

    /**
     * @return int
     */
    public function setLimit($limit)
    {
        $this->limit = (int) $limit;

        return $this;
    }

    /**
     * @return int
     */
    public function setPage($page)
    {
        $this->page = (int) $page;

        return $this;
    }

    /**
     * @return int
     */
    public function addLimit()
    {
        if ($this->limit === 0) {
            return $this;
        }

        if (! $this->limit) {
            $this->limit = config('novaposhta.page_limit');
        }

        $this->methodProperties['Limit'] = $this->limit;

        return $this;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        if ($this->page === 0) {
            return $this;
        }

        $this->methodProperties['Page'] = $this->page;

        return $this;
    }
}
