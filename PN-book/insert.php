<?php
include "dbconnect.php";
 // Selecting Database from Server
if(isset($_POST['submit'])){ // Fetching variables of the form which travels in URL
$PID = $_FILES['PID'];
$Title = $_POST['Title'];
$Author = $_POST['Author'];
$MRP=$_POST['MRP'];
$Price=$_POST['Price'];
$Available=$_POST['Available'];
$Publisher=$_POST['Publisher'];
$Category=$_POST['Category'];
$Description=$_POST['Description'];
$Language=$_POST['Language'];
$Page=$_POST['Page'];
$weight=$_POST['weight'];

$path = 'img/books/' . $_FILES['PID']['name'];    
move_uploaded_file($_FILES['PID']['tmp_name'],$path );  
// if (isset($_POST['submit']) && isset($_FILES['PID'])) {
//     if ($_FILES['PID']['error'] > 0)
//         echo "Upload lỗi rồi!";
//     else {
//         $path = 'img/books/' . $_FILES['PID']['name'];    
//         move_uploaded_file($_FILES['PID']['tmp_name'],$path );  
//     }   
// }

$a = explode(".",$_FILES['PID']['name']);
if($PID !=''||$Title !=''){
//Insert Query of SQL

$query = mysqli_query($con,"insert into products(PID,Title,Author,MRP,Price,Available,Publisher,Category,Description,Language,Page,weight) values ('$a[0]', '$Title', '$Author','$MRP','$Price','$Available','$Publisher','$Category','$Description','$Language','$Page','$weight')");
echo "<script>alert('Thêm sách thành công...!!');</script>";
header("Refresh:0; url=insert.html");
}

else{
    echo "<script>alert('Thêm sách lỗi hãy thử lại');</script>";
header("Refresh:0; url=insert.html");
}
}
mysqli_close($con); // Closing Connection with Server
?> 