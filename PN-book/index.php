<?php
session_start();
include "dbconnect.php";

if (isset($_GET['Message'])) {
    print '<script type="text/javascript">
               alert("' . $_GET['Message'] . '");
           </script>';
}

if (isset($_GET['response'])) {
    print '<script type="text/javascript">
               alert("' . $_GET['response'] . '");
           </script>';
}

if(isset($_POST['submit']))
{
  if($_POST['submit']=="login")
  { 
        $gmail=$_POST['register_Gmail'];
        $username=$_POST['login_username'];
        $password=$_POST['login_password'];
        $query = "SELECT * from users where Gmail='$gmail' and UserName ='$username' AND Password='$password'";
        $result = mysqli_query($con,$query);
        if(mysqli_num_rows($result) > 0)
        {
             $row = mysqli_fetch_assoc($result);
             $_SESSION['user']=$row['Gmail'];
             $_SESSION['user']=$row['UserName'];
             
             print'
                <script type="text/javascript">alert("Đăng nhập thành công!!!");</script>
                  ';
        }
        else
        {    print'
              <script type="text/javascript">alert("Tên đăng nhập hoặc mật khẩu không chính xác!!!");</script>
                  ';
        }
  }
  else if($_POST['submit']=="register")
  {
        $gmail=$_POST['register_Gmail'];
        $username=$_POST['register_username'];
        $password=$_POST['register_password'];
        $query="select * from users where UserName = '$username' ";
        $result=mysqli_query($con,$query);
        if(mysqli_num_rows($result)>0)
        {   
               print'
               <script type="text/javascript">alert("Tên người dùng đã tồn tại");</script>
                    ';

        }
        else
        {
          $query ="INSERT INTO users VALUES ('$gmail','$username','$password')";
          $result=mysqli_query($con,$query);
          print'
                <script type="text/javascript">
                 alert("ĐĂNG KÝ THÀNH CÔNG!!!");
                </script>
               ';
        }
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Books">
    <meta name="author" content="Shivangi Gupta">
    <title>Online Bookstore</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">
    <style>
      .modal-header {background:#D67B22;color:#fff;font-weight:800;}
      .modal-body{font-weight:800;}
      .modal-body ul{list-style:none;}
      .modal .btn {background:#D67B22;color:#fff;}
      .modal a{color:#D67B22;}
      .modal-backdrop {position:inherit !important;}
       #login_button,#register_button{background:none;color: #D67B22!important;}       
       #query_button {position:fixed;right:0px;bottom:0px;padding:10px 80px;
                      background-color:#D67B22;color:#fff;border-color:#f05f40;border-radius:2px;}
  	@media(max-width:767px){
        #query_button {padding: 5px 20px;}
  	}
    </style>
</head>
<body>
  <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" style="padding: 1px;"><img class="img-responsive" alt="Brand" src="img/logo2.png"  style="width: 147px; margin: 0px;"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
         <ul class="nav navbar-nav navbar-right">
        <?php
        
        if(!isset($_SESSION['user']))
          { 
            echo'
            <li>
            
                <button type="button" id="login_button" class="btn btn-lg" data-toggle="modal" data-target="#login">Đăng Nhập</button>
                  <div id="login" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title text-center">Thông Tin Đăng nhập</h4>
                            </div>
                            <div class="modal-body">
                                          <form class="form" role="form" method="post" action="index.php" accept-charset="UTF-8">
                                          <div class="form-group">
                                                <label class="sr-only" for="Gmail">Gmail</label>
                                                <input type="text" name="register_Gmail" class="form-control" placeholder="Email" required>
                                            </div>
                                              <div class="form-group">
                                                  <label class="sr-only" for="username">Username</label>
                                                  <input type="text" name="login_username" class="form-control" placeholder="Tên đăng nhập" required>
                                              </div>
                                              <div class="form-group">
                                                  <label class="sr-only" for="password">Password</label>
                                                  <input type="password" name="login_password" class="form-control"  placeholder="Mật khẩu" required>
                                              </div>
                                              <div class="form-group">
                                                  <button type="submit" name="submit" value="login" class="btn btn-block">
                                                      Đăng Nhập
                                                  </button>
                                              </div>
                                          </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                    </div>
                  </div>
            </li>
            <li>                 
              <button type="button" id="register_button" class="btn btn-lg" data-toggle="modal" data-target="#register">Đăng Ký</button>
                <div id="register" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title text-center">Đăng ký thành viên</h4>
                          </div>
                          <div class="modal-body">
                                        <form class="form" role="form" method="post" action="index.php" accept-charset="UTF-8">
                                        <div class="form-group">
                                                <label class="sr-only" for="Họ Và Tên">Họ và Tên</label>
                                                <input type="text" name="register_Họ và Tên" class="form-control" placeholder="Họ và Tên" required>
                                            </div>
                                        <div class="form-group">
                                                <label class="sr-only" for="Gmail">Gmail</label>
                                                <input type="text" name="register_Gmail" class="form-control" placeholder="Email" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="username">Username</label>
                                                <input type="text" name="register_username" class="form-control" placeholder="Tên đăng nhập" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="password">Password</label>
                                                <input type="password" name="register_password" class="form-control"  placeholder="Mật khẩu" required>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="submit" value="register" class="btn btn-block">
                                                    Đăng Ký
                                                </button>
                                            </div>
                                        </form>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Đóng </button>
                          </div>
                      </div>
                  </div>
                </div>
                
            </li>
            <div class="btn btn-lg" >
          		<a href="admin1.php" style="text-decoration:none">Admin Login</a
                > 
                
        	</div>';
            
          } 
        else
          {   echo' <li> <a href="#" class="btn btn-lg">' .$_SESSION['user']. '.</a></li>
                    <li> <a href="cart.php" class="btn btn-lg"><span class="glyphicon glyphicon-shopping-cart">Giỏ Hàng</a> </li>; 
                    <li> <a href="destroy.php" class="btn btn-lg"><span class="glyphicon glyphicon-log-out">Đăng Xuất</a> </li>';
               
          }
?>

          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  <div id="top" >
      <div id="searchbox" class="container-fluid" style="width:112%;margin-left:-6%;margin-right:-6%;">
          <div>
              <form role="search" method="POST" action="Result.php">
                  <input type="text" class="form-control" name="keyword" style="width:80%;margin:20px 10% 20px 10%;" placeholder="Tìm kiếm Sách , Tác giả hoặc thể loại">
              </form>
          </div>
      </div>

      <div class="container-fluid" id="header">
          <div class="row">
              <div class="col-md-3 col-lg-3" id="category">
                  <div style="background:#D67B22;color:#fff;font-weight:800;border:none;padding:15px;"> Cửa Hàng Sách </div>
                  <ul>
                      
                  <li> <a href="Product.php?value=Văn%20học%20và%20viễn tưởng" > Văn học & Viễn tưởng </a> </li>
                      <li> <a href="Product.php?value=Học%20thuật"> Học thuật</a> </li>
                      <li> <a href="Product.php?value=Tiểu%20sử%20và%20tự%20truyện"> Tiểu sử và Tự truyện </a> </li>
                      <li> <a href="Product.php?value=Trẻ%20em%20và%20thanh%20thiếu%20niên"> Trẻ em & Thanh thiếu niên </a> </li>
                      <li> <a href="Product.php?value=Sách%20tâm%20lý%20và%20kỹ%20năng%20sống"> Tâm Lý và Kỹ Năng Sống </a> </li>
                      <li> <a href="Product.php?value=Quản%20lý%20kinh%20doanh"> Quản lý kinh doanh </a> </li>
                      <li> <a href="Product.php?value=Sức%20khỏe%20và%20nấu%20ăn"> Sức khỏe và Nấu ăn </a> </li>

                  </ul>
              </div>
              <div class="col-md-6 col-lg-6">
                  <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                          <li data-target="#myCarousel" data-slide-to="1"></li>
                          <li data-target="#myCarousel" data-slide-to="2"></li>
                          <li data-target="#myCarousel" data-slide-to="3"></li>
                          <li data-target="#myCarousel" data-slide-to="4"></li>
                          <li data-target="#myCarousel" data-slide-to="5"></li>
                      </ol>
                      
                        <!-- Wrapper for slides -->
                      <div class="carousel-inner" role="listbox">
                          <div class="item active">
                            <img class="img-responsive" src="img/carousel/1.4.jpg">
                          </div>

                          <div class="item">
                            <img class="img-responsive "src="img/carousel/4.1.jpg">
                          </div>

                          <div class="item">
                            <img class="img-responsive" src="img/carousel/6.1.jpg">
                          </div>

                      
                          </div>
                      </div>
                  </div>
              </div>
             
          </div>
      </div>
  </div>

  <div class="container-fluid text-center" id="new">
      <div class="row">
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=NEW-1&category=new">
              <div class="book-block">
                  <div class="tag">New</div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="book block-center img-responsive" src="img/new/1.jpg">
                  <hr>
                  Đại Bàng Đổi Vàng Lấy Khế <br>
                
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=NEW-2&category=new">
              <div class="book-block">
                  <div class="tag">New</div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="block-center img-responsive" src="img/new/2.jpg">
                  <hr>
                  Sói Đói Rất Giỏi Săn Mồi<br>
                 
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=NEW-3&category=new">
              <div class="book-block">
                  <div class="tag">New</div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="block-center img-responsive" src="img/new/3.png">
                  <hr>
                  Mặt Trời Trong Suối Lạnh<br>
                  
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=NEW-4&category=new">
              <div class="book-block">
                  <div class="tag">New</div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="block-center img-responsive" src="img/new/4.jpg">
                  <hr>
                  Nam Thiên Kì Đàm<br>
                  
              </div>
            </a>
          </div>
      </div>
  </div>
<div class="container-fluid text-center" id="hot">
      <div class="row">
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=HOT-1&category=hot">
              <div class="book-block">
                  <div class="tag">Hot</div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="book block-center img-responsive" src="img/hot/1.jpg">
                  <hr>
                  Khi Bạn Đang Mơ Thì Người Khác Đang Nỗ Lực<br>
                  115.000 VND
                
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=HOT-2&category=hot">
              <div class="book-block">
                  <div class="tag">Hot</div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="block-center img-responsive" src="img/hot/2.jpg">
                  <hr>
                  Nhà Giả Kim (Tái Bản 2020)<br>
                  79.000 VND
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=HOT-3&category=hot">
              <div class="book-block">
                  <div class="tag">Hot</div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="block-center img-responsive" src="img/hot/3.png">
                  <hr>
                  Người Nam Châm (Tái Bản 2019)<br>
                  65.000 VND
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=HOT-4&category=hot">
              <div class="book-block">
                  <div class="tag">Hot</div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="block-center img-responsive" src="img/hot/4.jpg">
                  <hr>
                  Đọc Vị Bất Kỳ Ai (Tái Bản 2019)<br>
                  79.000 VND
              </div>
            </a>
          </div>
      </div>
  </div>
  <div class="container-fluid" id="author">
      <h3 style="color:#D67B22;"> Tác giả yêu thích </h3>
      <div class="row">
          <div class="col-sm-5 col-md-3 col-lg-3">
              <a ><img class="img-responsive center-block" src="img/popular-author/0.jpg"></a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
              <a ><img class="img-responsive center-block" src="img/popular-author/1.jpg"></a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
              <a ><img class="img-responsive center-block" src="img/popular-author/2.jpg"></a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
              <a ><img class="img-responsive center-block" src="img/popular-author/3.jpg"></a>
          </div>
      </div>
    
      </div>
  </div>

  <footer style="margin-left:-6%;margin-right:-6%;">
      <div class="container-fluid">
          <div class="row">
              <div class="col-sm-1 col-md-1 col-lg-1">
              </div>
              <div class="col-sm-7 col-md-5 col-lg-5">
                  <div class="row text-centerLet">
                      <h2></h2>
                      <hr class="primary">
                      <p>Nếu có thắc mắc vui lòng liên hệ </p>
                  </div>
                  <div class="row">
                      <div class="col-md-6 text-center">
                          <span class="glyphicon glyphicon-earphone"></span>
                          <p>0889256202</p>
                      </div>
                      <div class="col-md-6 text-center">
                          <span class="glyphicon glyphicon-envelope"></span>
                          <p>Longchuacobo@gmail.com</p>
                      </div>
                  </div>
              </div>
              <div class="hidden-sm-down col-md-2 col-lg-2">
              </div>
              <div class="col-sm-4 col-md-3 col-lg-3 text-center">
                  <h2 style="color:#D67B22;">Theo dõi chúng tôi tại</h2>
                  <div>
                      
                      <a href="https://www.facebook.com/long.tam.142035">
                      <img title="Facebook" alt="Facebook" src="img/social/facebook.png" width="35" height="35" />
                      </a>
                      </a>
                  </div>
              </div>
          </div>
      </div>
  </footer>

<div class="container">
  <!-- Trigger the modal with a button -->
  <button type="button" id="query_button" class="btn btn-lg" data-toggle="modal" data-target="#query">Câu hỏi phản hồi</button>
  <!-- Modal -->
  <div class="modal fade" id="query" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">PHẢN HỒI KHÁCH HÀNG</h4>
          </div>
          <div class="modal-body">           
                    <form method="post" action="query.php" class="form" role="form">
                        <div class="form-group">
                             <label class="sr-only" for="name">Họ và tên</label>
                             <input type="text" class="form-control"  placeholder="Tên của bạn" name="name" required>
                        </div>
                        <div class="form-group">
                             <label class="sr-only" for="email">Email</label>
                             <input type="email" class="form-control" placeholder="Nhập email" name="email" required>
                        </div>
                        <div class="form-group">
                             <label class="sr-only" for="query">Lời nhắn</label>
                             <textarea class="form-control" rows="5" cols="30" name="msg" placeholder="Nhập lời nhắn" required></textarea>
                        </div>
                        <div class="form-group">
                              <button type="submit" name="submit" value="query" class="btn btn-block">
                                                              Gửi phản hồi
                               </button>
                        </div>
                    </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
          </div>
      </div>
    </div>  
  </div>
</div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
</body>
</html>	