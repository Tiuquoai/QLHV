<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Trang Đăng Nhập Sinh Viên</title>
<link rel="icon" type="image/png" href="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<script type="text/javascript" src="js/bootstrap.js"></script>
<style>
.full-width-div {
    position: relative;
    width: 100vw;
    left: 0;
}
.ca{
	border-radius:2px;
	width: 65px;
}
pi{
	font-family:"Comic Sans MS", cursive;
	font-weight:400px;
	font-style:inherit;
}
@media(max-width:1200px){
}
</style>
</head>

<body>
<div class="container mw-100 border">

<div class="row header"  id="codinh">
<!--Đây là phần banner-->
<div class="row header col-xs-12 col-sm-12 col-md-12 col-lg-12" style="background-color:#88b77b; height:30px;    margin: 0px;" id="codinh">
&nbsp;<center></center><p style="color:#FFF">Gọi Điện: 0143.234.563 - ext 808 &nbsp; &nbsp; Email: csm@gmail.com</p> 
</div>
<p></p>
</div>
<div>
<center><img src="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180" height="75px" width="120px" /></center>
</div>
<br/>
<!--Đây là phần form đăng nhập-->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
     <center><h3>Đăng Nhập Hệ Thống</h3></center>
     <br/>
     <form action="dntc.php" method="post" enctype="multipart/form-data">
     <center><input type="text" name="a" placeholder="Nhập mã sinh viên" size="26" required="required" /></center>
     <p></p>
     <center><input type="password" name="p" placeholder="Nhập mật khẩu" size="26" required="required"  /></center>
     <p></p>
     <?php
	$length=5;
if(isset($_GET["len"]))
$length=$_GET["len"];
$seed = str_split('abcdefghijklmnopqrstuvwxyz'
                 .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                 .'0123456789!@#$%^&*'); // and any other characters
shuffle($seed); // probably optional since array_is randomized; this may be redundant
$rand = '';
foreach (array_rand($seed, 5) as $k) $rand .= $seed[$k];
$text= $rand;
$text1=$rand;
$_SESSION['captcha'] = $text;
?>
<center><input type="text" name="cap" placeholder="Nhập mã Captcha" size="13" />&nbsp;&nbsp;<?php if(isset($_REQUEST['return'])) {?><button class="ca" style="background-image: url('https://tse1.mm.bing.net/th?id=OIP.ego98MuNmMGNbTwirWA6AAHaCe&pid=Api&rs=1&c=1&qlt=95&w=95&h=45');"><pi><?php echo $_SESSION['captcha'];?></pi></button><?php }
else{
	?>
    <button class="ca" style="background-image: url('https://tse1.mm.bing.net/th?id=OIP.ego98MuNmMGNbTwirWA6AAHaCe&pid=Api&rs=1&c=1&qlt=95&w=95&h=45');"><pi><?php echo $_SESSION['captcha'];?></pi></button>
    <?php
}?>
&nbsp;<a href="login-sv.php?return"><img src="https://tse1.mm.bing.net/th?id=OIP.cIlpGiTwzStTACcUBDEqRwHaGW&pid=Api&P=0&h=180" height="15px" width="15px" /></a></center>
<?php

	 
	 ?>
     <p></p>
     <input type="hidden" name="cd" value="<?php echo $_SESSION['captcha'];?>" />
     <input type="hidden" name="dn" value="tiuquoaiiiii" >

     		<center><input type="submit" value="Đăng Nhập"  class="abc"  /> &nbsp; <a href="resetpass.php">Quên Mật Khẩu ?</a> </center>
   
    
     </form>
     
</div>
<br />
<!--Đây là phần footer-->
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
</div>

</div>
</body>
</html>
<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("codinh");

var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}
</script>