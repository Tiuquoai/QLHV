<?php
	include_once("controller/cTKSV.php");
	$p=new cTKSV();
	if(isset($_POST['capnhat'])){
		     $email=$_POST['f'];
			 $sdt=$_POST['e'];
		     if(!preg_match("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})/",$email)){
					echo "<script>alert('Email không đúng định dạng')</script>";
				}
			 elseif(!preg_match("/[0-9]{10}/",$sdt)){
				 echo "<script>alert('Số Điện Thoại là 10 số')</script>";
			 }
			 else {
		$p->CapNhatInfo1();
		$p->CapNhatInfo();
		echo "<script>Cập Nhật Thành Công !</script>";
		echo header("refresh:0,url='info.php?bm=".$_REQUEST['bm']."");
			 }
	}
?>

<?php
session_start();
if(!isset($_REQUEST['bm'])){
	echo header("refresh:0,url='index.php'");
}
include_once("Model/mKetNoiSV.php");
$p=new ketnoiSV();
$kn=$p->ketnoi($ketnoi);
$ma=$_REQUEST['bm'];
$sql="select * from user where user_code='$ma'";
$qr=mysql_query($sql);
$r=mysql_fetch_assoc($qr);
$ma=$r['user_code'];
$mk=$r['matkhau'];
$k=$_SESSION['mk'];
$m=$_SESSION['ma'];
if($k != $mk || $m != $ma){
	echo header("refresh:0,url='index.php'");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Thông Tin Sinh Viên</title>
<link rel="icon" type="image/png" href="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180"/><link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<style>
a{
	color: #000;
}
a:hover{
	color: #000;
}
.sticky {
  position:fixed;
  top: -15px;
  padding-top:15px;
  width:100%;
  height:10px;
  z-index:8;
  background-color:rgba(255,255,255,0.92);
  box-shadow:0.1px 0.1px 0.1px yellow;
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

<br />
<?php 
include_once("Controller/cTKSV.php");
$p=new cTKSV();
$xuat=$p->XuatInfo();
$x=mysql_fetch_assoc($xuat);
$a= $x['user_code'];
$b= $_REQUEST['bm'];
if(!isset($_REQUEST['bm'])){
	echo header("refresh:0,url='index.php");
}
if($b != $a){
	echo header("refresh:0,url='index.php");
}

$anh=$x['anh'];
if(!preg_match("/^[A-Za-z]{1,100}[.(jpg|png)]{3}/",$anh)){
	?>
    <center><img src="<?php echo $anh?>" height="150px" width="150px" class="rounded-circle" /></center>
	<?php
}
else{
	?>
	<center><img src="img/<?php echo $anh?>" height="150px" width="150px" class="rounded-circle" /></center>
    <?php
}
?>
<p></p>
    <center><?php echo "<p>".$x['tensinhvien']."</p>" ?></center>
    <p align="right"><a href="info.php?bm=<?php echo $_REQUEST['bm'] ?>&&dmk">Đổi mật khẩu ?</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="info.php?bm=<?php echo $_REQUEST['bm']; ?>&&chinhsua"><img src="https://tse4.mm.bing.net/th?id=OIP.B7zOpV_oMJAcGd85aSujHQHaHa&pid=Api&P=0&h=180" height="20px" width="20px"  /> Đề 
    Xuất Chỉnh Sửa</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="dxuat.php?xuat">Đăng Xuất</a></p>
    <hr />
    <?php 
	 if(isset($_GET['chinhsua'])){
		 ?>
         <form action="#" method="post" enctype="multipart/form-data">
         <h4>Thông Tin Chung</h4>
    <br/>
    <div class="row">
       <div class="col-xs-3 col-sm-3 col-md-4 col-lg-4">
       Tên Sinh Viên: <strong><input type="text" name="a" value="<?php echo $x['tensinhvien'];?>" disabled="disabled" /></strong>
       <p></p>
       	 Mã Số Sinh Viên: <strong><input type="text" name="b" value="<?php echo $x['masosinhvien']; ?>" disabled="disabled" /></strong>
    <p></p>
    <?php
					if($x['gioitinh']==Nam){
						$nam="checked";
					}
					elseif($x['gioitinh']==Nữ){
						$nu="checked";
					}
	?>
         Giới Tính: <strong>&nbsp;&nbsp;<input type="radio" name="c" value="Nam" <?php echo $nam ?>   /> Nam &nbsp;&nbsp;&nbsp;<input type="radio" name="c" value="Nữ" <?php echo $nu ?> required="required"  /> Nữ</strong>
         
       </div>
       <div class="col-xs-3 col-sm-3 col-md-4 col-lg-4">
       Ngày Sinh: <strong><input type="date" name="d" value="<?php 
	   $currentDate = $x['ngaysinh'];
       $convertedDate = date("Y-m-d", strtotime($currentDate));
	   echo $convertedDate;?>" required="required"/></strong>
       <p></p>
       Điện Thoại: <strong><input type="text" name="e" value="<?php echo $x['sdt'];?>" required="required" /></strong>
       <p></p>
       Email: <strong><input type="text" name="f" value="<?php echo $x['email'];?>" required="required" /></strong>
       </div>
       <div class="col-xs-3 col-sm-3 col-md-4 col-lg-4">
       Số CCCD: <strong><input type="text" name="g" value="<?php echo $x['cccd'];?>" required="required"/></strong>
       <p></p>
       Ngày Cấp: <strong><input type="date" name="h" value="<?php 
	   $cD = $x['ngaycap'];
       $cV = date("Y-m-d", strtotime($cD));
	   echo $cV;?>" required="required" /></strong>
       <p></p>
       Nơi Cấp: <strong><input type="text" name="i" value="<?php echo $x['noicap'];?>" required="required"  /></strong>
       </div>
    </div>
    <p></p>
       Địa Chỉ Liên Hệ: <strong><input type="text" name="j" value="<?php echo $x['diachilienhe'];?>" disabled="disabled" size="50" /></strong>
       <p></p>
       Hộ Khẩu Thường Trú: <strong><input type="text" name="k" value="<?php echo $x['hokhauthuongtru'];?>" size="50" required="required" /></strong>
    <br/>
    <br />
    <h4>Thông Tin Học Vấn</h4>
    <br />
    <div class="row">
    <div class="col-xs-3 col-sm-3 col-md-4 col-lg-4">
    Trạng thái: <?php if($x['trangthai']==1){
		echo "<strong>"."Đang Học"."</strong>";
	}
	elseif($x['trangthai']==1){
		echo "<strong>"."Đã Tốt Nghiệp"."</strong>";
	}
	else{
		echo "<strong>"."Ngừng Học"."</strong>";
	}?>
    <p></p>
    Lớp: <strong><?php echo $x['lopCN'];?></strong>
    <p></p>
    Bậc Đào Tạo: <strong>Đại Học</strong>
    <p></p>
    Khoa: <strong><?php echo $x['tenkhoa'];?></strong>
    <p></p>
    Chuyên Ngành: <strong><?php echo $x['tenchuyennganh'];?></strong>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-4 col-lg-4">
    Ngày Vào Trường: <strong><?php echo $x['ngayvaotruong'];?></strong>
    <p></p>
    Cơ Sở: <strong><?php echo $x['cosodaotao'];?></strong>
    <p></p>
    Loại Hình Đào Tạo: <strong>Chính Quy</strong>
    <p></p>
    Khóa Học: <strong><?php echo $x['khoa'];?></strong>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-4 col-lg-4">
    </div>
    </div>
    <br/>
    <input type="hidden" name="id" value="<?php echo $x['user_id']; ?>" />
    <center><input type="submit" name="capnhat" value="Lưu Thay Đổi" /></center>
    </form>
         <?php
	 }
	 elseif(isset($_REQUEST['dmk'])){
		 ?>
         <form action="#" method="post">
         	<div class="row">
            	<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                <center><h5>Đổi Mật Khẩu</h5></center>
                <p></p>
                <center>
                <?php
				if(isset($_POST['d'])){
					$ma=$_REQUEST['bm'];
					$mk=md5($_POST['a']);
					$xm=$_POST['xm'];
					$sql="select * from user where user_code='$ma'";
					$qr=mysql_query($sql);
					$e=mysql_fetch_assoc($qr);
					$mkc=$e['matkhau'];
					$a=$_POST['a'];
					$b=$_POST['b'];
					if(md5($xm)!=$mkc){
						echo "<script>alert('Nhập mật khẩu cũ không đúng !')</script>";
					}
					elseif($b!=$a){
						echo "<script>alert('Mật khẩu nhập lại không khớp !')</script>";
					}
					else{
						$sql="update user set matkhau='$mk' where user_code='$ma'";
						$qr=mysql_query($sql);
						echo "<script>alert(' Đổi mật khẩu hoàn tất !')</script>";
					}
				}
				?>
                <form action="#" method="post" enctype="multipart/form-data">
                <p></p>
                Mật Khẩu Cũ: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="xm" required="required"/>
                <p></p>
                Mật Khẩu Mới:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="a" required="required" />
                <p></p>
                Nhập Lại Mật Khẩu:&nbsp;<input type="password" name="b"  required="required"/>
                <p></p>
                <input type="submit" name="d" value="OK" />
                </form>
                </center>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                </div>
            </div>
         </form>
         
         <?php
	 }
	 else{
	?>
    <h4>Thông Tin Chung</h4>
    <br/>
    <div class="row">
       <div class="col-xs-3 col-sm-3 col-md-4 col-lg-4">
       Tên Sinh Viên: <strong><?php echo $x['tensinhvien'];?></strong>
       <p></p>
       	 Mã Số Sinh Viên: <strong><?php echo $x['masosinhvien']; ?></strong>
    <p></p>
         Giới Tính: <strong><?php echo $x['gioitinh'];?></strong>
         
       </div>
       <div class="col-xs-3 col-sm-3 col-md-4 col-lg-4">
       Ngày Sinh: <strong><?php $ngaysinh = date_create($x['ngaysinh']);
echo date_format($ngaysinh, 'd-m-Y');?></strong>
       <p></p>
       Điện Thoại: <strong><?php echo $x['sdt'];?></strong>
       <p></p>
       Email: <strong><?php echo $x['email'];?></strong>
       </div>
       <div class="col-xs-3 col-sm-3 col-md-4 col-lg-4">
       Số CCCD: <strong><?php echo $x['cccd'];?></strong>
       <p></p>
       Ngày Cấp: <strong><?php $ngaycap = date_create($x['ngaycap']);
echo date_format($ngaycap, 'd-m-Y');?></strong>
       <p></p>
       Nơi Cấp: <strong><?php echo $x['noicap'];?></strong>
       </div>
    </div>
    <p></p>
       Địa Chỉ Liên Hệ: <strong><?php echo $x['diachilienhe'];?></strong>
       <p></p>
       Hộ Khẩu Thường Trú: <strong><?php echo $x['hokhauthuongtru'];?></strong>
    <br/>
    <br />
    <h4>Thông Tin Học Vấn</h4>
    <br />
    <div class="row">
    <div class="col-xs-3 col-sm-3 col-md-4 col-lg-4">
    Trạng thái: <?php if($x['trangthai']==1){
		echo "<strong>"."Đang Học"."</strong>";
	}
	elseif($x['trangthai']==1){
		echo "<strong>"."Đã Tốt Nghiệp"."</strong>";
	}
	else{
		echo "<strong>"."Ngừng Học"."</strong>";
	}?>
    <p></p>
    Lớp: <strong><?php echo $x['lopCN'];?></strong>
    <p></p>
    Bậc Đào Tạo: <strong>Đại Học</strong>
    <p></p>
    Khoa: <strong><?php echo $x['tenkhoa'];?></strong>
    <p></p>
    Chuyên Ngành: <strong><?php echo $x['tenchuyennganh'];?></strong>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-4 col-lg-4">
    Ngày Vào Trường: <strong><?php $nvt = date_create($x['ngayvaotruong']);
echo date_format($nvt, 'd-m-Y');?></strong>
    <p></p>
    Cơ Sở: <strong><?php echo $x['cosodaotao'];?></strong>
    <p></p>
    Loại Hình Đào Tạo: <strong>Chính Quy</strong>
    <p></p>
    Khóa Học: <strong><?php echo $x['khoa'];?></strong>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-4 col-lg-4">
    </div>
    </div>
    <?php
	 }
	?>
<p></p>
<center><a href="homeSV.php?bm=<?php echo $_REQUEST['bm'] ?>"><img src="https://tse1.mm.bing.net/th?id=OIP.bJPd-eud68jE583arFBaugHaHa&pid=Api&P=0&h=180" 
height="30px" width="30px"/></a></center>
<p></p>
<br />
<br />

<!--Đây là phần footer-->
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 border" style="background-color:#fff">
     <div class="row">
     	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
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