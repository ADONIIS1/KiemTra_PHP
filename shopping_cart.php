<?php include_once("header.php");?>
<?php
    
    require_once("entities/product.class.php");
    require_once("entities/category.class.php");
    $cates = Category::list_category();

    
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    error_reporting(E_ALL);
    ini_set('display_errors','1');
    if(isset($_GET['id'])){
        $pro_id = $_GET["id"];



        $was_found = false;
        $i = 0;
        if(!isset($_SESSION["cart_items"])|| count($_SESSION["cart_items"])<1){
            $_SESSION["cart_items"] = array(0 => array("pro_id" => $pro_id, "quantity" => 1 ));

        }else{
            foreach($_SESSION["cart_items"] as $item){
                $i++;
                foreach ($item as $key => $value) {
                    if($key == "pro_id" && $value == $pro_id){
                        array_splice($_SESSION["cart_items"], $i-1, 1, array(array("pro_id" =>  $pro_id, "quantity" =>
                        $item["quantity"]+1)));
                        $was_found = true;
                    }
                }
            }
            if($was_found == false){
                array_push($_SESSION["cart_items"], array("pro_id" => $pro_id, "quantity"=> 1));
            }
        }
        header("location: shopping_cart.php");
    }


    function remove_cart_data() {
        unset($_SESSION['cart_items']);
    }
    
    // Check if the button has been clicked
    if(isset($_POST['remove_cart_button'])) {
        remove_cart_data();
        header("location: list_product.php");
    }
    
    ?>


<div class="container text-center">
    <div class="col-sm-3">
        <h3>Danh mục</h3>
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
        <h3>Thông tin giỏ hàng</h3><br>
        <table class="table table-condensed">
            <thead>
                <tr>
                    <th>Tên sản Phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_money = 0;
                if(isset($_SESSION["cart_items"]) && count($_SESSION["cart_items"])>0){
                    foreach($_SESSION["cart_items"] as $item){
                        $id = $item["pro_id"];
                        $product = Product::get_product($id);
                        $prod = reset($product);
                        $total_money += $item["quantity"]*$prod["Price"];
                        $total_money_sp = $item["quantity"]*$prod["Price"];

                        echo "<tr>
                                <td>".$prod["ProductName"]."</td>
                                <td><img style = 'width:90px; height:80px' src=".$prod["Picture"]."/></td>
                                <td>".$item["quantity"]."</td>
                                <td>".$prod["Price"]."</td>
                                <td>".$total_money_sp."</td>
                            </tr>";   
                    }
                        echo "
                            <tr>
                                <td colspan=5>
                                    <p class='text-right text-danger'>Tổng tiền: ".$total_money."</p> 
                                </td>
                            </tr>"
                         ?>
                            <tr>
                                <td colspan=3>
                                    <p class='text-right'>
                                        <button style="margin-top: 10px;" type='button' onclick="location.href= '/list_product.php'" class='btn btn-primary'> Tiếp tục mua hàng</button>
                                    </p>
                                </td>
                                <td colspan=2>
                                    <p class='text-right'>
                                    <form method="post">
                                        <button type="submit" name="remove_cart_button" class='btn btn-success'>Thanh toán</button>
                                    </form>

                                    </p>
                                </td>
                            </tr>
                <?php
                }
                else{
                    echo"Không có sản phẩm nào trong giỏ hàng!";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php include_once('footer.php');