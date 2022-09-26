<?php

class Cart {

    private array $items = [

    ];

    public function getItems()
    {
        return $this->items;
    }

    public function addProduct(Product $product, int $quantity) 
    {
        
        $cartItem = $this->findCartItem($product->getId());

        if($cartItem == null) {
            $cartItem = new CartItem($product, 0);
            $this->items[$product->getId()] = $cartItem;
        }

        $cartItem->increaseQuantity($quantity);
        return $cartItem;

    }

    public function findCartItem(int $productId)
    {
        return $this->items[$productId] ?? null;
    }

    public function getTotalQuantity() 
    {
        $totalQuant = 0;
        foreach($this->items as $item) {
            $totalQuant += $item->getQuantity();
        }
        return $totalQuant;
    }

    public function getTotalSum() 
    {
        $totalSum = 0;
        foreach ($this->items as $item) {
            $totalSum += ($item->getQuantity() * $item->getProduct()->getPrice());
        }
        return $totalSum;
    }

    public function removeProduct(Product $product)
    {
        unset($this->items[$product->getId()]);
    }

}