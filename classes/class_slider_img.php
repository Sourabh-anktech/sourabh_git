<?php
class SliderImg
{
	protected $dbObj = NULL;

    public function __construct()
    {
		$this->dbObj = new MysqliDb(SERVER_NAME, USER_NAME, PASSWORD, DB_NAME);
    }
    
    public function add_new_sliderimg($data = array()){
		
		if (empty($data)) {
			return false;
		}
		
		$slider_img_id = $this->dbObj->insert ('slider_img', $data);
		if($slider_img_id) {
			return $slider_img_id;
		}
		else {
			return false;
		}
	
	}
		public function getSliderImgData($conditions = array(), $limit = null) {
		
		if(!empty($conditions)) {
			foreach($conditions as $key => $cond) {
				$this->dbObj->where($key, $cond);
			}
		}
		
		return $this->dbObj->get("slider_img i", $limit);				
	}
	
	public function update_slider_img_data($data = array(),$conditions = array()) {
		
		if(empty($data)) {
			return false;
		}
		
		foreach($conditions as $key => $cond) {
			$this->dbObj->where ($key, $cond);
		}
		
		$slider_img_id = $this->dbObj->update ('slider_img', $data);		
		if($slider_img_id) {
			return $slider_img_id;
		}
		return false;
	}
	
	public function sliderImgNotExist($conditions = array()) {
		if(empty($conditions)) {
			return false;
		}
		
		foreach($conditions as $key => $cond) {
			$this->dbObj->where($key, $cond);
		}
		
		return $this->dbObj->getValue("slider_img", "count(*)");				
	}
	
	public function sliderimg_delete($conditions = array()) {
		
		if(empty($conditions)) {
			return false;
		}
		
		foreach($conditions as $key => $cond) {
			$this->dbObj->where($key, $cond);
		}
		
		return $this->dbObj->delete("slider_img");				
	}
		
	public function countNoOfSliders($conditions = array()) {
		if(!empty($conditions)) {
			foreach($conditions as $key => $cond) {
			$this->dbObj->where($key, $cond);
		}
	}
		
		return $this->dbObj->getValue("slider_img", "count(*)");				
	}
	
	public function getPaginationSLidersData($conditions = array(), $limit = null, $fields = array("*"), $page_no = null) {
		
		if(!empty($conditions)) {
			foreach($conditions as $key => $cond) {
				$this->dbObj->where($key, $cond);
			}
		}
		
		$this->dbObj->pageLimit=$limit;
		
		if(count($fields) > 1) {
			return $this->dbObj->arraybuilder()->paginate("slider_img", $page_no, $fields);
		}
		return $this->dbObj->arraybuilder()->paginate("slider_img", $page_no, array());
	}
}

// END class
