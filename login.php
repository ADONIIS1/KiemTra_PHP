<?php include_once("header.php");

require_once("entities/user.class.php");
?>



<?php 



    if(isset($_SESSION["user"])!=""){
        header("Location: index.php");
    }
    if(isset($_POST['btn-login'])){
        $u_name = $_POST['txtname'];
        $u_pass = $_POST['txtpass'];
        $user =  User::checkLogin($u_name,  $u_pass);
        if($user){
            session_start();
            $_SESSION['user'] = $u_name;
            header("Location: index.php");
        }else{
            echo "loi";
        }
           
    }
?>
<form method="post" style="width:30%">
    <div class="form-group row">
        <label for="txtname" class="col-sm-2 form-control-label">UserName</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="txtname" placeholder="User Name">
        </div>
    </div>
    <div class="form-group row">
        <label for="txtpass" class="col-sm-2 form-control-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="txtpass" placeholder="Password">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" name="btn-login" value="btn-login" value="Login Up">
        </div>
    </div>
</form>
<?php include_once("footer.php")?>