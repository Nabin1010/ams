



<?php
    require_once('constants.php');


    /*
        $conn = db_get_conn();
        $query = "query goes here";
        $result = $conn->query($query);
        $row = $res->fetch_assoc();
        echo $row['_msg'];
    */
    function db_get_conn()
    {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($conn->connect_errno) {
            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
            die();
        }

        return $conn;
    }

    /*
        set login session
        session format
        $_SESSION['session']
            $_SESSION['session']['loggedin'] = true|false;
            $_SESSION['session']['user'] = [
                'id' = id,
                'fullname' = fullname,
                'email' = email,
                'image' = image,
                'role' = role,
                'slug' = slug,
            ]
    */ 
    function setSession($detail)
    {
        $session = array(
            'loggedin' => true,
            'user' => [
                'id' => $detail['id'],
                'fullname' => $detail['fullname'],
                'email' => $detail['email'],
                'image' => $detail['image'],
                'role' => $detail['role'],
                'slug' => $detail['slug']
            ]
        );
        $_SESSION['session'] = $session;
    }

    function isAuthenticated()
    {
        if(isset($_SESSION['session']['loggedin']) && $_SESSION['session']['loggedin'] == true)
        {
            return true;
        }
        return false;
    }

    function isAuthorized($slug)
    {
        if(isset($_SESSION['session']['loggedin']) && $_SESSION['session']['user']['slug'] == $slug)
        {
            return true;
        }
        return false;
    }

    function unsetSession()
    {
        $_SESSION['session'] = '';
        header('Location: index.php');
    }

    
    
    // Session based flash message structure
    // A flash message consists of 3 different attributes
    // 1. type: message type. success, warning, info, danger

    function set_flash($type, $title, $body)
    {
        $flashtypes = array('success', 'warning', 'info', 'danger');

        if(in_array($type, $flashtypes))
        {
            $_SESSION['flash']['hasmessage'] = true;
            $_SESSION['flash']['type'] = $type;
            $_SESSION['flash']['title'] = $title;
            $_SESSION['flash']['body'] = $body;
        }
        else
        {
            echo "Message type error";
        }
    }

    function unset_flash()
    {
        if($_SESSION['flash']['hasmessage'])
        {
            $_SESSION['flash']['hasmessage'] = false;
            $_SESSION['flash']['type'] = '';
            $_SESSION['flash']['title'] = '';
            $_SESSION['flash']['body'] = '';
        }
    }

    function display_flash()
    {
        if(isset($_SESSION['flash']))
        {
            if($_SESSION['flash']['hasmessage'])
            {
                // echo $_SESSION['flash']['type']."<br>";
                // echo $_SESSION['flash']['title']."<br>";
                // echo $_SESSION['flash']['body'];
                
                $type= 'alert-'.$_SESSION['flash']['type'];
                $title= $_SESSION['flash']['title'];
                $body= $_SESSION['flash']['body'];
                echo'<h3 class="alert '.$type.'">'.$title.'</h3>';
                echo'<p class="alert '.$type.'">'.$body.'</p>';
                unset_flash();
            }
        }
    }

    // dd method similar to laravel dd method to dump and die
    function dd($param)
    {
        var_dump($param);
        die();
    }

    // Get unique filename
    function getfilename()
    {
        $filename = date('Ymd').'-'.uniqid('').uniqid('');
        // $fullfilepath = DOCUMENT_ROOT.$filename;
        return $filename;
    }