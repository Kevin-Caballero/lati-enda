<?php

class Product{
    protected $id;
    protected $name;
    protected $descripcion;
    protected $category_id;
    protected $image_url;
    protected $price;
    protected $stock;

    public function __construct($id, $name, $descripcion, $category_id, $image_url, $price, $stock)
    {
        $this->id = $id;
        $this->name = $name;
        $this->descripcion = $descripcion;
        $this->category_id = $category_id;
        $this->image_url = $image_url;
        $this->price = $price;
        $this->stock = $stock;
    }

    public function getid() { return $this->id; }

    public function getname() { return $this->name; }

    public function getdescripcion() { return $this->descripcion; }

    public function getcategory_id() { return $this->category_id; }

    public function getimage_url() { return $this->image_url; }

    public function getprice() { return $this->price; }

    public function getstock() { return $this->stock; }
}
