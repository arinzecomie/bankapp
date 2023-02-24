<?php
class session{
    private $session_track;
	
    public function start(){
	    sesseion_start();
	}//end method start()
	
	public function destroy(){
	session_destroy();
	}//end method destroy()
	
	
}
?>