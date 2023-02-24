 <?php 
 function get_question($query_fields, $filter_by, $dir="../"){
	$db = new Db_conn();
	$table_name = "question q";
	$db->select_data($table_name, $query_fields);
	$min_id = $query_fields['min_id'];
	$i = 0;
	 while($row = $db->return_sth()->fetch()){
		 
		 $title = $row['qcont'];
		 $name = $row['name'];
		 $cat = $row['cat'];
		 $qby = $row['qby'];
		 $qcode = $row['qcode'];
		 $date = $row['date']." ".$row['time'];
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
		 <div class="forum_views">
		 <a  href='<?php echo $dir; ?>forum/topic/<?php echo $qcode;?>'><b><?php echo $total_ans; ?>
		 </b></a> <br>Rep <br><div style="border-top:1px solid grey;"> <?php echo $views;?> <br> Views</div>
		</div> 
		 <div class="title_content"> 
		 <a  href='<?php echo $dir; ?>forum/topic/<?php echo $qcode;?>'><span class="inner_title"><?php echo substr($title, 0, 200); echo $ttl; if(strlen($title) > 200){echo "...";} ?> </span></a><br>
		 
		 <a href='<?php echo $dir; ?>forum/?refcat=<?php echo $cat;?>'><button class="forum_cat"><?php echo $cat;?></button></a><br>
		 <div style="padding-top:5px;">
		 <b>By</b> <a  href='<?php echo $dir; ?>forum/profiles/<?php echo $qby;?>'> <span class="forum_by"><?php echo $name;?></span> </a> 
		 <span style="white-space:nowrap;">
		 <span class="glyphicon glyphicon-time"></span> <span class="forum_date"> <?php echo time_elapsed_string($date); ?> </span>
			</span>
		<span style="margin-left:10px;">
		 <a  href='<?php echo $dir; ?>forum/topic/<?php echo $qcode;?>'>
		 <span class="forum_by">Reply</span>
		 </a>
		 </span>
		 <?php 
		 //if the viewer is the owner of the post, print edit button
		 if($_SESSION['all_user'] == $qby ){
			 echo "<a href='../forum/editing/$qcode'><b>Edit</b></a>";
		 } ?>
		 <br>
		 </div>
		 </div>
		 </div>
	<?php
	    $i++;
		$last_id = $row['id'];
	 }//end while
	
		if($i >= 20 && $last_id != $min_id){
		?>
		
		<center>
		<?php if($filter_by == "category"){
			echo"<a href='?refcat=$cat&num_limit=$last_id'> ";
		}else{
			echo"<a href='?num_limit=$last_id'> ";
		}
		?>
				<div >See more...</div>
				</a>
				</center>
	<?php
		}else{
			if(isset($_GET['num_limit'])){
			echo " <center> <h3 style='color:red;' > End </h3> </center>";
		}//end if !isset
		}//end if else $i
	 $db->close_db();
	 $dbhandle->close_db();
 }//end fucntion get_question
 ?>

