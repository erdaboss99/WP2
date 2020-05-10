<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) 
    {
        $postData = [
            'email_address' => $_POST['email_address'],
            'user_password' => $_POST['user_password']
        ];

        if(empty($postData['email_address']) || empty($postData['user_password'])) 
        {
            echo "Email address or password cannot be empty !";
        } 
        else if (!filter_var($postData['email_address'], FILTER_VALIDATE_EMAIL)) 
        {
            echo "Email format is not valid!";
        } 
        else if(!UserLogin($postData['email_address'], $postData['user_password'])) 
        {
            echo "Email or password is incorrect";
        }

        $postData['user_password'] = "";
    }
?>

<form method="post">
  <div class="form-group">
    <label for="loginEmail">Email address</label>
    <input type="email" class="form-control" id="loginEmail" aria-describedby="emailHelp" name="email_address" value="<?= isset($postData) ? $postData['email_address'] : '';?>">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="loginPassword">Password</label>
    <input type="password" class="form-control" id="loginPassword" name="user_password" value="">
  </div>
  <button type="submit" class="btn btn-primary" name="login">Login</button>
</form>