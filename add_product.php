<?php
require_once("entities/product.class.php");
require_once("entities/category.class.php");

if(isset($_POST["btnsubmit"])) {

    $productName = $_POST["txtName"];

    $cateID = $_POST["txtCateID"];
    $price = $_POST["txtprice"];
    $quantity = $_POST["txtquantity"];
    $description = $_POST["txtdesc"];
    $picture = $_FILES["txtpic"];
    $newProduct = new Product($productName,$cateID,$price,$quantity,$description,$picture);
    $result = $newProduct->save();

    if(!$result){

        header("Location: add_product.php?failure");
    }
    else{
        header("Location: add_product.php?inserted");

    }
}
?>

<?php include_once("header.php"); ?>

<?php 
    if(isset($_Get["inserted"])){
        echo "<h2> Thêm sản phẩm thành công <h2>";

    }
?>

<?php 
    echo isset($_POST["txtName"]) ? $_POST["txtName"] : ""; 
?>



<form method="POST" enctype="multipart/form-data" style="padding-left: 400px">
    <div class="row">
        <div class="lbltitle">
            <label for="txtName">Tên sản phẩm</label>
        </div>

        <div class="lblinput">
            <input type="text" name="txtName" value="<?php echo isset($_POST["txtName"]) ? $_POST["txtName"] : ""; ?>">
        </div>

    </div>

    </br>
    <div class="row">

        <div class="lbltitle">

            <label for="txtdesc"> Mô tả sản phẩm</label>
        </div>

        <div class="lblinput">
            <textarea name="txtdesc" cols="21" rows="10"
                value="<?php echo isset($_POST["txtdesc"]) ? $_POST["txtdesc"] : ""; ?>"></textarea>
        </div>
    </div>
    </br>
    <div class="row">

        <div class="lbltitle">

            <label for="txtquantity"> số lượng sản phẩm</label>
        </div>

        <div class="lblinput">
             <input type="text" name="txtquantity" value="<?php echo isset($_POST["txtquantity"]) ? $_POST["txtquantity"] : ""; ?>">
        </div>
    </div> 
    </br>
        <div class="row">

        <div class="lbltitle">

            <label for="txtprice"> giá sản phẩm</label>
        </div>

        <div class="lblinput">
        <input type="text" name="txtprice" value="<?php echo isset($_POST["txtprice"]) ? $_POST["txtprice"] : ""; ?>">
        </div>
    </div> 
    </br>
    <div class="row">

        <div class="lbltitle">

            <label for="txtCateID"> Loại sản phẩm</label>
        </div>

        <div class="lblinput">
            <select class="form-control" name="txtCateID" style="width:300px">
                <option value=""  selected>-- Chọn Loại --</option>
                <?php
                    $cates = Category::list_category();
                    foreach($cates as $item){
                        echo "<option value = ".$item["CateID"].">".$item["CategoryName"]."</option>";
                    }
                ?>
            </select>
        </div>
    </div> 
    </br>
    <div class="row">

        <div class="lbltitle">

            <label for="">Hinh ảnh sản phẩm</label>
        </div>

        <div class="lblinput">
        <input type="file" name="txtpic" accept=".PNG,.GIF,.JPG" value="<?php echo isset($_POST["txtpic"]) ? $_POST["txtpic"] : ""; ?>">
        </div>
    </div>
        
</br>
    <div class="row">
        <div class="submit">
            <input type="submit" name="btnsubmit" value="Thêm sản phẩm">
        </div>
    </div>

</form>

<?php include_once("footer.php");   ?>