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

<?php
if(!isset($_REQUEST['bm'])){
	echo header("refresh:0,url='index.php'");
}
?>
<?php
if(isset($_REQUEST['ctmh'])){
	$is=$_REQUEST['is'];
	$il=$_REQUEST['il'];
	$ihp=$_REQUEST['ihp'];
include_once("Model/mKetNoiSV.php");
$p=new ketnoiSV();
$kn=$p->ketnoi($ketnoi);
if($kn){
	$kt="select * from thongketruycap where mahocphan='$ihp' and id_lophocphan='$il' and id_sinhvien='$is'";
	$k=mysql_query($kt);
	if(mysql_num_rows($k)==1){
	$sql="update thongketruycap set ngaytruycap=now() where mahocphan='$ihp' and id_lophocphan='$il' and id_sinhvien='$is'";
	$qr=mysql_query($sql);
	}
	else{
	$sql="insert into thongketruycap(ngaytruycap, mahocphan, id_lophocphan, id_sinhvien)
	values(now(), '$ihp', '$il', '$is')";
	$qr=mysql_query($sql);
	}
}
}
?>
<?php
/* Sinh viên nộp bài */
if(isset($_POST['nop'])){
include_once("Model/mKetNoiSV.php");
$p=new ketnoiSV();
$kn=$p->ketnoi($ketnoi);
if($kn){
	//file.zip
$t=$_FILES['f']['type'];
$s=$_FILES['f']['size'];
if($s > 10*1024*1024){
	echo "<script>alert('Kích thước file không được quá 10MB !')</script>";
}
if($t!='text/plain'&&$t!='application/x-zip-compressed'&&$t!='application/vnd.openxmlformats-officedocument.wordprocessingml.document'
&&$t!='application/pdf'&&$t!='application/msword'&&$t!='application/x-rar-compressed'&&$t!='application/octet-stream'&&
$t!='application/x-compressed'&&$t!='application/vnd.openxmlformats-officedocument.presentationml.presentation'){
	echo "<script>alert('Định dạng file không được chấp nhận')</script>";
}
else{
if($t=='application/x-zip-compressed'){
function searchAndDeleteZipWithKeyword($zipFilePath, $keyword) {
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	
    if (file_exists($zipFilePath)) {
        $zip = new ZipArchive;

        if ($zip->open($zipFilePath) === TRUE) {
            $keywordFound = false;

            // Duyệt qua các file trong file ZIP và kiểm tra từ khóa trong nội dung của chúng
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $fileContent = $zip->getFromIndex($i);

                // Kiểm tra xem từ khóa có tồn tại trong nội dung của file không
                if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
                    $keywordFound = true;
                    break;
                }
            }

            $zip->close();

            if ($keywordFound) {
                // Xóa file ZIP nếu từ khóa được tìm thấy
                if (unlink($zipFilePath)) {
                    echo "<script>alert('File .zip chứa mã thực thi không cho upload !')</script>";
                } else {
					
                    
                }
            } else {
                $a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	$sql="insert into filenopbtlt(tieude,filenop,ngaynop,id_btlt,id_sinhvien) values ('$a','$f', now(), '$id', '$is')";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&&is=".$_REQUEST['is']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&id=".$_REQUEST['id']."&&nopbai&&ctmh#bt'");
            }
        } else {
            echo "Không thể mở file ZIP.";
        }
    } else {
        echo "File ZIP không tồn tại.";
    }
	
}

// Sử dụng hàm để kiểm tra từ khóa và xóa file ZIP
$zipFilePath = 'file/'.$_FILES['f']['name']; // Đường dẫn tới file ZIP bạn muốn kiểm tra và xóa
searchAndDeleteZipWithKeyword($zipFilePath, $searchKeyword);

}
elseif($t=='application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
	$filename = $_FILES['f']['tmp_name'];
	$filetype = $_FILES['f']['type'];

    if(!$filename || !file_exists($filename)){
        echo "File không tồn tại.";
        return;
    }

    $zip = new ZipArchive;
    if ($zip->open($filename) === true) {
        $content = $zip->getFromName('word/document.xml');
        $zip->close();

        $content = strip_tags($content);
        $content = html_entity_decode($content);
    } else {
        echo "<script> alert('Không thể mở tệp .zip !')</script>";
    }
	if(strpos($content,'Exec(')!=false||strpos($content,'System')!=false||strpos($content,'exec(')!=false||strpos($content,'system(')!=
	false||strpos($content,'Eval(')!=false||strpos($content,'eval(')!=false||strpos($content,'Propen(')!=false||strpos($content,'propen(')!=false||strpos($content,'Phpinfo(')!=false||strpos($content,'phpinfo(')!=false||strpos($content,'Chmod(')!=false||strpos($content,'chmod(')!=false){
		  echo "<script>alert('File .docx chứa mã thực thi không cho upload !')</script>";
	}
	else{
		$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	$sql="insert into filenopbtlt(tieude,filenop,ngaynop,id_btlt,id_sinhvien) values ('$a','$f', now(), '$id', '$is')";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&&is=".$_REQUEST['is']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&id=".$_REQUEST['id']."&&nopbai&&ctmh#bt'");
	}
}
elseif($t=='application/vnd.openxmlformats-officedocument.presentationml.presentation'){
	class DocxConversion {
    private $filename;

    function __construct($filePath) {
	$file = $_FILES['f']['tmp_name'];
    $path = "file/".$_FILES['f']['name'];
	move_uploaded_file($file,$path);
        $this->filename = "file/".$_FILES['f']['name'];
    }
        function pptx_to_text() {
        $zip_handle = new ZipArchive;
        $output_text = "";
        $slide_number = 1; // loop through slide files

        if (true === $zip_handle->open($this->filename)) {
            while (($xml_index = $zip_handle->locateName("ppt/slides/slide" . $slide_number . ".xml")) !== false) {
                $xml_datas = $zip_handle->getFromIndex($xml_index);
                $xml_handle = new DOMDocument;
                $xml_handle->loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
                $output_text .= strip_tags($xml_handle->saveXML());
                $slide_number++;
            }

            if ($slide_number == 1) {
                $output_text .= "";
            }

            $zip_handle->close();
        } else {
            $output_text .= "";
        }

        return $output_text;
    }

    function convertToText() {
        if (isset($this->filename) && !file_exists($this->filename)) {
            return "File Not exists";
        }

        $fileArray = pathinfo($this->filename);
        $file_ext  = $fileArray['extension'];

        if ($file_ext == "doc" || $file_ext == "docx" || $file_ext == "xlsx" || $file_ext == "pptx") {
            if ($file_ext == "pptx") {
                return $this->pptx_to_text();
            }
        } else {
            return "Invalid File Type";
        }
    }
	}
	$docObj = new DocxConversion($_FILES['f']['name']); // replace your document name with the correct extension doc or docx
$content = $docObj->convertToText();
if(strpos($content,'Exec(')!=false||strpos($content,'System')!=false||strpos($content,'exec(')!=false||strpos($content,'system(')!=
	false||strpos($content,'Eval(')!=false||strpos($content,'eval(')!=false||strpos($content,'Propen(')!=false||strpos($content,'propen(')!=false||strpos($content,'Phpinfo(')!=false||strpos($content,'phpinfo(')!=false||strpos($content,'Chmod(')!=false||strpos($content,'chmod(')!=false){
		  echo "<script>alert('File .pptx chứa mã thực thi không cho upload !')</script>";
		unlink("file/".$_FILES['f']['name']);
	}
	else{
		$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	$sql="insert into filenopbtlt(tieude,filenop,ngaynop,id_btlt,id_sinhvien) values ('$a','$f', now(), '$id', '$is')";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&&is=".$_REQUEST['is']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&id=".$_REQUEST['id']."&&nopbai&&ctmh#bt'");
		
	}
}
elseif($t='application/octet-stream'||$t='text/plain'){
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	$filePath = 'file/'.$_FILES['f']['name']; // Đường dẫn đến file PHP bạn muốn quét

$fileContent = file_get_contents($filePath);

if ($fileContent !== false) {
    if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
		unlink($filePath);
        echo "<script>alert('Phát hiện file .txt/.php chứa mã thực thi không cho up')</script>";
        // Thực hiện các hành động khi tìm thấy từ khóa trong file PHP
    } else {
		$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	$sql="insert into filenopbtlt(tieude,filenop,ngaynop,id_btlt,id_sinhvien) values ('$a','$f', now(), '$id', '$is')";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&&is=".$_REQUEST['is']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&id=".$_REQUEST['id']."&&nopbai&&ctmh#bt'");
    }
} else {
    echo "Không thể đọc file.";
}
}
}
	/*
	$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	if(isset($_POST['nop'])){
		$filename = $_FILES['f']['tmp_name'];
	$filetype = $_FILES['f']['type'];
	$size=$_FILES['f']['size'];
	$type=$_FILES['f']['type'];
if($size > 10*1024*1024){
	echo "<script>alert('Quá Lớn!')</script>";
}
elseif($type!="application/vnd.openxmlformats-officedocument.wordprocessingml.document"&&$filetype!="application/msword"&&
$filetype!="application/pdf"&&$filetype!="application/zip"){
	echo "<script>alert('Tập Tin Định Dạng Không Chấp Nhận')</script>";
}
else{
    if(!$filename || !file_exists($filename)){
        echo "File không tồn tại.";
        return;
    }

    $zip = new ZipArchive;
    if ($zip->open($filename) === true) {
        $content = $zip->getFromName('word/document.xml');
        $zip->close();

        $content = strip_tags($content);
        $content = html_entity_decode($content);
    } else {
        echo "<script> alert('Không thể mở tệp tin zip')</script>";
    }
	if(strpos($content,'Exec(')!=false||strpos($content,'System')!=false||strpos($content,'exec(')!=false||strpos($content,'system(')!=
	false||strpos($content,'Eval(')!=false||strpos($content,'eval(')!=false||strpos($content,'Propen(')!=false||strpos($content,'propen(')!=false||strpos($content,'Phpinfo(')!=false||strpos($content,'phpinfo(')!=false||strpos($content,'Chmod(')!=false||strpos($content,'chmod(')!=false){
		echo "<script> alert('Đã phát hiện shell web tiềm năng không cho upload !')</script>";
	}
	else{
		$target_directory = 'file/';
        $target_file = $target_directory.basename($f);
        move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
		$sql="insert into filenopbtlt(tieude,filenop,ngaynop,id_btlt,id_sinhvien) values ('$a','$f', now(), '$id', '$is')";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&&is=".$_REQUEST['is']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&id=".$_REQUEST['id']."&&nopbai&&ctmh#bt'");
	}
		
	}
	}
	*/
}
}
?>

