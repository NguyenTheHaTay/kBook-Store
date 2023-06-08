<?php
	if(isset($_POST['submit'])){
		$name=$_POST['name'];
		$email=$_POST['email'];
		
		$msg=$_POST['msg'];

		$to='20010869@st.phenikaa-uni.edu.vn'; // Receiver Email ID, Replace with your email ID
		$subject='Form Submission';
		$message="Name :".$name."\n"."email :".$email."\n"."Phản hồi :"."\n\n".$msg;
		$headers="From: ".$email;

		if(mail($to, $subject, $message, $headers)){
			echo "<h1>Gửi thành công! Cảm ơn"." ".$name.", Chúng tôi sẽ phản hồi sớm lại bạn!</h1>";
		}
		else{
			echo "Có lỗi xảy ra!";
		}
	}
?>