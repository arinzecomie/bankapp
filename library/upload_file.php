<?php
class Upload{	


/*$files is the html form file array, 
$rename is the new name you want to save the file with.$filetype
$dir is the folder you want to upload file to e.g "uploads/"
*/

/* sample variables
	$files = $_FILES;
	$dir = "adverts/";//folder to upload image to
	$img_name = basename( $_FILES[ "fileToUpload" ][ "name" ]);
	$original_image = $dir.$img_name;
	$file_type = pathinfo($original_image,PATHINFO_EXTENSION);//get the image file type
	$rename = "bizadvertbanner".rand(time(), 9999).Date("s").".".$file_type;//set the new image file name
upload_all($files, $rename, $dir);//call upload_img function from master.php file
*/

function upload_all($files, $rename="", $dir){
	
    $main_file = $dir.$rename;
    $uploadOk = 1;
	$imageFileType = pathinfo($main_file,PATHINFO_EXTENSION);
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0 ) {
echo "Sorry, your file
was not uploaded." ;
// if everything is ok, try to upload file
} else {
if (copy ( $_FILES ["fileToUpload" ][ "tmp_name" ], $main_file)) {
$return_msg = "The file " .
basename( $_FILES[ "fileToUpload" ][ "name" ])." has been uploaded." ;
} else {
$return_msg = "Sorry, therewas an error uploading your file." ;
}
}
return $return_msg;
}//end function upload_all()


    //UPLOAD FILE
	public function upload_file($directory){
	
    $directory = $directory;
    $upload_file= $directory. basename($_FILES["imageToUpload"] ["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($directory,PATHINFO_EXTENSION);//file type of the image
        
		if( $imageFileType != "jpg" &&
            $imageFileType != "png" &&
            $imageFileType != "gif" && 
            $imageFileType != "jpeg"){
		    print "You select wrong file in place of image, Try again!";
		    exit();
			}//end if

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0 ) {
        echo "Sorry, your file was not uploaded." ;
        // if everything is ok, try to upload file
    } else {
        if (copy ( $_FILES ["imageToUpload" ][ "tmp_name" ], $upload_file)) {
        echo "<b> Your image file >> </b>" .basename( $_FILES[ "imageToUpload" ][ "name" ])." <b>has been uploaded.</b> <br>" ;
        $image_file = basename( $_FILES[ "imageToUpload" ][ "name" ]);//file name of image
    }//end if
    }//end if
}//end method upload_file
	
public function upload_vid(){
//upload video
$t_dr="../uploads/";
$t_file= $t_dr. basename($_FILES["fileToUpload"] ["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($t_file,PATHINFO_EXTENSION);//file type of the video
if( $imageFileType != "mp4" &&
    $imageFileType != "3gp" &&
    $imageFileType != "avi" &&
    $imageFileType != "mov" && 
    $imageFileType != "mpeg"){
		print "Please select a video file!"; 
		}//end if

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0 ) {
echo "Sorry, your file was not uploaded." ;
// if everything is ok, try to upload file
} else {
if (copy ( $_FILES ["fileToUpload" ][ "tmp_name" ], $t_file)) {
echo "<b> Your Video file >></b>" .basename( $_FILES[ "fileToUpload" ][ "name" ])." <b>has been uploaded.</b>" ;
$video_file = basename( $_FILES[ "fileToUpload" ][ "name" ]);//file name of video
}
}

}//end method upload_vid
}//end class upload

?>