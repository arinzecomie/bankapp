// Get the modal
var modal = document.getElementById('myModal');
var notif = document.getElementById('myNotif');

// Get the button that opens the modal
var btn = document.getElementById("btn1");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
var closeNotif = document.getElementById("close_notif");

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks on <span> (x), close the modal
closeNotif.onclick = function() {
    notif.style.display = "none";
	document.getElementById("notif_display").innerHTML="";
	document.getElementById("modal_title").innerHTML ="";
	document.getElementById("err_msg").innerHTML ="";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// When the user clicks the button, open the modal 
function add_staff() {
   notif.style.display="block";
	document.getElementById("err_msg").innerHTML= "<div style='width:50%; margin:auto;'> <form id='update' action='../admin/admin_process.php'  method='post'> <h2 class='text-center' style='color:#fff;'>Generate admin registration code</h2> <br>"
	+"Staff Designation:<select type='text' name='designation' class='form-control' >"
	+"<option>select_position</option>"
	+"<option>Super_admin</option>"
	+"<option>Agent</option>"
	+"<option>System_admin</option>"
	+ "</select> <br>"
	+ "<input type='hidden' name='generate_code' class='form-control' value='staff_code'>"
	+ "<input type='submit' name='generate_staff' class='btn btn-primary center-block' value='Generate'>"
	+ "</form></div>";
}


function show_credit(){
	document.getElementById('show_credit').style.display="block";
	
}//end show_credit

function show_change_days(){
	document.getElementById('show_change_days').style.display="block";
	
}//end show_credit


function view_customers(category) {
    modal.style.display = "block";
    modal.style.overflow = "scroll";
	document.getElementById("my_form").innerHTML= "<center> <img src='../image/loading.gif' style=''> <center>";
	var formD ="#my_form";
	var form_data = category;
	  $.ajax({
	    type:'POST',
        url:'../ajax_submit.php',
        data: {link_rq:form_data},
        success: function(data){
		  //print success message
		  $(formD).html(data);
		},
        error: function(error){
		  //error message
		  alert('sbmission failed');
		}		
	  });
}


//Ajax submit 
function ajax_sub(){
    $("#update").one('submit', function(event){
	  event.preventDefault();
	  var form_data = $(this);
	  $.ajax({
	    type:'POST',
        url:form_data.attr('action'),
        data: form_data.serialize(),
        success: function(data){
		  //print success message
		 alert('sucessful');
		  $('#msg').html(data);
		},
        error: function(error){
		  //error message
		  alert('sbmission failed');
		}		
	  });
	});
}//end ajax_sub
