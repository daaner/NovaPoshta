<?php

namespace Daaner\NovaPoshta\Traits;

use Exception;

trait OptionsSeatProperty
{
    protected $OptionsSeat;
    protected $Weight;

    /**
     * Параметр груза для каждого места отправления.
     * Перебираем значение массива и указываем нужные объемы.
     * Если не указывать значение из конфига в 1 кг.
     *
     * @see https://devcenter.novaposhta.ua/docs/services/556eef34a0fe4f02049c664e/operations/57484280a0fe4f33f0d4dd77
     *
     * @param  string|array  $OptionsSeat
     * @return $this
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
            } catch (Exception $e) {
                $this->OptionsSeat[] = $data[1];
            }
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function getOptionsSeat()
    {
        if (! $this->OptionsSeat) {
            $defaultSeat = [
                'volumetricVolume' => '1',
                'volumetricWidth' => '24',
                'volumetricLength' => '17',
                'volumetricHeight' => '10',
                'weight' => '1',
            ];

            $this->OptionsSeat = $defaultSeat;
        }
        $this->methodProperties['OptionsSeat'] = $this->OptionsSeat;

        return $this;
    }

    /**
     * Устанавливаем вес груза. По умолчанию значение из конфига
     * nit:Daan
     * Не обязательно, если выставляем OptionsSeat, но пока оставлю тут
     *
     * @param  string  $weight
     * @return $this
     */
    public function setWeight(string $weight)
    {
        $this->Weight = $weight;

        return $this;
    }

    /**
     * @return $this
     */
    public function getWeight()
    {
        $this->methodProperties['Weight'] = $this->Weight ?: config('novaposhta.weight');

        return $this;
    }
}
