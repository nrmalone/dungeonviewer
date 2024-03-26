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
            } else {
                return false;
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
            if (is_array($listPC)) {
                $data = [];
                foreach ($listPC as $PC) {
                    $arr['campaignID'] = $PC->campaignID;
                    $getCampaignQuery = "SELECT * FROM campaigns WHERE campaignID = :campaignID;";
                    $getCampaign = $DB->read($getCampaignQuery, $arr);
                    if (is_array($getCampaign)) {
                        array_push($data, $getCampaign);
                    } else {
                        $data = false;
                    }
                }
            }
            if (isset($data)) {
            return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function getCampaign($campaignID = false) {
        if (is_int(($campaignID))) {
            $arr['campaignID'] = $campaignID;
        } else {
            return false;
        }

        $arr['userID'] = $_SESSION['userID'];

        $DB = new Database();
        $getCampaignQuery = "SELECT * FROM campaigns WHERE campaignID = :campaignID AND userID = :userID LIMIT 1;";
        $getCampaign = $DB->read($getCampaignQuery, $arr);

        if (is_array($getCampaign)) {
            return $getCampaign;
        } else {
            return false;
        }
    }

    function createCampaign($POST) {
        $DB = new Database();
        $_SESSION['error'] = '';

        if (isset($_SESSION['userID']) && isset($POST['name']) && isset($POST['password']))
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
        $DB = new Database();
        $_SESSION['error'] = '';

        if (isset($_SESSION['userID']) && isset($POST['joinID']) && isset($POST['password']) && isset($POST['pcID'])) {
            $arr['userID'] = $_SESSION['userID'];
            $arr['pcID'] = is_int(intval(sanitize($POST['pcID']))) ? intval(sanitize($POST['pcID'])) : false;

            $checkPCQuery = ($arr['pcID'] != false) ? "SELECT * FROM pcs WHERE pcID = :pcID AND userID = :userID;" : false;
            $checkPC = $DB->read($checkPCQuery, $arr);

            $arr2['campaignID'] = is_int(intval(sanitize($POST['joinID']))) ? intval(sanitize($POST['joinID'])) : false;
            $arr2['campaignPassword'] = sanitize($POST['password']);

            $checkCampaignQuery = ($checkPC) ? "SELECT * FROM campaigns WHERE campaignID = :campaignID AND campaignPassword = :campaignPassword;" : false;
            if ($checkCampaignQuery) {
                $checkCampaign = $DB->read($checkCampaignQuery, $arr2);
                $arr['campaignID'] = $arr2['campaignID'];
            } else {
                $checkCampaign = false;
            }

            $joinCampaignQuery = ($checkCampaign) ? "UPDATE pcs SET campaignID = :campaignID WHERE (userID = :userID AND pcID = :pcID);" : false;
            $joinCampaign = ($joinCampaignQuery) ? $DB->write($joinCampaignQuery, $arr) : false;

            if ($joinCampaign) {
                $_SESSION['message'] = "Successfully joined campaign!";
                header("Location:" . ROOT . "campaign");
            } else {
                $_SESSION['message'] = 'Incorrect join information.';
                header("Location:" . ROOT . "campaign");
            }
        } //fixed POST submission by removing else{} right here... no code will execute until submission button on form is pressed
        //header in else[} kept firing because the POST was being auto-submitted?
    }

    function editCampaign($POST) {
        $DB = new Database();
        $_SESSION['error'] = '';

        if (isset($POST['campaignID']) && isset($POST['name']) && isset($POST['password']) && isset($_SESSION['userID'])) {
            $arr['userID'] = $_SESSION['userID'];
            $arr['campaignID'] = intval(sanitize($POST['campaignID']));
            $arr['campaignName'] = sanitize($POST['name']);
            $arr['campaignPassword'] = sanitize($POST['password']);

            $editCampaignQuery = "UPDATE campaigns SET campaignName = :campaignName, campaignPassword = :campaignPassword WHERE (campaignID = :campaignID AND userID = :userID)";
            $editCampaign = $DB->write($editCampaignQuery, $arr);

            if ($editCampaign) {
                $_SESSION['message'] = 'Successfully edited campaign: ' . $arr['campaignName'] . '!';
                header("Location:" . ROOT . "campaign");
            } else {
                $_SESSION['message'] = 'Unable to edit campaign.';
                header("Location" . ROOT . "campaign");
            }
        } elseif (isset($POST['campaignID'])) {
            $_SESSION['message'] = 'Unable to edit campaign, test.';
            header("Location:" . ROOT . "campaign");
        } else {

        }
    }

    function deleteCampaign($POST) {

    }
}