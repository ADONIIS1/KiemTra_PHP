<?php
require_once("config/db.class.php");



class Product{
    public  $productID; 
    public  $productName; 
    public	$cateID; 
    public	$price; 
    public	$quantity; 
    public	$desciption; 
    public	$picture;	

    public function __construct($pro_name, $cate_id,$price,$quantity,$des, $picture)
    {
        $this->productName = $pro_name;
        $this->cateID = $cate_id;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->desciption = $des;
        $this->picture = $picture;
        
    }
    public function save()
    {

        $file_temp = $this->picture['tmp_name'];
        $user_file = $this->picture['name'];
        $timestamp = date("Y").date("m").date("d").date("h").date("i").date("s");
        $filepath = "uploads/".$timestamp.$user_file;
        if(move_uploaded_file($file_temp,$filepath)== false){
            return false;
        }



        $db = new Db();
        $sql = "INSERT INTO Product(ProductName, CateID, Price, Quantity,Desciption,Picture) VALUES 
        ('$this->productName','$this->cateID','$this->price','$this->quantity','$this->desciption','$filepath')";
        $result = $db->query_execute($sql);

        return $result;
       
    }

    public static function list_product()
    {
        $db = new Db();
        $sql = "SELECT * FROM product";
        $result = $db->select_to_array($sql);
        return $result;
        # code...
    }

    public static function list_product_by_cateid($cateid){
        $db = new Db();
        $sql = "SELECT * FROM product where cateID = '$cateid'";
        $result = $db->select_to_array($sql);
        return $result;
    }
}