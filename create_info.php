<?php require_once("includes/session.php"); require_once('includes/functions.php'); require_once("includes/connect.php");?>
<?php  confirm_logged_in(); ?>
<?php
//Form validation
  $errors = array();
  $required_fields = array('menu', 'position', 'visible');
  foreach($required_fields as $fieldname){
  if(!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
  	$errors[] = $fieldname;
  }
  }
$field_with_lengths = array('menu' => 50);
foreach($field_with_lengths as $fieldname => $maxlength){
	if(strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength){
		$erros[] = $fieldname;	}
}

  if (!empty($errors)){
  	header("Location: new_info.php");
  	exit;
  }

  $menu = mysql_prep($_POST['menu']) ;
  $position = mysql_prep($_POST['position']) ;
  $visible = mysql_prep($_POST['visible']) ;

  $query = "INSERT INTO information (menu,position, visible) VALUES ('{$menu}', {$position}, {$visible})";
  if (mysql_query($query, $connection)){
  	header("Location: content.php");
  	exit;
  } else {
  	echo "<p>Info create failed error</p>";
  	echo mysql_error();
  }

?>

<?php msql_close($connection); ?>