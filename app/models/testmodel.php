<?php

class TestModel
{
    function testSanitization($POST) {
        if (isset($POST['username']) && isset($POST['email']) && isset($POST['password'])) {
            $arr['username'] = sanitize($POST['username'], 'username');
            $arr['email'] = sanitize($POST['email'], 'email');
            $arr['password'] = password_hash($POST['password'], PASSWORD_BCRYPT);

            $DB = new Database();
            $createTestUserQuery = "INSERT INTO testusers (username, userEmail, userPassword) values (:username, :email, :password);";
            $createTestUser = $DB->write($createTestUserQuery, $arr);
            if ($createTestUser) {
                header("Location:" . ROOT . "account");
            }
        }
    }

    function display($userID) {
        $DB = new Database();
        $arr['userID'] = $userID;
        $getTestUserQuery = "SELECT * FROM testusers WHERE userID = :userID;";
        $getTestUser = $DB->read($getTestUserQuery, $arr);
        if ($getTestUser) {
            return $getTestUser;
        }
    }
}