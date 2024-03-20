<?php

class Character extends Controller
{
    public function index()
    {
        $data['title_page'] = 'Characters';

        $character = $this->loadModel('PlayerCharacter');
        $characterModel = new PlayerCharacter;
        $data['pcs'] = $characterModel->listAll();

        $this->view('character', $data);
    }

    public function createcharacter()
    {
        $data['title_page'] = 'Create Character';

        $data['defaultRaces'] = ['Dragonborn', 'Dwarf', 'Elf', 'Gnome', 'Half-Elf', 'Halfling', 'Half-Orc', 'Human', 'Tiefling'];
        $data['defaultClasses'] = ['Barbarian', 'Bard', 'Cleric', 'Druid', 'Fighter', 'Monk', 'Paladin', 'Ranger', 'Rogue', 'Sorcerer', 'Warlock', 'Wizard'];
        $data['alignments'] = ['Lawful Good', 'Neutral Good', 'Chaotic Good', 'Lawful Neutral', 'True Neutral', 'Chaotic Neutral', 'Lawful Evil', 'Neutral Evil', 'Chaotic Evil'];

        $character = $this->loadModel('PlayerCharacter');
        $characterModel = new PlayerCharacter;
        
        $characterModel->createCharacter($_POST);
        $this->view('createcharacter', $data);
    }

    public function editcharacter($pcID = false)
    {
            $data['title_page'] = 'Edit Character';

            $data['defaultRaces'] = ['Dragonborn', 'Dwarf', 'Elf', 'Gnome', 'Half-Elf', 'Halfling', 'Half-Orc', 'Human', 'Tiefling'];
            $data['defaultClasses'] = ['Barbarian', 'Bard', 'Cleric', 'Druid', 'Fighter', 'Monk', 'Paladin', 'Ranger', 'Rogue', 'Sorcerer', 'Warlock', 'Wizard'];
            $data['alignments'] = ['Lawful Good', 'Neutral Good', 'Chaotic Good', 'Lawful Neutral', 'True Neutral', 'Chaotic Neutral', 'Lawful Evil', 'Neutral Evil', 'Chaotic Evil'];

            if (is_int(intval(sanitize($pcID)))) {
                $data['pcID'] = intval(sanitize($pcID));
            } else {
                $data['pcID'] = false;
            }

            $character = $this->loadModel('PlayerCharacter');
            $characterModel = new PlayerCharacter;
            $data['pc'] = $characterModel->getCharacter($data['pcID']);

            $characterModel->editCharacter($_POST);
            $this->view('editcharacter', $data);
    } 

    public function deletecharacter($pcID)
    {

    }

    public function modeler($pcID = false)
    {
        $data['title_page'] = 'Character Modeler';

        if (is_int(intval(sanitize($pcID)))) {
            $character = $this->loadModel('PlayerCharacter');
            $characterModel = new PlayerCharacter;
            try {
                $data['pc'] = $characterModel->modeler(intval(sanitize($pcID)));
            } catch (ArgumentCountError $e) {
                $_SESSION['message'] = 'Unable to load character modeler.';
                header("Location:" . ROOT . "character");
            }
            $this->view('modeler', $data);
        } else {
            $_SESSION['message'] = 'Unable to load character modeler.';
            header("Location:" . ROOT . "character");
        }
    }

    public function uploadavatar($pcID = false)
    {
        if (is_int(intval(sanitize($pcID)))) {
            $character = $this->loadModel('PlayerCharacter');
            $characterModel = new PlayerCharacter;
            try {
                $data['pc'] = $characterModel->getCharacter(intval(sanitize($pcID)));
            } catch (ArgumentCountError $e) {
                $_SESSION['message'] = 'Unable to grab character.';
                header("Location:" . ROOT . "character");
            }
            $data['title_page'] = 'Upload Avatar';
            $characterModel->uploadAvatar($_POST);
            $this->view('uploadavatar', $data);
        } else {
            $data['title_page'] = 'Error';
            $_SESSION['message'] = 'Unable to process avatar update.';
            $this->view('error', $data);
        }
    }
}