<?php require_once("includes/session.php"); ?>
<?php  confirm_logged_in(); ?>
<?php //this page is included on the edit_page and new_file.php 
 if(!isset($new_page)){
 	$new_page = false; }
?>
<p>Page name:
								<input type="text" name="menu" value="<?php echo $table2['menu']; ?>" id="menu" />
							</p>
							<p>Position:
								<select name="position">
									<?php  
									if (!$new_page){
										$page_set = get_pages_for_info($table2['information_id']);
										$page_count = mysql_num_rows($page_set);
									} else {
										$page_set = get_pages_for_info($sel_table1['id']);
										$page_count = mysql_num_rows($page_set) + 1;
									}
									for ($count=1; $count <= $page_count; $count++){
										echo "<option value=\"{$count}\"";
										if ($table2['position'] == $count){
											echo "selected"; }
											echo ">{$count}</option>";
									}
									   ?>
								</select>
							</p>
							<p>Visible:
								<input type ="radio" name="visible" value ="0" 
								<?php if($table2['visible'] == 0){
									echo "checked";
								}  ?> />No <br /> 
								<input type ="radio" name="visible" value ="1" 
								<?php if($table2['visible'] == 1){
									echo "checked";
								}  ?>
								/>Yes
							</p>
							<p>Content: <br />
								<textarea  name="content" rows"20" cols="80"><?php 
								echo $table2['content']; ?></textarea>
							</p>