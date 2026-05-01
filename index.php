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
<p></p>
</div>
<div>
<center><img src="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180" height="75px" width="120px" /></center>
</div>
<br/>

<center>
<div id="menu"> <!--Start the unordered list after the opening menu division -->
  <ul>
    <li><a href="index.php"><strong>Trang Chủ</strong></a></li>
    <li><a href="login-sv.php"><strong>Sinh Viên</strong></a></li>
    <li><a href="login-gv.php"><strong>Giảng Viên</strong></a></li>
    <li><a href="login-ad.php"><strong>AdminHT</strong></a></li>
    <li><a href="index.php?tintuc"><strong>Tin Tức</strong></a></li>
  </ul>  
</div>
</center>
<br />
<hr />
<br />

<div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
<?php
if(isset($_REQUEST['tintuc'])){
	?>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
    <?php
	if(isset($_REQUEST['ct'])){
	?>

    <?php
	include_once("Model/mKetNoiSV.php");
	$p=new ketnoiSV();
	$p->ketnoi($ketnoi);
	$ct=$_REQUEST['ct'];
	$sql="select * from tintuc where id_tintuc='$ct'";
	$qr=mysql_query($sql);
	$m=mysql_fetch_assoc($qr);
	?>
    <h4><?php echo $m['tieude'] ?></h4>
    <p></p>
    <i>Tác giả:&nbsp;<strong><?php echo $m['tacgia'] ?></strong></i>&nbsp;-&nbsp;<i>Ngày Đăng Tải:&nbsp;<strong><?php echo $m['ngaydangtai'] ?></strong></i>
    <br />
    <p></p>
    <?php echo $m['noidung'] ?>
    </div>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
    <?php
	}
	else{
		?>
        <h5>Tin Tức</h5>
    <br /><?php
	include_once("Model/mKetNoiSV.php");
	$p=new ketnoiSV();
	$p->ketnoi($ketnoi);
	$sql="select * from tintuc";
	$qr=mysql_query($sql);
	while($x=mysql_fetch_assoc($qr)){
		?>
        <a href="index.php?tintuc&&ct=<?php echo $x['id_tintuc'] ?>"><img src="<?php echo $x['anhdaidien'] ?>" height="100px" 
        width="160px" />&nbsp;&nbsp;<strong><?php echo $x['tieude'] ?>
        </strong>&nbsp;|&nbsp;<?php echo $x['ngaydangtai'] ?>&nbsp;-&nbsp;Tác giả:&nbsp;<?php echo $x['tacgia'] ?></a><br /><br />
        <?php
	}
	}
	?>
    <br />
    <?php
}
else{
	?>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
    <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
    <br />
    <h5>Giới Thiệu</h5>
    <br />
    - Hi All ! Đây Là Hệ Thống Học Trực Tuyến Nhé :)
    <br /><p></p>
    - Hệ thống được tích hợp các chức năng hữu ích, cần thiết và giúp ích làm cho việc giảng dạy và học tập được diễn ra hiệu quả và 
    suôn sẻ hơn.
    <p></p>
   <strong> * Những mặt lợi ích hệ thống mang lại :</strong>
    <p></p>
    - Thuận lợi lưu trữ tài liệu học tập
    <p></p>
    - Tăng cường tương tác giữa GV-SV
    <p></p>
    - Khả năng học tập linh hoạt
    <p></p>
    - ...
    <p></p>
    <strong>* Giải pháp học tập hiệu quả:</strong>
    <p></p>
    <strong>Lựa chọn môi trường học tập phù hợp</strong>
    <p></p>
