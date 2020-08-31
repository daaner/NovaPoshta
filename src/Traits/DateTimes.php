<?php

namespace Daaner\NovaPoshta\Traits;

use Carbon\Carbon;

trait DateTimes
{
    protected $dateTime;
    protected $dateTimeFrom;
    protected $dateTimeTo;
    protected $format = 'd.m.Y';

    /**
     * @param string||Carbon||date $dateTime
     * @return this
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $this->checkDate($dateTime);

        return $this;
    }

    /**
     * @param string||Carbon||date $dateTimeFrom
     * @return this
     */
    public function setDateTimeFrom($dateTimeFrom)
    {
        $this->dateTimeFrom = $this->checkDate($dateTimeFrom);

        return $this;
    }

    /**
     * @param string||Carbon||date $dateTimeTo
     * @return this
     */
    public function setDateTimeTo($dateTimeTo)
    {
        $this->dateTimeTo = $this->checkDate($dateTimeTo);

        return $this;
    }

    /**
     * @return this
     */
    public function getDateTime()
    {
        if ($this->dateTime && (!$this->dateTimeFrom || !$this->dateTimeTo)) {
            $this->methodProperties['DateTime'] = $this->dateTime;
        }

        return $this;
    }

    /**
     * @return this
     */
    public function getDateTimeFromTo()
    {
        if ($this->dateTimeFrom || $this->dateTimeTo) {
            if (!$this->dateTimeTo) {
                $this->dateTimeTo = Carbon::now()->format($this->format);
            }
            if (!$this->dateTimeFrom) {
                $this->dateTimeFrom = $this->dateTimeTo;
            }

            $this->methodProperties['DateTimeFrom'] = $this->dateTimeFrom;
            $this->methodProperties['DateTimeTo'] = $this->dateTimeTo;
        }

        return $this;
    }

    /**
     * @param string||Carbon||date $date
     * @return $date
     */
    public function checkDate($date)
    {
        if ($date instanceof Carbon) {
            $date = $date->format($this->format);
        } else {
            try {
                $date = Carbon::parse($date)->format($this->format);
            } catch (\Exception $e) {
                $date = null;
            }
        }

        return $date;
    }
}
