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
<title>Home Sinh Viên</title>
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
	ac{
		font-size:15px;
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
@media(min-width:992px) and (max-width:1200px) {
	
	.b1{
	border-radius:50%;
}
.b2{
	border-radius:50%;
	background-color:#CFC;
}
.mt{
	display:none;
}
	.r{
		height:200px;
		width:290px;
	}
	td{
  padding: 5px;
}
hp{
	font-weight:500;
	font-size:16px;
}
}
@media(min-width:1300px){
.b1{
	border-radius:50%;
}
.b2{
	border-radius:50%;
	background-color:#CFC;
}
	.u{
		height:200px;
		width:345px;
		margin-top:-15px;
	}
	td{
  padding: 10px;
}
hp{
	font-weight:500;
	font-size:20px;
}
.dt{
	display:none;
}

}
@media(max-width:1300px){
.b1{
	border-radius:50%;
}
.b2{
	border-radius:50%;
	background-color:#CFC;
}
.mt{
	display:none;
}
	.r{
		height:150px;
		width:220px;
	}
	table td{
  padding: 5px;
}
hp{
	font-weight:500;
	font-size:16px;
}
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
<p></p>
<div class="row">
<div class="col-xs-3 col-md-3 col-lg-3 col-md-3">
<img src="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180" height="75px" width="120px" />
</div>
<div class="col-xs-6 col-md-6 col-lg-6 col-md-6">
</div>
<div class="col-xs-3 col-md-3 col-lg-3 col-md-3">
<?php
include_once("Model/mKetNoiADHT.php");
$p=new ketnoiAD();
$kn=$p->ketnoi($ketnoi);
if($kn){
	$bm=$_REQUEST['bm'];
	$sql="select *from user u join sinhvien s on u.user_id=s.user_id where user_code='$bm' ";
	$asv=mysql_query($sql);
	$t=mysql_fetch_assoc($asv);
}
$anh=$t['anh'];
if(!preg_match("/^[A-Za-z]{1,100}[.(jpg|png)]{3}/",$anh)){
	?>
    <center><a href="info.php?bm=<?php echo $_REQUEST['bm'] ?>"><img src="<?php echo $anh?>" height="50px" width="50px" class="rounded-circle" /></a></center>
	<?php
}
else{
	?>
	<center><a href="info.php?bm=<?php echo $_REQUEST['bm'] ?>"><img src="img/<?php echo $anh?>" height="50px" width="50px" class="rounded-circle" /></a></center>
    <?php
}
?>
<p></p>
<center><ac><a href="info.php?bm=<?php echo $_REQUEST['bm'] ?>"><?php echo $t['tensinhvien'] ?></a></ac></center>
</div>
</div>
</div>
<br/>
<div class="row">
    <div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
    <?php
	include_once("Model/mKetNoiADHT.php");
	$p=new ketnoiAD();
	$kn=$p->ketnoi($ketnoi);
	if($kn){
		$bm=$_REQUEST['bm'];
		$sql="select * from user u join sinhvien sv on u.user_id=sv.user_id where u.user_code='$bm'";
		$xttsv=mysql_query($sql);
		$t=mysql_fetch_assoc($xttsv);
	}
	?>
    <?php /*
     <center><a href="monhocSV.php?bm=<?php echo $_REQUEST['bm']; ?>&&is=<?php echo md5($t['id_sinhvien']) ?>"><img src="https://tse3.mm.bing.net/th?id=OIP.O3LsMYayOvJA8BuA9tArDAHaHa&pid=Api&h=100&w=100"/></a><br /></center>
     <center><a href="monhocSV.php?bm=<?php echo $_REQUEST['bm']; ?>&&is=<?php echo md5($t['id_sinhvien']) ?>">Môn Học</a></center>
    </div>
    <div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
     <center><img src="https://tse3.mm.bing.net/th?id=OIP.AQTzkAx9LPcqIwDYgPh8bAAAAA&pid=Api&P=0&h=100&w=100"/><br /></center>
     <center>Lịch Học</center>
    </div>
    <div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
     <center><img src="https://tse3.mm.bing.net/th?id=OIP.Q9vTiQlYO5jp9oFOdaKxIQAAAA&pid=Api&P=0&h=100&w=100"/><br /></center>
     <center>Xem Điểm</center>
    </div>
	<div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
     <center><img src="https://tse1.mm.bing.net/th?id=OIP.DMvXnqOWQX1W7jPT7S4z1QHaHa&pid=Api&P=0&h=100&w=100"/><br /></center>
     <center>Đăng Ký Học Phần</center>
    </div>
</div>
<br/>
<br/>
<br/>
<div class="row">
    <div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
     <center><img src="https://tse4.mm.bing.net/th?id=OIP.BHU3P0qKU9f971doXYN2QwHaHa&pid=Api&h=100&w=100"/><br /></center>
     <center>Thông Báo Học Vụ</center>
    </div>
    <div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
     <center><img src="https://tse3.mm.bing.net/th?id=OIP.34udK5xHyu3Q1WdJ03LJBgHaHa&pid=Api&h=100&w=100"/><br /></center>
     <center>Biểu Mẫu Học Vụ</center>
    </div>
     <div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
     <center><img src="https://tse3.mm.bing.net/th?id=OIP._6U_d4bU6OAkA4s4UqRI9gHaHa&pid=Api&P=0&h=100&w=100"/><br /></center>
     <center>Đơn Nghỉ Phép</center>
    </div>
    <div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
     <center><img src="https://tse4.mm.bing.net/th?id=OIP.9ocbe0BGVIzJRTGWa1UBmQHaHe&pid=Api&&h=100&w=100"/><br /></center>
     <center>Các Hoạt Động</center>
    </div>
	
</div>
<br/>
<br/>
<br/>
<div class="row">
	 <div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
     <center><img src="https://tse3.mm.bing.net/th?id=OIP._jJmyMhEJ-OzMR-QeGo2LQAAAA&pid=Api&h=100&w=100"/><br /></center>
     <center>Tin Tức</center>
    </div>
    <div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
     <center><img src="https://tse2.mm.bing.net/th?id=OIP.myiNQ3Vw47hLqXW11-cgFAAAAA&pid=Api&P=0&h=100&w=100"/><br /></center>
     <center>Hướng Dẫn Sử Dụng</center>
    </div>
	<div class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
     <center><a href="info.php?bm=<?php echo $_REQUEST['bm'] ?>"><img src="https://tse1.mm.bing.net/th?id=OIP.s4tbDYPeiJIcNO7NUV69KwHaHa&pid=Api&P=0&h=100&w=100"/></a><br /></center>
     <center><a href="info.php?bm=<?php echo $_REQUEST['bm'] ?>">Thông Tin Sinh Viên</a></center>
    </div>
	*/?>
    </div>
</div>
<br />
<h5 style="color:#F63; font-size:25px;">Các Khóa Học Của Tôi</h5>
</br>
<div class="col-xs-12 col-sm-12 col-lg-12 col-md-12 mt">
<table>
<thead>
<?php
$is=md5($t['id_sinhvien']);
	$bangghimoitrang=!empty($_GET['per_page'])?$_GET['per_page']:8;
	$tranghientai=!empty($_GET['page'])?$_GET['page']:1;
    $start_from = ($tranghientai-1) * $bangghimoitrang;
	$sql="select * from sinhvien sv join hoctap h on sv.id_sinhvien=h.id_sinhvien
	join monlop m on m.id=h.id join hocphan hp on hp.id_hocphan=m.id_hocphan
	join lophocphan l on l.id_lophocphan=m.id_lophocphan
	join ct_hocphan c on c.id_hocphan=hp.id_hocphan
	join giangday gd on gd.id=m.id join giangvien gv on gv.id_giangvien=gd.id_giangvien
	where md5(sv.id_sinhvien)='$is' limit $start_from,$bangghimoitrang";
	$laymh=mysql_query($sql);
	$bangghimoitrang=!empty($_GET['per_page'])?$_GET['per_page']:8;
	$tranghientai=!empty($_GET['page'])?$_GET['page']:1;
	$pt="select count(h.id_hoctap) from sinhvien sv join hoctap h on sv.id_sinhvien=h.id_sinhvien
	join monlop m on m.id=h.id join hocphan hp on hp.id_hocphan=m.id_hocphan
	join lophocphan l on l.id_lophocphan=m.id_lophocphan
	join ct_hocphan c on c.id_hocphan=hp.id_hocphan
	join giangday gd on gd.id=m.id join giangvien gv on gv.id_giangvien=gd.id_giangvien
	where md5(sv.id_sinhvien)='$is'";
	$qr=mysql_query($pt); 
    $cot = mysql_fetch_row($qr);  
    $tongbangghi = $cot[0];  
   	$tongsotrang = ceil($tongbangghi / $bangghimoitrang); 
	while($tt=mysql_fetch_assoc($laymh)){
		if($a==0){
	echo "<tr>";
	}

?>
<?php
$lt=$tt['thuhocLT'];
$plt=$tt['phonghocLT'];
$th=$tt['thuhocTH'];
$pth=$tt['phonghocTH'];
?>
<br />
                    	<td><center><p style="background-image: url('https://tse3.mm.bing.net/th?id=OIP.KBCZQ_Mrn2I5jzatY3AFkwHaEK&pid=Api&P=0&h=180;" class="u border"><a href="ctmonhoc.php?bm=<?php 
						echo $_REQUEST['bm']?>&&is=<?php echo $t['id_sinhvien'] ?>&&ihp=<?php echo md5($tt['id_hocphan']); ?>&&il=<?php echo $tt['id_lophocphan'] ?>&&ctmh"><?php echo "<br/>"."<hp>".$tt['tenhocphan'].'&nbsp;('.$tt['mahocphan'].")"."</a></hp><br><br>Lớp Học Phần&nbsp;:&nbsp;" ?><?php echo $tt['tenlophocphan'] ?></p></center></td>
                    <?php
	$a++;
	if($a==4){
		echo "</tr>";
	}
	}
	?>
    </thead>
    </table>
    <p></p>
            <center><?php include_once("Controller/cPageM.php"); ?></center>
            <br />
</div>
<div class="col-xs-12 col-sm-12 col-lg-12 col-md-12 dt">
<table>
<thead>
<?php
$is=md5($t['id_sinhvien']);
	$bangghimoitrang1=!empty($_GET['per_page'])?$_GET['per_page']:8;
	$tranghientai1=!empty($_GET['page'])?$_GET['page']:1;
    $start_from1 = ($tranghientai1-1) * $bangghimoitrang1;
	$sql1="select * from sinhvien sv join hoctap h on sv.id_sinhvien=h.id_sinhvien
	join monlop m on m.id=h.id join hocphan hp on hp.id_hocphan=m.id_hocphan
	join lophocphan l on l.id_lophocphan=m.id_lophocphan
	join ct_hocphan c on c.id_hocphan=hp.id_hocphan
	join giangday gd on gd.id=m.id join giangvien gv on gv.id_giangvien=gd.id_giangvien
	where md5(sv.id_sinhvien)='$is' limit $start_from,$bangghimoitrang";
	$laymh1=mysql_query($sql1);
	$bangghimoitrang1=!empty($_GET['per_page'])?$_GET['per_page']:8;
	$tranghientai1=!empty($_GET['page'])?$_GET['page']:1;
	$pt1="select count(h.id_hoctap) from sinhvien sv join hoctap h on sv.id_sinhvien=h.id_sinhvien
	join monlop m on m.id=h.id join hocphan hp on hp.id_hocphan=m.id_hocphan
	join lophocphan l on l.id_lophocphan=m.id_lophocphan
	join ct_hocphan c on c.id_hocphan=hp.id_hocphan
	join giangday gd on gd.id=m.id join giangvien gv on gv.id_giangvien=gd.id_giangvien
	where md5(sv.id_sinhvien)='$is'";
	$qr1=mysql_query($pt1); 
    $cot1 = mysql_fetch_row($qr1);  
    $tongbangghi1 = $cot1[0];  
   	$tongsotrang1 = ceil($tongbangghi1 / $bangghimoitrang1); 
	while($tt1=mysql_fetch_assoc($laymh1)){
		if($a1==0){
	echo "<tr>";
	}

?>
<?php
$lt=$tt1['thuhocLT'];
$plt=$tt1['phonghocLT'];
$th=$tt1['thuhocTH'];
$pth=$tt1['phonghocTH'];
?>
<br />
                    	<td><center><p style="background-image: url('https://tse3.mm.bing.net/th?id=OIP.KBCZQ_Mrn2I5jzatY3AFkwHaEK&pid=Api&P=0&h=180;" class="r"><a href="ctmonhoc.php?bm=<?php 
						echo $_REQUEST['bm']?>&&is=<?php echo $tt1['id_sinhvien'] ?>&&ihp=<?php echo md5($tt1['id_hocphan']); ?>&&il=<?php echo $tt1['id_lophocphan'] ?>&&ctmh"><?php echo "<br/>"."<hp>".$tt1['tenhocphan'].'&nbsp;('.$tt1['mahocphan'].")"."</a></hp><br><br>Lớp Học Phần&nbsp;:&nbsp;" ?><?php echo $tt1['tenlophocphan'] ?></p></center></td>
                    <?php
	$a1++;
	if($a1==4){
		echo "</tr>";
	}
	}
	?>
    </thead>
    </table>
    <p></p>
            <center><?php include_once("Controller/cPage1.php"); ?></center>
            <br />
</div>

<br/>
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