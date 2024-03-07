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
                    $_SESSION['userID'] = $data[0]->userID;
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
            if(strlen($POST['username']) >= 4 && strlen($POST['username']) <= 16 && !str_contains($POST['password'],'\\') && !str_contains($POST['password'],'\/') && !str_contains($POST['password'],'\'') && !str_contains($POST['password'],'*') && !str_contains($POST['password'],',') && !str_contains($POST['password'],'<') && !str_contains($POST['password'],'>') && !str_contains($POST['password'],'!') && !str_contains($POST['password'],'&')) {
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
                        $_SESSION['message'] = 'User account successfully created!';
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

    function updateemail($POST)
    {
        $DB = new Database;
        $_SESSION['error'] = '';

        if(isset($POST['email']) && filter_var(sanitize($POST['email']), FILTER_VALIDATE_EMAIL)) {
            $arr['submittedEmail'] = sanitize($POST['email']);

            $checkDuplicateQuery = "SELECT * FROM users WHERE userEmail = :submittedEmail;";
            $checkDuplicate = $DB->read($checkDuplicateQuery, $arr);
            if(!$checkDuplicate) {
                $arr['userID'] = $_SESSION['userID'];

                $updateUsernameQuery = "UPDATE users SET userEmail = :submittedEmail WHERE userID = :userID;";
                $data = $DB->write($updateUsernameQuery, $arr);

                if ($data) {
                    $_SESSION['email'] = $arr['submittedEmail'];
                    $_SESSION['message'] = 'Email updated to' . $arr['submittedEmail'];
                    header("Location:" . ROOT . "account");
                    exit();
                } else {
                    $_SESSION['message'] = 'Unable to update email at this time.';
                    header("Location:" . ROOT . "account/updateemail");
                    exit();
                }
            } else {
                $_SESSION['message'] = 'Unable to update. Email ' . $arr['submittedEmail'] . ' is already in use.';
                header("Location:" . ROOT . "account/updateemail");
                exit();
            }
        }
    }

    function updateusername($POST)
    {
        $DB = new Database;
        $_SESSION['error'] = '';

        if(isset($POST['username']) && strlen($POST['username']) >= 4 && strlen($POST['username']) <= 16) {
            $arr['submittedUsername'] = sanitize($POST['username']);

            $checkDuplicateQuery = "SELECT * FROM users WHERE username = :submittedUsername;";
            $checkDuplicate = $DB->read($checkDuplicateQuery, $arr);
            if(!$checkDuplicate) {
                $arr['userID'] = $_SESSION['userID'];

                $updateUsernameQuery = "UPDATE users SET username = :submittedUsername WHERE userID = :userID;";
                $data = $DB->write($updateUsernameQuery, $arr);

                if ($data) {
                    $_SESSION['username'] = $arr['submittedUsername'];
                    $_SESSION['message'] = 'Username updated to ' . $arr['submittedUsername'];
                    header("Location:" . ROOT . "account");
                    exit();
                } else {
                    $_SESSION['message'] = 'Unable to update username at this time.';
                    header("Location:" . ROOT . "account/updateusername");
                    exit();
                }
            } else {
                $_SESSION['message'] = 'Unable to update. Username ' . $arr['submittedUsername'] . ' is already in use.';
                header("Location:" . ROOT . "account/updateusername");
                exit();
            }
        }
    }

    function deleteaccount($POST) {
        $DB = new Database;
        $_SESSION['error'] = '';

        if((isset($POST['username']) && strlen($POST['username']) >=4 && strlen($POST['username']) <= 16) && isset($POST['password'])) {
            $arr['submittedUsername'] = sanitize($POST['username']);
            $sanitized_password = sanitize($POST['password']);

            $checkUserQuery = "SELECT * FROM users WHERE username = :submittedUsername;";
            $checkUser = $DB->read($checkUserQuery, $arr);
            if(is_array($checkUser) && password_verify($sanitized_password, $checkUser[0]->userPassword)) {
                
                // TODO -- SQL delete not working
                $deleteUserQuery = "DELETE FROM users WHERE username = :submittedUsername;";
                $deleteUser = $DB->write($deleteUserQuery, $arr);

                $_SESSION['message'] = $arr['submittedUsername'] . '\'s account has been deleted.';
                $this->signout();
            } else {
                $_SESSION['message'] = 'Unable to delete ' . $arr['submittedUsername'] . '\'s account at this time.';
                header("Location:" . ROOT . "account");
                exit();
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