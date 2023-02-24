//function to process up voting
function upVote(track, vote_num, id){
    var update = "#"+id;
	var formSpec = "forum_func.php?form_element=upVote";
	$.ajax({
			
			type:"POST",
			url: formSpec,
			data: {voteN:track, voteLimit:vote_num},
			cache: false,
			success: function(html){
				//alert("successful");
				$(update).html(html);
			},
			 error: function(error){
		  //error message
		  alert('Try again');
		}
			
		})

}


//Ajax submit  main
function vCount1(id, vote){
    var getId = "#"+id;
    var vN = vote;
    var url = id+"-"+vN;
	var formSpec = "../vote/"+ url;
	$.ajax({
			
			type:"POST",
			url: formSpec,
			//data: {form1:"meeeeee", voteN:me},
			success: function(html){
			    //alert(getId);
				$(getId).html(html);
			},
				 error: function(error){
		  //error message
		  alert('Try again>>');
		}
			
		})
}//end ajax_sub


//Ajax submit  main
function vCount(id, vote){
    var getId = "#"+id;
    var vN = vote;
    var url = id+"-"+vN;
	var formSpec = "../../vote/"+ url;
	$.ajax({
			
			type:"POST",
			url: formSpec,
			//data: {form1:"meeeeee", voteN:me},
			success: function(html){
			    //alert(getId);
				$(getId).html(html);
			},
				 error: function(error){
		  //error message
		  alert('Try again>>');
		}
			
		})
}//end ajax_sub


//function to check if category is selected
function check_cat(){
    document.getElementById('err_msg').style.background = 'none';  
    document.getElementById('err_msg').style.padding = '0px';
    document.getElementById('err_msg').innerHTML=''; 
    var value = document.getElementById('category').value;
if(value != "Select_category"){
    ajax_sub();
}else{ 
    document.getElementById('myNotif').style.display = 'block';  document.getElementById('err_msg').style.background = 'lightgreen';  document.getElementById('err_msg').style.padding = '20px'; document.getElementById('err_msg').innerHTML='Please select your post category! '; 
    return false; 
}

}