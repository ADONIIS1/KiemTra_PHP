<?php
    require_once("entities/product.class.php");
    require_once("entities/category.class.php")
?>
<?php include ("header.php");?>
<?php
    if(!isset($_GET["cateid"])){
        $prods = Product::list_product();
    }else{
        $cateid = $_GET["cateid"];
        $prods = Product::list_product_by_cateid($cateid);
    }
    $cates = Category::list_category();
?>

<div class="container text-center">
    <div class="col-sm-3">
    <h3 class="panel-heading">Danh Mục</h3>
        <ul class="list-group">
            <?php
            foreach($cates as $item)
            {
                echo"<li class='list-group-item'><a 
                href=/list_product.php?cateid=".$item["CateID"].">".$item["CategoryName"]."</a></li>";
            }
            ?>
        </ul>
    </div>
    <div class="col-sm-9">
        <h3>Sản phẩm cửa Hàng</h3>
        <div class="row">
            <?php
            $length = sizeof($prods);
            if($length <= 0){
                include ("not_found.php");
            }else{
                foreach($prods as $item){
                    ?>
                    <div class="col-sm-4">
                        <a href="/product_detail.php?id=<?php echo $item["ProductID"];?>">
                            <img src="<?php echo "/".$item["Picture"];?>" class="img-responsive" style="width: 50%; height:50%" alt="Image">
                        </a>
                        <p class="text-danger"><?php echo $item["ProductName"]?></p>
                        <p class="text-info"><?php echo $item["Price"]?></p>
                        <p>
                            <a type="button" href="/product_detail.php?id=<?php echo $item["ProductID"];?>" class="btn btn-primary"> Mua Hàng</a>
                        </p>
                    </div>
                <?php }
            }?>
            
        </div>
    </div>
</div>
<?php
include("footer.php");