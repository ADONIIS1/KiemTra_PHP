<?php
require_once("config/db.class.php");
class Category{
    public $cateID;
    public $categoryName;
    public $description;
    public function __construct($cate_Name,$des)
    {
        $this->categoryName = $cate_Name;   
        $this->description = $des;   
    }
    public static function list_category(){
        $db = new Db();
        $sql = "SELECT * FROM category";
        $result = $db->select_to_array($sql);
        return $result;
         
    }
}