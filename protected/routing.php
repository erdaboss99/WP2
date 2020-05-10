<?php
    if(!array_key_exists('P', $_GET) || empty($_GET['P']))
	    $_GET['P'] = 'home';

    
    switch ($_GET['P']) 
    {
        case 'home': 
            require_once PROTECTED_DIR.'normal/home.php'; 
            break;
        

        case 'login':
            !IsUserLoggedIn() ? require_once PROTECTED_DIR.'user/login.php' : header('Location: index.php?P=home');
            break;
            
        case 'registration':
            !IsUserLoggedIn() ? require_once PROTECTED_DIR.'user/registration.php' : header('Location: index.php?P=home');
            break;
            
        case 'permission':  
            IsUserLoggedIn() ? require_once PROTECTED_DIR.'normal/permission_level.php' : header('Location: index.php?P=home');
            break;
            
        case 'addf':  
            IsUserLoggedIn() ? require_once PROTECTED_DIR.'fueling/add_fueling.php' : header('Location: index.php?P=home');
            break;

        case 'profilev':
            IsUserLoggedIn() ? require_once PROTECTED_DIR.'vehicle/profile_vehicle.php' : header('Location: index.php?P=home');
            break;

        case 'listv':  
            IsUserLoggedIn() ? require_once PROTECTED_DIR.'vehicle/list_vehicle.php' : header('Location: index.php?P=home');
            break;

        case 'upload':
            IsUserLoggedIn() ? require_once PROTECTED_DIR.'upload.php' : header('Location: index.php?P=home');
            break;

        case 'listt':  
            IsUserLoggedIn() ? require_once PROTECTED_DIR.'vehicle/list_trip.php' : header('Location: index.php?P=home');
            break;

        case 'addv':  
            IsUserLoggedIn() ? require_once PROTECTED_DIR.'vehicle/add_vehicle.php' : header('Location: index.php?P=home');
            break;

        case 'logout':  
            IsUserLoggedIn() ? UserLogout() : header('Location: index.php?P=home');
            break;

        default:
            require_once PROTECTED_DIR.'normal/404.php'; 
            break;
    }
?>