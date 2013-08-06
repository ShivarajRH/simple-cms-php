<?php require_once("includes/session.php"); require_once("includes/connect.php")  ;    ?>
<?php require_once("includes/functions.php"); ?>
<?php  confirm_logged_in(); ?>
<?php

if(intval($_GET['info']) == 0){
//redirect_to("content.php"); }
header("Location: content.php"); }
include("includes/form_functions.php");

if (isset($_POST['submit'])) {                    /*    So if it is set we'll run for validation, */
$errors = array();

// Form Validation
$required_fields = array('menu', 'position', 'visible', 'content');
$errors = array_merge($errors, check_required_fields($required_fields, $_POST));

$fields_with_lengths = array('menu' => 30);
$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));



$information_id = mysql_prep($_GET['info']);
$menu = trim(mysql_prep($_POST['menu']));
$position = mysql_prep($_POST['position']);
$visible = mysql_prep($_POST['visible']);
$content = mysql_prep($_POST['content']);

if (empty($errors)){
$query = "INSERT INTO pages (menu, position, visible, content, information_id) VALUES ('{$menu}', {$position}, {$visible}, '{$content}', {$information_id})";
	if($result = mysql_query($query, $connection)){
		$message = "The new page was created successfully";
		$new_page_id = mysql_insert_id();
		redirect_to("content.php?page={$new_page_id}");
	} else {
		$message = "This page failed to be created";
		$message .= "<br/>" . mysql_error();}
	}  else {
		if (count($errors) == 1){
			$message = "There was 1 error in the form.";
		} else {
			$message = "There were " . count($errors) . "errors in the form.";
		}
	} //end of form processing
}
?>
<?php find_selected_page() ?>
<?php include('includes/header.php'); ?>
	<div id="content">
		<table id="table">
			<tr>
				<td id="nav">
					<?php echo navigation($sel_table1, $table2); ?>
					<br />
					<a href="new_info.php">+ Add new information</a>

				</td>
				<td id="main">
						<h2>Adding a new page:</h2>

				<?php if (!empty($message)){ echo "<p class=\"message\">" . $message . "</p>";}?> 
<?php  if(!empty($errors)){ display_errors($errors); } ?>

						<form action="new_page.php?info=<?php echo $sel_table1['id']; ?>" method="post">
							<?php $new_page = true; ?>
							<?php include("page_form.php") ?>
							<input type ="submit" name ="submit" value ="Create page" />
						</form>
						<br />
						<a href="edit_info.php?page=<?php echo $sel_table1['id']; ?>">Cancel</a>
						<br />
				</td>
			</tr>
		</table>
	</div>
<?php include('includes/footer.php'); ?>
