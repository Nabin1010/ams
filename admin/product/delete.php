<?php
require_once('./../../core/constants.php');
require_once('./../../core/functions.php');

if(!isAuthenticated()){
	header('Location: ' .LOGIN_PAGE);
}

display_flash();
if(isset($_GET['id']))
{
if(is_numeric($_GET['id']))
{

$conn = db_get_conn();
// sql to delete a record
$query = "DELETE FROM tblproduct WHERE id={$_GET['id']}";
if ($conn->query($query) === TRUE)
{
$conn->close();
set_flash('success', 'Success', 'product deleted!!');
header('Location: index.php');
}
else
{
$conn->close();
set_flash('danger', 'Error', 'Error deleting record:'.$conn->error);
header('Location: index.php');
}
}
}
?>