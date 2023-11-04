<?php

class Customer{
  protected $id;
  protected $name;
  protected $address;
  protected $email;
  protected $password;

  public function __construct($name, $address, $email, $password)
  {
    $this->name = $name;
    $this->address = $address;
    $this->email = $email;
    $this->password = $password;
  }

  public function getid() { return $this->id; }
  public function getname() { return $this->name; }
  public function getaddress() { return $this->address; }
  public function getemail() { return $this->email; }
  public function getpassword() { return $this->password; }
}