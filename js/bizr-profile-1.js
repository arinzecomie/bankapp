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

//read image upload form with ajax
function upload_photo(form_action){
    
	notif.style.display = "block";
	//notif.style.overflow = "auto";
	$('#sbmt_loader').show();
	var formSpec = "../ajax_formload.php?form_element=" + form_action+"&dir=relative0";
	$.ajax({
			
			type:"POST",
			url: formSpec,
			//data: {form_element:formSpec},
			cache: false,
			success: function(html){
				$("#notif_display").html(html);
			},
			complete: function(){
			$('#sbmt_loader').hide();	
			}
			
		})

}//end upload_photo()

//read image upload form with ajax
function upload_photo3(form_action){
    
	notif.style.display = "block";
	//notif.style.overflow = "auto";
	$('#sbmt_loader').show();
	var formSpec = "../../ajax_formload.php?form_element=" + form_action+"&dir=relative2";
	$.ajax({
			
			type:"POST",
			url: formSpec,
			//data: {form_element:formSpec},
			cache: false,
			success: function(html){
				$("#notif_display").html(html);
			},
			complete: function(){
			$('#sbmt_loader').hide();	
			}
			
		})

}//end upload_photo()

//read image upload form with ajax 2
function upload_photo2(form_action){
    
	notif.style.display = "block";
	//notif.style.overflow = "auto";
	$('#sbmt_loader').show();
	var formSpec = "ajax_formload.php?form_element=" + form_action+"&dir=relative";
	$.ajax({
			
			type:"POST",
			url: formSpec,
			//data: {form_element:formSpec},
			cache: false,
			success: function(html){
				$("#notif_display").html(html);
			},
			complete: function(){
			$('#sbmt_loader').hide();	
			}
			
		})

}//end upload_photo2()

//display image thumbnail imediately after selection
function readUrl(input){
	//document.getElementById("show").style.display="block";
	if(input.files && input.files[0]){
		var reader = new FileReader();
		reader.onload = function(e){
			$('#show').attr('src', e.target.result)
			.width(100).show();
		}
		reader.readAsDataURL(input.files[0]);
		document.getElementById("show_status").innerHTML="";
		var avatar = document.getElementById("avatar");
		avatar.style.display = "none";
		var add_btn = document.getElementById("show_btn");
		add_btn.style.display = "block";
	}
}

//Ajax submit 
function ajax_sub_img(){ 
    alert("image1");
    $("#upload").one('submit', function(event){ alert("image");
         notif.style.display = "block";
        $('#sbmt_loader').show();
        document.getElementById("notif_display").style.display="none";
	  event.preventDefault();
	  var form_data = $(this);
        if(form_data == ''){alert("empty");}
	  $.ajax({
	    type:'POST',
        url:form_data.attr('action'),
        data: new FormData(this),
		cache:false,
		contentType:false,
		processData:false,
        success: function(data){
		  //print success message
		  notif.style.display = "none";
		 //alert(data);
		  $('#msg').html(data);
		},
		complete: function(){
			$('#sbmt_loader').hide();	
			},
        error: function(error){
		  //error message
		  alert('submission failed');
		}		
	  });
	});
}//end ajax_sub


//Ajax submit attach image 
function ajax_attach_img(){ 

    $("#upload").one('submit', function(event){ 
	var file_name = document.getElementById("file-input").value;//get the name of the selected image to extract the  file extention
	  var file_extention = file_name.split('.').pop();//extract the file extention of the image
	  var extentions = ["png", "jpg", "jpeg", "cdr", "psd", "gif"];
	  if(extentions.indexOf(file_extention) > -1){ 
	  //do nothing for now
	  }else{
		  alert("File format not supported. Supported formats are - (png, jpg, jpeg, psd, cdr and gif)");
		  return false
		  }
	 
	  var design_name = document.getElementById("design_name").value;//get the name of the sample design
	  var all = design_name + "." + file_extention; //set the image name and extension
         document.getElementById("show_status").innerHTML="Uploading...";
         document.getElementById("show_btn").style.display="none";
		  //alert(all);
        //$('#sbmt_loader').show();
        //document.getElementById("notif_display").style.display="none";
	  event.preventDefault();
	  var form_data = $(this);
        if(form_data == ''){alert("empty");}
	  $.ajax({
	    type:'POST',
        url:form_data.attr('action'),
        data: new FormData(this),
		cache:false,
		contentType:false,
		processData:false,
        success: function(data){
		  //print success message
		  document.getElementById("show_status").innerHTML="Success!";
		 //alert(data);
		  $('#msg').html(data);
		},
		complete: function(){
			$('#loader').hide();	
			},
        error: function(error){
		  //error message
		  alert('submission failed');
		}		
	  });
	});
}//end ajax_sub


