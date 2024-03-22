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

    function createCampaign($POST) {
        $DB = new Database();
        $_SESSION['error'] = '';

        if (isset($POST['name']) && isset($_SESSION['userID']))
        {
            $arr['userID'] = $_SESSION['userID'];
            $arr['campaignName'] = sanitize($POST['name']);
            $arr['campaignPassword'] = sanitize($POST['password']);

            $createCampaignQuery = "INSERT INTO campaigns (userID, campaignName, campaignPassword) values (:userID, :campaignName, :campaignPassword);";
            $createCampaign = $DB->write($createCampaignQuery, $arr);

            if ($createCampaign) {
                $_SESSION['message'] = 'Your campaign -' . $arr['campaignName'] . ' was successfully created!';
                header("Location:" . ROOT . "campaign");
            } else {
                $_SESSION['message'] = 'Problem creating ' . $arr['campaignName'] . '.';
                header("Location:" . ROOT . "campaign");
            }
        }
    }

    function joinCampaign($POST)
    {

    }

    function editCampaign($POST) {

    }

    function deleteCampaign($POST) {

    }
}