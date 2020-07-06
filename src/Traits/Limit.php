<?php

namespace Daaner\NovaPoshta\Traits;

trait Limit
{
    protected $limit;
    protected $page;
    protected $methodProperties;

    /**
     * @return this
     */
    public function setLimit($limit)
    {
        $this->limit = (int) $limit;

        return $this;
    }

    /**
     * @return this
     */
    public function setPage($page)
    {
        $this->page = (int) $page;

        return $this;
    }

    /**
     * @return this
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
     * @return this
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
