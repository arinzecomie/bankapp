<?php
/*$files is the html form file array, 
$rename is the new name you want to save the file with 
$dir is the folder you want to upload file to*/
function upload_img($files, $rename, $dir){
    $t_file= $dir.$rename;
    $uploadOk = 1;
	$imageFileType = pathinfo($t_file,PATHINFO_EXTENSION);
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0 ) {
echo "Sorry, your file
was not uploaded." ;
// if everything is ok, try to upload file
} else {
if (copy ( $_FILES ["fileToUpload" ][ "tmp_name" ], $t_file)) {
$return_msg = "The file " .
basename( $_FILES[ "fileToUpload" ][ "name" ])." has been uploaded." ;
} else {
$return_msg = "Sorry, therewas an error uploading your file." ;
}
}
}//end function upload_img()
?>