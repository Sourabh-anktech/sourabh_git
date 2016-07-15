<?php
class BlogPost
{
	protected $dbObj = NULL;

    public function __construct()
    {
		$this->dbObj = new MysqliDb(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);
    }
    
    public function add_new_blog($data = array()){
		
		if (empty($data)) {
			return false;
		}
		
		$blog_id = $this->dbObj->insert ('blog_post', $data);
		if($blog_id) {
			return $blog_id;
		}
		else {
			return false;
		}
	
	}
		public function getblogsData($conditions = array(), $limit = null, $fields = array("*")) {
		
		if(!empty($conditions)) {
			foreach($conditions as $key => $cond) {
				$this->dbObj->where($key, $cond);
			}
		}
		
		if(count($fields) > 1) {
			return $this->dbObj->get("blog_post", $limit, $fields);
		}
		return $this->dbObj->get("blog_post", $limit, array());				
	}
	
		public function getblogsListData($conditionsEqual = array(), $conditionsNotEqual = array(), $limit = null, $fields = array("*")) {
		
		if(!empty($conditionsEqual)) {
			foreach($conditionsEqual as $key => $cond) {
				$this->dbObj->where($key, $cond);
			}
		}
		
		if(!empty($conditionsNotEqual)) {
			foreach($conditionsNotEqual as $key => $cond) {
				$this->dbObj->where($key, $cond, "!=");
			}
		}
		
		if(count($fields) > 1) {
			return $this->dbObj->get("blog_post", $limit, $fields);
		}
		return $this->dbObj->get("blog_post", $limit, array());				
	}
	
	public function update_blog_data($data = array(),$conditions = array()) {
		
		if(empty($data)) {
			return false;
		}
		
		foreach($conditions as $key => $cond) {
			$this->dbObj->where ($key, $cond);
		}
		
		$blog_id = $this->dbObj->update ('blog_post', $data);		
		if($blog_id) {
			return $blog_id;
		}
		return false;
	}
	
	public function blogNotExist($conditions = array()) {
		if(empty($conditions)) {
			return false;
		}
		
		foreach($conditions as $key => $cond) {
			$this->dbObj->where($key, $cond);
		}
		
		return $this->dbObj->getValue("blog_post", "count(*)");				
	}
	
	public function blog_delete($conditions = array()) {
		
		if(empty($conditions)) {
			return false;
		}
		
		foreach($conditions as $key => $cond) {
			$this->dbObj->where($key, $cond);
		}
		
		return $this->dbObj->delete("blog_post");				
	}
	
	public function countNoOfBlogs($conditions = array()) {
		if(!empty($conditions)) {
			foreach($conditions as $key => $cond) {
			$this->dbObj->where($key, $cond);
		}
	}
		
		return $this->dbObj->getValue("blog_post", "count(*)");				
	}
	
	public function getPaginationBlogsData($conditions = array(), $limit = null, $fields = array("*"), $page_no = null) {
		
		if(!empty($conditions)) {
			foreach($conditions as $key => $cond) {
				$this->dbObj->where($key, $cond);
			}
		}
		
		$this->dbObj->pageLimit=$limit;
		
		if(count($fields) > 1) {
			return $this->dbObj->arraybuilder()->paginate("blog_post", $page_no, $fields);
		}
		return $this->dbObj->arraybuilder()->paginate("blog_post", $page_no, array());
	}
		
}

// END class
