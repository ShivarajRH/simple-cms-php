<?php require_once("includes/session.php"); require_once("includes/connect.php")    ;    ?>
<?php require_once("includes/functions.php"); ?>
<?php  confirm_logged_in(); ?>
<?php

if(intval($_GET['info']) == 0){
//redirect_to("content.php"); }
header("Location: content.php"); }

if (isset($_POST['submit'])) {                    /*    So if it is set we'll run for validation, */
$errors = array();

// Form Validation
$required_fields = array('menu', 'position', 'visible');
foreach($required_fields as $fieldname) {
if (!isset($_POST[$fieldname]) || (empty($_POST[$fieldname]) && !is_numeric($_POST[$fieldname]))) {
$errors[] = $fieldname;
}
}

$fields_with_lengths = array('menu' => 30);
foreach($fields_with_lengths as $fieldname => $maxlength ){
if(strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength){
$errors[] = $fieldname; }
}                                        // start here

if (empty($errors)){

$id = mysql_prep($_GET['info']);
$menu = mysql_prep($_POST['menu']);
$position = mysql_prep($_POST['position']);
$visible = mysql_prep($_POST['visible']);

$query = "UPDATE information SET
menu = '{$menu}',
position = {$position},
visible = {$visible}

WHERE id = {$id}";

$result = mysql_query($query, $connection);
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


				</td>
				<td id="main">
						<h2>Edit things <?php echo $sel_table1['menu']; ?></h2>

				<?php
if (!empty($message)){
echo "<p class=\"message\">" . $message . "</p>";
}
?> 
<?php  
	if (!empty($errors)){
		echo "<p class=\"errors\">";
		echo "Please correct the following fields:<br />";
		foreach($errors as $error){
			echo " * " . $error . "<br />";
		} echo "</p>";
	}
  ?>

						<form action="edit_info.php?info=<?php echo urlencode($sel_table1['id']); ?>" method="post">
							<p>Info Title:
								<input type="text" name="menu" value="<?php echo $sel_table1['menu']; ?>" id="menu" />
							</p>
							<p>Position:
								<select name="position">
									<?php  $info_set = get_all_info();
									       $info_count = mysql_num_rows($info_set);
									       for($count=1; $count <=$info_count+1; $count++){
									       	echo "<option value=\"{$count}\"";
									       	if($sel_table1['position'] == $count){
									       		echo "selected";
									       	}

									       	echo " >{$count}</option>";
									       }	
									   ?>
								</select>
							</p>
							<p>Visible:
								<input type ="radio" name="visible" value ="0" 
								<?php if($sel_table1['visible'] == 0){
									echo "checked";
								}  ?> />No <br /> 
								<input type ="radio" name="visible" value ="1" 
								<?php if($sel_table1['visible'] == 1){
									echo "checked";
								}  ?>
								/>Yes
							</p>
							<input type ="submit" name ="submit" value ="Edit information" />
							<br /><br />
							<a href="delete_information.php?info=<?php 
							echo urlencode($sel_table1['id']);
							?>" onclick="return confirm('Do you really want to delete this?');">Delete information</a>
						</form>
						<br />
						<a href="content.php">Cancel</a>
						<div class="square" style="margin-top: 2em; border-top: 1px solid black;">
							<h3>Pages in this information:</h3>
							<ul>
								<?php 
								$info_pages = get_pages_for_info($sel_table1['id']);
								while($page = mysql_fetch_array($info_pages)){
									echo "<li><a href=\"content.php?page={$page['id']}\">
									{$page['menu']}</a></li>";
								}
								 ?>
							</ul>	
							<br />
							<a href="new_page.php?info=<?php echo $sel_table1['id'];?>">Add a new page to this information</a>
						</div>
						
				</td>
			</tr>
		</table>
	</div>
<?php include('includes/footer.php'); ?>
