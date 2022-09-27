<?php

namespace Daaner\NovaPoshta\Traits;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Date;

trait DateTimes
{
    protected $dateTime;
    protected $dateTimeFrom;
    protected $dateTimeTo;
    protected $format = 'd.m.Y';
    protected $formatTime = 'd.m.Y H:i:s';

    /**
     * @param  string|Carbon|date  $dateTime
     * @return void
     */
    public function setDateTime($dateTime): void
    {
        $this->dateTime = $this->checkDate($dateTime);
    }

    /**
     * @param  string|Carbon|date  $dateTimeFrom
     * @return void
     */
    public function setDateTimeFrom($dateTimeFrom): void
    {
        $this->dateTimeFrom = $this->checkDate($dateTimeFrom);
    }

    /**
     * @param  string|Carbon|date  $dateTimeTo
     * @return void
     */
    public function setDateTimeTo($dateTimeTo): void
    {
        $this->dateTimeTo = $this->checkDate($dateTimeTo);
    }

    /**
     * @return void
     */
    public function getDateTime(): void
    {
        if ($this->dateTime && (! $this->dateTimeFrom || ! $this->dateTimeTo)) {
            $this->methodProperties['DateTime'] = $this->dateTime;
        }

        if (! $this->dateTime) {
            $this->dateTime = Carbon::now()->format($this->format);
            $this->methodProperties['DateTime'] = $this->dateTime;
        }
    }

    /**
     * @return void
     */
    public function getDateTimeFromTo(): void
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
    }

    /**
     * Странно, но тут с минутами и секундами.
     *
     * @param  string|Carbon|date|null  $from
     * @param  string|Carbon|date|null  $to
     * @return void
     */
    public function getDateFromTo($from = null, $to = null): void
    {
        // DateFrom
        if ($from) {
            $from = $this->checkDate($from, $this->formatTime);
        } else {
            $from = Carbon::now()->addMonth(-3)->format($this->formatTime);
        }

        // DateTo
        if ($to) {
            $to = $this->checkDate($to, $this->formatTime);
        } else {
            $to = Carbon::now()->format($this->formatTime);
        }

        $this->methodProperties['DateFrom'] = $from;
        $this->methodProperties['DateTo'] = $to;
    }

    /**
     * @param  string|Carbon  $date
     * @return string $date
     */
    public function checkDate($date, ?string $format = null): string
    {
        if (! $format) {
            $format = $this->format;
        }

        if ($date instanceof Carbon) {
            $date = $date->format($format);
        } else {
            try {
                $date = Carbon::parse($date)->format($format);
            } catch (Exception $e) {
                $date = Carbon::now()->format($format);
            }
        }

        return $date;
    }
}
