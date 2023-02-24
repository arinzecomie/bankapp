<?php
/*
function to set the pagination value with url variable and database id
the function returns a query array to pass to the main page that will run the pagination
with  the total_rows, max_id and min_id array index inclusive if set
$table_name is the name of the database table to paginate
$pagination (array) query is the query to run the pagination, < or > condition data is always left empty because pagination function will handle it
$row_count_query (array), is the query to count the total number of matched row to paginate with the maximum or mininum id for pagination
*/
function paginate($table_name, $pagination_query, $row_count_query=array()){
	$last =  0;

	if(isset($_GET['num_limit'])){
		
		$last = $_GET['num_limit'];
		
		if(empty($last) || $last < 1){
			
			$last = 0;
		}
		
		if(!is_numeric($last)){
		$last = 0;
		}
	}

    $db = new Db_conn();
	$total_rows = null;
	//if the database count query is not set, dont run the query
	if(!empty($row_count_query)){
	//get total number of rows
	$query_fields = $row_count_query;
	$db->select_data($table_name, $query_fields);
	$total  = $db->return_sth()->fetch();
	$total_rows = $total['total'];//total rows
	$max_id = $total['max'];//maximum id row
	$min_id = $total['min'];//maximum id row
	}//end if !empty
	
	//if $last is not 0, set the url var value as the pagination data
	if($last != 0){
	$pagination_query['data'] = array_merge($pagination_query['data'], array($last));
	}//end if
	
	//if $last is 0, set the database id value as the pagination value
   if($last == 0 || $last == ""){
	   $pagination_query['data'] = array_merge($pagination_query['data'], array($max_id + 1));
   }//end if	   
   $query_fields = $pagination_query;	
		
	//$more = "<a href='?num_limit=$last_id'> See more...</a>";
	$extra_data =  array("total_rows"=>$total_rows, "max_id"=>$max_id, "min_id"=>$min_id, "last"=>$last); 

return $set_pagination = array_merge($query_fields, $extra_data);



}//end function paginate()
//$pg = paginate($pag);
?>