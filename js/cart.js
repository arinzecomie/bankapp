
//Ajax Shopping Cart  submit 
function cart_sub(form_id){ 
	var form_id = "#"+form_id
    $(form_id).one('submit', function(event){
      notif.style.display = "block";
    $('#sbmt_loader').show();
    //$('#notif_display').hide();
	  event.preventDefault();
	  var form_data = $(this);
	  $.ajax({
	    type:'POST',
        url:form_data.attr('action'),
        data: form_data.serialize(),
        success: function(data){
		  //print success message
		$('#notif_display').show();
		
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
}//end cart_sub


//romove item from cart
function remove_item(form_action, dir){
	notif.style.display = "block";
	//notif.style.overflow = "auto";
	$('#sbmt_loader').show();
	if(dir =="../"){var add_dir = "ii";}
	var formSpec = dir + "cart/index.php?form_id=" + form_action+"&dir=" + add_dir;
	$.ajax({
			
			type:"POST",
			url: formSpec,
			//data: {form_element:formSpec},
			cache: false,
			success: function(data){
				$("#msg").html(data);
			},
			complete: function(){
			$('#sbmt_loader').hide();	
			}
			
		})

}//end remove_item()

function remove_item_checkout_pg(form_action, dir){
	//notif.style.display = "block";
	//notif.style.overflow = "auto";
	//$('#loader').show();
	//alert(dr);
	//alert(form_action);
	var formSpec = dir + "cart/index.php?remove_id=" + form_action+"&dir=relative";
	$.ajax({
			
			type:"POST",
			url: formSpec,
			//data: {form_element:formSpec},
			cache: false,
			success: function(data){
				$("#checkout_view").html(data);
			},
			complete: function(){
			$('#loader').hide();	
			}
			
		})

}//end remove_item()

//view cart from the cart icon
function view_cart(form_action){
    var get_id = '#msg';
	var dir = 0;
	if(form_action == "../"){var dir = "ii";}
	var formSpec = form_action + "cart/index.php?view_cart=view_cart_box&dir=" +dir;
	if(form_action == "checkout"){var dir = "ii"; var formSpec = "../cart/index.php?checkout_pg_view=view_cart_box&dir=" +dir; var get_id = '#checkout_view'; }else{
		notif.style.display = "block";
	//notif.style.overflow = "auto";
	$('#sbmt_loader').show();
	
	}
	
	$.ajax({
			
			type:"POST",
			url: formSpec,
			//data: {form_element:formSpec},
			cache: false,
			success: function(data){
				$('#notif_display').show();
				$(get_id).html(data);
			},
			complete: function(){
			$('#sbmt_loader').hide();	
			}
			
		})

}//end view_cart()


//view cart from the cart icon
function view_cart2(){
    
	notif.style.display = "block";
	//notif.style.overflow = "auto";
	$('#sbmt_loader').show();
	var formSpec = "../cart/index.php?view_cart=view_cart_box";
	$.ajax({
			
			type:"POST",
			url: formSpec,
			//data: {form_element:formSpec},
			cache: false,
			success: function(data){
				$("#msg").html(data);
			},
			complete: function(){
			$('#sbmt_loader').hide();	
			}
			
		})

}//end view cart()


//increase cart quantity
function increase_cart(){
    
	var incr = document.getElementById("qty");
	incr.value++;
	document.getElementById("p_qty").value++;

}//end increase cart()

//increase cart quantity
function decrease_cart(){
    
	
	var decr = document.getElementById("qty");
	if(decr.value == 1){ 
	//do nothing 
	}else{
	decr.value--;
	document.getElementById("p_qty").value--;
	}//end if else

}//end increase cart()

//update the cart quantity when the user manually typed the numbers
function update_pqty(){
    
	var update = document.getElementById("qty").value;
	
	document.getElementById("p_qty").value = update;

}//end increase cart()



//use to check if logged in user want to checkout with his registered details
function checkout_mode(){
    
	var check_box = document.getElementById("checkout_mode");
	
	if(check_box.checked == true){
		document.getElementById("default_checkout").style.display="block";
		document.getElementById("checkout_details").style.display="none";
	
	}else{
		
		document.getElementById("default_checkout").style.display="none";
		document.getElementById("checkout_details").style.display="block";
	}//end if
	
	//document.getElementById("p_qty").value = update;

}//end checkout_mode()