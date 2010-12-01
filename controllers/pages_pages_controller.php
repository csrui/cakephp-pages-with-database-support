<?php

class PagesPagesController extends PagesAppController {
	
	var $pageTitle = 'Pages';
	
	function beforeFilter() {
		
		parent::beforeFilter();
		
		$this->Auth->allow('*');
		
		$this->Auth->deny('admin_edit');
		
		if ($this->action == 'admin_edit' || $this->action == 'admin_add' || $this->action == 'admin_delete') {
			$this->Account->roles('Admin', 'PageEditor');
		}
		
	}
	
	/**
	 * View the selected paged content from the DB
	 * @param string $slug [optional]
	 * @return void
	 */
	function get($slug = null) {
		
		$cond = array(
			'PagesPage.language' => ($this->Cookie->read('lang') ? $this->Cookie->read('lang') : DEFAULT_LANGUAGE),
			'PagesPage.slug' => $slug
		);
		
		$page = $this->PagesPage->find('first', array('conditions' => $cond));
		
		if (empty($page))
		{
			$cond['PagesPage.language'] = DEFAULT_LANGUAGE;
			$page = $this->PagesPage->find('first', array('conditions' => $cond));
		}
		
		$this->pageTitle = $page['PagesPage']['title'];
		$this->set('page', $page);
		
	}
	
	function view() 
	{
		
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
		$page = $subpage = $title = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title'));
		
		$filename = VIEWS.'pages/'.join('/', $path).'.ctp';
					
		if (file_exists($filename))
		{
			$this->render('view', null, $filename);
			
		}
		else
		{
			$this->get($path);
		}
		
	}
		
	function admin_edit($slug, $lang = 'eng') {
		
		$cond = array(
			'PagesPage.language' => $lang,
			'OR' => array(
				'PagesPage.slug' => $slug,
				'PagesPage.id' => $slug
			)
		);
		
		if (empty($this->data)) {
			
			$this->data = $this->PagesPage->find('first', array('conditions' => $cond));
			$this->pageTitle = __('Edit ', true) . $this->data['PagesPage']['title'];
			
		} else {
			
			if ($this->PagesPage->save($this->data)) {
				$this->Session->setFlash(__('Page has been saved', true));
			} else {
				$this->Session->setFlash(__('There are some errors, please correct them', true));
			}
			
		}				
		
	}
	
}
	
?>
