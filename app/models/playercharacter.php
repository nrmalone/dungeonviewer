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

    function listAvailable() {
        $DB = new Database();
        $_SESSION['error'] = '';

        if (isset($_SESSION['userID'])) {
            $arr['userID'] = $_SESSION['userID'];

            $listPCQuery = "SELECT * FROM pcs WHERE userID = :userID AND campaignID IS NULL;";
            $data = $DB->read($listPCQuery, $arr);

            if(is_array($data))
            {
                return $data;
            } else {
                return false;
            }
        }
    }

    function getCharacter($pcID) {
        $DB = new Database();
        $_SESSION['error'] = '';

        $arr['pcID'] = intval(sanitize($pcID));

        $getPCQuery = "SELECT * FROM pcs WHERE pcID = :pcID;";
            $getPC = $DB->read($getPCQuery, $arr);

            if(is_array($getPC))
            {
                return $getPC;
            } else {
                return false;
            }
    }

    function createCharacter($POST) {
        $DB = new Database();
        $_SESSION['error'] = '';

        if (isset($POST['name']) && isset($_SESSION['userID']))
        {
            $arr['userID'] = $_SESSION['userID'];
            //character traits
            $arr['pcName'] = sanitize($POST['name']);
            $arr['pcRace'] = sanitize($POST['race']);
            $arr['pcClass'] = sanitize($POST['class']);
            $arr['pcAlignment'] = sanitize($POST['alignment']);

            //character level & XP calculation
            $arr['pcLevel'] = intval(sanitize($POST['level']));
            $possibleXP = [
                1 => 0,
                2 => 300,
                3 => 900,
                4 => 2700,
                5 => 6500,
                6 => 14000,
                7 => 23000,
                8 => 34000,
                9 => 48000,
                10 => 64000,
                11 => 85000,
                12 => 100000,
                13 => 120000,
                14 => 140000,
                15 => 165000,
                16 => 195000,
                17 => 225000,
                18 => 265000,
                19 => 305000,
                20 => 355000
            ];
            $arr['pcXP'] = $possibleXP[$arr['pcLevel']];
            
            //armor
            if(isset($POST['shield'])) {
                $arr['pcAC'] = intval(sanitize($POST['armor'])) + 2;
            } else {
                $arr['pcAC'] = intval(sanitize($POST['armor']));
            }

            //character attributes
            if (intval(sanitize($POST['strength'] > 0))) {
                $arr['pcSTR'] = intval(sanitize($POST['strength']));
            } else {
                $arr['pcSTR'] = 8;
            }

            if (intval(sanitize($POST['dexterity'] > 0))) {
                $arr['pcDEX'] = intval(sanitize($POST['dexterity']));
            } else {
                $arr['pcDEX'] = 8;
            }

            if (intval(sanitize($POST['constitution'] > 0))) {
                $arr['pcCON'] = intval(sanitize($POST['constitution']));
            } else {
                $arr['pcCON'] = 8;
            }

            if (intval(sanitize($POST['intelligence'] > 0))) {
                $arr['pcINT'] = intval(sanitize($POST['intelligence']));
            } else {
                $arr['pcINT'] = 8;
            }

            if (intval(sanitize($POST['wisdom'] > 0))) {
                $arr['pcWIS'] = intval(sanitize($POST['wisdom']));
            } else {
                $arr['pcWIS'] = 8;
            }

            if (intval(sanitize($POST['charisma'] > 0))) {
                $arr['pcCHA'] = intval(sanitize($POST['charisma']));
            } else {
                $arr['pcCHA'] = 8;
            }

            $modifiers = [
                1 => -5,
                2 => -4,
                3 => -4,
                4 => -3,
                5 => -3,
                6 => -2,
                7 => -2,
                8 => -1,
                9 => -1,
                10 => 0,
                11 => 0,
                12 => 1,
                13 => 1,
                14 => 2,
                15 => 2,
                16 => 3,
                17 => 3,
                18 => 4,
                19 => 4,
                20 => 5,
                21 => 5,
                22 => 6,
                23 => 6,
                24 => 7,
                25 => 7,
                26 => 8,
                27 => 8,
                28 => 9,
                29 => 9,
                30 => 10
            ];

            //HP calculation
            switch ($arr['pcClass']) {
                case 'Barbarian':
                    $arr['pcHP'] = 12 + $modifiers[intval($arr['pcCON'])];
                break;

                case 'Bard':
                    $arr['pcHP'] = 8 + $modifiers[intval($arr['pcCON'])];
                break;

                case 'Cleric':
                    $arr['pcHP'] = 8 + $modifiers[intval($arr['pcCON'])];
                break;

                case 'Druid':
                    $arr['pcHP'] = 8 + $modifiers[intval($arr['pcCON'])];
                break;

                case 'Fighter':
                    $arr['pcHP'] = 10 + $modifiers[intval($arr['pcCON'])];
                break;

                case 'Monk':
                    $arr['pcHP'] = 8 + $modifiers[intval($arr['pcCON'])];
                break;

                case 'Paladin':
                    $arr['pcHP'] = 10 + $modifiers[intval($arr['pcCON'])];
                break;

                case 'Ranger':
                    $arr['pcHP'] = 10 + $modifiers[intval($arr['pcCON'])];
                break;

                case 'Rogue':
                    $arr['pcHP'] = 8 + $modifiers[intval($arr['pcCON'])];
                break;

                case 'Sorcerer':
                    $arr['pcHP'] = 6 + $modifiers[intval($arr['pcCON'])];
                break;
                
                case 'Warlock':
                    $arr['pcHP'] = 8 + $modifiers[intval($arr['pcCON'])];
                break;

                case 'Wizard':
                    $arr['pcHP'] = 6 + $modifiers[intval($arr['pcCON'])];
                break;
            }

            //database write
            $createCharacterQuery = "INSERT INTO pcs (userID, pcName, pcRace, pcClass, pcAlignment, pcHP, pcLevel, pcXP, pcAC, pcSTR, pcDEX, pcCON, pcINT, pcWIS, pcCHA) values (:userID, :pcName, :pcRace, :pcClass, :pcAlignment, :pcHP, :pcLevel, :pcXP, :pcAC, :pcSTR, :pcDEX, :pcCON, :pcINT, :pcWIS, :pcCHA);";
            $createCharacter = $DB->write($createCharacterQuery, $arr);

            if ($createCharacter) {
                $_SESSION['message'] = 'Your character ' . $arr['pcName'] . ' was successfully created!';
                header("Location:" . ROOT . "character");
            } else {
                $_SESSION['message'] = 'Problem creating character.';
                header("Location:" . ROOT . "createcharacter");
            }
        }
    }

    function editCharacter($POST) {
        $DB = new Database();
        $_SESSION['error'] = '';

        if (isset($POST['name']) && isset($_SESSION['userID'])) {
            $arr['pcID'] = intval(sanitize($POST['pcID']));
            $arr['userID'] = $_SESSION['userID'];

            $checkForPCQuery = "SELECT * FROM pcs WHERE (pcID = :pcID AND userID = :userID);";
            $checkForPC = $DB->read($checkForPCQuery, $arr);

            if (is_array($checkForPC))
            {
                //character traits
                $arr['pcName'] = sanitize($POST['name']);
                $arr['pcRace'] = sanitize($POST['race']);
                $arr['pcClass'] = sanitize($POST['class']);
                $arr['pcAlignment'] = sanitize($POST['alignment']);

                //character level & XP calculation
                $arr['pcLevel'] = intval(sanitize($POST['level']));
                $possibleXP = [
                    1 => 0,
                    2 => 300,
                    3 => 900,
                    4 => 2700,
                    5 => 6500,
                    6 => 14000,
                    7 => 23000,
                    8 => 34000,
                    9 => 48000,
                    10 => 64000,
                    11 => 85000,
                    12 => 100000,
                    13 => 120000,
                    14 => 140000,
                    15 => 165000,
                    16 => 195000,
                    17 => 225000,
                    18 => 265000,
                    19 => 305000,
                    20 => 355000
                ];
                $arr['pcXP'] = $possibleXP[$arr['pcLevel']];
                
                //armor
                if(isset($POST['shield'])) {
                    $arr['pcAC'] = intval(sanitize($POST['armor'])) + 2;
                } else {
                    $arr['pcAC'] = intval(sanitize($POST['armor']));
                }

                //character attributes
                if (intval(sanitize($POST['strength'] > 0))) {
                    $arr['pcSTR'] = intval(sanitize($POST['strength']));
                } else {
                    $arr['pcSTR'] = 8;
                }

                if (intval(sanitize($POST['dexterity'] > 0))) {
                    $arr['pcDEX'] = intval(sanitize($POST['dexterity']));
                } else {
                    $arr['pcDEX'] = 8;
                }

                if (intval(sanitize($POST['constitution'] > 0))) {
                    $arr['pcCON'] = intval(sanitize($POST['constitution']));
                } else {
                    $arr['pcCON'] = 8;
                }

                if (intval(sanitize($POST['intelligence'] > 0))) {
                    $arr['pcINT'] = intval(sanitize($POST['intelligence']));
                } else {
                    $arr['pcINT'] = 8;
                }

                if (intval(sanitize($POST['wisdom'] > 0))) {
                    $arr['pcWIS'] = intval(sanitize($POST['wisdom']));
                } else {
                    $arr['pcWIS'] = 8;
                }

                if (intval(sanitize($POST['charisma'] > 0))) {
                    $arr['pcCHA'] = intval(sanitize($POST['charisma']));
                } else {
                    $arr['pcCHA'] = 8;
                }

                $modifiers = [
                    1 => -5,
                    2 => -4,
                    3 => -4,
                    4 => -3,
                    5 => -3,
                    6 => -2,
                    7 => -2,
                    8 => -1,
                    9 => -1,
                    10 => 0,
                    11 => 0,
                    12 => 1,
                    13 => 1,
                    14 => 2,
                    15 => 2,
                    16 => 3,
                    17 => 3,
                    18 => 4,
                    19 => 4,
                    20 => 5,
                    21 => 5,
                    22 => 6,
                    23 => 6,
                    24 => 7,
                    25 => 7,
                    26 => 8,
                    27 => 8,
                    28 => 9,
                    29 => 9,
                    30 => 10
                ];

                //HP calculation
                switch ($arr['pcClass']) {
                    case 'Barbarian':
                        $arr['pcHP'] = 12 + $modifiers[intval($arr['pcCON'])];
                    break;

                    case 'Bard':
                        $arr['pcHP'] = 8 + $modifiers[intval($arr['pcCON'])];
                    break;

                    case 'Cleric':
                        $arr['pcHP'] = 8 + $modifiers[intval($arr['pcCON'])];
                    break;

                    case 'Druid':
                        $arr['pcHP'] = 8 + $modifiers[intval($arr['pcCON'])];
                    break;

                    case 'Fighter':
                        $arr['pcHP'] = 10 + $modifiers[intval($arr['pcCON'])];
                    break;

                    case 'Monk':
                        $arr['pcHP'] = 8 + $modifiers[intval($arr['pcCON'])];
                    break;

                    case 'Paladin':
                        $arr['pcHP'] = 10 + $modifiers[intval($arr['pcCON'])];
                    break;

                    case 'Ranger':
                        $arr['pcHP'] = 10 + $modifiers[intval($arr['pcCON'])];
                    break;

                    case 'Rogue':
                        $arr['pcHP'] = 8 + $modifiers[intval($arr['pcCON'])];
                    break;

                    case 'Sorcerer':
                        $arr['pcHP'] = 6 + $modifiers[intval($arr['pcCON'])];
                    break;
                    
                    case 'Warlock':
                        $arr['pcHP'] = 8 + $modifiers[intval($arr['pcCON'])];
                    break;

                    case 'Wizard':
                        $arr['pcHP'] = 6 + $modifiers[intval($arr['pcCON'])];
                    break;
                }

                $editCharacterQuery = "UPDATE pcs SET pcName = :pcName, pcRace = :pcRace, pcClass = :pcClass, pcAlignment = :pcAlignment, pcHP = :pcHP, pcLevel = :pcLevel, pcXP = :pcXP, pcAC = :pcAC, pcSTR = :pcSTR, pcDEX = :pcDEX, pcCON = :pcCON, pcINT = :pcINT, pcWIS = :pcWIS, pcCHA = :pcCHA WHERE (pcID = :pcID AND userID = :userID);";
                $editCharacter = $DB->write($editCharacterQuery, $arr);

                if ($editCharacter) {
                    $_SESSION['message'] = 'Successfully edited ' . $arr['pcName'] . '.';
                    header("Location:" . ROOT . "character");
                } else {
                    $_SESSION['message'] = 'Unable to edit character.';
                    header("Location:" . ROOT . "character");
                }
            } else {
                $_SESSION['message'] = 'Unable to edit character.';
                header("Location:" . ROOT . "character");
            }
        }
    }

    function modeler($pcID) {
        $DB = new Database();
        $_SESSION['error'] = '';

        if (isset($pcID) && is_int($pcID)) {
            $arr['pcID'] = intval(sanitize($pcID));

            $getPCQuery = "SELECT * FROM pcs WHERE pcID = :pcID;";
            $getPC = $DB->read($getPCQuery, $arr);

            if(is_array($getPC))
            {
                return $getPC;
            } else {
                return false;
            }
        } else {
            $_SESSION['message'] = 'character ID missing from URL, unable to open modeler';
            header("Location:" . ROOT . "character");
        }
    }

    function uploadAvatar($POST) {
        $DB = new Database();
        $_SESSION['error'] = '';

        if (isset($POST['pcID']) && is_int(intval(sanitize($POST['pcID']))))
        {
            $arr['pcID'] = intval(sanitize($POST['pcID']));
            $arr['userID'] = $_SESSION['userID'];

            $getPCQuery = "SELECT * FROM pcs WHERE pcID = :pcID AND userID = :userID;";
            $getPC = $DB->read($getPCQuery, $arr);

            if ($getPC) {
                //save uploaded file to img/characters/ folder... naming scheme: u(userID)p(pcID).(file-type)
            } else {
                $_SESSION['message'] = 'Unable to pull character.';
                header("Location:" . ROOT . "character");
            }
        }
    }
}