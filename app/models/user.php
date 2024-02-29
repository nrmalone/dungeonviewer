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
            $arr['password'] = password_hash((sanitize($POST['password'])), PASSWORD_BCRYPT);

            $signinQuery = "SELECT * FROM users WHERE username = :username && userPassword = :password limit 1;";
            $signinCheck = $DB->read($signinQuery, $arr);
            if (is_array($signinCheck))
            {
                $_SESSION['username'] = $signinCheck[0]->username;
                $_SESSION['email'] = $signinCheck[0]->userEmail;

                echo '<script type="text/javascript">alert("Signed in as ' . $_SESSION['username'] . ', ' . $_SESSION['email'] . '");</script>';
                header("Location:" . ROOT);
            } else {
                $_SESSION['error'] = 'Incorrect username or password.';
                
                echo '<script type="text/javascript">alert(' . $_SESSION['error'] . ');</script>';
                header("Location:" . ROOT . "account/signin");
            }
        }
    }

    function signup($POST)
    {
        $DB = new Database();
        $_SESSION['error'] = '';

        if(isset($POST['username']) && isset($POST['email']) && isset($POST['password'])) {
            $arr['username'] = sanitize($POST['username']);
            $arr['email'] = sanitize($POST['email']);            

            $checkDuplicateQuery = "SELECT * FROM users WHERE username = :username OR userEmail = :email limit 1;";
            $checkDuplicate = $DB->read($checkDuplicateQuery, $arr);
            if(!$checkDuplicate) {
                $arr['password'] = password_hash((sanitize($POST['password'])), PASSWORD_BCRYPT);
                
                $signupQuery = "INSERT INTO users (username, userEmail, userPassword) values (:username, :email, :password);";
                $DB->write($signupQuery, $arr);

                echo '<script type="text/javascript">alert("User registration successful!");</script>';
                header("Location:" . ROOT . "account/signin");
            } else {
                $_SESSION['error'] = 'User data already exists... Try "forgot password" from signin page.';

                echo '<script type="text/javascript">alert(' . $_SESSION['error'] . ');</script>';
                header("Location:" . ROOT . "account/signup");                
            }
        }
    }
}