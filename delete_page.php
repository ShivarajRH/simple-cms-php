<?php require_once("includes/session.php"); require_once("includes/connect.php")    ;    ?>
<?php require_once("includes/functions.php"); ?>
<?php  confirm_logged_in(); ?>
<?php

if(intval($_GET['page']) == 0){
header("Location: content.php"); }
 $id = mysql_prep($_GET['page']);
 if($page = get_pages_by_id($id)){
 	$query = "DELETE FROM pages WHERE id = {$page['id']} LIMIT 1";
 	$result = mysql_query($query);
 	if(mysql_affected_rows() == 1){
 		redirect_to("edit_info.php?info={$page['information_id']}");
 	} else {
 		echo "<p>Page was not deleted </p>";
 		echo "<p>" . mysql_error() . "</p>";
 		echo "<a href=\"content.php\">Return to main site</a>";
 		}
 	} else {
 		//doesnt exist
 		redirect_to('content.php');
 	}
 


?>

<?php mysql_close($db); ?>
