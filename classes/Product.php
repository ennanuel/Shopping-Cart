<?php

class Product {

    private int $id;
    private string $title;
    private float $price;
    private int $availableQuantity;

    public function __construct(int $id, string $title, float $price, int $availableQuantity) {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->availableQuantity = $availableQuantity;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId() 
    {
        return $this->id;
    }

    public function setAvailableQuant($availableQuant)
    {
        $this->availableQuantity = $availableQuant;
    }

    public function getAvailableQuant() 
    {
        return $this->availableQuantity;
    }

    public function addToCart(Cart $cart, int $quantity)
    {
        return $cart->addProduct($this, $quantity);
    }

    public function removeFromCart(Cart $cart)
    {
        $cart->removeProduct($this);
    }

    public function getPrice()
    {
        return $this->price;
    }

}