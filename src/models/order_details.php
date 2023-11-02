<?php 

class OrderDetails{
  protected $id;
  protected $order_id;
  protected $product_id;
  protected $quantity;
  protected $price;

  public function __construct($id, $order_id, $product_id, $quantity, $price)
  {
    $this->id = $id;
    $this->order_id = $order_id;
    $this->product_id = $product_id;
    $this->quantity = $quantity;
    $this->price = $price;
  }

  public function getid() { return $this->id; }
  public function getorder_id() { return $this->order_id; }
  public function getproduct_id() { return $this->product_id; }
  public function getquantity() { return $this->quantity; }
  public function getprice() { return $this->price; }
}