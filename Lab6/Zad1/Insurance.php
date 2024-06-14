<?php

require_once 'CarWithAdditions.php';

class Insurance extends CarWithAdditions {
    private $insurancePercent;
    private $ownershipYears;

    public function __construct($model, $euroPrice, $euroRatePln, $alarm, $radio, $airConditioning, $insurancePercent, $ownershipYears) {
        parent::__construct($model, $euroPrice, $euroRatePln, $alarm, $radio, $airConditioning);
        $this->insurancePercent = $insurancePercent;
        $this->ownershipYears = $ownershipYears;
    }

    public function calculatePrice() {
        $carPriceWithAdditions = parent::calculatePrice();
        $discount = (100 - $this->ownershipYears) / 100;
        $insurancePrice = $this->insurancePercent * $carPriceWithAdditions * $discount;
        return $carPriceWithAdditions + $insurancePrice;
    }
}
?>