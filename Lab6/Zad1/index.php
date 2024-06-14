<?php

require_once 'NewCar.php';
require_once 'CarWithAdditions.php';
require_once 'Insurance.php';

$model = "Chevrolet Camaro";
$euroPrice = 50000;
$euroRatePln = 4.5;
$alarm = 2000;
$radio = 1500;
$airConditioning = 3000;
$insurancePercent = 0.05;
$ownershipYears = 3;

$car = new NewCar($model, $euroPrice, $euroRatePln);
echo "Base price in PLN: " . $car->calculatePrice() . " PLN<br>";

$carWithAdditions = new CarWithAdditions($model, $euroPrice, $euroRatePln, $alarm, $radio, $airConditioning);
echo "Price with additions in PLN: " . $carWithAdditions->calculatePrice() . " PLN<br>";

$insurance = new Insurance($model, $euroPrice, $euroRatePln, $alarm, $radio, $airConditioning, $insurancePercent, $ownershipYears);
echo "Price with insurance in PLN: " . $insurance->calculatePrice() . " PLN<br>";

?>