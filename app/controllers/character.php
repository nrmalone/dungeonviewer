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
        
        $this->view('createcharacter', $data);
        $characterModel->createCharacter($_POST);
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
}