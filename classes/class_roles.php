<?php
class Roles
{
	protected $dbObj = NULL;

    public function __construct()
    {
		$this->dbObj = new MysqliDb(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);
    }
    
    public function add_new_role($data = array()){
		
		if (empty($data)) {
			return false;
		}
		
		$role_id = $this->dbObj->insert ('roles', $data);
		if($role_id) {
			return $role_id;
		}
		else {
			return false;
		}
	
	}
	
	public function getRolesData($conditions = array(), $limit = null) {
		
		if(!empty($conditions)) {
			foreach($conditions as $key => $cond) {
				$this->dbObj->where($key, $cond);
			}
		}
		
		return $this->dbObj->get("roles r", $limit);				
	}
	
	public function update_role_data($data = array(),$conditions = array()) {
		
		if(empty($data)) {
			return false;
		}
		
		foreach($conditions as $key => $cond) {
			$this->dbObj->where ($key, $cond);
		}
		
		$id = $this->dbObj->update ('roles', $data);		
		if($id) {
			return $id;
		}
		return false;
	}
	
	public function roleNotExist($conditions = array()) {
		if(empty($conditions)) {
			return false;
		}
		
		foreach($conditions as $key => $cond) {
			$this->dbObj->where($key, $cond);
		}
		
		return $this->dbObj->getValue("roles", "count(*)");				
	}
	
	public function role_delete($conditions = array()) {
		
		if(empty($conditions)) {
			return false;
		}
		
		foreach($conditions as $key => $cond) {
			$this->dbObj->where($key, $cond);
		}
		
		return $this->dbObj->delete("roles");				
	}
		
	public function countNoOfRoles($conditions = array()) {
		if(!empty($conditions)) {
			foreach($conditions as $key => $cond) {
			$this->dbObj->where($key, $cond);
		}
	}
		
		return $this->dbObj->getValue("roles", "count(*)");				
	}
	
	public function getPaginationRolesData($conditions = array(), $limit = null, $fields = array("*"), $page_no = null) {
		
		if(!empty($conditions)) {
			foreach($conditions as $key => $cond) {
				$this->dbObj->where($key, $cond);
			}
		}
		
		$this->dbObj->pageLimit=$limit;
		
		if(count($fields) > 1) {
			return $this->dbObj->arraybuilder()->paginate("roles", $page_no, $fields);
		}
		return $this->dbObj->arraybuilder()->paginate("roles", $page_no, array());
	}
}

// END class
