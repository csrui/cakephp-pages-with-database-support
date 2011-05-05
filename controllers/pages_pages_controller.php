<?php

class PagesPagesController extends PagesAppController {
		
	function beforeFilter() {
		
		parent::beforeFilter();
		
		$this->Auth->allow('*');
		
		$this->Auth->deny('admin_edit');
		
		if (isset($this->admin)) {
			$this->Account->checkRoles('Admin', 'PageEditor');
		}
		
		$this->set('title_for_layout', __('Pages', true));
		
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
		
		$this->set('title_for_layout', $page['PagesPage']['title']);
		$this->set('page', $page);
		
	}
	
	function view() {
		
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
					
		if (file_exists($filename)) {
			
			/* DOESNT WORK BECAUSE TITLE MIGHT CONTAIN PHP CODE
			$content = file_get_contents($filename);
			$content = explode("\n", $content);
			
			var_dump($content);
			
			$content = $content[0];
			$content = strip_tags($content);
			$this->set('title_for_layout', $content);
			*/
			
			$this->set('title_for_layout', __("$title", true));
			
			$this->render('view', null, $filename);
			
		} else {
			
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
