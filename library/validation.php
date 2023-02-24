<?php
class Validation{
    protected $error = array();//array to report error during validation
    protected $validated_data = array();//array to hold validated data
	protected $error_data;//variable to hold error data per method
	protected $passed = true;//variable to report if there's error or not
    protected $count = 0;//variable to count the number of errors
	
	//method for basic validation of form data
	//$_POST = form data, $submit_button = name of form submit_button
	public function validate_data($form_data, $submit_button="submit_button"){
	    foreach($form_data as $key=>$values){
		    $value = trim($values);//trim data 
		    $value = strip_tags($value);//remove html tags
			
		switch($key){
			
		    CASE $submit_button:;
            break;
            default:
			
		if(empty($value)){
		    $this->error_data = ++$this->count ."&nbsp Fields are empty, please fill all required field";
			$this->passed = false;				
		}//end if empty
		
		$this->add_valid_data($value);//add validated data to array
		    break;
			
		 }//end switch
		 
	    }//end foreach
		
	 //if error, add error report to array
	if($this->passed == false){
		$this->add_error($this->error_data);
	}//end if $this->passed
	
	}//end method validate_values
	
	
	//method for validation without empty() check
	//$_POST = form data, $submit_button = name of form submit_button
	public function validate_non_empty($form_data, $submit_button="submit_button"){
	    foreach($form_data as $key=>$values){
		    $value = trim($values);//trim data 
		    $value = strip_tags($value);//remove html tags
			
		switch($key){
			
		    CASE $submit_button:;
            break;
            default:
		/*	
		if(empty($value)){
		    $this->error_data = ++$this->count ."&nbsp Fields are empty, please fill all required field";
			$this->passed = false;				
		}//end if empty
		*/
		
		if(empty($value)){
		    $value = "?";			
		}//end if empty
		
		
		$this->add_valid_data($value);//add validated data to array
		    break;
			
		 }//end switch
		 
	    }//end foreach
		
	 //if error, add error report to array
	if($this->passed == false){
		$this->add_error($this->error_data);
	}//end if $this->passed
	
	}//end method validate_values
	
	private function add_error($error_data){
		    $this->error[] = $error_data;
	}//end method print_error	
	
	//return validation status
	public function return_passed(){
		    return $this->passed;
	}//end method return_passed
	
	//return error array
	public function return_error(){
		    return $this->error;
	}//end method return_error

	//return validated data
	public function return_valid_data(){
		    return $this->validated_data;
	}//end method return_valid_data
	
	//add validated values to array
	public function add_valid_data($value){
		    $this->validated_data[] = $value;
	}//end method add_valid_data

	//validate password and hash
	public function validate_password($password, $re_password){
		if(strlen($password) < 6){
		    die("password should not be less than 6");
	    }else{
		
		    if($this->check_equality($password, $re_password) == true){
			    //hash password
			}else{
				die("password did not match");
			}//end if else
		
	    }//end if else
			
	}//end method validate_password

	//check if two data is equal
	public function check_equality($data_1, $data_2){
		   
            if($data_1 == $data_2){
				return true;
			}else{
				return false;
			}//if else		   
			
	}//end method check_equality

}//end class Validation


class Check_exist extends Validation{
	
	public function check_username($data_array, $submit_button){
		$this->validate_data($data_array, $submit_button);
		
		
	}
	
}//end class Check_exist
?>