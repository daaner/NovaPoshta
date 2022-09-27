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
     * @param  string|array  $OptionsSeat
     * @return void
     */
    public function setOptionsSeat($OptionsSeat): void
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
    }

    /**
     * @return void
     */
    public function getOptionsSeat(): void
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
    }

    /**
     * Устанавливаем вес груза. По умолчанию значение из конфига
     * nit:Daan
     * Не обязательно, если выставляем OptionsSeat, но пока оставлю тут
     *
     * @param  string  $weight
     * @return void
     */
    public function setWeight(string $weight): void
    {
        $this->Weight = $weight;
    }

    /**
     * @return void
     */
    public function getWeight(): void
    {
        $this->methodProperties['Weight'] = $this->Weight ?: config('novaposhta.weight');
    }
}