<?php
/* Sinh viên nộp bài tập thực hành*/
include_once("Model/mKetNoiSV.php");
$p=new ketnoiSV();
$kn=$p->ketnoi($ketnoi);
if($kn){
	if(isset($_POST['nopth'])){
		//file.zip
$t=$_FILES['f']['type'];
$s=$_FILES['f']['size'];
if($s > 10*1024*1024){
	echo "<script>alert('Kích thước file không được quá 10MB !')</script>";
}
if($t!='text/plain'&&$t!='application/x-zip-compressed'&&$t!='application/vnd.openxmlformats-officedocument.wordprocessingml.document'
&&$t!='application/pdf'&&$t!='application/msword'&&$t!='application/x-rar-compressed'&&$t!='application/octet-stream'){
	echo "<script>alert('Định dạng file không được chấp nhận !')</script>";
}
else{
if($t=='application/x-zip-compressed'){
function searchAndDeleteZipWithKeyword($zipFilePath, $keyword) {
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	
    if (file_exists($zipFilePath)) {
        $zip = new ZipArchive;

        if ($zip->open($zipFilePath) === TRUE) {
            $keywordFound = false;

            // Duyệt qua các file trong file ZIP và kiểm tra từ khóa trong nội dung của chúng
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $fileContent = $zip->getFromIndex($i);

                // Kiểm tra xem từ khóa có tồn tại trong nội dung của file không
                if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
                    $keywordFound = true;
                    break;
                }
            }

            $zip->close();

            if ($keywordFound) {
                // Xóa file ZIP nếu từ khóa được tìm thấy
                if (unlink($zipFilePath)) {
                    echo "<script>alert('File .zip chứa mã thực thi không thể upload !')</script>";
                } else {
                    
                }
            } else {
                $a=$_POST['a'];
					$f=$_FILES['f']['name'];
					$is=$_REQUEST['is'];
					$id=$_REQUEST['id'];
		$sql="insert into filenopbtth(tieude,filenop,ngaynop,id_btth,id_sinhvien) values ('$a','$f', now(), '$id', '$is')";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&&is=".$_REQUEST['is']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&id=".$_REQUEST['id']."&&nopbaith&&ctmh#btth'");
            }
        } else {
            echo "Không thể mở file ZIP.";
        }
    } else {
        echo "File ZIP không tồn tại.";
    }
	
}

// Sử dụng hàm để kiểm tra từ khóa và xóa file ZIP
$zipFilePath = 'file/'.$_FILES['f']['name']; // Đường dẫn tới file ZIP bạn muốn kiểm tra và xóa
searchAndDeleteZipWithKeyword($zipFilePath, $searchKeyword);

}
elseif($t=='application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
	$filename = $_FILES['f']['tmp_name'];
	$filetype = $_FILES['f']['type'];

    if(!$filename || !file_exists($filename)){
        echo "File không tồn tại.";
        return;
    }

    $zip = new ZipArchive;
    if ($zip->open($filename) === true) {
        $content = $zip->getFromName('word/document.xml');
        $zip->close();

        $content = strip_tags($content);
        $content = html_entity_decode($content);
    } else {
        echo "<script> alert('Không thể mở tệp .zip !')</script>";
    }
	if(strpos($content,'Exec(')!=false||strpos($content,'System')!=false||strpos($content,'exec(')!=false||strpos($content,'system(')!=
	false||strpos($content,'Eval(')!=false||strpos($content,'eval(')!=false||strpos($content,'Propen(')!=false||strpos($content,'propen(')!=false||strpos($content,'Phpinfo(')!=false||strpos($content,'phpinfo(')!=false||strpos($content,'Chmod(')!=false||strpos($content,'chmod(')!=false){
		 echo "<script>alert('File .docx chứa mã thực thi không thể upload !')</script>";
	}
	else{
					$a=$_POST['a'];
					$f=$_FILES['f']['name'];
					$is=$_REQUEST['is'];
					$id=$_REQUEST['id'];
		$sql="insert into filenopbtth(tieude,filenop,ngaynop,id_btth,id_sinhvien) values ('$a','$f', now(), '$id', '$is')";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&&is=".$_REQUEST['is']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&id=".$_REQUEST['id']."&&nopbaith&&ctmh#btth'");
	}
}
elseif($t='application/octet-stream'||$t='text/plain'){
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	$filePath = 'file/'.$_FILES['f']['name']; // Đường dẫn đến file PHP bạn muốn quét

$fileContent = file_get_contents($filePath);

if ($fileContent !== false) {
    if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
		unlink($filePath);
		 echo "<script>alert('File .txt/ .php chứa mã thực thi không thể upload !')</script>";
        // Thực hiện các hành động khi tìm thấy từ khóa trong file PHP
    } else {
		$a=$_POST['a'];
					$f=$_FILES['f']['name'];
					$is=$_REQUEST['is'];
					$id=$_REQUEST['id'];
		$sql="insert into filenopbtth(tieude,filenop,ngaynop,id_btth,id_sinhvien) values ('$a','$f', now(), '$id', '$is')";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&&is=".$_REQUEST['is']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&id=".$_REQUEST['id']."&&nopbaith&&ctmh#btth'");
        // Thực hiện các hành động khi không tìm thấy từ khóa trong file PHP
    }
} else {
    echo "Không thể đọc file.";
}
}
}
	}
	/*$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
		$target_directory = 'file/';
        $target_file = $target_directory.basename($f);
        move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
		$sql="insert into filenopbtth(tieude,filenop,ngaynop,id_btth,id_sinhvien) values ('$a','$f', now(), '$id', '$is')";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&&is=".$_REQUEST['is']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&id=".$_REQUEST['id']."&&nopbaith&&ctmh#btth'");
		
	}
	*/
}
?>

<?php
/* Sinh viên nộp bài kiểm tra thực hành*/
if(isset($_POST['nopktth'])){
include_once("Model/mKetNoiSV.php");
$p=new ketnoiSV();
$kn=$p->ketnoi($ketnoi);
if($kn){
	//file.zip
$t=$_FILES['f']['type'];
$s=$_FILES['f']['size'];
if($s > 10*1024*1024){
	echo "<script>alert('Kích thước file không được quá 10MB !')</script>";
}
if($t!='text/plain'&&$t!='application/x-zip-compressed'&&$t!='application/vnd.openxmlformats-officedocument.wordprocessingml.document'
&&$t!='application/pdf'&&$t!='application/msword'&&$t!='application/x-rar-compressed'&&$t!='application/octet-stream'&&
$t!='application/x-compressed'){
	echo "<script>alert('Định dạng file không được chấp nhận !')</script>";
}
else{
if($t=='application/x-zip-compressed'){
function searchAndDeleteZipWithKeyword($zipFilePath, $keyword) {
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	
    if (file_exists($zipFilePath)) {
        $zip = new ZipArchive;

        if ($zip->open($zipFilePath) === TRUE) {
            $keywordFound = false;

            // Duyệt qua các file trong file ZIP và kiểm tra từ khóa trong nội dung của chúng
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $fileContent = $zip->getFromIndex($i);

                // Kiểm tra xem từ khóa có tồn tại trong nội dung của file không
                if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
                    $keywordFound = true;
                    break;
                }
            }

            $zip->close();

            if ($keywordFound) {
                // Xóa file ZIP nếu từ khóa được tìm thấy
                if (unlink($zipFilePath)) {
                    echo "<script>alert('File .zip chứa mã thực thi không cho upload !')</script>";
                } else {
					
                    
                }
            } else {
               $a=$_POST['a'];
		$f=$_FILES['f']['name'];
		$is=$_REQUEST['is'];
		$id=$_REQUEST['id'];
		$sql="insert into filenopbtth(tieude,filenop,ngaynop,id_btth,id_sinhvien) values ('$a','$f', now(), '$id', '$is')";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&&is=".$_REQUEST['is']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&id=".$_REQUEST['id']."&&nopbaith&&ctmh#btthkt'");
            }
        } else {
            echo "Không thể mở file ZIP.";
        }
    } else {
        echo "File ZIP không tồn tại.";
    }
	
}

// Sử dụng hàm để kiểm tra từ khóa và xóa file ZIP
$zipFilePath = 'file/'.$_FILES['f']['name']; // Đường dẫn tới file ZIP bạn muốn kiểm tra và xóa
searchAndDeleteZipWithKeyword($zipFilePath, $searchKeyword);

}
elseif($t=='application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
	$filename = $_FILES['f']['tmp_name'];
	$filetype = $_FILES['f']['type'];

    if(!$filename || !file_exists($filename)){
        echo "File không tồn tại.";
        return;
    }

    $zip = new ZipArchive;
    if ($zip->open($filename) === true) {
        $content = $zip->getFromName('word/document.xml');
        $zip->close();

        $content = strip_tags($content);
        $content = html_entity_decode($content);
    } else {
        echo "<script> alert('Không thể mở tệp .zip !')</script>";
    }
	if(strpos($content,'Exec(')!=false||strpos($content,'System')!=false||strpos($content,'exec(')!=false||strpos($content,'system(')!=
	false||strpos($content,'Eval(')!=false||strpos($content,'eval(')!=false||strpos($content,'Propen(')!=false||strpos($content,'propen(')!=false||strpos($content,'Phpinfo(')!=false||strpos($content,'phpinfo(')!=false||strpos($content,'Chmod(')!=false||strpos($content,'chmod(')!=false){
		echo "<script> alert('File .docx chứa mã thực thi không cho upload !')</script>";
	}
	else{
		$a=$_POST['a'];
		$f=$_FILES['f']['name'];
		$is=$_REQUEST['is'];
		$id=$_REQUEST['id'];
		$sql="insert into filenopbtth(tieude,filenop,ngaynop,id_btth,id_sinhvien) values ('$a','$f', now(), '$id', '$is')";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&&is=".$_REQUEST['is']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&id=".$_REQUEST['id']."&&nopbaith&&ctmh#btthkt'");
	}
}
elseif($t='application/octet-stream'||$t='text/plain'){
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	$filePath = 'file/'.$_FILES['f']['name']; // Đường dẫn đến file PHP bạn muốn quét

$fileContent = file_get_contents($filePath);

if ($fileContent !== false) {
    if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
		unlink($filePath);
        echo "<script>alert('File .txt/.php có chứa mã thực thi web không cho upload !')</script>";
        // Thực hiện các hành động khi tìm thấy từ khóa trong file PHP
    } else {
        // Thực hiện các hành động khi không tìm thấy từ khóa trong file PHP
		$a=$_POST['a'];
		$f=$_FILES['f']['name'];
		$is=$_REQUEST['is'];
		$id=$_REQUEST['id'];
		$sql="insert into filenopbtth(tieude,filenop,ngaynop,id_btth,id_sinhvien) values ('$a','$f', now(), '$id', '$is')";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&&is=".$_REQUEST['is']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&id=".$_REQUEST['id']."&&nopbaith&&ctmh#btthkt'");
    }
} else {
    echo "Không thể đọc file.";
}
}
}

	/*
	$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	if(isset($_POST['nopktth'])){
		$target_directory = 'file/';
        $target_file = $target_directory.basename($f);
        move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
		$sql="insert into filenopbtth(tieude,filenop,ngaynop,id_btth,id_sinhvien) values ('$a','$f', now(), '$id', '$is')";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&&is=".$_REQUEST['is']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&id=".$_REQUEST['id']."&&nopbaith&&ctmh#btthkt'");
		
	}
	*/
}
}
?>


