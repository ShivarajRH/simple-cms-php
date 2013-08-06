<?php require_once("includes/session.php");  ?>
<?php require_once("includes/connect.php");    ?>
<?php require_once("includes/functions.php"); ?>
<?php 
if (logged_in()){
	redirect_to("faculty.php");
}
include_once("includes/form_functions.php");

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
	$query = "SELECT * FROM users WHERE username = '{$username}' AND hashed_password = '{$hashed_password }' LIMIT 1";
	$result_set = mysql_query($query);
	confirm_query($result_set);
	if(mysql_num_rows($result_set) == 1 ){
		$found_user = mysql_fetch_array($result_set);
		$_SESSION['user_id'] = $found_user['id'];
		$_SESSION['username'] = $found_user['username'];
		redirect_to("faculty.php");
	} else {
		$message = "Username / password is incorrect. <br /> Please make sure your caps lock key is off!";
	}


} else {
	if(count($errors) == 1){
		$message = "There was 1 error in the form";
	} else {
		$message = "There were" . count($errors) . "errors in the form.";
	}
}
} else {
	if(isset($_GET['logout']) && $_GET['logout'] == 1){
		$message = "You are now logged out.";
	}
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
						<h2>Login page</h2>
						<?php if (!empty($message)) { echo "<p class=\"message\">" . $message . "</p>";} ?>
						<?php if(!empty($errors)){ display_errors($errors);} ?>
						<form action="login.php" method="post">
							<table>
								<tr>
									<td>Username:</td>
									<td><input type="text" name="username" maxlenght="50" value="<?php echo htmlentities($username);?>" /></td>
								</tr>
								<tr>
									<td>Password:</td>
									<td><input type="password" name="password" maxlength="50" value="<?php echo htmlentities($password); ?>"/></td>
								</tr>
								<tr>
									<td colspan="2"><input type="submit" name="submit" value="Login" /></td>
								</tr>
							</table>
						</form>
				</td>
			</tr>
		</table>
	</div>
<?php include('includes/footer.php'); ?>
