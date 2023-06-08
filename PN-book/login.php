<?php
include "dbconnect.php";

if(isset($_POST['submit'])) //kiểm tra biến submit
{
  if($_POST['submit']=="login")
  { 
        $gmail=$_POST['register_Gmail'];
        $username=$_POST['login_username'];
        $password=$_POST['login_password'];
        $query = "SELECT * from users where Gmail='$gmail' and UserName ='$username' AND Password='$password'";
        $result = mysqli_query($con,$query)or die(mysqli_connect_error());
        if(mysqli_num_rows($result) > 0) //kiểm tra xem có tồn tại không
        {
             $row = mysqli_fetch_assoc($result);
             $_SESSION['user']=$row['UserName'];
             header("Location: index.php?login=" . "Đăng nhập thành công");
        }
        else
          echo "Sai tài khoản hoặc mật khẩu hoặc email";
   }
}

?>	
