<?php

class AboutModel
{
    public $title;
    public $description;

    public function __construct(){
        $this->title = 'About Page';
        $this->description = 'Hey, this is my personal web portfolio.';
    }
}