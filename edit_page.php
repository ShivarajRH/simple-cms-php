<?php require_once("includes/session.php"); require_once("includes/connect.php")    ;    ?>
<?php require_once("includes/functions.php"); ?>
<?php  confirm_logged_in(); ?>
<?php

if(intval($_GET['page']) == 0){
//redirect_to("content.php"); }
header("Location: content.php"); }
include("includes/form_functions.php");

if (isset($_POST['submit'])) {                   
$errors = array();

// Form Validation
$required_fields = array('menu', 'position', 'visible', 'content');
$errors = array_merge($errors, check_required_fields($required_fields));

$fields_with_lengths = array('menu' => 30);
$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths));



$id = mysql_prep($_GET['page']);
$menu = trim(mysql_prep($_POST['menu']));
$position = mysql_prep($_POST['position']);
$visible = mysql_prep($_POST['visible']);
$content = mysql_prep($_POST['content']);

if (empty($errors)){
$query = "UPDATE pages SET
menu = '{$menu}',
position = {$position},
visible = {$visible},
content = '{$content}'

WHERE id = {$id}";

$result = mysql_query($query);
if (mysql_affected_rows() == 1)    {
$message = "The information was correctly updated.";
}    else {
// failed
$message = "The information was an Epic Fail";
$message .= "<br />" . mysql_error();
}
} else {
// Errors are happening
$message = "There were " . count($errors) . " error(s) in the form. Please check again and fill all the fields.!";
}
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
						<h2>Edit page: <?php echo $table2['menu']; ?></h2>

				<?php if (!empty($message)){ echo "<p class=\"message\">" . $message . "</p>";}?> 
<?php  if(!empty($errors)){ display_errors($errors); } ?>

						<form action="edit_page.php?page=<?php echo $table2['id']; ?>" method="post">
							<?php include("page_form.php") ?>
							<input type ="submit" name ="submit" value ="Update page" />
							<br /><br />
							<a href="delete_page.php?page=<?php 
							echo $table2['id'];
							?>" onclick="return confirm('Do you really want to delete this page?');">Delete page</a>
						</form>
						<br />
						<a href="content.php?page=<?php echo $table2['id']; ?>">Cancel</a>
						
				</td>
			</tr>
		</table>
	</div>
<?php include('includes/footer.php'); ?>
