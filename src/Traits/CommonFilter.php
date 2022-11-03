<?php

namespace Daaner\NovaPoshta\Traits;

trait CommonFilter
{
    protected $length;
    protected $width;
    protected $height;
    protected $volumetricWeight;

    /**
     * @param  int|string  $length  Длина
     * @return $this
     */
    public function setLength($length): self
    {
        $this->length = $length;

        return $this;
    }

    /**
     * @param  int|string  $width  Ширина
     * @return $this
     */
    public function setWidth($width): self
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @param  int|string  $height  Высота
     * @return $this
     */
    public function setHeight($height): self
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @param  int|string  $volumetricWeight  Объемный вес
     * @return $this
     */
    public function setVolumetricWeight($volumetricWeight): self
    {
        $this->volumetricWeight = $volumetricWeight;

        return $this;
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
