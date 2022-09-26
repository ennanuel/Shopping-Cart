<?php

class CartItem {

    private Product $product;
    private int $quantity;

    public function __construct(Product $product, int $quantity) 
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function setProduct($product)
    {
        $this->product = $product;
    }

    public function getProduct()
    {
        return $this->product;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function increaseQuantity($amount = 1) 
    {
        if(($this->getQuantity() + $amount) > $this->getProduct()->getAvailableQuant()) {
            throw new Exception (message: "Product quantity cannot be more than " .$this->product->getAvailableQuant());
        }
        $this->quantity += $amount;
    }

    public function decreaseQuantity($amount = 1) 
    {
        if(($this->getQuantity() - $amount) < 1) {
            throw new Exception (message: "Product quantity cannot be less than 1");
        }
        $this->quantity -= $amount;
    }

}