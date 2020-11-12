<?php
    class A{
        private $name;
        public function __construct(string $name){
            $this->name = $name;
        }
        public function getName(){
            return $this->name;
        }
        public function setName(string $name){
            $this->name = $name;
        }
        static public function create(){
            return new static("Nowy");
        }
    }
?>