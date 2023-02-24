 <?php 
 function get_question($query_fields){
	$db = new Db_conn();
	$table_name = "question q";
	$db->select_data($table_name, $query_fields);
	 while($row = $db->return_sth()->fetch()){
		 
		 $title = $row['qcont'];
		 $name = $row['name'];
		 $cat = $row['cat'];
		 $qby = $row['qby'];
		 $qcode = $row['qcode'];
		 $date = $row['date'];
		 $time = $row['time'];
		$views = $row['views'];		 
		 //fetch the number of answers per question
		 $dbhandle = new Db_conn();
		 $table_name = "answer a";
		 $query_fields = array("field_names"=>array("count(id) as total_ans"), "where"=>array("a.quest_code ="), "data"=>array($qcode) );
		 $dbhandle->select_data($table_name, $query_fields);	   
		 $ttl_ans = $dbhandle->return_sth()->fetch();
	 $total_ans = $ttl_ans['total_ans'];
		
		 ?>
		 <div class='forum_title row'>
		 <div style='float:left; display:block; padding:5px;'>
		 <a href='questions.php?refid=<?php echo $qcode; ?>'><b><?php echo $total_ans; ?></b></a> Ans <br> <?php echo $views;?> Views
		</div> 
		 <div style='display:inline-block; width:80%; padding:5px; border-left:1px solid grey;'> <b><a href='questions.php?refid=<?php echo $qcode;?>'><?php echo $title;?> </a></b><br>
		 Category:<a href='?refcat=<?php echo $cat;?>'><?php echo $cat;?></a> <br>
		 <b>By</b> <a href='profile.php?mem=<?php echo $qby;?>'><?php echo $name;?></a> <b>On</b> <?php echo $date;?>
		 <?php 
		 //if the viewer is the owner of the post, print edit button
		 if($_SESSION['all_user'] == $qby ){
			 echo "<a href='edit.php?_pref=$qcode&linkreq=edit'><b>Edit</b></a>";
		 } ?>
		 <br>
		 </div>
		 </div>
	<?php
	 }//end while
	 $db->close_db();
	 $dbhandle->close_db();
 }//end fucntion get_question
 ?>

<?php
//upvote fucntion running with ajax
if(isset($_POST['vote_count'])){
			$ans_code = $_POST['form_element'];
			$vote_count = $_POST['vote_count'];
	        //update the vote of the answer
			$db = new Db_conn();
			$table_name = "answer";
			$data = array($vote_count + 1, $ans_code);
			$query_fields = array("field_names"=>array("vote"), "where"=>array("ans_code ="), "data"=>$data);
			$db->update_db($table_name, $query_fields);
	
	echo $vote_count +1;
	
}//end isset
?>
