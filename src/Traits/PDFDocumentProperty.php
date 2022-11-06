<?php

namespace Daaner\NovaPoshta\Traits;

trait PDFDocumentProperty
{
    protected $Copies;
    protected $PageFormat;
    protected $Position;
    protected $Type;
    protected $printForm;

    protected $isScansheet;
    protected $PrintOrientation;

    /**
     * Устанавливаем количество копий.
     * 1 - по умолчанию.
     *
     * @param  string  $Copies  Количество копий
     * @return $this
     */
    public function setCopies(string $Copies): self
    {
        $this->Copies = $Copies;

        return $this;
    }

    /**
     * @return void
     */
    public function getCopies(): void
    {
        $this->methodProperties['Copies'] = $this->Copies ?: 1;
    }

    /**
     * Устанавливаем формат страницы.
     * Варианты: A4, A5.
     *
     * @param  string  $PageFormat  Формат страницы
     * @return $this
     */
    public function setPageFormat(string $PageFormat): self
    {
        $this->PageFormat = $PageFormat;

        return $this;
    }

    /**
     * @return void
     */
    public function getPageFormat(): void
    {
        if ($this->PageFormat) {
            $this->methodProperties['PageFormat'] = $this->PageFormat;
        }
    }

    /**
     * Устанавливаем значение Position.
     *
     * @param  string  $Position  Указываем Position
     * @return $this
     */
    public function setPosition(string $Position): self
    {
        $this->Position = $Position;

        return $this;
    }

    /**
     * @return void
     */
    public function getPosition(): void
    {
        $this->methodProperties['Position'] = $this->Position ?: '1';
    }

    /**
     * Устанавливаем тип документа.
     * `pdf` - по умолчанию.
     * Варианты: pdf, pdf8.
     *
     * @param  string  $Type  Указываем Type
     * @return $this
     */
    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    /**
     * @return void
     */
    public function getType(): void
    {
        $this->methodProperties['Type'] = $this->Type ?: 'pdf';
    }

    /**
     * Устанавливаем макет документа.
     * По умолчанию - `Document_new`.
     *
     * Варианты:
     * `Document_new` - полная экспресс накладная
     *                - PageFormat: А4, A5
     *                - Type: pdf
     * `Marking_85x85` - наклейки на А4
     *                 - PageFormat: А4
     *                 - Type: pdf8
     * `Marking_100x100` - наклейки для принтера 100х100
     *                   - PageFormat: null
     *                   - Type: pdf
     *
     * @param  string  $printForm  Указываем макет
     * @return $this
     */
    public function setPrintForm(string $printForm): self
    {
        $this->printForm = $printForm;

        return $this;
    }

    /**
     * @return void
     */
    public function getPrintForm(): void
    {
        if (! $this->printForm) {
            $this->printForm = config('novaposhta.print_form');
        }

        $this->methodProperties['printForm'] = $this->printForm;
    }

    /**
     * Флаг, что данная распечатка является реестром.
     *
     * @param  string|null  $PrintOrientation  Ориентация печати
     * @return $this
     */
    public function setThisIsScansheet(?string $PrintOrientation = null): self
    {
        $this->isScansheet = true;
        $this->printForm = 'ScanSheet';
        $this->PrintOrientation = $PrintOrientation ?: config('novaposhta.scan_sheet_orientation');

        return $this;
    }
}
