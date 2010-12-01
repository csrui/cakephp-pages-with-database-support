<?php
    
Class PagesAppController extends AppController {
	
	var $components = array('Session', 'Ua.Account', 'Auth');
	
	var $helpers = array('Bbcode', 'Text');
	
}
	
?>