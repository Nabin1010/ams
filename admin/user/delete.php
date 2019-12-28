<?php
    require_once('./../../core/constants.php');
    require_once('./../../core/functions.php');
    
    if(!isAuthenticated()){
    	header('Location: ' .LOGIN_PAGE);
    }
    
    
    if(isset($_GET['id']))
    {
    if(is_numeric($_GET['id']))
    {
    if($_GET['id'] == $_SESSION['session']['user']['id'])
    {
    set_flash('danger', 'Error', 'Unable to delete yourself!!');
    header('Location: index.php');
    }
    else
    {
    $conn = db_get_conn();
    // sql to delete a record
    $query = "DELETE FROM tbluser WHERE id={$_GET['id']}";
    //dd($query);
    if ($conn->query($query) === TRUE)
    {
    $conn->close();
    set_flash('success', 'Success', 'User deleted!!');
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
    }
    ?>