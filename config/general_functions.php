<?php
/*
 * General Functions 
 * */
function pr($pr_data = array()){
	echo '<pre>';
	print_r($pr_data);
	echo '</pre>';
}

function checkUserLogin($redirect = true){
	if(!isset($_SESSION['user'])) {
		if($redirect)
			@header("location:login.php");
		else
			return false;
	}
	elseif(!isset($_SESSION['user']['isLoggedIn'])) {
		if($redirect)
			@header("location:login.php");
		else
			return false;
	}
	return true;
}

function checkAdminUserLogin($redirect = true){
	if(!isset($_SESSION['admin'])) {
		if($redirect)
			@header("location:login.php");
		else
			return false;
	}
	elseif(!isset($_SESSION['admin']['isLoggedIn'])) {
		if($redirect)
			@header("location:login.php");
		else
			return false;
	}
	return true;
}

function redirectURL($redirect_uri = null) {
	if($redirect_uri) {
		@header("Location: ". $redirect_uri);
		// Add fallback JS redirect if header doesn't work
		echo '<script type="text/javascript">window.location.href = "'.$redirect_uri.'";</script>';
	}
	exit(0); // exit if redirect fails
}

function limited_data($data, $length)
{
  if(strlen($data)<=$length)
  {
    return $data;
  }
  else
  {
    $data=substr($data,0,$length) . ' ....';
    return $data;
  }
}

function getPaginationLinksFront($cur_page_no, $limit, $total_record, $start, $end, $cur_page_url) {
	$total_page = ceil($total_record / $limit);
	
	if($total_page<$cur_page_no) {
		return "<h1>No Records Found</h1>";
	}
	
	if($start == '0' && $end >= $total_record -1)
	{
		return false;
	}
	
	$cur_page_no_nxt = $cur_page_no+1;
	$cur_page_no_prv = $cur_page_no-1;
	$flag_prv		 = false;
	$flag_nxt		 = false;
	$output			 = '';
	
	if($start == '0' && $end < $total_record - 1)
	{
		$flag_nxt = true;
	}
	else if($start != '0' && $end >= $total_record -1) {
		$flag_prv = true;
	}
	else {
		$flag_nxt = true;
		$flag_prv = true;
	}
	
	if($flag_prv == true)
	{
		$output .= "<a href = '".$cur_page_url."?page=".$cur_page_no_prv."'>Previous</a>";
	}
	if($flag_nxt == true)
	{
		$output .= $nxt = "<a href = '".$cur_page_url."?page=".$cur_page_no_nxt."'>Next</a>";
	}
	return $output;
}
	
//~ function getPaginationLinksAdmin($cur_page_no, $limit, $total_record, $start, $end, $cur_page_url) {
	//~ $total_page = ceil($total_record / $limit);
	//~ 
	//~ if($total_page<$cur_page_no) {
		//~ return "<h1>No Records Found</h1>";
	//~ }
	//~ $output 		 = '';
	//~ $cur_page_no_prv = $cur_page_no-1;
	//~ $cur_page_no_nxt = $cur_page_no+1;
	//~ $nxt	 		 = '';
	//~ $prv			 = '';
	//~ $nxt_dis	 	 = '';
	//~ $prv_dis		 = '';
	//~ 
	//~ for($i = 0; $i<$total_page; $i++)
	//~ {
		//~ $page_nos=$i+1;
		//~ $num = "<a href = '".$cur_page_url."?page=".$page_nos."' class='btn btn-sm btn-primary' role='group'>".$page_nos."</a>";
		//~ $output.=$num;
	//~ }
	//~ 
	//~ $nxt = "<a href = '".$cur_page_url."?page=".$cur_page_no_nxt."' class='btn btn-sm btn-primary'>Next</a>";
	//~ $prv = "<a href = '".$cur_page_url."?page=".$cur_page_no_prv."' class='btn btn-sm btn-primary'>Previous</a>";
	//~ $nxt_dis = "<a href = '#' class='btn btn-sm btn-primary disabled'>Next</a>";
	//~ $prv_dis = "<a href = '#' class='btn btn-sm btn-primary disabled'>Previous</a>";
	//~ 
	//~ if($start == '0' && $end >= $total_record -1)
	//~ {
		//~ return false;
	//~ }
	//~ else if($start == '0' && $end < $total_record - 1)
	//~ {
		//~ $output = $prv_dis.$output.$nxt;
	//~ }
	//~ else if($start != '0' && $end >= $total_record -1) {
		//~ $output = $prv.$output.$nxt_dis;
	//~ }
	//~ else {
		//~ $output = $prv.$output.$nxt;
	//~ }
	//~ return $output;
