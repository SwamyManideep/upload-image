<?php
define("MAX_SIZE","400");
$target_dir = "upload/";
$dir = getcwd();
echo $dir   ."<br>";
$target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
echo $target_file ."<br>";
echo $imageFileType ."<br>";
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileUpload"]["tmp_name"]);
	    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
	
    echo "Sorry, file already exists.".$target_file;
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
else{
//File Resize
if ($_FILES["fileUpload"]["size"] > 500000)
{
 echo "You have exceeded the size limit";
 $errors=1;
}
if($imageFileType=="jpg" || $imageFileType=="jpeg" )
{
$uploadedfile = $_FILES['fileUpload']['tmp_name'];
$src = imagecreatefromjpeg($uploadedfile);
}
else if($imageFileType=="png")
{
$uploadedfile = $_FILES['fileUpload']['tmp_name'];
$src = imagecreatefrompng($uploadedfile);
}
else 
{
$src = imagecreatefromgif($uploadedfile);
}
 
list($width,$height)=getimagesize($uploadedfile);

$newwidth=150;
$newheight=($height/$width)*$newwidth;
$tmp=imagecreatetruecolor($newwidth,$newheight);

$newwidth1=150;
$newheight1=($height/$width)*$newwidth1;
$tmp1=imagecreatetruecolor($newwidth1,$newheight1);

imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,
 $width,$height);

imagecopyresampled($tmp1,$src,0,0,0,0,$newwidth1,$newheight1, 
$width,$height);

$filename = "upload/". $_FILES['fileUpload']['name'];
$filename1 = "upload/small". $_FILES['fileUpload']['name'];

imagejpeg($tmp,$filename,100);
imagejpeg($tmp1,$filename1,100);

imagedestroy($src);
imagedestroy($tmp);
imagedestroy($tmp1);
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], getcwd().'/' . $target_file)) {
        echo "The file ". basename( $_FILES["fileUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>