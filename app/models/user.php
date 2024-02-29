<?php

class User
{
    function signin($POST)
    {
        $DB = new Database();
        $_SESSION['error'] = '';

        if (isset($POST['username']) && isset($POST['password']))
        {
            $arr['username'] = sanitize($POST['username']);
            //$arr['password'] = password_hash((sanitize($POST['password'])), PASSWORD_BCRYPT);
            $sanitized_password = sanitize($POST['password']);
            //$arr['password'] = password_hash($unhashed_password), PASSWORD_BCRYPT);

            $usernameCheckQuery = "SELECT * FROM users WHERE username = :username limit 1;";
            $data = $DB->read($usernameCheckQuery, $arr);
            if (is_array($data))
            {
                $hashed_password = $data[0]->userPassword;

                if (password_verify($sanitized_password, $hashed_password)) {
                    $_SESSION['username'] = $data[0]->username;
                    $_SESSION['email'] = $data[0]->userEmail;
                    
                    $_SESSION['message'] = 'Welcome, ' . $_SESSION['username'] . '!';
                    header("Location:" . ROOT);
                } else {
                    //$_SESSION['message'] = 'Incorrect username or password.';
                    $_SESSION['message'] = 'Incorrect username or password.';
                    header("Location:" . ROOT . "account/signin");
                }
            } else {
                $_SESSION['message'] = 'Unable to perform login';
                header("Location" . ROOT . "account/signin");
            }
        }
    }

    function signup($POST)
    {
        $DB = new Database();
        $_SESSION['error'] = '';

        if(isset($POST['username']) && isset($POST['email']) && isset($POST['password']))
        {
            if(strlen($POST['username']) >= 4 && !str_contains($POST['password'],'\\') && !str_contains($POST['password'],'\/') && !str_contains($POST['password'],'\'') && !str_contains($POST['password'],'*') && !str_contains($POST['password'],',') && !str_contains($POST['password'],'<') && !str_contains($POST['password'],'>') && !str_contains($POST['password'],'!') && !str_contains($POST['password'],'&')) {
                $arr['username'] = sanitize($POST['username']);
                $arr['email'] = sanitize($POST['email']);            

                $checkDuplicateQuery = "SELECT * FROM users WHERE username = :username OR userEmail = :email limit 1;";
                $checkDuplicate = $DB->read($checkDuplicateQuery, $arr);
                if(!$checkDuplicate) {
                    $arr['password'] = password_hash((sanitize($POST['password'])), PASSWORD_BCRYPT);
                    
                    $signupQuery = "INSERT INTO users (username, userEmail, userPassword) values (:username, :email, :password);";
                    $data = $DB->write($signupQuery, $arr);

                    if ($data) {
                        //$_SESSION['message'] = 'User account successfully created!';
                        $_SESSION['message'] = 'User account successfully created! -- ' . $arr['password'];
                        header("Location:" . ROOT . "account/signin");
                    }
                } else {
                    $_SESSION['message'] = 'User data already exists... Try "forgot password" from signin page.';
                    header("Location:" . ROOT . "account/signup");                
                }
            } else {
                $_SESSION['message'] = 'Unable to create user. Error in username or password formatting.';
                header("Location:" . ROOT . "account/signup");
            }
        }
    }

    function signout()
    {
        session_destroy();
        session_start();
        header("Location:" . ROOT);
    }
}