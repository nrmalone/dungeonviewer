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

    public function viewcharacter($pcID)
    {

    }

    public function editcharacter($pcID)
    {

    }

    public function deletecharacter($pcID)
    {

    }

    public function modeler($pcID)
    {
        $data['title_page'] = 'Character Modeler';

        if (is_int(intval(sanitize($pcID)))) {
            $character = $this->loadModel('PlayerCharacter');
            $characterModel = new PlayerCharacter;
            $data['pc'] = $characterModel->modeler(intval(sanitize($pcID)));

            $this->view('modeler', $data);
        } else {
            $_SESSION['message'] = 'Unable to load character modeler.';
            header("Location:" . ROOT . "character");
        }
    }
}