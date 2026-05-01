<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
//Download QRCode
				if(isset($_GET['fu'])){
					$ten=urlencode(basename($_GET['fu']));
					$path="file/".$ten;
					if(!empty($ten)&& file_exists($path)){
						header("Cache-Control: public");
						header("Content-Description:File Transfer");
						header("Content-Disposition: attachment; filename=$ten");
						header("Content-Type: application/zip");
						header("Content-Transfer-Encoding: binary");
						
						$dataX = base64_decode($_GET['f']);//make the string into the image
    file_put_contents($ten, $dataX);//save the image on the server
//everything thing above this line works within Unity

    $fileSize = filesize($ten);//get the file size

    //bunch of headers, comments next to the ones I have an idea about
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private",false);
    header("Content-Type: multipart/form-data");//gives content type
    header("Content-Length: ".$ten);//file size
    header("Content-Disposition: attachment; filename=".$ten);//download file path
    header("Content-Transfer-Encoding: binary");
    ob_clean();
    flush();
    readfile( $stringName );
						
						readfile($path);
						exit;
						
						
					}
					else{
						echo "Tệp không tồn tại";
					}
				}
?>
</body>
</html>