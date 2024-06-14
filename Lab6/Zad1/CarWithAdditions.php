<?php

require_once 'NewCar.php';

class CarWithAdditions extends NewCar {
    private $alarm;
    private $radio;
    private $airConditioning;

    public function __construct($model, $euroPrice, $euroRatePln, $alarm, $radio, $airConditioning) {
        parent::__construct($model, $euroPrice, $euroRatePln);
        $this->alarm = $alarm;
        $this->radio = $radio;
        $this->airConditioning = $airConditioning;
    }

    public function calculatePrice() {
        $basePricePLN = parent::calculatePrice();
        $additionsPrice = $this->alarm + $this->radio + $this->airConditioning;
        return $basePricePLN + $additionsPrice;
    }
}
?>