//Ajax submit 
function ajax_sub(form_id){
	var form_id = "#"+form_id;
    $(form_id).one('submit', function(event){ //alert("Got it");
      notif.style.display = "block";
    $('#sbmt_loader').show();
    $('#notif_display').hide();
	  event.preventDefault();
	  var form_data = $(this); 
	  $.ajax({
	    type:'POST',
        url:form_data.attr('action'),
        data: form_data.serialize(), 
        success: function(data){ 
		  //print success message
		$('#notif_display').show();
		  $('#err_msg').html(data);
		},
		complete: function(){
			$('#sbmt_loader').hide();	
			},
        error: function(error){
		  //error message
		  alert('submission failed');
		}		
	  });
	});
}//end ajax_sub

//Ajax submit 
function news_comment(){
    $("#comment_form").one('submit', function(event){
      notif.style.display = "block";
    $('#sbmt_loader').show();
    $('#notif_display').hide();
	  event.preventDefault();
	  var form_data = $(this);
	  $.ajax({
	    type:'POST',
        url:form_data.attr('action'),
        data: form_data.serialize(),
        success: function(data){
		  //print success message
		$('#notif_display').show();
		  $('#comment_div').html(data);
		},
		complete: function(){
			$('#sbmt_loader').hide();	
			},
        error: function(error){
		  //error message
		  alert('submission failed');
		}		
	  });
	});
}//end ajax_sub


//read all categories menus to the home page
function read_categories(){
	
	modal.style.display = "block";
	//modal.style.overflow = "auto";
	$('#pre_loader').show();
	var formSpec = "categories.php?form_element=all_categories";
	$.ajax({
			
			type:"POST",
			url: formSpec,
			//data: {form_element:formSpec},
			cache: true,
			success: function(html){
				$("#my_form").html(html);
			},
			complete: function(){
			$('#loader').hide();	
			}
			
		})

}//end read_categories

//read all categories menus to the upper directory pages
function read_categories2(){
	
	modal.style.display = "block";
	//modal.style.overflow = "auto";
	$('#pre_loader').show();
	var formSpec = "../categories.php?form_element=all_categories&dir=../";
	$.ajax({
			
			type:"POST",
			url: formSpec,
			//data: {form_element:formSpec},
			cache: true,
			success: function(html){
				$("#my_form").html(html);
			},
			complete: function(){
			$('#loader').hide();	
			}
			
		})

}//end read_categories

//read all categories menus to the upper directory pages
function read_categories3(){
	
	modal.style.display = "block";
	//modal.style.overflow = "auto";
	$('#pre_loader').show();
	var formSpec = "../../categories.php?form_element=all_categories&dir=../";
	$.ajax({
			
			type:"POST",
			url: formSpec,
			//data: {form_element:formSpec},
			cache: true,
			success: function(html){
				$("#my_form").html(html);
			},
			complete: function(){
			$('#loader').hide();	
			}
			
		})

}//end read_categories

//read all categories to select input of profile page
function read_cat(){
	modal.style.display = "block";
	//modal.style.overflow = "auto";
	$('#pre_loader').show();
	var formSpec = "categories.php?form_element=all_cat";
	$.ajax({
			
			type:"POST",
			url: formSpec,
			//data: {form_element:formSpec},
			cache: true,
			success: function(html){
				$("#my_form").html(html);
			},
			complete: function(){
			$('#loader').hide();	
			}
			
			
		})

}//end read_categories

//set the selected category to form input value
function input_cat(input_value){
	
	document.getElementById("cat").value = input_value;
	modal.style.display = "none";
	
}//end input_cat

