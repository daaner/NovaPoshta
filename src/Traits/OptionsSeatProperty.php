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
     * @param  string|array  $OptionsSeat  Указание объемного веса массивом или индексом из массива в конфиге
     * @return $this
     */
    public function setOptionsSeat($OptionsSeat): self
    {
        $data = config('novaposhta.options_seat');
        if (is_array($OptionsSeat) === false) {
            $OptionsSeat = explode(',', /** @scrutinizer ignore-type */ $OptionsSeat);
        }
        foreach ($OptionsSeat as $value) {
            try {
                $this->OptionsSeat[] = $data[$value];
            } catch (Exception $e) {
                $this->OptionsSeat[] = $data[1];
            }
        }

        return $this;
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
     * Устанавливаем вес груза. По умолчанию значение из конфига.
     * Не обязательно, если выставляем OptionsSeat, но это не точно.
     *
     * @param  string  $weight  Вес груза
     * @return $this
     */
    public function setWeight(string $weight): self
    {
        $this->Weight = $weight;

        return $this;
    }

    /**
     * Установка веса.
     *
     * @return void
     */
    public function getWeight(): void
    {
        $this->methodProperties['Weight'] = $this->Weight ?: config('novaposhta.weight');
    }
}
