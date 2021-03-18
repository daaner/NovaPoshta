<?php

namespace Daaner\NovaPoshta\Traits;

use Carbon\Carbon;

trait DateTimes
{
    protected $dateTime;
    protected $dateTimeFrom;
    protected $dateTimeTo;
    protected $format = 'd.m.Y';
    protected $formatTime = 'd.m.Y H:i:s';

    /**
     * @param string|Carbon|date $dateTime
     * @return this
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $this->checkDate($dateTime);

        return $this;
    }

    /**
     * @param string|Carbon|date $dateTimeFrom
     * @return this
     */
    public function setDateTimeFrom($dateTimeFrom)
    {
        $this->dateTimeFrom = $this->checkDate($dateTimeFrom);

        return $this;
    }

    /**
     * @param string|Carbon|date $dateTimeTo
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
        if ($this->dateTime && (! $this->dateTimeFrom || ! $this->dateTimeTo)) {
            $this->methodProperties['DateTime'] = $this->dateTime;
        }

        if (! $this->dateTime) {
            $this->dateTime = Carbon::now()->format($this->format);
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
            if (! $this->dateTimeTo) {
                $this->dateTimeTo = Carbon::now()->format($this->format);
            }
            if (! $this->dateTimeFrom) {
                $this->dateTimeFrom = $this->dateTimeTo;
            }

            $this->methodProperties['DateTimeFrom'] = $this->dateTimeFrom;
            $this->methodProperties['DateTimeTo'] = $this->dateTimeTo;
        }

        return $this;
    }

    /**
     * Странно, но тут с минутами и секундами.
     * @param string|Carbon|date|null $from
     * @param string|Carbon|date|null $to
     * @return this
     */
    public function getDateFromTo($from = null, $to = null)
    {
        // DateFrom
        if ($from) {
            if ($from instanceof Carbon) {
                $from = $from->format($this->formatTime);
            } else {
                try {
                    $from = Carbon::parse($from)->format($this->formatTime);
                } catch (\Exception $e) {
                    $from = Carbon::now()->addMonth(-3)->format($this->formatTime);
                }
            }
        } else {
            $from = Carbon::now()->addMonth(-3)->format($this->formatTime);
        }

        // DateTo
        if ($to) {
            if ($to instanceof Carbon) {
                $to = $to->format($this->formatTime);
            } else {
                try {
                    $to = Carbon::parse($to)->format($this->formatTime);
                } catch (\Exception $e) {
                    $to = Carbon::now()->format($this->formatTime);
                }
            }
        } else {
            $to = Carbon::now()->format($this->formatTime);
        }

        $this->methodProperties['DateFrom'] = $from;
        $this->methodProperties['DateTo'] = $to;

        return $this;
    }

    /**
     * @param string|Carbon $date
     * @return string $date
     */
    public function checkDate($date)
    {
        if ($date instanceof Carbon) {
            $date = $date->format($this->format);
        } else {
            try {
                $date = Carbon::parse($date)->format($this->format);
            } catch (\Exception $e) {
                $date = Carbon::now()->format($this->format);
            }
        }

        return $date;
    }
}
