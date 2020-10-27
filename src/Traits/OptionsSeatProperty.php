<?php

namespace Daaner\NovaPoshta\Traits;

trait OptionsSeatProperty
{
    protected $OptionsSeat;
    protected $Weight;

    /**
     * @param string|array $OptionsSeat
     * Параметр груза для каждого места отправления
     * Перебираем значение массива и вказываем нужные объемы
     * Если не указывать значение из конфига в 1 кг
     * @see https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/57484280a0fe4f33f0d4dd77
     * @return this
     */
    public function setOptionsSeat($OptionsSeat)
    {
        $data = config('novaposhta.options_seat');
        if (is_array($OptionsSeat) === false) {
            $OptionsSeat = explode(',', /** @scrutinizer ignore-type */ $OptionsSeat);
        }
        foreach ($OptionsSeat as $key => $value) {
            try {
                $this->OptionsSeat[] = $data[$value];
            } catch (\Exception $e) {
                $this->OptionsSeat[] = $data[1];
            }
        }

        return $this;
    }

    public function getOptionsSeat()
    {
        if (! $this->OptionsSeat) {
            $this->OptionsSeat[] = config('novaposhta.options_seat')[10];
        }
        $this->methodProperties['OptionsSeat'] = $this->OptionsSeat;

        return $this;
    }

    /**
     * @param string $Weight
     * Устанавливаем вес груза. По умолчанию значение из конфига
     * nit:Daan
     * Не обязательно, если выставляем OptionsSeat, но пока оставлю тут
     * @return this
     */
    public function setWeight($Weight)
    {
        $this->Weight = $Weight;

        return $this;
    }

    public function getWeight()
    {
        if (! $this->Weight) {
            $this->Weight = config('novaposhta.weight');
        }
        $this->methodProperties['Weight'] = $this->Weight;

        return $this;
    }
}
