<!DOCTYPE html>
<html>
<body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<form >
    Select image to upload:
    <input type="file" name="fileUpload" id="fileUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

<script>
$('form').on('click','[type="submit"]',function(pic){
pic.preventDefault();
var _this=$('form');
var text=_this.find('[name="text"]').val();
var file=_this.find('[name="fileUpload"]')[0].files;
console.log(file);
var formdata = new FormData();
                        formdata.append("fileUpload", file[0]);
                        var ajax = new XMLHttpRequest();
                    //    ajax.upload.addEventListener("progress", progressHandler, false);
//ajax.addEventListener("load", uploadComplete, false);
//ajax.addEventListener("error", uploadFailed, false);
// ajax.addEventListener("abort", uploadCanceled, false);
                        ajax.open("POST", 'upload.php');
                        ajax.send(formdata);
})
</script>
</body>
</html>