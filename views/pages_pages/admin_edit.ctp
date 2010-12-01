<div class="pages edit">

<h2><?php __('Edit Page') ?></h2>

<?php

	echo $this->Form->create('PagesPage', array('url' => array('controller' => 'pages', 'action' => 'edit')));
	
	echo $this->Form->input('id');
	echo $this->Form->input('title');
	
	echo $this->Form->input('body', array('rows' => 16, array('class' => 'mceEditor')));

?>

<fieldset>
	<legend><?php __('Meta'); ?></legend>
<?php

	echo $this->Form->input('slug');
	echo $this->Form->input('language');
	echo $this->Form->input('keywords');
	echo $this->Form->input('description', array('type' => 'textarea'));
	
?>
</fieldset>

<?php echo $this->Form->end('Save page'); ?>

</div>