<?php

class NewCar {
    protected $model;
    protected $euroPrice;
    protected $euroRatePln;

    public function __construct($model, $euroPrice, $euroRatePln) {
        $this->model = $model;
        $this->euroPrice = $euroPrice;
        $this->euroRatePln = $euroRatePln;
    }

    public function calculatePrice() {
        return $this->euroPrice * $this->euroRatePln;
    }

    public function getModel() {
        return $this->model;
    }

    public function getEuroPrice() {
        return $this->euroPrice;
    }

    public function getEuroRatePln() {
        return $this->euroRatePln;
    }
}
?>