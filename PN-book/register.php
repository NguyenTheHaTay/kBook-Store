<?php

include "dbconnect.php";


if(isset($_POST['submit']))
{
   if($_POST['submit']=="register")
     {
        $gmail=$_POST['register_gmail'];
        $username=$_POST['register_username'];
        $password=$_POST['register_password'];
        $query="select * from users where UserName = '$username'";
        $result=mysqli_query($con,$query) or die(mysqli_connect_error());
        if(mysqli_num_rows($result)>0)
        {
              header("Location: index.php?register=" . "Tên đăng nhập đã có Hãy dùng tên khác");
        }
        else
        {
          $query ="INSERT INTO users VALUES ('$username','$password')";
          $result=mysqli_query($con,$query);
          header("Location: index.php?register=" . "Đăng nhập thành công!!");
        }
    }
}

?>