Môi trường là yếu tố có ảnh hưởng lớn đến hiệu quả của buổi học. Vì thế một không gian yên tĩnh, không ồn ào, thoáng mát là những tiêu chí để tạo môi trường lý tưởng để thực hiện buổi học online. Vì thế bạn nên lựa chọn một môi trường đủ ánh sáng, không gian yên tĩnh để không ảnh hưởng đến cảm hứng học tập và giúp cho việc tiếp thu bài giảng hiệu quả hơn.
<p></p>
<strong>Tham khảo các tài liệu trước khi học online</strong>
<p></p>
<img src="https://o.rada.vn/data/image/2021/05/24/Hoc-online.jpg" width="100%" />
<p></p>
Tham khảo tài liệu trước khi học online
Trước khi bắt đầu buổi học trực tuyến, bạn nên đọc trước tài liệu, bài giảng để nắm trước những kiến thức sẽ được dạy trong buổi học đó. Điều này sẽ giúp cho khi nghe giảng bạn sẽ dễ dàng hơn trong việc hiểu và ghi nhớ chúng. Và khi nghe giảng xong bạn sẽ dễ dàng chinh phục được các bài tập và trở nên hứng thú với bài học hơn.
<p></p>
<strong>Rèn luyện thói quen học tập hàng ngày</strong>
<p></p>
Phương pháp học online muốn đạt hiệu quả cao thì đòi hỏi bạn cần nghiêm túc, tạo thói quen tốt trong quá trình học tập. Khi có thời gian rảnh, bạn nên vào bài học mỗi ngày, điều này giúp việc bổ sung kiến thức mới được liên tục hơn. Học tập hàng ngày giúp bạn cảm thấy thoải mái, không bị áp lực, tránh tÌnh trạng lười biếng. Hơn nữa khi tạo thói quen học hàng ngày cũng sẽ giúp bạn ghi nhớ các thông tin, kiến thức cần thiết được cập nhật mỗi ngày.
<p></p>
<strong>Cải thiện kỹ năng đọc nhanh</strong>
<p></p>
Giải pháp học online hiệu quả đó là bạn cần cải thiện kỹ năng đọc nhanh của mình khi tham gia vào bài học trực tuyến. Rèn luyện đọc nhanh giúp bạn nắm bắt được nhiều thông tin dễ dàng và nâng cao hiệu quả trong học tập của chính bản thân mình.
<p></p>
Kỹ năng đọc nhanh được cải thiện sẽ giúp phương pháp học trực tuyến của bạn được cập nhật thêm nhiều thông tin quan trọng trong khoảng thời gian nhất định. Từ đó, quá trình học online sẽ có khả năng cải thiện kết quả như mong muốn.
<p></p>
<strong>Rèn luyện khả năng ghi chép thường xuyên</strong>
<p></p>
Khi tham gia học tập trực tuyến, đừng quên ghi chép lại những khía cạnh kiến thức mà bản thân cảm thấy cần thiết để biến nó trở thành kho tàng dữ liệu quý báu cho lĩnh vực đang học. Hãy tận dụng kỹ năng ghi chép của bản thân để lưu lại chúng bởi những thông tin này sẽ giúp bạn nhớ bài hơn thay vì phải xem lại toàn bộ bài giảng.
<p></p>
<strong>Tạo nhóm học tập hiệu quả</strong>
<p></p>
Tham gia vào học tập trực tuyến, bạn không phải tự mình tham gia khóa học một mình. Để đạt kết quả cao trong học online, bạn nên chia sẻ cho nhiều người khác có nhu cầu học, tạo nhóm học tập hiệu quả. Phương pháp này giúp bạn có thể trao đổi thông tin và thảo luận đề tài với nhau, giúp bổ sung kiến thức hỗ trợ nhau trong quá trình học.
<p></p>
<img src="https://tuyengiao.vn/Uploads/2022/12/9/10/HN1.jpg" width="100%" />
<p></p>
Ngoài ra, khi học online bạn còn có thể trao đổi thông tin qua các group, diễn đàn để học hỏi, chia sẻ thông tin nhằm bổ trợ cho nhau để giúp đạt được kết quả học tập tốt.
<p></p>
...
<p align="right"><strong>Phuc Nguyen</strong></p>

    </div>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
    </div>
    <?php
}
?>	
</div>
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