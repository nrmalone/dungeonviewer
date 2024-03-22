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

    }

    public function editcampaign($campaignID = false)
    {

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