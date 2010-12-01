<?php 
/* SVN FILE: $Id$ */
/* Planamatch schema generated on: 2010-06-13 15:06:26 : 1276440806*/
class PlanamatchSchema extends CakeSchema {
	var $name = 'Planamatch';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $pages = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'slug' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'unique'),
		'body' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'keywords' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'description' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'language' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'UNIQUE' => array('column' => 'slug', 'unique' => 1), 'INDEX' => array('column' => 'title', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'MyISAM')
	);
}
?>