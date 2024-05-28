<?php

class Campaign extends Controller
{
    public function index()
    {
        $data['title_page'] = 'Campaigns';

        $campaign = $this->loadModel('CampaignModel');
        $campaignModel = new CampaignModel;
        $data['campaignsHosted'] = $campaignModel->listHosted();
        $data['campaignsPlayed'] = $campaignModel->listPlayed();

        if ($data['campaignsPlayed'] != false) {
            $data['pcsPlayed'] = [];
            $character = $this->loadModel('PlayerCharacter');
            $characterModel = new PlayerCharacter;
            foreach($data['campaignsPlayed'] as $campaign) {
                array_push($data['pcsPlayed'], $characterModel->getPlayedCharacter($campaign[0]->campaignID));
            }
        } else {
            $data['pcsPlayed'] = false;
        }

        $this->view('campaign', $data);
    }

    public function createcampaign()
    {
        $data['title_page'] = 'Create a Campaign';

        $campaign = $this->loadModel('CampaignModel');
        $campaignModel = new CampaignModel;

        $data['campaigns'] = $campaignModel->listHosted(); 
        $campaignModel->createCampaign($_POST);
        $this->view('createcampaign', $data);
    }

    public function joincampaign()
    {
        $data['title_page'] = 'Join a Campaign';

        $campaign = $this->loadModel('CampaignModel');
        $campaignModel = new CampaignModel;

        $character = $this->loadModel('PlayerCharacter');
        $characterModel = new PlayerCharacter;

        $data['pcs'] = $characterModel->listAvailable();

        /*
        experiencing issue with the form in join view...
        form tags aren't nested in table or split incorrectly when double checking HTML
        marking as issue on Github
        */
        //disregard above comment, fixed in joinCampaign() in model file
        $campaignModel->joinCampaign($_POST);
        $this->view('join', $data);
    }

    public function editcampaign($campaignID = false)
    {
        $data['title_page'] = 'Edit Campaign';

        if (is_int(intval(sanitize($campaignID)))) {
            $data['campaignID'] = intval(sanitize($campaignID));
        } else {
            $data['campaignID'] = false;
        }

        $campaign = $this->loadModel('CampaignModel');
        $campaignModel = new CampaignModel;
        $data['campaign'] = $campaignModel->getCampaign($data['campaignID']);

        $campaignModel->editCampaign($_POST);
        $this->view('editcampaign', $data);
    }

    public function deletecampaign($campaignID = false)
    {

    }

    public function host($campaignID = false)
    {
        $data['title_page'] = 'Hosting a Campaign';
        if (is_int(intval(sanitize($campaignID)))) {
            $sanitizedCID = intval(sanitize($campaignID));
            $campaign = $this->loadModel('CampaignModel');
            $campaignModel = new CampaignModel;

            $data['campaign'] = $campaignModel->getCampaign($sanitizedCID);
            if ($data['campaign'] != false) {
                $data['title_page'] = 'Hosting a Campaign';
            } else {
                $data['title_page'] = 'Campaign Error';
                $_SESSION['message'] = 'Unable to host selected campaign.';
            }
        } else {
            $data['title_page'] = 'Campaign Error';
            $data['campaign'] = false;
            $_SESSION['message'] = 'Unable to host selected campaign.';
        }
        $this->view('campaignhost', $data);
    }

    public function play($campaignID = false, $pcID = false)
    {
        if (is_int(intval(sanitize($campaignID))) && is_int(intval(sanitize($pcID)))) {
            $data['title_page'] = 'Playing a Campaign';
            $campaign = $this->loadModel('CampaignModel');
            $campaignModel = new CampaignModel;
            $data['campaign'] = $campaignModel->getPlayedCampaign(intval(sanitize($campaignID)));
            
            $character = $this->loadModel('PlayerCharacter');
            $characterModel = new PlayerCharacter;
            $data['pc'] = $characterModel->getCharacter(intval(sanitize($pcID)));
            $data['possibleXP'] = [
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

            $data['modifiers'] = [
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
        } else {

        }
        $this->view('campaignplay', $data);
    }
}