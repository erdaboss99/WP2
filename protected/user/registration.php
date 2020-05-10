<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registration']))
    {
        $postData = [
            'fname' => $_POST['name_first'],
            'lname' => $_POST['name_last'],
            'email_address' => $_POST['email_address'],
            'email1' => $_POST['email1'],
            'user_password' => $_POST['user_password'],
            'password1' => $_POST['password1']
        ];

        if(empty($postData['fname']) || empty($postData['lname']) || empty($postData['email_address']) || empty($postData['email1']) || empty($postData['user_password']) || empty($postData['password1']))
        {
            echo "Missing information!";
        }
        else if($postData['email_address'] != $postData['email1'])
        {
            echo "Email addresses do not match!";
        }
        else if(!filter_var($postData['email_address'], FILTER_VALIDATE_EMAIL))
        {
            echo "Email format is not valid!";
        }
        else if($postData['user_password'] != $postData['password1'])
        {
            echo "Passwords do not match!";
        }
        else if(strlen($postData['user_password'] < 5))
        {
            echo "Password too short! Minimum length is 8 characters";
        }
        else if(!UserRegister($postData['email_address'], $postData['user_password'], $postData['fname'], $postData['lname']))
        {
            echo "Registration failed!";
        }

        $postData['user_password'] = $postData['password1'] = "";
    }
?>

<form method="post">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="registerFirstName">First Name</label>
            <input type="text" class="form-control" id="registerFirstName" name="name_first" value="<?=isset($postData) ? $postData['fname'] : "";?>">
        </div>
        <div class="form-group col-md-6">
            <label for="registerLastName">Last Name</label>
            <input type="text" class="form-control" id="registerLastName" name="name_last" value="<?=isset($postData) ? $postData['lname'] : "";?>">
        </div>
    </div>

    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="registerEmail">Email</label>
            <input type="email" class="form-control" id="registerEmail" name="email_address" value="<?=isset($postData) ? $postData['email_address'] : "";?>">
        </div>
        <div class="form-group col-md-6">
            <label for="registerEmail1">Confirm Email</label>
            <input type="email" class="form-control" id="registerEmail1" name="email1" value="<?=isset($postData) ? $postData['email1'] : "";?>">
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="registerPassword">Password</label>
            <input type="password" class="form-control" id="registerPassword" name="user_password" value="">
        </div>
        <div class="form-group col-md-6">
            <label for="registerPassword1">Confirm Password</label>
            <input type="password" class="form-control" id="registerPassword1" name="password1" value="">
        </div>
    </div>    

    <button type="submit" class="btn btn-primary" name="registration">Register</button>
</form>