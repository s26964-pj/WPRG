<?php

require_once 'Product.php';
require_once 'Cart.php';

$product1 = new Product("Laptop", 1500, 1);
$product2 = new Product("Phone", 500, 2);

$cart = new Cart();
$cart->addProduct($product1);
$cart->addProduct($product2);

echo $cart;

$cart->removeProduct($product1);

echo "<br>After removing a product:<br>";
echo $cart;

?>