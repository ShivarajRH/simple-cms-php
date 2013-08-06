<?php
function mysql_prep($value){
$magic_quotes_active = get_magic_quotes_gpc();
$new_enough_php = function_exists("mysql_real_escape_string(unescaped_string)");
if ($new_enough_php){
	if ($magic_quotes_active){
		$value = stripslashes($value);
	}
	$value = mysql_real_escape_string($value);
} else {
	if (!$magic_quotes_active){
		$value = addslashes($value);
	}

}
  return $value;
}

function redirect_to($location = NULL){
	if($location != NULL){
		header("Location: {$location}");
		exit;
	}
}


function confirm_query($result_set){
    if(!$result_set){
	echo mysql_error();
}
}
function get_all_info(){
	global $connection;
	$query = "SELECT * FROM information ORDER BY position ASC";
    $info_set = mysql_query($query);
    confirm_query($info_set);
    return $info_set;
}
function get_pages_for_info($information_id){
	global $connection;
	$query = "SELECT * FROM pages WHERE information_id ={$information_id} ORDER BY position ASC";
    $page_set = mysql_query($query);
    confirm_query($page_set);
    return $page_set;
}
function get_info_by_id($information_id){
	global $connection;
	$query = "SELECT * ";
	$query .= "FROM information "; 
	$query .= "WHERE id=" . $information_id;
	$query .= " LIMIT 1";
	$result_set = mysql_query($query, $connection);
	confirm_query($result_set);
	if ($info = mysql_fetch_array($result_set)){

	return $info;
} else {
	return NULL;
}
}

function get_pages_by_id($page_id){
	global $connection;
	$query = "SELECT * ";
	$query .= "FROM pages "; 
	$query .= "WHERE id=" . $page_id;
	$query .= " LIMIT 1";
	$result_set = mysql_query($query, $connection);
	confirm_query($result_set);
	if ($page = mysql_fetch_array($result_set)){

	return $page;
} else {
	return NULL;
}
}

function find_selected_page(){
	global $sel_table1;
	global $table2;
	if(isset($_GET['info'])){ //grab value from db
		$sel_table1 = get_info_by_id($_GET['info']);
		$sel_t2 = 0;
		$table2 = NULL;
	} elseif (isset($_GET['page'])){ //else if for our pages
		$table1 = 0;
		$sel_table1 = NULL;
		$table2 = get_pages_by_id($_GET['page']);
	}
	else {
		$table1 = 0;
		$sel_table1 = NULL;
		$table2 = 0;
	}
}

function navigation($sel_table1, $table2){
$output = "<ul class=\"info\">";

$info_set = get_all_info();

while ($info = mysql_fetch_array($info_set)){

	$output .= "<li";
	if($info['id'] == $sel_table1['id']){
	$output .= " class=\"selected\"";
	}
	$output .= "><a href=\"edit_info.php?info=" . urlencode($info['id']) . "\">{$info['menu']}</a></li>";

$page_set = get_pages_for_info($info['id']);

$output .= "<ul class=\"pages\">";
while ($page= mysql_fetch_array($page_set)){
	$output .= "<li";
	if($page['id'] == $table2['id']){
		$output .= " class=\"selected\"";
	}
	$output .= "><a href=\"content.php?page=" . urlencode($page['id']) ."\">{$page['menu']}</a></li>";
}
 $output .= "</ul>";
}

$output .= "</ul>";
return $output;
}



function public_navigation($sel_table1, $table2){
$output = "<ul class=\"info\">";

$info_set = get_all_info();

while ($info = mysql_fetch_array($info_set)){

	$output .= "<li";
	if($info['id'] == $sel_table1['id']){
	$output .= " class=\"selected\"";
	}
	$output .= "><a href=\"index.php?info=" . urlencode($info['id']) . "\">{$info['menu']}</a></li>";
if($info['id'] == $sel_table1['id']){
$page_set = get_pages_for_info($info['id']);

$output .= "<ul class=\"pages\">";
while ($page= mysql_fetch_array($page_set)){
	$output .= "<li";
	if($page['id'] == $table2['id']){
		$output .= " class=\"selected\"";
	}
	$output .= "><a href=\"index.php?page=" . urlencode($page['id']) ."\">{$page['menu']}</a></li>";
}
 $output .= "</ul>";
 }
}

$output .= "</ul>";
return $output;
}


?>