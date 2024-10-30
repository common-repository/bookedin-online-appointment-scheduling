<?php
class ButtonConfig {
    public $config;
    public $backgroundColor;
    public $bottomColor;
    public $textColor;
    public $isSmall;
    public $buttonText;
    public $companyToken;
    public $textWidth;
    public $textMargin;
    public $iconWidth;
    public $height;
    public $fontSize;

    public function buildArray() {
        return array(
            'config' => $this->config,
            'backgroundColor' => $this->backgroundColor,
            'bottomColor' => $this->bottomColor,
            'textColor' => $this->textColor,
            'isSmall' => $this->isSmall,
            'buttonText' => $this->buttonText,
            'companyToken' => $this->companyToken,
            'textWidth' => $this->textWidth,
            'textMargin' => $this->textMargin,
            'iconWidth' => $this->iconWidth,
            'height' => $this->height,
            'fontSize' => $this->fontSize,
        );
    }
}