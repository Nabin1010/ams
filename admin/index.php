<?php
require_once('./../core/constants.php');
require_once('./../core/functions.php');

if(!isAuthenticated()){
	header('Location: ' .LOGIN_PAGE);
}


require_once('inc/header.php');
require_once('inc/sidebar.php');
require_once('inc/navigation.php');

display_flash();


?>
<style type="text/css">
    .numbers{
        margin-right: 70px;
    }

</style>


 <div class="">
            
                                        <!-- Admin-->
                                        <div class="col-md-2 alert alert-success numbers">
                                           
                                            <p>Admin</p>
                                            <?php
                                                    $conn = db_get_conn();
                                                    $query = "SELECT COUNT(id) AS total_admin FROM tbluser
                                                    WHERE role_id=1";
                                                        if ($result = $conn->query($query))
                                                        {
                                                            $row=$result->fetch_assoc();
                                                            echo "{$row['total_admin']}";
                                                        }
                                            ?>
                                        </div>
                                        <!-- Admin ends-->
                                   

                    
                                        <!-- customer-->
                                        <div  class="col-md-2 alert alert-danger numbers">
                                            <p>Customer</p>
                                            
                                            <?php
                                                    $conn = db_get_conn();
                                                    $query = "SELECT COUNT(id) AS total_customer FROM tbluser
                                                    WHERE role_id=3";
                                                        if ($result = $conn->query($query))
                                                        {
                                                            $row=$result->fetch_assoc();
                                                            echo "{$row['total_customer']}";
                                                        }
                                                    ?>

                                        </div>
                                        <!-- customer eds-->
                                    



                                        <!-- product-->
                                        <div  class="col-md-2 alert alert-info numbers">
                                            <p>Product</p>
                                           <?php
                                                    $conn = db_get_conn();
                                                    $query = "SELECT COUNT(id) AS total_product FROM tblproduct";
                                                        if ($result = $conn->query($query))
                                                        {
                                                            $row=$result->fetch_assoc();
                                                            echo "{$row['total_product']}";
                                                        }
                                                ?>


                                        </div>
                                        <!-- product ends-->

                                        <div  class="col-md-2 alert alert-warning numbers">
                                            <p>Orders</p>
                                           <?php
                                                    $conn = db_get_conn();
                                                    $query = "SELECT COUNT(id) AS total_order FROM tblorder";
                                                        if ($result = $conn->query($query))
                                                        {
                                                            $row=$result->fetch_assoc();
                                                            echo "{$row['total_order']}";
                                                        }
                                                ?>


                                        </div>
                                        <!-- product ends-->
</div>
                                    
<?php
require_once('inc/footer.php');
?>


