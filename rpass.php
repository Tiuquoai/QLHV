<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Trung Tam He thong CRM</title>
<link rel="icon" type="image/png" href="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script type="text/javascript" src="js/jquery.zoom.min.js"></script>
</head>

<body>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 border" style="background-color:#fff">
     <div class="row">
     	<div class="row header col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:#88b77b; height:30px;    margin: 0px;" id="codinh">
&nbsp;<center></center><p style="color:#FFF">Gọi Điện: 0143.234.563 - ext 808 &nbsp; &nbsp; Email: csm@gmail.com</p> 
</div>
<p></p>
</div>
<div>
<center><img src="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180" height="75px" width="120px" /></center>
        
        </div>
     </div>
<br/>

 <?php  
 $ca= md5($_REQUEST['e']);
 $xa= $_REQUEST['xm'];
 if(!isset($_REQUEST['e']) || !isset($_REQUEST['xm']) || $xa != $ca){
	  echo header("refresh:0,url='index.php'");
 }
                    if(isset($_POST['td'])){
								$p=$_POST['p'];
								$rp=$_POST['rp'];
								include_once("Controller/cTKADHT.php");
								if($rp!=$p){
									 echo "<script>alert('Mật khẩu nhập lại không khớp với mật khẩu!')</script>";
								}
								else
								{
									$p=new cTKAD();
								    $p->CapNhatMatKhauKH();
								    echo "<script>alert('Thay đổi mật khẩu hoàn tất!')</script>";
								    echo header("refresh:0,url='index.php'");
								
							
					
								
								
							
                              

include "class.phpmailer.php"; // include the class name
$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "phucable@gmail.com";
$mail->Password = "afbv blky ofzi vzsy";
$mail->SetFrom("shop@gmail.com");
$mail->AddAddress($_REQUEST['e']);
$mail->Subject = "Trung Tam Quan Tri CRM";
$mail->Body = "-Mật khẩu của bạn đã được Reset,bạn không tiết lộ ra bên ngoài !
<p></p>-Bạn vui lòng nhấn vào đây đăng nhập Website lại mật khẩu vừa thay đổi: <a href='http://localhost/QuanLyHocVu/index.php'>http://localhost/QuanLyHocVu/index.php</a>";
 if(!$mail->Send()){
    echo "Mailer Error: " . $mail->ErrorInfo;
}
else{
}
  
					}
					}
						
						?>
 <center><h3>Đổi lại mật khẩu ? </h3></center>
                               <br />
                       <form action="#" method="post">
                    	<center><ps>Mật Khẩu Mới:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="p" required="required" /></ps></center>
                        <br />
                        <center><ps>Nhập Lại Mật Khẩu:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="rp" required="required" /></ps></center>
                        <center><ps><input type="hidden" name="pe" value="<?php echo $se; ?>" required="required" /></ps></center>
                        <br />
                        
                        <center><input type="submit" name="td" value="OK" required="required"/></center>
                        <br />

                     </form>
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 border" style="background-color:#fff">
     <div class="row">
     	<div class="col-xs-4 col-sm-4 col-md-44 col-lg-4">
        <br />
       <img src="https://tse3.mm.bing.net/th?id=OIP.mF4R5YAnHij_hccRrGDCYwAAAA&pid=Api&P=0&h=180" height="75px" width="100px" />
        <p></p>
        <p>Chào Mừng Các Bạn Đến Với Hệ Thống ...</p>
        <br />
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <p></p>
        <h5>Liên Kết</h5>
        <p></p>
        - Link Liên Kết 1<p></p>
        - Link Liên Kết 2<p></p>
        - ...
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
        <p></p>
        <h5>Liên Hệ</h5>
        <p></p>
        Trung Tâm Quản Trị Hệ Thống - Trường ...
        <p></p>
        <img src="https://tse4.mm.bing.net/th?id=OIP.VMPvKsUQ9Q91rlEDRqsj8AHaHa&pid=Api&P=0&h=180" height="30px" width="30px" /> &nbsp; Phone :&nbsp;0143.234.563<p></p>
         <img src="https://tse3.mm.bing.net/th?id=OIP.Ye2A24tF7KlssZxi_cffWwHaGD&pid=Api&P=0&h=180" height="30px" width="30px" /> &nbsp; Email :&nbsp;abc@gmail.com
        
        </div>
     </div>
</div>
</body>
</html>