//view the login form to the user
function userLogin(){ 
var dir = "../";
            document.getElementById('myNotif').style.display = 'block'; 
			document.getElementById("err_msg").innerHTML = "<center> <b id='login_title'> Login or Register <a href='"+dir+"/sign-in/'><span style='margin:10px 10px 10px 10px; color:#fff; font-weight:bold;'>Here </a> </b> </center>";
	var user = document.getElementById("user_login").innerHTML;
		document.getElementById("notif_display").innerHTML = user;
	
}//end 

//view the login form to the user(company)
function companyLogin(){
			document.getElementById("err_msg").innerHTML = "<center> <b id='login_title'> Login to explore more features </b> </center>";
	var user = document.getElementById("company_login").innerHTML;
		document.getElementById("notif_display").innerHTML = user;
	
}//end 

//view the user signup form
function userSignup(){
	notif.style.display = "block";
	var user = document.getElementById("signup_form").innerHTML;
		document.getElementById("notif_display").innerHTML = user;
		document.getElementById("err_msg").innerHTML = "<center> <b id='login_title'> Signup to explore more features </b> </center>";
	
}//end 

function backLogin(){
	notif.style.display = "block";
	var previous = document.getElementById("myForm").innerHTML;
	document.getElementById('notif_display').innerHTML = previous;
	//alert(previous);
}

function allSignup(){
	notif.style.display = "block";
				document.getElementById("err_msg").innerHTML = "<center> <b id='login_title'> Create Account</b> </center>";

	var logOptions = document.getElementById("signupOption").innerHTML;
	document.getElementById('notif_display').innerHTML = logOptions;
}

//show or hide read more button of the company description
var a_comp = document.getElementById("about_company");
//alert(document.getElementById("about_company").clientHeight);
//alert(document.getElementById("about_company").scrollHeight);
if(a_comp.scrollHeight > a_comp.clientHeight){
		document.getElementById("more").style.display="block";
}else{
		document.getElementById("more").style.display="none";

}

function read_more(){
	//alert("got it");
	var readMore = document.getElementById("about_company");
	var classValue = document.getElementById("about_company").className;
	if(classValue == "hide_desc"){
		readMore.className = readMore.className.replace("hide_desc", "show_desc");
		document.getElementById("moreBtn").innerHTML="Read Less<<";
	}else{
		
		readMore.className = readMore.className.replace("show_desc", "hide_desc");
		document.getElementById("moreBtn").innerHTML="Read More>>";
	}
	//readMore.className = "show_desc"
}


function read_less(){
	var readMore = document.getElementById("about_company2");
	var more_div = document.getElementById("toggle_read");
	var more_btn = document.getElementById("more").innerHTML;
	alert("got it");
	readMore.setAttribute("id", "about_company");
	more_div.innerHTML = more_btn;
	
}

//function to validate company registration details
document.getElementById("login_com").onclick = function(){
	//alert("got it");
var passw = document.getElementById("pass_log").value;
var user_n = document.getElementById("com_user").value;
//check if username
if(user_n.length == 0){
	document.getElementById("user_n").innerHTML = "<span> This field should not be empty!</span>";
	return false;
}
//check if password is empty
if(passw.length == 0){
	document.getElementById("passw_log").innerHTML = "<span> Password field should not be empty!</span>";
	return false;
}

}

//function to validate user registration details
function validate_pRecover(){
	//alert("got it");
var passwrd = document.getElementById("passwrd").value;
var passwrd2 = document.getElementById("passwrd2").value;
    
//check if company name is empty
if(passwrd == ""){
	document.getElementById("passw1").innerHTML = "<span> The password field should not be empty!</span>";
	return false;
}

//check if password is less than six
if(passwrd.length < 6){
	document.getElementById("passw1").innerHTML = "<span> Password must be more than six!</span>";
	return false;
}
//check if password match
if(passwrd != passwrd2){
	document.getElementById("passw2").innerHTML = "<span> Password did not match!</span>";
	return false;
}

}//end function validate_user


