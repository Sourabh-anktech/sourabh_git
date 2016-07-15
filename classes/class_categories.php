<?php
class Categories
{
	protected $dbObj = NULL;

    public function __construct()
    {
		$this->dbObj = new MysqliDb(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);
    }
    
    public function add_new_category($data = array()){
		
		if (empty($data)) {
			return false;
		}
		
		$category_id = $this->dbObj->insert ('categories', $data);
		if($category_id) {
			return $category_id;
		}
		else {
			return false;
		}
	
	}
	
	public function getCategoriesData($conditions = array(), $limit = null, $fields = array("*"), $joins = array(), $enable_Join = TRUE) {
		
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
		
		if($enable_Join)
			$this->dbObj->join('categories ctg', 'c.parent_id = ctg.id', 'LEFT');
		
		if(count($fields) > 1) {
			return $this->dbObj->get("categories c", $limit, $fields);			
		}
		return $this->dbObj->get("categories c", $limit, array());
	}
	
	//~ 
	//~ public function printOptions ($options, $parent, $level=0)
	//~ {
		//~ $output = '';
		//~ foreach ($options as $opt)
		//~ {
		   //~ if ($parent == $opt['parent_id'])
		   //~ {
			   //~ $indent  = str_repeat('--', $level); 
			   //~ $output .= "<option value='".$opt['id']."'>".$indent.$opt['category_name']."</option>";
			   //~ $output .= $this->printOptions($options, $opt['id'], $level+1);
		   //~ }	 
		//~ }
		//~ return $output;
	//~ }
	//~ 
	//~ public  function getBlogsCategoryDropDown($selected = array()) {
	//~ 
		//~ $listData = $this->dbObj->get("categories c");		
		//~ 
		//~ $output = "<select class='form-control'>";
		//~ $output .= $this->printOptions ($listData,0);
		//~ $output .= "</select>";
		//~ return $output;
	//~ }
	
	public function printOptions ($options, $level = 0, $selected_value)
	{
		$output = "";
		foreach ($options as $opt)
		{
			$selected = "";
			if($selected_value == $opt['id']) {
				$selected = 'selected';
			}
			$indent  = str_repeat('---', $level);
			$output .= "<option value='".$opt['id']."' ".$selected.">".$indent.$opt['category_name']."</option>";
			$conditions = array("c.parent_id" => $opt['id']);
			$childListData = $this->getCategoriesData($conditions, null, array('c.id', 'c.category_name'), array(), FALSE);
			if(!empty($childListData)) {
				$output .= $this->printOptions($childListData, $level+1, $selected_value);
			}
		}
		return $output;
	}
	
	public  function getBlogsCategoryDropDown($selected = array(), $selected_value = 0, $select_box_name = "", $select_box_id = "") {
		$output = "";
		$id 	= "";
		$conditions = array("c.parent_id" => '0');
		$listData = $this->getCategoriesData($conditions, null, array('c.id', 'c.category_name'), array(), FALSE);
		if(!empty($select_box_id)) {
			$id= $select_box_id;
		}
		if(!empty($listData)) {
			$output = "<select class='form-control' name='".$select_box_name."' id='".$id."'><option value='0'>None</option>";
			$output .= $this->printOptions ($listData, 0, $selected_value);
			$output .= "</select>";
		}
		return $output;
	}
	
	public function categoryRemoveDeadlock($parent_category_id = 0,$category_id =0) {
		$check = '1';
		if($parent_category_id == $category_id)
		{
			$check = '0';
		}
		else {
			$conditions = array("c.parent_id" => $parent_category_id);
			$data = $this->getCategoriesData($conditions, null, array('c.id', 'c.parent_id'), array(), FALSE);
			if(!empty($data)) {
				$check = '0';
				$data = $this->categoryRemoveDeadlockRecursive($data[0]['parent_id'], $data);
			}
		}
		return $check;
	}
	
	public function categoryRemoveDeadlockRecursive($parent_category_id, $data=array()) {
		$check = 1;
		foreach($data as $d) {
			$conditions = array("c.parent_id" => $d['id']);
			$childData = $this->getCategoriesData($conditions, null, array('c.id', 'c.parent_id'), array(), FALSE);
			if(!empty($childData)) {
				$check = 0;
				$data = $this->categoryRemoveDeadlockRecursive($data[0]['parent_id'], $childData);
			}
		}
		return $check;
	}
	
	public function update_category_data($data = array(),$conditions = array()) {
		
		if(empty($data)) {
			return false;
		}
		
		foreach($conditions as $key => $cond) {
			$this->dbObj->where ($key, $cond);
		}
		
		$id = $this->dbObj->update ('categories', $data);		
		if($id) {
			return $id;
		}
		return false;
	}
	
	public function categoryNotExist($conditions = array()) {
		if(empty($conditions)) {
			return false;
		}
		
		foreach($conditions as $key => $cond) {
			$this->dbObj->where($key, $cond);
		}
		
		return $this->dbObj->getValue("categories", "count(*)");				
	}
	
	public function category_delete($conditions = array()) {
		
		if(empty($conditions)) {
			return false;
		}
		
		foreach($conditions as $key => $cond) {
			$this->dbObj->where($key, $cond);
		}
		
		return $this->dbObj->delete("categories");				
	}
		
	public function countNoOfCategories($conditions = array()) {
		if(!empty($conditions)) {
			foreach($conditions as $key => $cond) {
			$this->dbObj->where($key, $cond);
		}
	}
		
		return $this->dbObj->getValue("categories", "count(*)");				
	}
	
	public function getPaginationCategoriesData($conditions = array(), $limit = null, $fields = array("*"), $joins = array(), $page_no = null) {
		
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
		
		$this->dbObj->join('categories ctg', 'c.parent_id = ctg.id', 'LEFT');
		
		$this->dbObj->pageLimit=$limit;
		
		if(count($fields) > 1) {
			return $this->dbObj->arraybuilder()->paginate("categories c", $page_no, $fields);			
		}
		return $this->dbObj->arraybuilder()->paginate("categories c", $page_no, array());
	}
}

// END class
