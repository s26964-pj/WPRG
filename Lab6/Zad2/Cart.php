<?php

require_once 'Product.php';

class Cart {
    private $products;

    public function __construct() {
        $this->products = [];
    }

    public function addProduct(Product $product) {
        $this->products[] = $product;
    }

    public function removeProduct(Product $product) {
        foreach ($this->products as $key => $prod) {
            if ($prod->getName() === $product->getName()) {
                unset($this->products[$key]);
                $this->products = array_values($this->products);
                break;
            }
        }
    }

    public function getTotal() {
        $total = 0;
        foreach ($this->products as $product) {
            $total += $product->getPrice() * $product->getQuantity();
        }
        return $total;
    }

    public function __toString() {
        $output = "Products in cart:<br>";
        foreach ($this->products as $product) {
            $output .= $product . "<br>";
        }
        $output .= "Total price: " . $this->getTotal();
        return $output;
    }
}

?>