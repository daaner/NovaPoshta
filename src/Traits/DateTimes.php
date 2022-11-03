<?php

namespace Daaner\NovaPoshta\Traits;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Date;

trait DateTimes
{
    protected $dateTime;
    protected $dateTimeFrom;
    protected $dateBegin;
    protected $dateEnd;
    protected $dateTimeTo;
    protected $format = 'd.m.Y';
    protected $formatTime = 'd.m.Y H:i:s';

    /**
     * @param  string|Carbon|date  $dateTime  Указание даты
     * @return $this
     */
    public function setDateTime($dateTime): self
    {
        $this->dateTime = $this->checkDate($dateTime);

        return $this;
    }

    /**
     * @param  string|Carbon|date  $dateTimeFrom  С текущей даты
     * @return $this
     */
    public function setDateTimeFrom($dateTimeFrom): self
    {
        $this->dateTimeFrom = $this->checkDate($dateTimeFrom);

        return $this;
    }

    /**
     * @param  string|Carbon|date  $dateTimeTo  До текущей даты
     * @return $this
     */
    public function setDateTimeTo($dateTimeTo): self
    {
        $this->dateTimeTo = $this->checkDate($dateTimeTo);

        return $this;
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
     * @param  string|Carbon|date|null  $from  С текущей даты
     * @param  string|Carbon|date|null  $to  До текущей даты
     * @return void
     */
    public function getDateFromTo($from = null, $to = null): void
    {
        if ($from) {
            $from = $this->checkDate($from, $this->formatTime);
        } else {
            $from = Carbon::now()->/** @scrutinizer ignore-call */subMonths(3)
                ->format($this->formatTime);
        }

        if ($to) {
            $to = $this->checkDate($to, $this->formatTime);
        } else {
            $to = Carbon::now()->format($this->formatTime);
        }

        $this->methodProperties['DateFrom'] = $from;
        $this->methodProperties['DateTo'] = $to;
    }

    /**
     * Проверка даты на валидность.
     *
     * @param  string|Carbon|date  $date  Дата
     * @param  string|null  $format  Формат даты
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

    /**
     * @param  string|Carbon|date  $dateBegin  Дата начала
     * @return $this
     */
    public function setDateBegin($dateBegin): self
    {
        $this->dateBegin = $this->checkDate($dateBegin, $this->format);

        return $this;
    }

    /**
     * @param  string|Carbon|date  $dateEnd  Дата окончания
     * @return $this
     */
    public function setDateEnd($dateEnd): self
    {
        $this->dateEnd = $this->checkDate($dateEnd, $this->format);

        return $this;
    }

    /**
     * @return void
     */
    public function getDateBeginEnd(): void
    {
        if ($this->dateBegin) {
            $this->methodProperties['BeginDate'] = $this->dateBegin;
        }

        if ($this->dateEnd) {
            $this->methodProperties['EndDate'] = $this->dateEnd;
        }
    }
}
