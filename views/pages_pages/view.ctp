<?php
	
	if (!empty($page['PagesPage']['keywords']))
	{
		echo $this->Html->meta('keywords', $page['PagesPage']['keywords'], array('type' => 'keywords'), false);
	}
	else
	{
		echo $this->Html->meta('keywords', Configure::read('App.keywords'), array('type' => 'keywords'), false);
	}

	if (!empty($page['PagesPage']['description']))
	{
		echo $this->Html->meta('description', $page['PagesPage']['description'], array('type' => 'description'), false);
	}
	else
	{
		echo $this->Html->meta('description', Configure::read('App.description'), array('type' => 'description'), false);
	}
	
?>

<h2><?php echo $page['PagesPage']['title'] ?></h2>

<?php echo $bbcode->parse($page['PagesPage']['body']) ?>