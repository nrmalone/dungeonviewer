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

    }

    public function play($campaignID = false)
    {

    }
}