<?php
class Users
{
	protected $dbObj = NULL;

    public function __construct()
    {
		$this->dbObj = new MysqliDb(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);
    }
    
	public function add_new_user($data = array()) {
		
		if(empty($data)) {
			return false;
		}
		
		$id = $this->dbObj->insert ('users', $data);
		if($id)
		{
			return $id;
		}
		return false;
	}
    
	public function update_user_data($data = array(),$conditions = array()) {
		
		if(empty($data)) {
			return false;
		}
		
		foreach($conditions as $key => $cond) {
			$this->dbObj->where ($key, $cond);
		}
		
		$id = $this->dbObj->update ('users', $data);		
		if($id) {
			return $id;
		}
		return false;
	}
	
	public function isAlreadyExist($conditions = array()) {
		if(empty($conditions)) {
			return false;
		}
		
		foreach($conditions as $key => $cond) {
			$this->dbObj->where($key, $cond);
		}
		
		return $this->dbObj->getValue("users", "count(*)");				
	}
	
	public function notExist($conditions = array()) {
		if(empty($conditions)) {
			return false;
		}
		
		foreach($conditions as $key => $cond) {
			$this->dbObj->where($key, $cond);
		}
		
		return $this->dbObj->getValue("users", "count(*)");				
	}
	
	public function getUsersData($conditions = array(), $limit = null, $fields = array("*"), $joins = array(), $ordering = array()) {
		
		if(!empty($conditions)) {
			foreach($conditions as $key => $cond) {
				$this->dbObj->where($key, $cond);
			}
		}
		
		if(!empty($joins)) {
			foreach($joins as $key => $join) {
				$this->dbObj->join($join['table_name'], $join['cond_join'], $join['join_type']);
			}
		}
		
		if(!empty($ordering)) {
			foreach($ordering as $key => $orderby) {
				$this->dbObj->orderBy($orderby['field_name'], $orderby['direction']);
			}
		}
		
		//$db->join("users u", "p.tenantID=u.tenantID", "LEFT");
		$this->dbObj->join('roles r', 'u.role_id = r.id', 'LEFT');
		if(count($fields) > 1) {
			return $this->dbObj->get("users u", $limit, $fields);
		}
		
		return $this->dbObj->get("users u", $limit, array("u.*", "r.role_name"));				
	}
	
	public function user_delete($conditions = array()) {
		
		if(empty($conditions)) {
			return false;
		}
		
		foreach($conditions as $key => $cond) {
			$this->dbObj->where($key, $cond);
		}
		
		return $this->dbObj->delete("users");				
	}
	
	public function countNoOfUsers($conditions = array()) {
		if(!empty($conditions)) {
			foreach($conditions as $key => $cond) {
			$this->dbObj->where($key, $cond);
		}
	}
		
		return $this->dbObj->getValue("users", "count(*)");				
	}
	
	public function getPaginationUsersData($conditions = array(), $limit = null, $fields = array("*"), $joins = array(), $ordering = array(), $page_no = null) {
		
		if(!empty($conditions)) {
			foreach($conditions as $key => $cond) {
				$this->dbObj->where($key, $cond);
			}
		}
		
		if(!empty($joins)) {
			foreach($joins as $key => $join) {
				$this->dbObj->join($join['table_name'], $join['cond_join'], $join['join_type']);
			}
		}
		
		if(!empty($ordering)) {
			foreach($ordering as $key => $orderby) {
				$this->dbObj->orderBy($orderby['field_name'], $orderby['direction']);
			}
		}
		$this->dbObj->join('roles r', 'u.role_id = r.id', 'LEFT');
		
		$this->dbObj->pageLimit=$limit;
		
		if(count($fields) > 1) {
			return $this->dbObj->arraybuilder()->paginate("users u", $page_no, $fields);
		}
		return $this->dbObj->arraybuilder()->paginate("users u", $page_no, array("u.*", "r.role_name"));
	}
}

// END class
