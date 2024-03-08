<?php

class PlayerCharacter
{
    function listAll() {
        $DB = new Database();
        $_SESSION['error'] = '';

        if (isset($_SESSION['userID'])) {
            $arr['userID'] = $_SESSION['userID'];

            $listPCQuery = "SELECT * FROM pcs WHERE userID = :userID;";
            $data = $DB->read($listPCQuery, $arr);

            if(is_array($data))
            {
                return $data;
            } else {
                return false;
            }
        }
    }

    function createCharacter($POST) {
        $DB = new Database();
        $_SESSION['error'] = '';


    }
}