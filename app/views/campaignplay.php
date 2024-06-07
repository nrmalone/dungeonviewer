<?php include_once '../app/components/pageheader.php'; ?>

<?php if (isset($_SESSION['message'])) {
    echo '<div class="accountDiv" style="margin-left: 2%; margin-top: 2%; max-width: max-content;"><p><strong>' . $_SESSION['message'] . '</strong></p></div>';
    unset($_SESSION['message']);
}
?>

<?php if (isset($_SESSION['userID']) && ($data['pc'] != false) && ($_SESSION['userID'] == $data['pc'][0]->userID) && ($data['pc'][0]->campaignID == $data['campaign'][0]->campaignID)) : ?>
    <div align="center" style="margin: 2vh;">
        <h1 style="display: inline;">Playing <em><?=$data['campaign'][0]->campaignName?></em></h1>
        <h4 style="display: inline; margin-left: 3vw;"><a class="defaultLink" href="<?=ROOT?>campaign">← Back</a>&emsp;&emsp;<a class="defaultLink" style="margin-left: 3vw;">&#10683; Leave</a></h4>
    </div>
    <div align="center" style="margin: auto;">
        <div class="mapBackground forest" style="width: 70%; display: inline-block; margin: none; border: 0.5vw solid #6A0F0F; border-radius: 1vw 1vw 1vw 1vw; position: relative;">
            <table style="aspect-ratio:calc(5/4);">
                <?php for ($y=1; $y<=20; ++$y): ?>
                    <tr style="overflow: hidden;">
                    <?php for ($x=1; $x<=25; ++$x): ?>
                        <td style="margin: none; border: 1px solid black; width: 4vw; aspect-ratio:1/1;">
                                <div align="center" id="div:<?='x'.$x.':y'.$y?>" style="aspect-ratio: calc(5/4); margin: none;" onclick="sendMessage('campaign<?=$data['campaign'][0]->campaignID?>chat', 'move', '<?=$_SESSION['userID']?>,<?=$data['pc'][0]->pcID?>,<?=$x?>,<?=$y?>,<?=$data['pc'][0]->pcName?>')"></div>
                        </td>
                    <?php endfor; ?>
                    </tr>
                <?php endfor; ?>
            </table>
        </div>
        <div class="mapRightMenu" style="margin: none; display: inline-block; vertical-align: top; max-width: 20%; position: relative;">
            <table>
                <tr style="text-wrap: balance;">
                    <td style="font-size: 14pt; font-weight: bold;">
                        <?=$data['pc'][0]->pcName?>
                    </td>
                    <td>
                        <span>HP: <p id="currentHP" style="display: inline; margin: none;"><?=$data['pc'][0]->pcCurrentHP?></p>/<?=$data['pc'][0]->pcMaxHP?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        Lvl <?=$data['pc'][0]->pcLevel?> <?=$data['pc'][0]->pcRace?>
                    </td>
                    <td>
                        <?=$data['pc'][0]->pcClass?>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <?=explode(' ', $data['pc'][0]->pcAlignment)[0]?>
                    </td>
                    <td>
                        <?=explode(' ', $data['pc'][0]->pcAlignment)[1]?>
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        STR
                    </td>
                    <td>
                        <?=$data['pc'][0]->pcSTR?> <span style="font-size: 9pt;">(<?=$data['modifiers'][$data['pc'][0]->pcSTR]?>)</span>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        DEX
                    </td>
                    <td>
                        <?=$data['pc'][0]->pcDEX?> <span style="font-size: 9pt;">(<?=$data['modifiers'][$data['pc'][0]->pcDEX]?>)</span>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        CON
                    </td>
                    <td>
                        <?=$data['pc'][0]->pcCON?> <span style="font-size: 9pt;">(<?=$data['modifiers'][$data['pc'][0]->pcCON]?>)</span>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        INT
                    </td>
                    <td>
                        <?=$data['pc'][0]->pcINT?> <span style="font-size: 9pt;">(<?=$data['modifiers'][$data['pc'][0]->pcINT]?>)</span>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        WIS
                    </td>
                    <td>
                        <?=$data['pc'][0]->pcWIS?> <span style="font-size: 9pt;">(<?=$data['modifiers'][($data['pc'][0]->pcWIS)]?>)</span>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        CHA
                    </td>
                    <td>
                        <?=$data['pc'][0]->pcCHA?> <span style="font-size: 9pt;">(<?=$data['modifiers'][$data['pc'][0]->pcCHA]?>)</span>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        Armor
                    </td>
                    <td>
                        <?=$data['pc'][0]->pcAC?>
                    </td>
                </tr>
                <tr>
                    <td>
                        &nbsp;
                    </td>
                </tr>
            </table>

            <!-- chatbox -->
            <table>
                <tr align="center">
                    <td>
                        Chat
                    </td>
                </tr>
                <tr align="center">
                    <td>
                        <textarea disabled id="campaign<?=$data['campaign'][0]->campaignID?>chat" style="height: 30vh; resize: none; width: 95%;"></textarea>
                    </td>
                </tr>
                <tr align="center">
                    <td>
                        <input type="text" id="messageInput" style="width: 62.5%;"></input>
                        <button type="button" class="accountButton" onclick="content = document.getElementById('messageInput').value.toString(); sendMessage('campaign<?=$data['campaign'][0]->campaignID?>chat', 'msg', content)">Send</button>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <button type="button" onclick="sendMessage('campaign<?=$data['campaign'][0]->campaignID?>chat', 'roll', 1)">Coin</button>
                        <button type="button" onclick="sendMessage('campaign<?=$data['campaign'][0]->campaignID?>chat', 'roll', 4)">D4</button>
                        <button type="button" onclick="sendMessage('campaign<?=$data['campaign'][0]->campaignID?>chat', 'roll', 6)">D6</button>
                        <button type="button" onclick="sendMessage('campaign<?=$data['campaign'][0]->campaignID?>chat', 'roll', 8)">D8</button>
                    </td>                
                </tr>
                <tr>
                    <td align="center">
                        <button type="button" onclick="sendMessage('campaign<?=$data['campaign'][0]->campaignID?>chat', 'roll', 10)">D10</button>
                        <button type="button" onclick="sendMessage('campaign<?=$data['campaign'][0]->campaignID?>chat', 'roll', 12)">D12</button>
                        <button type="button" onclick="sendMessage('campaign<?=$data['campaign'][0]->campaignID?>chat', 'roll', 20)">D20</button>
                        <button type="button" onclick="sendMessage('campaign<?=$data['campaign'][0]->campaignID?>chat', 'roll', 100)">D100</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <script type="text/javascript">
        var chatContent = '';
        var pc = '<?=$data['pc'][0]->pcName?>';
        var chatID = 'campaign' + (<?=$data['campaign'][0]->campaignID?>).toString() + 'chat';
        var conn = new WebSocket('ws://192.168.1.158:8080');
        conn.onopen = function(e) {
            if (document.getElementById(chatID)) {
                msg = pc + " joined!";
                sendMessage(chatID, 'connection', msg);
            }
        };

        conn.onmessage = function(e) {
            msg = e.data.toString();
            msg = msg.split(';');
            if (msg[1] == chatID) {
                if (msg[0] != 'move') {
                    chatContent = chatContent.concat(msg[2] + "\n");
                    document.getElementById(chatID).textContent = chatContent;
                } else if (msg[0] == 'move') {
                    try {
                        movementContent = msg[2].split(',');

                        charUID = movementContent[0];
                        charPID = movementContent[1];
                        xCoord = movementContent[2];
                        yCoord = movementContent[3];
                        charName = movementContent[4];

                        //check to make sure the selected div doesn't contain another player's token
                        if (!document.getElementById('div:x' + xCoord + ':y' + yCoord).hasChildNodes()) {
                            if (document.getElementById('u' + charUID + 'p' + charPID)) {
                                document.getElementById('u' + charUID + 'p' + charPID).remove();
                                try {
                                    document.getElementById('u' + charUID + 'p' + charPID + 'name' + charName).remove();
                                } catch (error) {
                                    console.error(error);
                                }
                            }
                            //display character's name
                            charNameText = document.createElement("p");
                            charNameText.id = 'u' + charUID + 'p' + charPID + 'name' + charName;
                            charNameText.style = "font-size: 8pt; max-width: 8em; margin: 0; padding: 0;";
                            charNameText.textContent = charName;

                            // create character token on map
                            charToken = document.createElement("img");
                            charToken.id= 'u' + charUID + 'p' + charPID;
                            charToken.src = "<?=ROOT?>" + "img/characters/pcs/user" + charUID + "pc" + charPID + ".png";
                            charToken.style = 'object-fit: contain; max-width: 60%; aspect-ratio: 1/1; border-radius: 2vw; margin: 0; padding: 0;';

                            onerrorAttr = document.createAttribute("onerror");
                            onerrorAttr.value = "this.onerror=null; this.src='<?=ROOT?>img/characters/pcs/defaultpfp.jpg'";
                            charToken.setAttributeNode(onerror=onerrorAttr);

                            parentDiv = document.getElementById('div:x' + xCoord + ':y' + yCoord);
                            parentDiv.append(charNameText);
                            parentDiv.append(charToken);
                        }
                    } catch (error) {
                        console.error(error);
                    }
                }
            }
        }

        conn.onclose = function(e) {
            if (document.getElementById(chatID)) {
                msg = pc + " disconnected.";
                sendMessage(chatID, 'connection', msg);
            }
        }
        
        conn.onerror = function(e) {
            if (document.getElementById(chatID)) {
                msg = pc + " disconnected.";
                sendMessage(chatID, 'connection', msg);
            }
        }

        function sendMessage(campaign, type, content) {
            switch (type) {
                case 'connection':
                    if (content) {
                        document.getElementById(chatID).textContent = document.getElementById(chatID).textContent.concat(content.toString());
                        msg = type + ';' + campaign + ';' + content.toString();
                        conn.send(msg);
                    }
                break;
                case 'msg':
                    if (content) {
                        msg = content.toString().replaceAll(/"/g, '\"').replaceAll(/'/g, '\'').replaceAll(';', '');
                        msg = pc + ': ' + msg;
                        document.getElementById('messageInput').value = "";
                        document.getElementById(chatID).textContent = document.getElementById(chatID).textContent.concat(msg);
                        msg = type + ';' + campaign + ';' + msg;
                        conn.send(msg);
                    }
                break;
                case 'roll':
                    if (Number.isInteger(content)) {
                        if (content > 1) {
                            roll = (Math.floor(Math.random() * content) + 1);
                            msg = pc + ' rolled ' + roll.toString();
                            document.getElementById(chatID).textContent = document.getElementById(chatID).textContent.concat(msg);
                            msg = type + ';' + campaign + ';' + msg;
                            conn.send(msg);
                        } else if (content == 1) {
                            coin = Math.random()
                            msg = coin < 0.5 ? (pc + ' flipped heads.') : (pc + ' flipped tails.');
                            document.getElementById(chatID).textContent = document.getElementById(chatID).textContent.concat(msg);
                            msg = type + ';' + campaign + ';' + msg;
                            conn.send(msg);
                        }
                    }
                break;
                case 'move':
                    if (content.split(',').length == 5) {
                        msg = type + ';' + campaign + ';' + content;
                        conn.send(msg);
                    }
                break;
            }
        }
    </script>
<?php elseif (isset($_SESSION['userID'])) : ?>
    <div align="center" style="margin: 2vh;">
        <h1>Whoops, some sorcery has interfered with your URL bar!</h1>
        <h4>Head <a class="defaultLink" href="<?=ROOT?>campaign">back</a> to the campaigns menu to host a campaign or play as one of your characters.</h4>
    </div>
<?php else : ?>
    <div align="center" style="margin: 2vh;">
        <h1 style="display: inline;"><a class="defaultLink" href="<?=ROOT?>account/signin">Sign-in</a> to set forth on your journey.</h1>
        <h4 style="display: inline; margin-left: 3vw;"><a class="defaultLink" href="<?=ROOT?>campaign">← Back</a>&emsp;&emsp;<a class="defaultLink" style="margin-left: 3vw;">&#10683; Leave</a></h4>
    </div>
<?php endif; ?>

<?php include_once '../app/components/pagefooter.php'; ?>