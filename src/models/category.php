<?php

class Category{
  protected $id;
  protected $name;
  protected $image_url;

  public function __construct($id, $name, $image_url)
  {
    $this->id = $id;
    $this->name = $name;
    $this->image_url = $image_url;
  }

  public function getid() { return $this->id; }
  public function getname() { return $this->name; }
  public function getimage_url() { return $this->image_url; }
}