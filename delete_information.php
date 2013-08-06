<?php require_once("includes/session.php"); require_once("includes/connect.php")    ;    ?>
<?php require_once("includes/functions.php"); ?>
<?php  confirm_logged_in(); ?>
<?php if(intval($_GET['info']) == 0){
      redirect_to("content.php");
       }
       $id = mysql_prep($_GET['info']);

       if($information = get_info_by_id($id)){


       $query = "DELETE FROM information WHERE id = {$id} LIMIT 1";
       $result = mysql_query($query, $connection);
       if(mysql_affected_rows() == 1 ){
       	header("Location: content.php");
       	exit;
       } else {
       	echo "Information was not deleted";
       	echo mysql_error();
       	echo "<a href=\"content.php\">Return to our Main page</a>";
       } 
}
       else {
      //information wasnt even in our database
       	header("Location: content.php");
       	exit;
} 
      ?>


<?php mysql_close($connection); ?>