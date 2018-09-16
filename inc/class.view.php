<?php

    abstract class View {
        protected $title = "Main Page";
        protected $css = [];
        protected $js = [];

        function __construct($title=NULL) {
            if($title) {
                $this->title = $title;
            }
        }

        function addJs($filename) {
            $this->js[] = $filename;
        }
        
        function addCss($filename) {
            $this->css[] = $filename;
        }

        abstract function dump();
    }