<?php
/* Sinh viên sửa bài */
if(isset($_POST['suab'])){
include_once("Model/mKetNoiSV.php");
$p=new ketnoiSV();
$kn=$p->ketnoi($ketnoi);
if($kn){
	//file.zip
$t=$_FILES['f']['type'];
$s=$_FILES['f']['size'];
if($s > 10*1024*1024){
	echo "<script>alert('Kích thước file không được quá 10MB !')</script>";
}
if($t!='text/plain'&&$t!='application/x-zip-compressed'&&$t!='application/vnd.openxmlformats-officedocument.wordprocessingml.document'
&&$t!='application/pdf'&&$t!='application/msword'&&$t!='application/x-rar-compressed'&&$t!='application/octet-stream'&&
$t!='application/x-compressed'&&$t!='application/vnd.openxmlformats-officedocument.presentationml.presentation'){
	echo "<script>alert('Định dạng file không được chấp nhận')</script>";
}
else{
if($t=='application/x-zip-compressed'){
function searchAndDeleteZipWithKeyword($zipFilePath, $keyword) {
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	
    if (file_exists($zipFilePath)) {
        $zip = new ZipArchive;

        if ($zip->open($zipFilePath) === TRUE) {
            $keywordFound = false;

            // Duyệt qua các file trong file ZIP và kiểm tra từ khóa trong nội dung của chúng
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $fileContent = $zip->getFromIndex($i);

                // Kiểm tra xem từ khóa có tồn tại trong nội dung của file không
                if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
                    $keywordFound = true;
                    break;
                }
            }

            $zip->close();

            if ($keywordFound) {
                // Xóa file ZIP nếu từ khóa được tìm thấy
                if (unlink($zipFilePath)) {
                    echo "<script>alert('File .zip chứa từ khóa không cho upload !')</script>";
                } else {
					
                    
                }
            } else {
                $a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	$sql="update filenopbtlt set tieude='$a', filenop='$f', ngaynop=now() where id_sinhvien='$is' and id_btlt='$id'";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&&is=".$_REQUEST['is']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&id=".$_REQUEST['id']."&&nopbai&&ctmh#bt'");
            }
        } else {
            echo "Không thể mở file ZIP.";
        }
    } else {
        echo "File ZIP không tồn tại.";
    }
	
}

// Sử dụng hàm để kiểm tra từ khóa và xóa file ZIP
$zipFilePath = 'file/'.$_FILES['f']['name']; // Đường dẫn tới file ZIP bạn muốn kiểm tra và xóa
searchAndDeleteZipWithKeyword($zipFilePath, $searchKeyword);

}
elseif($t=='application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
	$filename = $_FILES['f']['tmp_name'];
	$filetype = $_FILES['f']['type'];

    if(!$filename || !file_exists($filename)){
        echo "File không tồn tại.";
        return;
    }

    $zip = new ZipArchive;
    if ($zip->open($filename) === true) {
        $content = $zip->getFromName('word/document.xml');
        $zip->close();

        $content = strip_tags($content);
        $content = html_entity_decode($content);
    } else {
        echo "<script> alert('Không thể mở tệp .zip !')</script>";
    }
	if(strpos($content,'Exec(')!=false||strpos($content,'System')!=false||strpos($content,'exec(')!=false||strpos($content,'system(')!=
	false||strpos($content,'Eval(')!=false||strpos($content,'eval(')!=false||strpos($content,'Propen(')!=false||strpos($content,'propen(')!=false||strpos($content,'Phpinfo(')!=false||strpos($content,'phpinfo(')!=false||strpos($content,'Chmod(')!=false||strpos($content,'chmod(')!=false){
		echo "<script> alert('File .docx chứa mã thực thi không cho upload !')</script>";
	}
	else{
		$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	$sql="update filenopbtlt set tieude='$a', filenop='$f', ngaynop=now() where id_sinhvien='$is' and id_btlt='$id'";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&&is=".$_REQUEST['is']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&id=".$_REQUEST['id']."&&nopbai&&ctmh#bt'");
	}
}
elseif($t=='application/vnd.openxmlformats-officedocument.presentationml.presentation'){
	class DocxConversion {
    private $filename;

    function __construct($filePath) {
	$file = $_FILES['f']['tmp_name'];
    $path = "file/".$_FILES['f']['name'];
	move_uploaded_file($file,$path);
        $this->filename = "file/".$_FILES['f']['name'];
    }
        function pptx_to_text() {
        $zip_handle = new ZipArchive;
        $output_text = "";
        $slide_number = 1; // loop through slide files

        if (true === $zip_handle->open($this->filename)) {
            while (($xml_index = $zip_handle->locateName("ppt/slides/slide" . $slide_number . ".xml")) !== false) {
                $xml_datas = $zip_handle->getFromIndex($xml_index);
                $xml_handle = new DOMDocument;
                $xml_handle->loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
                $output_text .= strip_tags($xml_handle->saveXML());
                $slide_number++;
            }

            if ($slide_number == 1) {
                $output_text .= "";
            }

            $zip_handle->close();
        } else {
            $output_text .= "";
        }

        return $output_text;
    }

    function convertToText() {
        if (isset($this->filename) && !file_exists($this->filename)) {
            return "File Not exists";
        }

        $fileArray = pathinfo($this->filename);
        $file_ext  = $fileArray['extension'];

        if ($file_ext == "doc" || $file_ext == "docx" || $file_ext == "xlsx" || $file_ext == "pptx") {
            if ($file_ext == "pptx") {
                return $this->pptx_to_text();
            }
        } else {
            return "Invalid File Type";
        }
    }
	}
	$docObj = new DocxConversion($_FILES['f']['name']); // replace your document name with the correct extension doc or docx
$content = $docObj->convertToText();
if(strpos($content,'Exec(')!=false||strpos($content,'System')!=false||strpos($content,'exec(')!=false||strpos($content,'system(')!=
	false||strpos($content,'Eval(')!=false||strpos($content,'eval(')!=false||strpos($content,'Propen(')!=false||strpos($content,'propen(')!=false||strpos($content,'Phpinfo(')!=false||strpos($content,'phpinfo(')!=false||strpos($content,'Chmod(')!=false||strpos($content,'chmod(')!=false){
		echo "<script> alert('File .pptx chứa mã thực thi không cho upload !')</script>";
		unlink("file/".$_FILES['f']['name']);
	}
	else{
		$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	$sql="update filenopbtlt set tieude='$a', filenop='$f', ngaynop=now() where id_sinhvien='$is' and id_btlt='$id'";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&&is=".$_REQUEST['is']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&id=".$_REQUEST['id']."&&nopbai&&ctmh#bt'");
	}
}
elseif($t='application/octet-stream'||$t='text/plain'){
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	$filePath = 'file/'.$_FILES['f']['name']; // Đường dẫn đến file PHP bạn muốn quét

$fileContent = file_get_contents($filePath);

if ($fileContent !== false) {
    if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
		unlink($filePath);
        echo "<script>alert('File .txt/.php chứa mã thực thi không cho upload !')</script>";
        // Thực hiện các hành động khi tìm thấy từ khóa trong file PHP
    } else {
        // Thực hiện các hành động khi không tìm thấy từ khóa trong file PHP
	$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	$sql="update filenopbtlt set tieude='$a', filenop='$f', ngaynop=now() where id_sinhvien='$is' and id_btlt='$id'";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&&is=".$_REQUEST['is']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&id=".$_REQUEST['id']."&&nopbai&&ctmh#bt'");
    }
} else {
    echo "Không thể đọc file.";
}
}
}
/*
if(isset($_POST['suab'])){
	$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	$filename = $_FILES['f']['tmp_name'];
	$filetype = $_FILES['f']['type'];
	$size=$_FILES['f']['size'];
if($size > 10*1024*1024){
	echo "<script>alert('Quá Lớn!')</script>";
}
elseif($filetype!="application/vnd.openxmlformats-officedocument.wordprocessingml.document"&&$filetype!="application/msword"&&
$filetype!="application/pdf"&&$filetype!="application/zip"){
	echo "<script>alert('Tập Tin Định Dạng Không Chấp Nhận')</script>";
}
else{

    if(!$filename || !file_exists($filename)){
        echo "File không tồn tại.";
        return;
    }

    $zip = new ZipArchive;
    if ($zip->open($filename) === true) {
        $content = $zip->getFromName('word/document.xml');
        $zip->close();

        $content = strip_tags($content);
        $content = html_entity_decode($content);
    } else {
        echo "<script> alert('Không thể mở tệp .zip !')</script>";
    }
	if(strpos($content,'Exec(')!=false||strpos($content,'System')!=false||strpos($content,'exec(')!=false||strpos($content,'system(')!=
	false||strpos($content,'Eval(')!=false||strpos($content,'eval(')!=false||strpos($content,'Propen(')!=false||strpos($content,'propen(')!=false||strpos($content,'Phpinfo(')!=false||strpos($content,'phpinfo(')!=false||strpos($content,'Chmod(')!=false||strpos($content,'chmod(')!=false){
		echo "<script> alert('Đã phát hiện shell web tiềm năng không cho upload !')</script>";
	}
	else{
		$target_directory = 'file/';
        $target_file = $target_directory.basename($f);
        move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
		$sql="update filenopbtlt set tieude='$a', filenop='$f', ngaynop=now() where id_sinhvien='$is' and id_btlt='$id'";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&&is=".$_REQUEST['is']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&id=".$_REQUEST['id']."&&nopbai&&ctmh#bt'");
		
	}
	}
}
*/
}
}
?>