//function to validate user registration details
//document.getElementById("signup_user").onclick = 
function validate_user(){
	//alert("got it");
var passw = document.getElementById("user_pw").value;
var repassw = document.getElementById("re_user_pw").value;
var name = document.getElementById("full_name").value;
var email = document.getElementById("user_email").value;
var phone = document.getElementById("user_ph").value;
//check if company name is empty
if(name == ""){
	document.getElementById("fn_msg").innerHTML = "<span> The user full name field should not be empty!</span>";
	return false;
}
//check if email is empty
if(email == ""){
	document.getElementById("email_message").innerHTML = "<span> This email field should not be empty!</span>";
	return false;
}
//check if phone is empty
if(phone == ""){
	document.getElementById("user_phone").innerHTML = "<span> This phone field should not be empty!</span>";
	return false;
}

//check if phone number is real number
if(isNaN(phone)){
	document.getElementById("user_phone").innerHTML = "<span>This field should contain only number!</span>";
	return false;
}
//check if password is less than six
if(passw.length < 6){
	document.getElementById("pw1").innerHTML = "<span> Password must be more than six!</span>";
	return false;
}
//check if password match
if(passw != repassw){
	document.getElementById("pw2").innerHTML = "<span> Password did not match!</span>";
	return false;
}

}//end function validate_user


//function to validate company registration details
function validate_reg(){
	//alert("got it");
var passw = document.getElementById("password").value;
var repassw = document.getElementById("re_password").value;
var name = document.getElementById("com_name").value;
var email = document.getElementById("com_email").value;
var phone = document.getElementById("com_phone").value;
var cat = document.getElementById("cat_select").value;
//check if company name is empty
if(name == ""){
	document.getElementById("name_msg").innerHTML = "<span> This company name field should not be empty!</span>";
	return false;
}
//check if email is empty
if(email == ""){
	document.getElementById("email_msg").innerHTML = "<span> This email field should not be empty!</span>";
	return false;
}
//check if phone is empty
if(phone == ""){
	document.getElementById("phone_msg").innerHTML = "<span> This phone field should not be empty!</span>";
	return false;
}

//check if phone number is real number
if(isNaN(phone)){
	document.getElementById("phone_msg").innerHTML = "<span>This field should contain only number!</span>";
	return false;
}
//check if a required value has been selected
if(cat =="Select"){
	document.getElementById("cat").innerHTML = "<span>Please select your company category!</span>";
	return false;
}
//check if password is less than six
if(passw.length < 6){
	document.getElementById("err_pw1").innerHTML = "<span> Password must be more than six!</span>";
	return false;
}
//check if password match
if(passw != repassw){
	document.getElementById("err_pw2").innerHTML = "<span> Password did not match!</span>";
	return false;
}


}//end function validate_reg


//read all categories menus to the home page
function contact_status(req){
	var formSpec = "../../ajax_submit.php?forum_req="+req;
	$.ajax({
			
			type:"POST",
			url: formSpec,
			data: {forum_req:req},
			success: function(html){
				$("#msg").html(html);
			}
			
		})

}//end read_categories

function show_category(){
	//alert("yess");
	document.getElementById("category_section_sm").style.display="block";
}


//menu sidebar script............................................
function menu(){
var openMenu = document.getElementById("openPageslide");
openMenu.onclick = function(){
document.getElementById("pageslide").style.display = "block";
openMenu.style.display="none";
}
var closeMenu = document.getElementById("closeMenu");
closeMenu.onclick = function(){
document.getElementById("pageslide").style.display = "none";
openMenu.style.display="inline-block";
}
}


function show_statement(div_id, btn_id){
	
	if(btn_id == "own_btn"){
		document.getElementById("own_btn").style.background="lightblue";
		document.getElementById("other_btn").style.background="#fff";
		
		document.getElementById("h4_own").style.color="#fff";
		document.getElementById("h4_other").style.color="#000";
		
		document.getElementById("own_b").style.display="block";
		document.getElementById("other_b").style.display="none";
	}
	
	if(btn_id == "other_btn"){
		document.getElementById("other_btn").style.background="lightblue";
		document.getElementById("own_btn").style.background="#fff";
		
		document.getElementById("h4_other").style.color="#fff";
		document.getElementById("h4_own").style.color="#000";
		
		document.getElementById("own_b").style.display="none";
		document.getElementById("other_b").style.display="block";
	}
	
	
}
/*
var readMore = document.getElementById("about_company");
	var classValue = document.getElementById("about_company").className;
	if(classValue == "hide_desc"){
		readMore.className = readMore.className.replace("hide_desc", "show_desc");
		document.getElementById("moreBtn").innerHTML="Read Less<<";
	}else{
		
		readMore.className = readMore.className.replace("show_desc", "hide_desc");
		document.getElementById("moreBtn").innerHTML="Read More>>";
	}*/