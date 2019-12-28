f<?php
/*
    Form submission actions
*/
    require_once('constants.php');
    require_once('functions.php');
    

    /**
     * ======================================================================================================
     * Create new user action
    */
    if(isset($_POST['form']) && $_POST['form'] == 'formusercreate')
    {
        // Fetch form data
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber'];
        $password = $_POST['password'];
        $passwordconfirm = $_POST['passwordconfirm'];
        $role_id = $_POST['role_id'];
        $image = 'dummy.jpg';
        $conn = db_get_conn();
        if($password == $passwordconfirm)
        {
            $password = md5($password);
            $query = "INSERT INTO tbluser (fullname, role_id, phone, email, password, image)
            VALUES ('$fullname', '$role_id', '$phonenumber', '$email', '$password', '$image')";
            if ($conn->query($query) === TRUE)
            {
                set_flash('success', 'Success', 'New user created successfully.');
            }
            else
            {
                set_flash('danger', 'Error', $conn->error);
            }
        }
        else
        {
            set_flash('danger', 'Error', 'Password not match.');
        }
        
        $conn->close();
        
        // Redirect back to previous page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

 
 
      /**
    * ======================================================================================================
    * Add New Product Action
    */
    if(isset($_POST['form']) && $_POST['form'] == 'formproductcreate')
    {
        // Fetch form data
        $name = $_POST['name'];
        $description = $_POST['description'];
        $available_qty = $_POST['available_qty'];
        $cat_id = $_POST['category_id'];

        //image upload
        $errors= array();
        $file_tmp =$_FILES['image']['tmp_name'];
        $file_type=$_FILES['image']['type'];

        $file_ext = explode('.',$_FILES['image']['name']);
        $file_ext = end($file_ext);
        $file_ext = strtolower($file_ext);


        $extarr= array("jpeg","jpg","png");

        if(in_array($file_ext,$extarr)=== false)
        {
            $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }
        
        if($_FILES['image']['size'] > 2097152)
        {
            $errors[]='File size must be less than 2 MB';
        }


        if(empty($errors)==true)
        {
            $filename = date('Ymd').'-'.uniqid('').uniqid('').'.'.$file_ext;
            move_uploaded_file($file_tmp,DOCUMENT_ROOT.'assets/img/product/'.$filename);
            $conn = db_get_conn();
             $query = "INSERT INTO tblproduct (name, description, available_qty,cat_id,product_image)
            VALUES ('$name', '$description', '$available_qty',$cat_id, '$filename' )";
           if ($conn->query($query) === TRUE)
            {
                set_flash('success', 'Success', 'New product added successfully.');
            }
            else
            {
                set_flash('danger', 'Error', $conn->error);
            }
        }
         else
        {
            set_flash('danger', 'Error', implode(". ",$errors));
        }
        
        // Redirect back to previous page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
        /**
     * ======================================================================================================
     * Edit user action
    */
    if(isset($_POST['form']) && $_POST['form'] == 'formuseredit')
    {
        // Fetch form data
        $user_id = $_POST['user_id'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $role_id = $_POST['role_id'];

        $conn = db_get_conn();
        $query = "
            UPDATE tbluser
            SET fullname = '{$fullname}', email = '{$email}', role_id = {$role_id}
            WHERE id = {$user_id};
        ";
        if ($conn->query($query) === TRUE)
        {
            set_flash('success', 'Success', 'User edit successfully.');
        }
        else
        {
            set_flash('danger', 'Error', $conn->error);
        }
        // Redirect back to previous page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }


    /**
     * ======================================================================================================
     * Change user password by admin
    */
    if(isset($_POST['form']) && $_POST['form'] == 'formusereditpassword')
    {
        $user_id = $_POST['user_id'];
        $newpassword = $_POST['newpassword'];
        $renewpassword = $_POST['renewpassword'];
        $conn = db_get_conn();
        $query = "
            SELECT * FROM tbluser WHERE id = {$user_id}
        ";
        if ($result = $conn->query($query))
        {
            if($result->num_rows == 1)
            {
                if($newpassword == $renewpassword)
                {
                    $newpassword = md5($newpassword);
                    // password change query (pcq)
                    $pcq = "
                    UPDATE tbluser
                    SET password = '{$newpassword}'
                    WHERE id = {$user_id};
                 ";
                    if($conn->query($pcq) === TRUE)
                    {
                        set_flash('success', 'Success', 'User password changed successfully.');
                    }
                    else
                    {
                        set_flash('danger', 'Error', $conn->error);
                    }
                }
                else
                {
                    set_flash('danger', 'Error', 'Password not match.');
                }
                
                // Redirect back to previous page
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
    }


    /**
     * ======================================================================================================
     * Login action
    */
   if(isset($_POST['form']) && $_POST['form'] == 'formlogin')
    {
               // fetch data
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        //dd($password);
        $conn = db_get_conn();
        
        $query = "
            SELECT
                tbluser.id, tbluser.fullname, tbluser.email, tbluser.password, tbluser.image, tblrole.name, tblrole.slug
                FROM tbluser JOIN tblrole
                ON tbluser.role_id = tblrole.id
                WHERE tbluser.email='".$email."'";
            //dd($query);
        $result = $conn->query($query);
        $conn->close();
        if($result->num_rows == 1)
        {
            $row = $result->fetch_assoc();
            if($row['password'] == $password)
            {
                setSession($row);
                // Redirect back to previous page
                if(isAuthorized('admin'))
                 {
                     header('Location: ' . ADMIN_URL);
                 }
                 elseif(isAuthorized('customer'))
                 {
                header('Location: ' . ROOT_FOLDER);
                }
            }
            else
            {
                set_flash('danger', 'Error', 'Incorrect username or password!');
                // Redirect back to previous page
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
           
        }
        else{
           set_flash('danger', 'Error', 'please register first');
            header('Location: '. $_SERVER['HTTP_REFERER']);
        }
    }


    /**
    * ======================================================================================================
    * Change user image
    */
    if(isset($_POST['form']) && $_POST['form'] == 'formimageupload')
    {
        $errors= array();
        $user_id = $_SESSION['session']['user']['id'];
        $file_tmp =$_FILES['image']['tmp_name'];
        $file_type=$_FILES['image']['type'];

        $file_ext = explode('.',$_FILES['image']['name']);
        $file_ext = end($file_ext);
        $file_ext = strtolower($file_ext);

        $extarr= array("jpeg","jpg","png");

        if(in_array($file_ext,$extarr)=== false)
        {
            $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }
        
        if($_FILES['image']['size'] > 2097152)
        {
            $errors[]='File size must be less than 2 MB';
        }


        if(empty($errors)==true)
        {
            $filename = date('Ymd').'-'.uniqid('').uniqid('').'.'.$file_ext;
            move_uploaded_file($file_tmp,DOCUMENT_ROOT.'assets/img/user/'.$filename);
            $conn = db_get_conn();
            $query = "
                UPDATE tbluser
                SET image = '{$filename}'
                WHERE id = {$user_id};
            ";
            if($conn->query($query) === TRUE)
            {
                set_flash('success', 'Success', 'User Profile picture changed successfully.');
                $_SESSION['session']['user']['image'] = $filename;
            }
            else
            {
                set_flash('danger', 'Error', $conn->error);
            }
        }
        else
        {
            set_flash('danger', 'Error', implode(". ",$errors));
        }
        
        // Redirect back to previous page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }


    /**
    * ======================================================================================================
    * User password change
    */
    if(isset($_POST['form']) && $_POST['form'] == 'formchangepassword')
    {
        $oldpassword = md5($_POST['oldpassword']);
        $newpassword = md5($_POST['newpassword']);
        $renewpassword = md5($_POST['renewpassword']);
        $user_id = $_SESSION['session']['user']['id'];

        $conn = db_get_conn();
        $query = "
            SELECT id, password FROM tbluser
            WHERE id='{$user_id}'
                ";

        if ($result = $conn->query($query))
        {
            if($result->num_rows == 1)
            {
                $row = $result->fetch_assoc();
                if($row['password'] == $oldpassword)
                {
                    // change user password query (cupq)
                    $cupq = "
                        UPDATE tbluser
                        SET password = '{$newpassword}'
                        WHERE id = {$user_id}
                    ";
                    if($conn->query($cupq) === TRUE)
                    {
                        set_flash('success', 'Success', 'User password changed successfully.');
                    }
                    else
                    {
                        set_flash('danger', 'Error', $conn->error);
                    }
                    set_flash('success', 'Success', 'Password changed successfully');
                    // Redirect back to previous page
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
                else
                {
                    set_flash('danger', 'Error', 'Password wrong.');
                    // Redirect back to previous page
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
            }
            else
            {
                set_flash('danger', 'Error', 'Password wrong.');
                // Redirect back to previous page
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
        
       } 
    

/*Registration form action */
 if(isset($_POST['form']) && $_POST['form'] == 'formregistration')
    {
        // Fetch form data
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phonenumber = $_POST['phonenumber'];
        $password = $_POST['password'];
        $passwordconfirm = $_POST['password_confirm'];
        $role_id = '3';
        $image = 'dummy.jpg';
        $conn = db_get_conn();
        if($password == $passwordconfirm)
        {
            $password = md5($password);
            $query = "INSERT INTO tbluser (fullname, role_id, phone, email, password, image)
            VALUES ('$fullname', '$role_id', '$phonenumber', '$email', '$password', '$image')";
            if ($conn->query($query) === TRUE)
            {   
              
               set_flash('success', 'Success', 'New user created successfully.');
            }
            else
            {
                set_flash('danger', 'Error', $conn->error);
            }
        }
        else
        {
            set_flash('danger', 'Error', 'Password not match.');
        }
        
        $conn->close();
        
        // Redirect back to previous page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

/***signout form***/
if(isset($_POST['signoutform']) && $_POST['form'] == 'signoutform')
    {
               // fetch data
        //$email = $_POST['email'];
        //$password = md5($_POST['password']);
        //dd($password);
        $conn = db_get_conn();
        
        $query = "
            SELECT
                tbluser.id, tbluser.fullname, tbluser.email, tbluser.password, tbluser.image, tblrole.name, tblrole.slug
                FROM tbluser JOIN tblrole
                ON tbluser.id = tblrole.id
                WHERE tbluser.email='".$email."'";
        $result = $conn->query($query);
        $conn->close();
        if($result->num_rows == 1)
        {
            $row = $result->fetch_assoc();
            if($row['password'] == $password)
            {
                setSession($row);
                // Redirect back to previous page
                header('Location: ' . ADMIN_URL);
            }
           
           
        }
    }
   /**
     * ======================================================================================================
     * Edit Product action
    */
    if(isset($_POST['form']) && $_POST['form'] == 'formproductedit')
    {
        // Fetch form data
        $product_id = $_POST['product_id'];
        $name = $_POST['name'];
        $category_id = $_POST['category_id'];
        $available_qty = $_POST['available_qty'];
        $description = $_POST['description'];


        $conn = db_get_conn();
        $query = "
            UPDATE tblproduct
            SET name = '{$name}', cat_id = {$category_id}, available_qty = {$available_qty}, description='{$description}'
            WHERE id = {$product_id};
        ";
        if ($conn->query($query) === TRUE)
        {
            set_flash('success', 'Success', 'Product edit successfully.');
        }
        else
        {
            set_flash('danger', 'Error', $conn->error);
        }
        // Redirect back to previous page
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

  /**
    * ======================================================================================================
    * Create New Product Action
    */
    if(isset($_POST['form']) && $_POST['form'] == 'addcategoryform')
    {
        // Fetch form data
        $cat_name = $_POST['cat_name'];
        $cat_slug = $_POST['cat_slug'];
        $conn = db_get_conn();

            $query = "INSERT INTO tblcategory (name, slug)
            VALUES ('$cat_name', '$cat_slug' )";

            if ($conn->query($query) === TRUE)
            {
                set_flash('success', 'Success', 'New category added successfully.');
            }
            else
            {
                set_flash('danger', 'Error', $conn->error);
            }
        $conn->close();
        
        // Redirect back to previous page
       header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
 /* ======================================================================================================
     *product order form
    */
 if(isset($_POST['form']) && $_POST['form'] == 'orderdetailform')
    {
        $user_id = $_SESSION['session']['user']['id'];
         $conn = db_get_conn();
         $query = "INSERT INTO tblorder (customer_id)
            VALUES ($user_id)";
             
            //dd($query);
             if ($conn->query($query) === TRUE)
             {
                $order_id = $conn->insert_id;
                $product_id = $_POST['product_id'];
                $qty_ordred=$_POST['qty_ordred'];
                $sql="INSERT INTO tblorderitem(order_id,product_id,quantity_order)
                VALUES('$order_id','$product_id','$qty_ordred')";
                 
                 //dd($sql);
                 if ($conn->query($sql) === TRUE)
                 {
                   set_flash('success', 'Success', ' You have successfully made an order.');
                   header('Location: ' . $_SERVER['HTTP_REFERER']);
                 }
                 
                 else{
                     set_flash('danger', 'Error', ' Your order cannot be placed at the moment');
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                 }
                }
                else{
                    set_flash('danger', 'Error', ' Something Went Wrong.');
                   header('Location: ' . $_SERVER['HTTP_REFERER']);
             }
        }

    