<?php
class Pages
{
	protected $dbObj = NULL;

    public function __construct()
    {
		$this->dbObj = new MysqliDb(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);
    }
    
    public function add_new_page($data = array()){
		
		if (empty($data)) {
			return false;
		}
		
		$page_id = $this->dbObj->insert ('pages', $data);
		if($page_id) {
			return $page_id;
		}
		else {
			return false;
		}
	
	}
		public function getPagesData($conditions = array(), $limit = null, $fields = array("*")) {
		
		if(!empty($conditions)) {
			foreach($conditions as $key => $cond) {
				$this->dbObj->where($key, $cond);
			}
		}
		
		if(count($fields) > 1) {
			return $this->dbObj->get("pages p", $limit, $fields);
		}
		return $this->dbObj->get("pages p", $limit, array());				
	}
	
	public function update_page_data($data = array(),$conditions = array()) {
		
		if(empty($data)) {
			return false;
		}
		
		foreach($conditions as $key => $cond) {
			$this->dbObj->where ($key, $cond);
		}
		
		$page_id = $this->dbObj->update ('pages', $data);		
		if($page_id) {
			return $page_id;
		}
		return false;
	}
	
	public function pageNotExist($conditions = array()) {
		if(empty($conditions)) {
			return false;
		}
		
		foreach($conditions as $key => $cond) {
			$this->dbObj->where($key, $cond);
		}
		
		return $this->dbObj->getValue("pages", "count(*)");				
	}
	
	public function page_delete($conditions = array()) {
		
		if(empty($conditions)) {
			return false;
		}
		
		foreach($conditions as $key => $cond) {
			$this->dbObj->where($key, $cond);
		}
		
		return $this->dbObj->delete("pages");				
	}
	
	public function countNoOfPages($conditions = array()) {
		if(!empty($conditions)) {
			foreach($conditions as $key => $cond) {
			$this->dbObj->where($key, $cond);
		}
	}
		
		return $this->dbObj->getValue("pages", "count(*)");				
	}
	
	public function getPaginationPagesData($conditions = array(), $limit = null, $fields = array("*"), $page_no = null) {
		
		if(!empty($conditions)) {
			foreach($conditions as $key => $cond) {
				$this->dbObj->where($key, $cond);
			}
		}
		
		$this->dbObj->pageLimit=$limit;
		
		if(count($fields) > 1) {
			return $this->dbObj->arraybuilder()->paginate("pages", $page_no, $fields);
		}
		return $this->dbObj->arraybuilder()->paginate("pages", $page_no, array());
	}
}

// END class
