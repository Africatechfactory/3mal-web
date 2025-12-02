<?php
	session_start();
	
	function logged_in(){
		return isset($_SESSION["user_id"]);
	}
	
	function confirm_logged_in(){
		if(!logged_in())
			{
			redirect_to("../sign-in/");
			}
		}
		
		
	function tutor_login(){
		return isset($_SESSION["tutor_id"]);
	}
	
	function confirm_tutor_login(){
		if(!tutor_login())
			{
			redirect_to("../tutor-signin/");
			}
		}
		
	function attd_login(){
		return isset($_SESSION["tutor_id"]);
	}
	
	function confirm_attd_login(){
		if(!attd_login())
			{
			redirect_to("../attd-signin/");
			}
		}
		
		
	function parent_login(){
		return isset($_SESSION["student_id"]);
	}
	
	function confirm_parent_login(){
		if(!parent_login())
			{
			redirect_to("../parent-signin/");
			}
		}
		
?>