<?php
/* Sinh viên sửa bài thực hành */
if(isset($_POST['suabth'])){
include_once("Model/mKetNoiSV.php");
$p=new ketnoiSV();
$kn=$p->ketnoi($ketnoi);
if($kn){
	//file.zip
$t=$_FILES['f']['type'];
$s=$_FILES['f']['size'];
if($s > 10*1024*1024){
	echo "<script>alert('Kích thước file không được quá 10MB !')</script>";
}
if($t!='text/plain'&&$t!='application/x-zip-compressed'&&$t!='application/vnd.openxmlformats-officedocument.wordprocessingml.document'
&&$t!='application/pdf'&&$t!='application/msword'&&$t!='application/x-rar-compressed'&&$t!='application/octet-stream'&&
$t!='application/x-compressed'){
	echo "<script>alert('Định dạng file không được chấp nhận !')</script>";
}
else{
if($t=='application/x-zip-compressed'){
function searchAndDeleteZipWithKeyword($zipFilePath, $keyword) {
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	
    if (file_exists($zipFilePath)) {
        $zip = new ZipArchive;

        if ($zip->open($zipFilePath) === TRUE) {
            $keywordFound = false;

            // Duyệt qua các file trong file ZIP và kiểm tra từ khóa trong nội dung của chúng
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $fileContent = $zip->getFromIndex($i);

                // Kiểm tra xem từ khóa có tồn tại trong nội dung của file không
                if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
                    $keywordFound = true;
                    break;
                }
            }

            $zip->close();

            if ($keywordFound) {
                // Xóa file ZIP nếu từ khóa được tìm thấy
                if (unlink($zipFilePath)) {
                   echo "<script>alert('File .zip chứa mã thực thi không thể upload !')</script>";
                } else {
                    
                }
            } else {
                $a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
		$sql="update filenopbtth set tieude='$a', filenop='$f', ngaynop=now() where id_sinhvien='$is' and id_btth='$id'";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&&is=".$_REQUEST['is']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&id=".$_REQUEST['id']."&&nopbaith&&ctmh#btth'");
            }
        } else {
            echo "Không thể mở file ZIP.";
        }
    } else {
        echo "File ZIP không tồn tại.";
    }
	
}

// Sử dụng hàm để kiểm tra từ khóa và xóa file ZIP
$zipFilePath = 'file/'.$_FILES['f']['name']; // Đường dẫn tới file ZIP bạn muốn kiểm tra và xóa
searchAndDeleteZipWithKeyword($zipFilePath, $searchKeyword);

}
elseif($t=='application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
	$filename = $_FILES['f']['tmp_name'];
	$filetype = $_FILES['f']['type'];

    if(!$filename || !file_exists($filename)){
        echo "File không tồn tại.";
        return;
    }

    $zip = new ZipArchive;
    if ($zip->open($filename) === true) {
        $content = $zip->getFromName('word/document.xml');
        $zip->close();

        $content = strip_tags($content);
        $content = html_entity_decode($content);
    } else {
        echo "<script> alert('Không thể mở tệp .zip !')</script>";
    }
	if(strpos($content,'Exec(')!=false||strpos($content,'System')!=false||strpos($content,'exec(')!=false||strpos($content,'system(')!=
	false||strpos($content,'Eval(')!=false||strpos($content,'eval(')!=false||strpos($content,'Propen(')!=false||strpos($content,'propen(')!=false||strpos($content,'Phpinfo(')!=false||strpos($content,'phpinfo(')!=false||strpos($content,'Chmod(')!=false||strpos($content,'chmod(')!=false){
		echo "<script> alert('Đã phát hiện shell web tiềm năng không cho upload !')</script>";
	}
	else{
		$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
		$sql="update filenopbtth set tieude='$a', filenop='$f', ngaynop=now() where id_sinhvien='$is' and id_btth='$id'";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&&is=".$_REQUEST['is']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&id=".$_REQUEST['id']."&&nopbaith&&ctmh#btth'");
	}
}
elseif($t='application/octet-stream'||$t='text/plain'){
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	$filePath = 'file/'.$_FILES['f']['name']; // Đường dẫn đến file PHP bạn muốn quét

$fileContent = file_get_contents($filePath);

if ($fileContent !== false) {
    if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
		unlink($filePath);
       echo "<script>alert('File .txt/ .php chứa mã thực thi không thể upload !')</script>";
        // Thực hiện các hành động khi tìm thấy từ khóa trong file PHP
    } else {
		$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
		$sql="update filenopbtth set tieude='$a', filenop='$f', ngaynop=now() where id_sinhvien='$is' and id_btth='$id'";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&&is=".$_REQUEST['is']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&id=".$_REQUEST['id']."&&nopbaith&&ctmh#btth'");
    }
} else {
    echo "Không thể đọc file.";
}
}
}
}
/*
if(isset($_POST['suabth'])){
	$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	    $target_directory = 'file/';
        $target_file = $target_directory.basename($f);
        move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
		$sql="update filenopbtth set tieude='$a', filenop='$f', ngaynop=now() where id_sinhvien='$is' and id_btth='$id'";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&&is=".$_REQUEST['is']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&id=".$_REQUEST['id']."&&nopbaith&&ctmh#btth'");
		
	}
	*/
}
?>

