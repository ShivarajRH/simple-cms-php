<?php require_once("includes/session.php"); require_once('includes/functions.php'); require_once("includes/connect.php");?>
<?php  confirm_logged_in(); ?>
<?php find_selected_page() ?>
<?php include('includes/header.php'); ?>
	<div id="content">
		<table id="table">
			<tr>
				<td id="nav">
					<?php echo navigation($sel_table1, $table2); ?>


				</td>
				<td id="main">
						<h2>Add new info</h2>
						<form action="create_info.php" method="post">
							<p>Info Title:
								<input type="text" name="menu" value="" id="menu" />
							</p>
							<p>Position:
								<select name="position">
									<?php  $info_set = get_all_info();
									       $info_count = mysql_num_rows($info_set);
									       for($count=1; $count <=$info_count+1; $count++){
									       	echo "<option value=\"{$count}\">{$count}</option>";
									       }	
									   ?>
								</select>
							</p>
							<p>Visible:
								<input type ="radio" name="visible" value ="0" />No <br /> 
								<input type ="radio" name="visible" value ="1" />Yes
							</p>
							<input type ="submit"  value ="Add info" />
						</form>
						<br />
						<a href="content.php">Cancel</a>
						
				</td>
			</tr>
		</table>
	</div>
<?php include('includes/footer.php'); ?>
