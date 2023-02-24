<?php
session_start();
?>
<?php
if(!isset($_SESSION['admin_username']) ||
  $_SESSION['admin_username']=="") {
header("location:admin/admin_login.php");
}

include('../library/library.php');
?>
<?php
//include("../../header_func.php");
//my_header("../../")
?>



 
<?php
//select file to edit
//edit files from directory
$directory = openDir("..");//open the directory to read the current files
chdir("..");//change directoru
	
//add all files in directory to $all_files array
while ($currentFile !== false){
$currentFile = readDir($directory);
$all_files[] = $currentFile;
if($currentFile == "." || $currentFile == ".."|| $currentFile == ""){
	//do nothing if it is not a real file name
}else{
$options .= "<option> $currentFile </option>";	
}

} // end while
closedir($directory);	
?>

 <center>

 <h3 > Edit/Update Page</h3>
 <hr>
    <form action="dev_update.php" method="post">
	   <b>Select file to Edit</b>
        <select  class="form-control input-lg" type="text" name="edit_file" >
		<option> Select_file</option>
        <?php
		echo $options;
		?>
		</select><br/>
           <input class="btn btn-primary" type="submit" name="submit_edit" value="Edit Page"> </input>
                 </form>








 <center>
 <div class="container">
 <h3 > Edit/Update Page</h3>
 <hr>

</div>
<?php
   if(isset($_GET['submit_edit'])) 
      {
        $filename=$_GET['submit_edit'];
        $filename= $filename;
           $openfile=fopen($filename, "r");                  
             if( file_exists( $filename )) {
               while(!feof($openfile)){
                 $source_file .=fgets($openfile); 
                   }//end while
                     }//end if file_exist
                       else{ print"File does not exist"; exit();
 
 }//end else


print<<<HERE
<center> <span style="font-weight:bold;"> Editing ($filename) </span> </center>
<form method="post" action="dev_update.php">
<textarea style="border:2px solid grey; border-radius:8px;" rows=20 cols=100 name="update_code">$source_file</textarea>
   <center>
   <br>
<input class="btn btn-primary btn-lg" type="submit" name="submit_update1" value="Update"> </input>
   <input type="hidden" value="$filename" name="edit_file"></input>
     </center>
              </form>
HERE;
}//end if isset
?>

<?php
if ( isset ($_POST['submit_update1'])) {
 $filename=$_POST['edit_file'];
     $openfile=fopen($filename, "w");
         $update_code = $_POST['update_code'];
           $change = fputs($openfile, $update_code);
		   fclose($openfile); 
if($change){
	
	print "<b style='color:green; font-size:20;'>File ($filename) Updated Successfully!</b>";
} 
   
}//end else if
?>


<?php
//add_new page

   if(isset($_GET['add_new_pg'])) 
      {
		  $filename = $_GET['add_new_pg'];
		  print<<<HERE
<center> <span style="font-weight:bold;"> Add New Page </span> </center>
<form method="post" action="dev_update.php">
<textarea style="border:2px solid grey; border-radius:8px;" rows=20 cols=100 name="pg_content">$source_file</textarea>
   <center>
   <br>
<input class="btn btn-primary btn-lg" type="submit" name="submit_new_pg" value="Add"> </input>
   <input type="hidden" value="$filename" name="file_name"></input>
     </center>
              </form>
HERE;
       
 }//end if isset


/* directory operations
chdir(".");
$dirPtr = openDir("/uploads");
*/
 if(isset($_POST['submit_new_pg'])) 
      {
$add = $_POST['pg_content'];
$save_as = $_POST['file_name'];

$openfile = fopen($save_as, "w");
   fputs($openfile, $add);
	  }//end isset
	  
	  
	  echo "<b> $save_as  </b> <br>";
	  echo "<b> $add  </b>";
?>
  
<?php
//my_footer($dir);
?>