//~ }

//~ function getPaginationLinksAdmin($cur_page_no, $limit, $total_record, $start, $end, $cur_page_url) {
	//~ $total_page = ceil($total_record / $limit);
	//~ 
	//~ if($total_page<$cur_page_no) {
		//~ return "<h1>No Records Found</h1>";
	//~ }
	//~ 
	//~ if($start == '0' && $end >= $total_record -1)
	//~ {
		//~ return false;
	//~ }
	//~ 
	//~ $cur_page_no_prv = $cur_page_no-1;
	//~ $cur_page_no_nxt = $cur_page_no+1;
	//~ $flag_prv		 = false;
	//~ $flag_nxt		 = false;
	//~ $output 		 = '';
	//~ 
	//~ 
	//~ if($start == '0' && $end < $total_record - 1)
	//~ {
		//~ $flag_nxt = true; 
	//~ }
	//~ else if($start != '0' && $end >= $total_record -1) {
		//~ $flag_prv = true;
	//~ }
	//~ else {
		//~ $flag_nxt = true;
		//~ $flag_prv = true;
	//~ }
//~ 
	//~ if($flag_prv == true)
	//~ {
		//~ $output.= "<a href = '".$cur_page_url."?page=".$cur_page_no_prv."' class='btn btn-sm btn-primary'>Previous</a>";
	//~ }
	//~ for($i = 0; $i<$total_page; $i++)
	//~ {
		//~ $page_nos= $i+1;
		//~ $active  = '';
		//~ if($cur_page_no == $page_nos) {
			//~ $active = ' active';
		//~ }
		//~ $num = "<a href = '".$cur_page_url."?page=".$page_nos."' class='btn btn-sm btn-primary".$active."' role='group'>".$page_nos."</a>";
		//~ $output.= $num;
	//~ }
	//~ if($flag_nxt == true)
	//~ {
		//~ $output.= "<a href = '".$cur_page_url."?page=".$cur_page_no_nxt."' class='btn btn-sm btn-primary'>Next</a>";
	//~ }
	//~ return $output;
//~ }

function getPaginationLinksAdmin($cur_page_no, $limit, $total_record, $start, $end, $cur_page_url) {
	$total_page = ceil($total_record / $limit);
	
	if($total_page<$cur_page_no) {
		return "<h1>No Records Found</h1>";
	}
	
	if($start == '0' && $end >= $total_record -1)
	{
		return false;
	}
	
	$cur_page_no_prv = $cur_page_no-1;
	$cur_page_no_nxt = $cur_page_no+1;
	$flag_prv		 = false;
	$flag_nxt		 = false;
	$output 		 = "<div class='btn-toolbar' role='toolbar'>";
	
	
	if($start == '0' && $end < $total_record - 1)
	{
		$flag_nxt = true; 
	}
	else if($start != '0' && $end >= $total_record -1) {
		$flag_prv = true;
	}
	else {
		$flag_nxt = true;
		$flag_prv = true;
	}

	if($flag_prv == true)
	{
		$output.= "<div class='btn-group' role='group'><a href = '".$cur_page_url."?page=".$cur_page_no_prv."'>Previous</a></div>";
	}
	for($i = 0; $i<$total_page; $i++)
	{
		$page_nos = $i+1;
		$active   = '';
		if($cur_page_no == $page_nos) {
			$active = ' active';
		}
		$num = "<div class='btn-group".$active."' role='group'><a href = '".$cur_page_url."?page=".$page_nos."' >".$page_nos."</a></div>";
		$output.= $num;
	}
	if($flag_nxt == true)
	{
		$output.= "<div class='btn-group' role='group'><a href = '".$cur_page_url."?page=".$cur_page_no_nxt."'>Next</a></div>";
	}
	$output.= "</div>";
	return $output;
}
?>
