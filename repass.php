<?php
session_start();
$_SESSION['re']=$_POST['re'];
$se=$_SESSION['re'];
$_SESSION['re']=strtotime("now");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script type="text/javascript" src="js/jquery.zoom.min.js"></script>

<script src="https://unpkg.com/js-image-zoom@0.4.1/js-image-zoom.js" type="application/javascript"></script>
<title>Trung Tam He thong CRM</title>
<link rel="icon" type="image/png" href="https://tse2.explicit.bing.net/th?id=OIP.AcaQjWrR2eV624qu8m6nIgHaHa&pid=Api&P=0&h=180"/>
<style>
tk{
	color:#C99;
	font-family:"Comic Sans MS", cursive;
	font-size:25px;
	
}
ps{
	color:#F33;
	font-size:18px;
}
table, th, td {
  border: 1px solid black;
}
</style>
</head>
<body>
<center>
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
        
                 </div>
    	<div class="row">
                 	<div class="col-xs-3 col-sm-3 col-md-3 col-ld-3">
                    	
                    </div>  
                    <div class="col-xs-6 col-sm-6 col-md-6 col-ld-6 border">
                    <br />
               
                    	
                        <?php
						    $p=$_POST['p'];
						    $OTP=$_POST['OTP'];
							$numOTP=$_POST['numOTP'];
							$tgn=$_POST['tgn'];
							$hieuluc= $_SESSION['re']-$tgn;
						if($OTP!=$numOTP){
								echo "<script>alert('Mã OTP không đúng!')</script>";
								echo header("refresh:0,url='resetpass.php'");
							}
						elseif($hieuluc>2*60){
								echo "<script>alert('Mã OTP hết hiệu lực!')</script>";
								echo header("refresh:0,url='resetpass.php'");
							}
						else{
							echo header("refresh:0,url='rpass.php?xm=".md5($se)."&&e=".$se."'");
						}
							
							
								?>
                            
                                <?php
					
							
?>
                    </div>  
                    
                    <div class="col-xs-3 col-sm-3 col-md-3 col-ld-3">
                    	
                    </div>  
</div>

                 
    </div>
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
</center>
</body>
</html>

<?php
/*
<center><table border='0.5px' width='100%'>

<tr style='background-color:#CFF;'>
<th>123</th>
<th>345</th>
</tr>
<td><center>123</center></td>
<td><center>345</center></td>
</tr>
</table></center>
*/
?>
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