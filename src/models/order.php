<?php

class Order{
  protected $id;
  protected $customer_id;
  protected $date;
  protected $total_amount;

  public function __construct($id, $customer_id, $date, $total_amount)
  {
    $this->id = $id;
    $this->customer_id = $customer_id;
    $this->date = $date;
    $this->total_amount = $total_amount;
  }

  public function getid() { return $this->id; }
  public function getcustomer_id() { return $this->customer_id; }
  public function getdate() { return $this->date; }
  public function gettotal_amount() { return $this->total_amount; }
}