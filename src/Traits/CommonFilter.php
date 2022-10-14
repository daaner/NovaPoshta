<?php

namespace Daaner\NovaPoshta\Traits;

trait CommonFilter
{
    protected $length;
    protected $width;
    protected $height;
    protected $volumetricWeight;

    /**
     * @param  int|string  $length Длина
     * @return void
     */
    public function setLength($length): void
    {
        $this->length = $length;
    }

    /**
     * @param  int|string  $width Ширина
     * @return void
     */
    public function setWidth($width): void
    {
        $this->width = $width;
    }

    /**
     * @param  int|string  $height Высота
     * @return void
     */
    public function setHeight($height): void
    {
        $this->height = $height;
    }

    /**
     * @param  int|string  $volumetricWeight Объемный вес
     * @return void
     */
    public function setVolumetricWeight($volumetricWeight): void
    {
        $this->volumetricWeight = $volumetricWeight;
    }

    /**
     * @return void
     */
    public function getLength(): void
    {
        if ($this->length) {
            $this->methodProperties['Length'] = $this->length;
        }
    }

    /**
     * @return void
     */
    public function getWidth(): void
    {
        if ($this->width) {
            $this->methodProperties['Width'] = $this->width;
        }
    }

    /**
     * @return void
     */
    public function getHeight(): void
    {
        if ($this->height) {
            $this->methodProperties['Height'] = $this->height;
        }
    }

    /**
     * @return void
     */
    public function getVolumetricWeight(): void
    {
        if ($this->volumetricWeight) {
            $this->methodProperties['VolumetricWeight'] = $this->volumetricWeight;
        }
    }
}
