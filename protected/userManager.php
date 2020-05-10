<?php 
    function IsUserLoggedIn() 
    {
        return $_SESSION != null && array_key_exists('u_id', $_SESSION) && is_numeric($_SESSION['u_id']);
    }

    function UserLogout()
    {
        session_unset();
        session_destroy();
        header('Location: index.php?P=home');
    }

    function UserLogin($email_address, $user_password)
    {
        $query = "SELECT user_id, name_first, name_last, email_address, access_level FROM user WHERE email_address = :email_address AND user_password = :user_password";
        $params = [
            ':email_address' => $email_address,
            ':user_password' => sha1($user_password)
        ]; 

        require_once DATABASE_CONTROLLER;
        $record = getRecord($query, $params);
        if(!empty($record))
        {
            $_SESSION['u_id'] = $record['user_id'];
            $_SESSION['name_first'] = $record['name_first'];
            $_SESSION['name_last'] = $record['name_last'];
            $_SESSION['email_address'] = $record['email_address'];
            $_SESSION['access_level'] = $record['access_level'];
            header('Location: index.php?P=home');
        }
        return false;
    }

    function UserRegister($email_address, $user_password, $fname, $lname)
    {
        $query = "SELECT user_id FROM user email_address = :email_address";
        $params = [':email_address' => $email_address ];

        require_once DATABASE_CONTROLLER;
        $record = getRecord($query, $params);
        if(empty($record))
        {
            $query = "INSERT INTO user (name_first, name_last, email_address, user_password) VALUES (:name_first, :name_last, :email_address, :user_password)";
            $params = [
                ':name_first' => $fname,
                ':name_last' => $lname,
                ':email_address' => $email_address,
                ':user_password' => sha1($user_password),
            ];

            if(executeDML($query, $params)) 
                header('Location: index.php?P=login');
        }
        return false;
    }
?>