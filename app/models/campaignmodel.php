<?php 
class CampaignModel
{
    function listHosted() {
        $DB = new Database;
        $_SESSION['error'] = '';

        if (isset($_SESSION['userID'])) {
            $arr['userID'] = $_SESSION['userID'];

            $listCampaignsHostedQuery = "SELECT * FROM campaigns WHERE userID = :userID;";
            $listCampaignsHosted = $DB->read($listCampaignsHostedQuery, $arr);

            if ($listCampaignsHosted) {
                return $listCampaignsHosted;
            }
        } else {
            return false;
        }
    }

    function listPlayed () {
        $DB = new Database;
        $_SESSION['error'] = '';

        if (isset($_SESSION['userID'])) {
            $arr['userID'] = $_SESSION['userID'];

            $listPCQuery = "SELECT * FROM pcs WHERE userID = :userID AND campaignID IS NOT NULL";
            $listPC = $DB->read($listPCQuery, $arr);
            unset($arr['userID']);

            $data['campaigns'] = [];
            $data['pcs'] = [];
            if (is_array($listPC)) {
                foreach ($listPC as $PC) {
                    $arr['campaignID'] = $PC->campaignID;
                    $getCampaignQuery = "SELECT * FROM campaigns WHERE campaignID = :campaignID;";
                    $getCampaign = $DB->read($getCampaignQuery, $arr);
                    if (is_array($getCampaign)) {
                        array_push($data['campaigns'], $getCampaign);
                        array_push($data['pcs'], $PC);
                    }
                }
            }
            return $data;
        } else {
            return $data['campaigns'] = false && $data['pcs'] = false;
        }
    }

    function createCampaign() {

    }

    function editCampaign($campaignID = false) {

    }

    function deleteCampaign($campaignID = false) {

    }
}