<?php require_once("includes/session.php");  ?>
<?php require_once("includes/connect.php");    ?>
<?php require_once("includes/functions.php"); ?>
<?php  confirm_logged_in(); ?>
<?php include_once("includes/form_functions.php");

if (isset($_POST['submit'])) {
$errors = array();

// Form Validation

$required_fields = array('username', 'password');
$errors = array_merge($errors, check_required_fields($required_fields, $_POST));

$fields_with_lengths = array('username' => 30, 'password' => 30);
$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths, $_POST));

$username = trim(mysql_prep($_POST['username']));
$password = trim(mysql_prep($_POST['password']));
$hashed_password = sha1($password);

if(empty($errors)){
	$query = "INSERT INTO users (username, hashed_password) VALUES ('{$username}', '{$hashed_password}')";
	$result = mysql_query($query, $connection);
	if ($result){
		$message = "The user was succesfully created";
	} else {
		$message = "The user could not be created.";
		$message = "There were" .  count($errors) . "errors in the form";
	}

} else {
	if(count($errors) == 1){
		$message = "There was 1 error in the form";
	} else {
		$message = "There were" . count($errors) . "errors in the form.";
	}
}
} else {
	$username = "";
	$password = "";
}
?>
<?php include("includes/header.php"); ?>
<div id="content">
		<table id="table">
			<tr>
				<td id="nav">
			<a href="faculty.php">Return to menu</a>
<br />	</td>
				<td id="main">
						<h2>Create a new user</h2>
						<?php if (!empty($message)) { echo "<p class=\"message\">" . $message . "</p>";} ?>
						<?php if(!empty($errors)){ display_errors($errors);} ?>
						<form action="new_fac.php" method="post">
							<table>
								<tr>
									<td>Username:</td>
									<td><input type="text" name="username" maxlenght="30" value="<?php echo htmlentities($username);?>" /></td>
								</tr>
								<tr>
									<td>Password:</td>
									<td><input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>"/></td>
								</tr>
								<tr>
									<td colspan="2"><input type="submit" name="submit" value="Create user" /></td>
								</tr>
							</table>
						</form>
				</td>
			</tr>
		</table>
	</div>
<?php include('includes/footer.php'); ?>
