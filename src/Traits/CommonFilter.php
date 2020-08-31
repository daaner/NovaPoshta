<?php

namespace Daaner\NovaPoshta\Traits;

trait CommonFilter
{
    protected $length;
    protected $width;
    protected $height;
    protected $volumetricWeight;

    /**
     * @param int||string $length
     * @return this
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * @param int||string $width
     * @return this
     */
    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    /**
     * @param int||string $height
     * @return this
     */
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @param int||string $volumetricWeight
     * @return this
     */
    public function setVolumetricWeight($volumetricWeight)
    {
        $this->volumetricWeight = $volumetricWeight;

        return $this;
    }

    /**
     * @return this
     */
    public function getLength()
    {
        if ($this->length) {
            $this->methodProperties['Length'] = $this->length;
        }

        return $this;
    }

    /**
     * @return this
     */
    public function getWidth()
    {
        if ($this->width) {
            $this->methodProperties['Width'] = $this->width;
        }

        return $this;
    }

    /**
     * @return this
     */
    public function getHeight()
    {
        if ($this->height) {
            $this->methodProperties['Height'] = $this->height;
        }

        return $this;
    }

    /**
     * @return this
     */
    public function getVolumetricWeight()
    {
        if ($this->volumetricWeight) {
            $this->methodProperties['VolumetricWeight'] = $this->volumetricWeight;
        }

        return $this;
    }
}
