<?php require_once('includes/functions.php'); require_once("includes/connect.php");?>
<?php find_selected_page(); ?>
<?php include('includes/header.php'); ?>
	<div id="content">
		<table id="table">
			<tr>
				<td id="nav">
					<?php echo public_navigation($sel_table1, $table2); ?>

				</td>
				<td id="main">
						<?php if($table2){ ?>
						<h2><?php echo $table2['menu']; ?></h2>
						<div class = "page-content">
						<?php echo $table2['content']; ?>
					</div>
					<?php } else {
						?> <h2>Welcome to my website</h2> <?php
					} ?>
						
				</td>
			</tr>
		</table>
	</div>
<?php include('includes/footer.php'); ?>
