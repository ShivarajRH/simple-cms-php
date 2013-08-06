<?php require_once("includes/session.php");  ?>
<?php include('includes/functions.php'); ?>
<?php  confirm_logged_in(); ?>
<?php include('includes/header.php'); ?>
	<div id="content">
		<table id="table">
			<tr>
				<td id="nav">
<br />
				</td>
				<td id="page">
					<h3>estas dentro del admin</h3>
					<p>welcom to the staff area</p>
					<ul>
						<li><a href="content.php">Manage site</a></li>
						<li><a href="new_fac.php">add new faculty user</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</td>
			</tr>
		</table>
	</div>
<?php include('includes/footer.php'); ?>