<?php
/* Sinh viên sửa bài kiểm tra thực hành */
if(isset($_POST['suabktth'])){
include_once("Model/mKetNoiSV.php");
$p=new ketnoiSV();
$kn=$p->ketnoi($ketnoi);
if($kn){
//file.zip
$t=$_FILES['f']['type'];
$s=$_FILES['f']['size'];
if($s > 10*1024*1024){
	echo "<script>alert('Kích thước file vượt quá 20MB')</script>";
}
if($t!='text/plain'&&$t!='application/x-zip-compressed'&&$t!='application/vnd.openxmlformats-officedocument.wordprocessingml.document'
&&$t!='application/pdf'&&$t!='application/msword'&&$t!='application/x-rar-compressed'&&$t!='application/octet-stream'&&
$t!='application/x-compressed'){
	echo "<script>alert('Định dạng file không được chấp nhận !')</script>";
}
else{
if($t=='application/x-zip-compressed'){
function searchAndDeleteZipWithKeyword($zipFilePath, $keyword) {
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	
    if (file_exists($zipFilePath)) {
        $zip = new ZipArchive;

        if ($zip->open($zipFilePath) === TRUE) {
            $keywordFound = false;

            // Duyệt qua các file trong file ZIP và kiểm tra từ khóa trong nội dung của chúng
            for ($i = 0; $i < $zip->numFiles; $i++) {
                $fileContent = $zip->getFromIndex($i);

                // Kiểm tra xem từ khóa có tồn tại trong nội dung của file không
                if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
                    $keywordFound = true;
                    break;
                }
            }

            $zip->close();

            if ($keywordFound) {
                // Xóa file ZIP nếu từ khóa được tìm thấy
                if (unlink($zipFilePath)) {
                    echo "<script>alert('File .zip chứa mã thực thi không cho upload !')</script>";
                } else {
					
                    
                }
            } else {
               $a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	$sql="update filenopbtth set tieude='$a', filenop='$f', ngaynop=now() where id_sinhvien='$is' and id_btth='$id'";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&&is=".$_REQUEST['is']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&id=".$_REQUEST['id']."&&nopbaith&&ctmh#btthkt'");
            }
        } else {
            echo "Không thể mở file ZIP.";
        }
    } else {
        echo "File ZIP không tồn tại.";
    }
	
}

// Sử dụng hàm để kiểm tra từ khóa và xóa file ZIP
$zipFilePath = 'file/'.$_FILES['f']['name']; // Đường dẫn tới file ZIP bạn muốn kiểm tra và xóa
searchAndDeleteZipWithKeyword($zipFilePath, $searchKeyword);

}
elseif($t=='application/vnd.openxmlformats-officedocument.wordprocessingml.document'){
	$filename = $_FILES['f']['tmp_name'];
	$filetype = $_FILES['f']['type'];

    if(!$filename || !file_exists($filename)){
        echo "File không tồn tại.";
        return;
    }

    $zip = new ZipArchive;
    if ($zip->open($filename) === true) {
        $content = $zip->getFromName('word/document.xml');
        $zip->close();

        $content = strip_tags($content);
        $content = html_entity_decode($content);
    } else {
        echo "<script> alert('Không thể mở tệp .zip !')</script>";
    }
	if(strpos($content,'Exec(')!=false||strpos($content,'System')!=false||strpos($content,'exec(')!=false||strpos($content,'system(')!=
	false||strpos($content,'Eval(')!=false||strpos($content,'eval(')!=false||strpos($content,'Propen(')!=false||strpos($content,'propen(')!=false||strpos($content,'Phpinfo(')!=false||strpos($content,'phpinfo(')!=false||strpos($content,'Chmod(')!=false||strpos($content,'chmod(')!=false){
		echo "<script> alert('File .docx chứa mã thực thi không cho upload !')</script>";
	}
	else{
		$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	$sql="update filenopbtth set tieude='$a', filenop='$f', ngaynop=now() where id_sinhvien='$is' and id_btth='$id'";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&&is=".$_REQUEST['is']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&id=".$_REQUEST['id']."&&nopbaith&&ctmh#btthkt'");
	}
}
elseif($t='application/octet-stream'||$t='text/plain'){
	$a=$_FILES['f']['tmp_name'];
	$b='file/'.$_FILES['f']['name'];
	move_uploaded_file($a,$b);
	$filePath = 'file/'.$_FILES['f']['name']; // Đường dẫn đến file PHP bạn muốn quét

$fileContent = file_get_contents($filePath);

if ($fileContent !== false) {
    if (strpos($fileContent,'Exec(')!=false||strpos($fileContent,'System')!=false||strpos($fileContent,'exec(')!=false||strpos($fileContent,'system(')!=
	false||strpos($fileContent,'Eval(')!=false||strpos($fileContent,'eval(')!=false||strpos($fileContent,'Propen(')!=false||strpos($fileContent,'propen(')!=false||strpos($fileContent,'Phpinfo(')!=false||strpos($fileContent,'phpinfo(')!=false||strpos($fileContent,'Chmod(')!=false||strpos($fileContent,'chmod(')!=false) {
		unlink($filePath);
        echo "<script>alert('File .txt/ .php chứa mã thực thi không cho upload !')</script>";
        // Thực hiện các hành động khi tìm thấy từ khóa trong file PHP
    } else {
        // Thực hiện các hành động khi không tìm thấy từ khóa trong file PHP
		$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	$sql="update filenopbtth set tieude='$a', filenop='$f', ngaynop=now() where id_sinhvien='$is' and id_btth='$id'";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&&is=".$_REQUEST['is']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&id=".$_REQUEST['id']."&&nopbaith&&ctmh#btthkt'");
    }
} else {
    echo "Không thể đọc file.";
}
}
}
}
/*
if(isset($_POST['suabktth'])){
	$a=$_POST['a'];
	$f=$_FILES['f']['name'];
	$is=$_REQUEST['is'];
	$id=$_REQUEST['id'];
	    $target_directory = 'file/';
        $target_file = $target_directory.basename($f);
        move_uploaded_file($_FILES['f']['tmp_name'], $target_file );
		$sql="update filenopbtth set tieude='$a', filenop='$f', ngaynop=now() where id_sinhvien='$is' and id_btth='$id'";
		$qr=mysql_query($sql);
		echo header("refresh:0,url='ctmonhoc.php?bm=".$_REQUEST['bm']."&&is=".$_REQUEST['is']."&&ihp=".$_REQUEST['ihp']."&&il=".$_REQUEST['il']."&&id=".$_REQUEST['id']."&&nopbaith&&ctmh#btthkt'");
		
	}
*/
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
@media(min-width:1200px){
.b1{
	border-radius:50%;
}
.b2{
	border-radius:50%;
	background-color:#CFC;
}
	.u{
		height:200px;
		width:350px;
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
@media(max-width:992px){
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
		width:200px;
	}
	table td{
  padding: 5px;
}
hp{
	font-weight:500;
	font-size:16px;
}
}
textarea{
	height:100px;
	width: 330px;
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
<a href="homeSV.php?bm=<?php echo $_REQUEST['bm']; ?>"><img src="https://tse3.mm.bing.net/th?id=OIP.Mzt3QQhdBuSmGLUb3mxAgAHaDU&pid=Api&P=0&h=180" height="75px" width="120px" /></a>
</div>
<div class="col-xs-6 col-md-6 col-lg-6 col-md-6">
</div>
<div class="col-xs-1 col-md-1 col-lg-1 col-md-1">
<a href="homeSV.php?bm=<?php echo $_REQUEST['bm']; ?>"><center><img src="https://tse4.mm.bing.net/th?id=OIP.NSlKGZ5lB61nmNw99CGwlwHaHa&pid=Api&P=0&h=180" height="50px" width="50px"  /></a><br /><p></p><a href="homeSV.php?bm=<?php echo $_REQUEST['bm']; ?>">Nhà Của Tôi</a></center>
</div>
<div class="col-xs-2 col-md-2 col-lg-2 col-md-2">
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

<?php
$is=$_REQUEST['is'];
$ihp=$_REQUEST['ihp'];
$sql="select * from hocphan hp join ct_hocphan c on hp.id_hocphan=c.id_hocphan where md5(hp.id_hocphan)='$ihp'";
$qr=mysql_query($sql);
$ttm=mysql_fetch_assoc($qr);
?>
<h5 style="color:#F63; font-size:25px;"><?php echo $ttm['tenhocphan']; ?></h5>
<br /><br />
<div class="row">
	<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
    </div>
    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-6">
     <div class="row">
     <?php if(isset($_REQUEST['kh'])){ ?>
     <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="background-color:#88b77b; padding:2px; height:60px; border-radius: 5px">
     <p></p>
         <center><strong><a href="ctmonhoc.php?bm=<?php echo $_REQUEST['bm'] ?>&&is=<?php echo $_REQUEST['is'] ?>&&ihp=<?php 
		  echo $_REQUEST['ihp']?>&&il=<?php echo $_REQUEST['il'] ?>&&kh"><n  style="color:white;">Khóa Học</n></a></strong></center>
    </div>
     <?php } else{ ?>
     <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="background-color:#f8f8f8; padding:2px; height:60px; border-radius: 5px">
     <p></p>
         <center><strong><a href="ctmonhoc.php?bm=<?php echo $_REQUEST['bm'] ?>&&is=<?php echo $_REQUEST['is'] ?>&&ihp=<?php 
		  echo $_REQUEST['ihp']?>&&il=<?php echo $_REQUEST['il'] ?>&&kh">Khóa Học</a></strong></center>
    </div>
    <?php } ?>
    &nbsp;
    <?php if(isset($_REQUEST['tv'])){ ?>
     <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="background-color:#88b77b; padding:2px; height:60px; border-radius: 5px">
     <p></p>
         <center><strong><a href="ctmonhoc.php?bm=<?php echo $_REQUEST['bm'] ?>&&is=<?php echo $_REQUEST['is'] ?>&&ihp=<?php 
		  echo $_REQUEST['ihp']?>&&il=<?php echo $_REQUEST['il'] ?>&&tv"><n  style="color:white;">Thành Viên</n></a></strong></center>
    </div>
     <?php } else{ ?>
     <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="background-color:#f8f8f8; padding:2px; height:60px; border-radius: 5px">
     <p></p>
         <center><strong><a href="ctmonhoc.php?bm=<?php echo $_REQUEST['bm'] ?>&&is=<?php echo $_REQUEST['is'] ?>&&ihp=<?php 
		  echo $_REQUEST['ihp']?>&&il=<?php echo $_REQUEST['il'] ?>&&tv">Thành Viên</a></strong></center>
    </div>
    <?php } ?>
    &nbsp;
  
   <?php if(isset($_REQUEST['ds'])){ ?>
     <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="background-color:#88b77b; padding:2px; height:60px; border-radius: 5px">
     <p></p>
         <center><strong><a href="ctmonhoc.php?bm=<?php echo $_REQUEST['bm'] ?>&&is=<?php echo $_REQUEST['is'] ?>&&ihp=<?php 
		  echo $_REQUEST['ihp']?>&&il=<?php echo $_REQUEST['il'] ?>&&ds"><n  style="color:white;">Điểm Số</n></a></strong></center>
    </div>
     <?php } else{ ?>
     <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="background-color:#f8f8f8; padding:2px; height:60px; border-radius: 5px">
     <p></p>
         <center><strong><a href="ctmonhoc.php?bm=<?php echo $_REQUEST['bm'] ?>&&is=<?php echo $_REQUEST['is'] ?>&&ihp=<?php 
		  echo $_REQUEST['ihp']?>&&il=<?php echo $_REQUEST['il'] ?>&&ds">Điểm Số</a></strong></center>
    </div>
    <?php } ?>
    &nbsp;
    <?php
	/*
	?>
    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" style="background-color:#f8f8f8; padding:2px; height:60px; border-radius: 5px">
    <p></p>
        <center><strong>Thông Báo</strong></center>
    </div>
	*/?>
     </div>
    </div>
    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-2">
    </div>
</div>
<br />
<?php
if(isset($_REQUEST['ds'])){
	?>
  <div class="row">
    <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
    </div>
    <div class="col-xs-6 col-sm-6 col-lg-6 col-md-6 border">
    <?php
		$is=$_REQUEST['is'];
		$il=$_REQUEST['il'];
		$ihp=$_REQUEST['ihp'];
		$s="select * from diem d join ct_hocphan c
		on d.id_hocphan=c.id_hocphan where d.id_sinhvien='$is' and d.id_lophocphan='$il' and md5(d.id_hocphan)='$ihp'";
		$qr=mysql_query($s);
		$r=mysql_fetch_assoc($qr);
	?>
    	 <p></p>
  	       <center><h5>Điểm Số Của Bạn</h5></center>
           <table class="table table-bordered">
           	<thead>
            	<tr>
                	<th>Tiêu Đề Điểm</th>
                    <th>Trọng Số</th>
                    <th>Điểm</th>
                </tr>
                <tr>
                	<td>TK1</td>
                    <td>20%</td>
                    <td><strong><?php echo $r['TK1'] ?></strong></td>
                </tr>
                <tr>
                	<td>TK2</td>
                    <td>20%</td>
                    <td><strong><?php echo $r['TK2'] ?></strong></td>
                </tr>
                <tr>
                	<td>TK3</td>
                    <td>20%</td>
                    <td><strong><?php echo $r['TK3'] ?></strong></td>
                </tr>
                <tr>
                	<td>GK</td>
                    <td>30%</td>
                    <td><strong><?php echo $r['GK'] ?></strong></td>
                </tr>
                <tr>
                	<td>TH1</td>
                    <td>100%</td>
                    <td><strong><?php echo $r['TH1'] ?></strong></td>
                </tr>
                <tr>
                	<td>TH2</td>
                    <td>100%</td>
                    <td><strong><?php echo $r['TH2'] ?></strong></td>
                </tr>
                <tr>
                	<td>TH3</td>
                    <td>100%</td>
                    <td><strong><?php echo $r['TH3'] ?></strong></td>
                </tr>
                <tr>
                	<td>CK</td>
                    <td>50%</td>
                    <td><strong><?php echo $r['CK'] ?></strong></td>
                </tr>
                <tr>
                <td>Tổng Số Tín Chỉ:&nbsp;<strong><?php echo $r['soTC'] ?></td>
                <td colspan="2">Tín Chỉ Lý Thuyết:&nbsp;<strong><?php echo $r['TCLT'] ?>&nbsp;&nbsp;</strong> - Tín Chỉ Thực Hành: &nbsp;<strong><?php echo $r['TCTH'] ?></td>
                </tr>
                <tr>
                <td colspan="3"><strong>Điểm TB:&nbsp;<?php $tc=$r['soTC'];
					          $tclt=$r['TCLT'];
							  $tcth=$r['TCTH'];
							  $tk1=$r['TK1'];
							  $tk2=$r['TK2'];
							  $tk3=$r['TK3'];
							  $gk=$r['GK'];
							  $th1=$r['TH1'];
							  $th2=$r['TH2'];
							  $th3=$r['TH3'];
							  $ck=$r['CK'];
							  if($tk2==""&&$tk3==""){
								  $tk=$tk1;
							  }
							  elseif($tk3==""){
								  $tk=($tk1+$tk2)/2;
							  }
							  else{
								  $tk=($tk1+$tk2+$tk3)/3;
							  }
							  if($th2==""&&$th3==""){
								  $th=$th1;
							  }
							  elseif($th3==""){
								  $th=($th1+$th2)/2;
							  }
							  else{
								  $th=($th1+$th2+$th3)/3;
							  }
							  if($ck==""){
							  }
							  else{
								  $dtb=((($tk*0.2+$gk*0.3+$ck*0.5)*$tclt+$th*$tcth)/$tc);
								  echo "&nbsp;&nbsp;<i>".round($dtb,1)."</i>";
							  }?></strong></td>
                </tr>
            </thead>
           </table>
 	     <p></p>
         &nbsp;<img src="https://tse1.mm.bing.net/th?id=OIP.6XyVD2q-E0jCDXr1Qe-wqgAAAA&pid=Api&P=0&h=180" height="30px"
         width="30px" /> &nbsp; <a href="ctmonhoc.php?bm=<?php echo $_REQUEST['bm']; ?>&&
         is=<?php echo $_REQUEST['is']; ?>&&ihp=<?php echo $_REQUEST['ihp']; ?>&&il=<?php echo $_REQUEST['il']; ?>&&ds&&kj#abc">Phản Hồi
         </a>
         <p></p>
         <?php
		 if(isset($_REQUEST['kj'])){ 
		 ?>
         <div id="abc" class="border">
         <center><h5>Phản Hồi Điểm</h5></center>
         <p></p>
         <form action="#" method="post" enctype="multipart/form-data">
         <center>Tiêu Đề: &nbsp; <input type="text" name="a" size="39" required="required" /></center>
         <p></p>
         <center>Nội Dung: <textarea name="b" required="required"></textarea></center>
         <p></p>
         <center>Lý Do: &nbsp;&nbsp;        &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="c" size="39" required="required" /></center>
         <p></p>
         <center><input type="submit" name="gui" value="Gửi Đi"</center>
         <p></p>
         <center><i>( Lưu ý: Phản Hồi Điểm Sẽ Được Gửi Về Gmail Giảng Viên. Xin Hãy Cân Nhắc Thật Kỹ Trước Khi Gửi ! )</i></center>
         <p></p>
         </form>
         </div>
         <?php
		 }
		 ?>
         <?php
		 if(isset($_POST['gui'])){
			 $il=$_REQUEST['il'];
			 $ihp=$_REQUEST['ihp'];
			 $is=$_REQUEST['is'];
			 $a=$_POST['a'];
			 $b=$_POST['b'];
			 $c=$_POST['c'];
			 $sql="select * from hocphan hp join ct_hocphan c on hp.id_hocphan=c.id_hocphan
				join monlop m on m.id_hocphan=hp.id_hocphan join hoctap h on h.id=m.id
				join giangday d on d.id=m.id join sinhvien s on s.id_sinhvien=h.id_sinhvien
				join giangvien gv on d.id_giangvien=gv.id_giangvien join user u on u.user_id=gv.user_id
				where md5(m.id_hocphan)='$ihp'
				and m.id_lophocphan='$il'";
				$qr=mysql_query($sql);
				$r=mysql_fetch_assoc($qr);
				$e= $r['email'];
				$sql1="select *from sinhvien s join user u on u.user_id=s.user_id where s.id_sinhvien='$is'";
				$qr1=mysql_query($sql1);
				$r1=mysql_fetch_assoc($qr1);
				$e1= $r1['email'];
				
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
$mail->SetFrom($e1);
$mail->AddAddress($e);
$mail->Subject = "Gmail Phan Hoi Diem Tu Sinh Vien !";
$mail->Body = "<p style='color:#000;'><strong>".$a."</strong> <br>
<p></p>
- Nội Dung: ".$b." <br/>
- Lý Do: ".$c." <br/>
- Xin Cảm Ơn Quý Thầy Cô Đã Xem !</p>";
 if($mail->Send()){
	
   
}
else{
}
		 echo "<script>alert('Gửi Đi Thành Công !')<script>";		
		 }
		 ?>
         <p></p>
    </div>
    <div class="col-xs-3 col-sm-3 col-lg-3 col-md-3">
    </div>
  </div>
  <br />
    <?php
}
elseif(isset($_REQUEST['tv'])){
	?>
    <div class="row">
    	<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
        </div>
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
        	<table class="table table-bordered">
            	<thead>
                	<tr>
                    	<th>STT</th>
                        <th>Họ Và Tên</th>
                        <th>Vai Trò</th>
                        <th><center>Lần Truy Cập Vào Khóa Học Gần Nhất</center></th>
                    </tr>
<?php 
$il=$_REQUEST['il'];
$ihp=$_REQUEST['ihp'];
$sql="select * from hocphan hp join ct_hocphan c on hp.id_hocphan=c.id_hocphan
join monlop m on m.id_hocphan=hp.id_hocphan join hoctap h on h.id=m.id
join giangday d on d.id=m.id join sinhvien s on s.id_sinhvien=h.id_sinhvien
join giangvien gv on d.id_giangvien=gv.id_giangvien
where md5(m.id_hocphan)='$ihp'
and m.id_lophocphan='$il'";
$qr=mysql_query($sql);
$qr1=mysql_query($sql);
?>
<tr>
	<td><?php echo "1"; ?></td>
    <td><?php 
	$kv=mysql_fetch_assoc($qr1); echo $kv['hotengiangvien'] ?></td>
    <td><?php echo "Giáo Viên"; ?></td>
    <td>
    <?php 
	$idgv=$kv['id_giangvien'];
	$il=$kv['id_lophocphan'];
	$sql2="select * from thongketruycap where id_giangvien='$idgv' and id_lophocphan='$il'";
						$qr2=mysql_query($sql2);
						$te=mysql_fetch_assoc($qr2);
						$tc=strtotime($te['ngaytruycap']);
						$ts=strtotime("now");
						$k= $ts-$tc;
						$g= $k%60;
						$p= floor(($k%3600)/60);
						$h= floor(($k%86400)/3600);
						$n= floor(($k%2592000)/86400);
						?><center>Truy cập <strong><?php echo $n."&nbsp;ngày&nbsp;".$h."&nbsp;giờ&nbsp;".$p."&nbsp;phút&nbsp;".$g; ?> giây</strong> &nbsp;trước</center></td>
</tr>
<?php
$a=2;
while($ttm=mysql_fetch_assoc($qr)){
?>
                    <tr>
                    	<td><?php echo $a++; ?></td>
                        <td><?php echo $ttm['tensinhvien'] ?></td>
                        <td><?php echo "Học Viên"; ?></td>
                        <td><?php
						$idsv=$ttm['id_sinhvien'];
						$il=$ttm['id_lophocphan'];
						$sql1="select * from thongketruycap where id_sinhvien='$idsv' and id_lophocphan='$il'";
						$qr1=mysql_query($sql1);
						$tc=mysql_fetch_assoc($qr1);
						$tc=strtotime($tc['ngaytruycap']);
						$ts=strtotime("now");
						$k= $ts-$tc;
						$g= $k%60;
						$p= floor(($k%3600)/60);
						$h= floor(($k%86400)/3600);
						$n= floor(($k%2592000)/86400);
						?><center>Truy cập <strong><?php echo $n."&nbsp;ngày&nbsp;".$h."&nbsp;giờ&nbsp;".$p."&nbsp;phút&nbsp;".$g; ?> giây</strong>&nbsp;trước</center></td>
                    </tr>
                    <?php }
					$a++; ?>
                </thead>
            </table>
        </div>
        <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
        </div>
    </div>
    <?php
}
else{
?>
<?php 
if(isset($_REQUEST['nopbaith'])){
$id=$_REQUEST['id'];
$sql="select * from baitapthuchanh where id_btth='$id'";
$qr=mysql_query($sql);
$r=mysql_fetch_assoc($qr);
	?>
    <div class="border">
    <?php
    $sql="select * from filenopbtth where id_sinhvien='$is' and id_btth='$id'";
$qr=mysql_query($sql);
$s=mysql_fetch_assoc($qr);
if(mysql_num_rows($qr)==1){
}
else{
	?>
    	<p></p>
        <center><h5><?php echo $r['tieude'] ?></h5></center>
    <p></p>
    <center><strong>Hạn Nộp Bài:</strong> <?php 
$cD = $r['batdaunop'];
$bd = date("H:i:s d-m-Y", strtotime($cD)); echo $bd; ?>&nbsp; <strong>Đến:</strong> &nbsp;<?php $cS = $r['ketthucnop'];
$kt = date("H:i:s d-m-Y", strtotime($cS)); echo $kt; ?> </center>
<p></p>
<hr />
<?php } ?>
<?php
$sql="select * from filenopbtth where id_sinhvien='$is' and id_btth='$id'";
$qr=mysql_query($sql);
$s=mysql_fetch_assoc($qr);
if(mysql_num_rows($qr)==1){
	?>
<center><h5>Sửa <?php echo $r['tieude'] ?> Đã Nộp</h5></center>
<p></p>
<p></p>
<br />
<form action="#" method="post" enctype="multipart/form-data">
<center>Tiêu Đề: &nbsp;<input type="text" name="a" value="<?php echo $s['tieude'] ?>" placeholder="MSSV_HoTen_TieuDe" size="40" required="required" /></center><br />
<center>File Đã Nộp: &nbsp;<input type="text" name="f1" value="<?php echo $s['filenop']  ?>" disabled="disabled" size="40" /></center>
<p></p>
<?php 
$bd=strtotime($r['batdaunop']);
$kt=strtotime($r['ketthucnop']);
$ht=strtotime("now");
if($ht<$bd || $ht>$kt){
}
else{
 ?>
 <center><input type="file" name="f" required="required" /><br /><br /><input type="submit" name="suabth" value="Sửa Bài"  />&nbsp;</center>
 <p></p>
<center><i>( Lưu ý: Sinh viên nộp file dưới dạng tên file MSSV_HoTen_TieuDe. Nộp File Đúng Hạn Và Không Thể Trễ Hơn! )</i></center>
 <?php } ?>
</form>
<p></p>
</div>
    <?php
}
else{
?>

<?php 
$bd=strtotime($r['batdaunop']);
$kt=strtotime($r['ketthucnop']);
$ht=strtotime("now");
if($ht<$bd || $ht>$kt){
}
else{
 ?><center><h5>Nộp File Tại Đây !</h5></center>
<p></p>
<form action="#" method="post" enctype="multipart/form-data">
<center>Tiêu Đề: &nbsp;<input type="text" name="a" placeholder="MSSV_HoTen_TieuDe" size="40" required="required" /></center><br />
<center><input type="file" name="f" required="required" /><br /><br /><input type="submit" name="nopth" value="Nộp Bài"  />&nbsp;</center>
 <p></p>
<center><i>( Lưu ý: Sinh viên nộp file dưới dạng tên file MSSV_HoTen_TieuDe. Nộp File Đúng Hạn Và Không Thể Trễ Hơn ! )</i></center>
 <?php
}
?>
</form>
<p></p>
</div>

<?php /* Phần trên là nộp bài thực hành */ ?>

    
    <?php
}
}
elseif(isset($_REQUEST['nopbaiktth'])){
	$id=$_REQUEST['id'];
$sql="select * from baitapthuchanh where id_btth='$id'";
$qr=mysql_query($sql);
$q=mysql_fetch_assoc($qr);
	?>
    <div class="border">
    	<p></p>
        <center><h5><?php echo $q['tieude'] ?></h5></center>
    <p></p>
    <center><strong>Hạn Nộp Bài:</strong> <?php 
$cD = $q['batdaunop'];
$bd = date("H:i:s d-m-Y", strtotime($cD)); echo $bd; ?>&nbsp; <strong>Đến:</strong> &nbsp;<?php $cS = $q['ketthucnop'];
$kt = date("H:i:s d-m-Y", strtotime($cS)); echo $kt; ?> </center>
<p></p>
<hr />
<?php
$sql="select * from filenopbtth where id_sinhvien='$is' and id_btth='$id'";
$qr=mysql_query($sql);
$s=mysql_fetch_assoc($qr);
if(mysql_num_rows($qr)==1){
	?>
<center><h5>Sửa <?php echo $r['tieude'] ?> Đã Nộp</h5></center>
<p></p>
<p></p>
<br />
<form action="#" method="post" enctype="multipart/form-data">
<center>Tiêu Đề: &nbsp;<input type="text" name="a" value="<?php echo $s['tieude'] ?>" placeholder="MSSV_HoTen_TieuDe" size="40" required="required" /></center><br />
<center>File Đã Nộp: <input type="text" name="f1" value="<?php echo $s['filenop']  ?>" disabled="disabled" size="40" /></center>
<p></p>
<?php 
$bd=strtotime($q['batdaunop']);
$kt=strtotime($q['ketthucnop']);
$ht=strtotime("now");
if($ht<$bd || $ht>$kt){
}
else{
 ?>
 <center><input type="file" name="f" required="required" /><br /><br /><input type="submit" name="suabktth" value="Sửa Bài"  />&nbsp;</center>
 <p></p>
<center><i>( Lưu ý: Sinh viên nộp file dưới dạng tên file MSSV_HoTen_TieuDe. Nộp File Đúng Hạn Và Không Thể Trễ Hơn ! )</i></center>
 <?php } ?>
</form>
<p></p>
</div>
    <?php
}
else{
?>

<?php 
$bd=strtotime($q['batdaunop']);
$kt=strtotime($q['ketthucnop']);
$ht=strtotime("now");
if($ht<$bd || $ht>$kt){
}
else{
 ?><center><h5>Nộp File Tại Đây !</h5></center>
<p></p>
<form action="#" method="post" enctype="multipart/form-data">
<center>Tiêu Đề: &nbsp;<input type="text" name="a" placeholder="MSSV_HoTen_TieuDe" size="40" required="required" /></center><br />
<center><input type="file" name="f" required="required" /><br /><br /><input type="submit" name="nopktth" value="Nộp Bài"  />&nbsp;</center>
 <p></p>
<center><i>( Lưu ý: Sinh viên nộp file dưới dạng tên file MSSV_HoTen_TieuDe. Nộp File Đúng Hạn Và Không Thể Trễ Hơn ! )</i></center>
 <?php
}
?>
</form>
<p></p>
</div>

<?php /* Phần trên là nộp bài thực hành */ ?>

    
    <?php
}
	
}
elseif(isset($_REQUEST['nopbai'])){ 
$id=$_REQUEST['id'];
$sql="select * from baitaplythuyet where id_btlt='$id'";
$qr=mysql_query($sql);
$x=mysql_fetch_assoc($qr);
?>

<div class="border">
<p></p>
<?php
$sql="select * from filenopbtlt where id_sinhvien='$is' and id_btlt='$id'";
$qr=mysql_query($sql);
$s=mysql_fetch_assoc($qr);
if(mysql_num_rows($qr)==1){
}
else{
	?>
<center><h5>File: <a href="taixuong.php?fu=<?php echo $x['filebt'];?>">&nbsp;&nbsp;&nbsp;<img src="https://tse4.mm.bing.net/th?id=OIP.CGIZlGWVwNcbkM97pcQajQHaJ-&pid=Api&P=0&h=180" height="30px" width="25px" />&nbsp;<?php 
		echo $x['tieude'];
		?></a> </h5></center>
<p></p>
<center><strong>Hạn Nộp Bài:</strong> <?php 
$cD = $x['batdaunop'];
$bd = date("H:i:s d-m-Y", strtotime($cD)); echo $bd; ?>&nbsp; <strong>Đến:</strong> &nbsp;<?php $cS = $x['ketthucnop'];
$kt = date("H:i:s d-m-Y", strtotime($cS)); echo $kt; ?> </center>
<p></p>
<center><i>( Sinh Viên Lấy File Vui Lòng Bấm Vào File Để Tải Xuống ! )</i></center>
<hr />
<?php } ?>
<?php
$sql="select * from filenopbtlt where id_sinhvien='$is' and id_btlt='$id'";
$qr=mysql_query($sql);
$s=mysql_fetch_assoc($qr);
if(mysql_num_rows($qr)==1){
	?>
<center><h5>Sửa <?php echo $x['tieude'] ?> Đã Nộp</h5></center>
<p></p>
<p></p>
<br />
<form action="#" method="post" enctype="multipart/form-data">
<center>Tiêu Đề: &nbsp;<input type="text" name="a" value="<?php echo $s['tieude'] ?>" placeholder="MSSV_HoTen_TieuDe" size="40" required="required" /></center><br />
<center>File Đã Nộp: &nbsp;<a href="taixuong.php?fu=<?php echo $s['filenop'];?>"><img src="https://tse2.mm.bing.net/th?id=OIP.8Ck3Lp06jASLSybjpchJJgHaHa&pid=Api&P=0&h=180"
height="30px" width="30px"/> <?php echo $s['filenop']  ?></a>
<input type="hidden" name="f1" value="<?php echo $s['filenop']  ?>" disabled="disabled" size="40" /></center>
<p></p>
<?php 
$bd=strtotime($x['batdaunop']);
$kt=strtotime($x['ketthucnop']);
$ht=strtotime("now");
if($ht<$bd || $ht>$kt){
}
else{
 ?>
 <center><input type="file" name="f" required="required" /><br /><br /><input type="submit" name="suab" value="Sửa Bài"  />&nbsp;</center>
 <p></p>
<center><i>( Lưu ý: Sinh viên nộp file dưới dạng tên file MSSV_HoTen_TieuDe. Nộp File Đúng Hạn Và Không Thể Trễ Hơn ! )</i></center>
 <?php } ?>
</form>
<p></p>
</div>
    <?php
}
else{
?>

<?php 
$bd=strtotime($x['batdaunop']);
$kt=strtotime($x['ketthucnop']);
$ht=strtotime("now");
if($ht<$bd || $ht>$kt){
}
else{
 ?><center><h5>Nộp <?php echo $x['tieude'] ?></h5></center>
<p></p>
<p></p>
<br />
<form action="#" method="post" enctype="multipart/form-data">
<center>Tiêu Đề: &nbsp;<input type="text" name="a" placeholder="MSSV_HoTen_TieuDe" size="40" required="required" /></center><br />
<center><input type="file" name="f" required="required" /><br /><br /><input type="submit" name="nop" value="Nộp Bài"  />&nbsp;</center>
 <p></p>
<center><i>( Lưu ý: Sinh viên nộp file dưới dạng tên file MSSV_HoTen_TieuDe. Nộp File Đúng Hạn Và Không Thể Trễ Hơn ! )</i></center>
 <?php
}
?>
</form>
<p></p>
</div>
<?php
}
}
else{
	$ihp=$_REQUEST['ihp'];
	$il=$_REQUEST['il'];
	$sql="select * from hocphan hp join ct_hocphan c on hp.id_hocphan=c.id_hocphan
	join monlop m on m.id_hocphan=hp.id_hocphan join lophocphan l on l.id_lophocphan=m.id_lophocphan
	join giangday g on m.id=g.id join giangvien gv on gv.id_giangvien=g.id_giangvien
	where md5(m.id_hocphan)='$ihp' and m.id_lophocphan='$il'";
	$tm=mysql_query($sql);
	$c=mysql_fetch_assoc($tm);
	?>
<div class="border">
<h5 style="color:#F63; font-size:25px;">Phần Lý Thuyết</h5>
<p></p>
    <strong style="color:#F63;font-size: 25px; font-weight:400;">Chung</strong>
  <p></p>
  <p style="font-size:20px;"><strong>* Thông Tin Môn Học:</strong>
  <br />
  <p></p>
  <p style="font-size:18px;">- Học Phần: <?php echo $c['tenhocphan']; ?>
  <p></p>
  <p style="font-size:18px;">- Mã Học Phần: <?php echo $c['mahocphan']; ?>
  <p></p>
  <p style="font-size:18px;">- Lớp Học Phần: <?php echo $c['tenlophocphan']; ?>
  <p></p>
  <p style="font-size:18px;">- Giảng Viên Lý Thuyết: <?php $v= $c['id_giangvien'];
  $sql="select * from giangvien where id_giangvien='$v'";
  $ttgv=mysql_query($sql);
  $gv=mysql_fetch_assoc($ttgv);
  echo $gv['hotengiangvien']; ?>
  </p>
  <p style="font-size:18px;">- Ngày Học LT: <?php echo "Thứ&nbsp;".$c['thuhocLT']; ?>&nbsp;&nbsp;| Tiết  Học: <?php echo $c['tietbatdauLT'] ?>&nbsp;-&nbsp;<?php echo $c['tietketthucLT'] ?>&nbsp;&nbsp;| Phòng Học LT: <?php echo $c['phonghocLT'] ?></p>
  
  <?php /* Code ở đây */ ?>
<p></p>

 <strong style="color:#F63;font-size: 25px; font-weight:400;">Tài Liệu Tham Khảo</strong>
 <p></p>
  <?php 
  $ihp=$_REQUEST['ihp'];
  $il=$c['id_lophocphan'];
  $ig=$c['id_giangvien'];
  $sql="select * from tltk tk join giangday gd on tk.id_giangday=gd.id_giangday
  join monlop m on m.id=gd.id  where md5(m.id_hocphan)='$ihp' and m.id_lophocphan='$il' and gd.id_giangvien='$ig'
  and loaitailieu='GT' ";
  $qr=mysql_query($sql);
  while($a=mysql_fetch_assoc($qr)){
  ?>
   <p style="font-size:18px;"><a href="taixuong.php?fu=<?php echo $a['filetailieu'];?>">&nbsp;&nbsp;&nbsp;<img src="https://tse4.mm.bing.net/th?id=OIP.CGIZlGWVwNcbkM97pcQajQHaJ-&pid=Api&P=0&h=180" height="30px" width="25px" />&nbsp;<?php 
		echo $a['tieude'];
		?></a></p>
    <?php
  }
?>
<p></p>

    <strong style="color:#F63;font-size: 25px; font-weight:400;">Slide Môn Học</strong>
  <p></p>
  <?php 
  $ihp=$_REQUEST['ihp'];
  $il=$c['id_lophocphan'];
  $ig=$c['id_giangvien'];
  $sql="select * from tltk tk join giangday gd on tk.id_giangday=gd.id_giangday
  join monlop m on m.id=gd.id  where md5(m.id_hocphan)='$ihp' and m.id_lophocphan='$il' and gd.id_giangvien='$ig'
  and loaitailieu='Slide' ";
  $qr=mysql_query($sql);
  while($a=mysql_fetch_assoc($qr)){
  ?>
   <p style="font-size:18px;"><a href="taixuong.php?fu=<?php echo $a['filetailieu'];?>">&nbsp;&nbsp;&nbsp;<img src="https://tse4.mm.bing.net/th?id=OIP.CGIZlGWVwNcbkM97pcQajQHaJ-&pid=Api&P=0&h=180" height="30px" width="25px" />&nbsp;<?php 
		echo $a['tieude'];
		?></a></p>
    <?php
  }
?>
<p></p>


<p></p>

   <strong style="color:#F63;font-size: 25px; font-weight:400;" id="bt">Bài Tập</strong>
  <p></p>
  <?php 
  $ihp=$_REQUEST['ihp'];
  $il=$c['id_lophocphan'];
  $ig=$c['id_giangvien'];
  $sql="select * from baitaplythuyet lt join giangday gd on lt.id_giangday=gd.id_giangday
  join monlop m on m.id=gd.id  where md5(m.id_hocphan)='$ihp' and m.id_lophocphan='$il' and gd.id_giangvien='$ig'";
  $qr=mysql_query($sql);
  while($a=mysql_fetch_assoc($qr)){
  ?>
   <p style="font-size:18px;"><a href="ctmonhoc.php?bm=<?php echo $_REQUEST['bm'] ?>&&is=<?php echo $_REQUEST['is'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&id=<?php echo $a['id_btlt'] ?>&&nopbai&&ctmh&&kh#bt">&nbsp;&nbsp;&nbsp;<img src="https://tse4.mm.bing.net/th?id=OIP.CGIZlGWVwNcbkM97pcQajQHaJ-&pid=Api&P=0&h=180" height="30px" width="25px" />&nbsp;<?php 
		echo $a['tieude'];
		?></a>&nbsp;&nbsp;<?php 
		$i=$a['id_btlt'];
		$is=$_REQUEST['is'];
		$sql1="select * from baitaplythuyet lt join filenopbtlt f on lt.id_btlt=f.id_btlt
		where f.id_btlt='$i' and f.id_sinhvien='$is'";
		$qr1=mysql_query($sql1);
		if(mysql_num_rows($qr1)==1){
			?>
            <img src="https://www.kindpng.com/picc/m/139-1398934_green-tick-tick-free-images-on-pixabay-clipart.png" height="20px" width="20px" />
            <?php
		}
		else{
		}
		
		 ?></p>
    <?php
  }
?>
<br />
<p></p>
<?php
if($ttm['loaihp']=='LT & TH'){
?>

<h5 style="color:#F63; font-size:25px;">Phần Thực Hành ( GVTH: <?php 
$is=$_REQUEST['is'];
$ihp=$_REQUEST['ihp'];
$sql="select * from hoctap h join monlop m on h.id=m.id
where h.id_sinhvien='$is' and md5(m.id_hocphan)='$ihp'";
$qr=mysql_query($sql);
$e=mysql_fetch_assoc($qr);
$n=$e['id_giangvienTH'];
$sql1="select *from giangvien where id_giangvien='$n'";
$qr1=mysql_query($sql1);
$f=mysql_fetch_assoc($qr1);
echo $f['hotengiangvien']?> )</h5>
<p></p>
  <strong style="color:#F63;font-size: 25px; font-weight:400;">Chung</strong>
<p></p>
  <p style="font-size:20px;"><strong>* Thông Tin Môn Học:</strong>
  <br />
   <p style="font-size:18px;">Ngày Học TH: <?php echo "Thứ&nbsp;".$c['thuhocTH']; ?>&nbsp;&nbsp;| Tiết  Học: <?php echo $c['tietbatdauTH'] ?>&nbsp;-&nbsp;<?php echo $c['tietketthucTH'] ?>&nbsp;&nbsp;| Phòng Học TH: <?php echo $c['phonghocTH'] ?></p>
  <?php /* Code ở đây */ ?>
</details><p></p>
    <strong style="color:#F63;font-size: 25px; font-weight:400;">Tài Liệu Thực Hành</strong>
  <?php /* Code ở đây */ ?>
  <p></p>
  <?php 
  $ihp=$_REQUEST['ihp'];
  $il=$c['id_lophocphan'];
  $ig1=$c['id_giangvienTH1'];
  $ig2=$c['id_giangvienTH2'];
  $sql="select * from tltk tk join giangday gd on tk.id_giangday=gd.id_giangday
  join monlop m on m.id=gd.id  where md5(m.id_hocphan)='$ihp' and m.id_lophocphan='$il' and ( gd.id_giangvienTH1='$ig1' or 
  gd.id_giangvienTH2='$ig2') and loaitailieu='BTTH' ";
  $qr=mysql_query($sql);
  while($a=mysql_fetch_assoc($qr)){
  ?>
   <p style="font-size:18px;"><a href="taixuong.php?fu=<?php echo $a['filetailieu'];?>">&nbsp;&nbsp;&nbsp;<img src="https://tse4.mm.bing.net/th?id=OIP.CGIZlGWVwNcbkM97pcQajQHaJ-&pid=Api&P=0&h=180" height="30px" width="25px" />&nbsp;<?php 
		echo $a['tieude'];
		?></a></p>
    <?php
  }
?>
<p></p>


<p></p>

<p></p>

   <strong style="color:#F63;font-size: 25px; font-weight:400;" id="btth">Nộp Bài Tập Hàng Tuần</strong>
  <?php /* Code ở đây */ ?>
  <p></p>
    <?php 
  $ihp=$_REQUEST['ihp'];
  $il=$c['id_lophocphan'];
  $ig1=$c['id_giangvienTH1'];
  $ig2=$c['id_giangvienTH2'];
  $sql="select * from baitapthuchanh th join giangday gd on th.id_giangday=gd.id_giangday
  join monlop m on m.id=gd.id  where md5(m.id_hocphan)='$ihp' and m.id_lophocphan='$il' and th.loaibai='' and ( gd.id_giangvienTH1='$ig1' 
  or gd.id_giangvienTH2='$ig2')";
  $qr=mysql_query($sql);
  while($a=mysql_fetch_assoc($qr)){
  ?>
   <p style="font-size:18px;"><a href="ctmonhoc.php?bm=<?php echo $_REQUEST['bm'] ?>&&is=<?php echo $_REQUEST['is'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&id=<?php echo $a['id_btth'] ?>&&nopbaith&&ctmh&&kh#btth">&nbsp;&nbsp;&nbsp;<img src="https://tse4.mm.bing.net/th?id=OIP.z_7a6dhGya62Do1gB6MVBAHaHa&pid=Api&P=0&h=180" height="20px" width="20px" />&nbsp;<?php 
		echo $a['tieude'];
		?></a>&nbsp;&nbsp;<?php 
		$i=$a['id_btth'];
		$is=$_REQUEST['is'];
		$sql1="select * from baitapthuchanh th join filenopbtth f on th.id_btth=f.id_btth
		where f.id_btth='$i' and f.id_sinhvien='$is'";
		$qr1=mysql_query($sql1);
		if(mysql_num_rows($qr1)==1){
			?>
            <img src="https://www.kindpng.com/picc/m/139-1398934_green-tick-tick-free-images-on-pixabay-clipart.png" height="20px" width="20px" />
            <?php
		}
		else{
		}
		
		
		 ?></p>
    <?php
  }
?>

<p></p>
    <strong style="color:#F63;font-size: 25px; font-weight:400;" id="btthkt">Bài Tập TH Kiểm Tra</strong>
  <?php /* Code ở đây */ } ?>
  <p></p>
    <?php 
  $ihp=$_REQUEST['ihp'];
  $il=$c['id_lophocphan'];
  $ig1=$c['id_giangvienTH1'];
  $ig2=$c['id_giangvienTH2'];
  $sql="select * from baitapthuchanh th join giangday gd on th.id_giangday=gd.id_giangday
  join monlop m on m.id=gd.id  where md5(m.id_hocphan)='$ihp' and m.id_lophocphan='$il' and th.loaibai='KTTH' and ( 
  gd.id_giangvienTH1='$ig1' or gd.id_giangvienTH2='$ig2')";
  $qr=mysql_query($sql);
  while($a=mysql_fetch_assoc($qr)){
  ?>
   <p style="font-size:18px;"><a href="ctmonhoc.php?bm=<?php echo $_REQUEST['bm'] ?>&&is=<?php echo $_REQUEST['is'] ?>&&ihp=<?php echo $_REQUEST['ihp'] ?>&&il=<?php echo $_REQUEST['il'] ?>&&id=<?php echo $a['id_btth'] ?>&&nopbaiktth&&ctmh&&kh">&nbsp;&nbsp;&nbsp;<img src="https://tse4.mm.bing.net/th?id=OIP.z_7a6dhGya62Do1gB6MVBAHaHa&pid=Api&P=0&h=180" height="20px" width="20px" />&nbsp;<?php 
		echo $a['tieude'];
		?></a>&nbsp;&nbsp;<?php 
		$i=$a['id_btth'];
		$is=$_REQUEST['is'];
		$sql1="select * from baitapthuchanh th join filenopbtth f on th.id_btth=f.id_btth
		where f.id_btth='$i' and f.id_sinhvien='$is'";
		$qr1=mysql_query($sql1);
		if(mysql_num_rows($qr1)==1){
			?>
            <img src="https://www.kindpng.com/picc/m/139-1398934_green-tick-tick-free-images-on-pixabay-clipart.png" height="20px" width="20px" />
            <?php
		}
		else{
		}
		
		
		 ?></p>
    <?php
  }
?>

<p></p>
      <?php
}
}
?>
</div>
<br />
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