<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Trang LMS</title>
<link rel="icon" type="image/png" href="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<script type="text/javascript" src="js/bootstrap.js"></script>
<style>
a{
	color:#000;
}
a:hover{
	color:#000;
}
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
#menu ul
{
  margin-top:  42px;
}
#menu ul li
{
  list-style-type: none;
  display: inline;
  margin-left: 50px;
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
</div>
<p></p>
<br/>
<!--Đây là phần form đăng nhập-->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
     <center><h3>Lấy Lại Mật Khẩu</h3></center>
     <br/>
     <form action="sendOTP.php" method="post" enctype="multipart/form-data">
     <center>
     Mã Tài Khoản* : <input type="text" name="ma" placeholder="Nhập mã giảng viên" size="26" required="required" />
     <p></p>
     Họ Và Tên* : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="ht" placeholder="Nhập họ và tên" size="26" required="required"  />		     <p></p>
     Số CCCD* : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="cccd" placeholder="Nhập số CCCD" size="26" required="required"  />
     <p></p>
     Email* : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="email" placeholder="Nhập email" size="26" required="required"  />
     <p></p>
     <input type="submit" name="kiemtra1" value="Xác Minh"/>
     </center>
    
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