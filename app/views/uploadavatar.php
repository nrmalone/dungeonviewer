<?php include_once '../app/components/pageheader.php'; ?>
<?php if (isset($_SESSION['userID']) && is_int($data['pc'][0]->pcID)) : ?>
    <?php $character = $data['pc'][0]; ?>
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            checkImageInput($_FILES['avatarUpload'], $character->pcID);
        }
    ?>
    <div class="pcDiv" style="max-width: max-content; max-height: 10%; margin-top: 2vh; margin-top: 2%; border-bottom: 5px solid #6A0F0F; margin-left: auto; margin-right: auto; padding: 0 2vw 0 2vw;">
        <table align="center" style="padding-bottom: 1vh;">
            <form method="POST" enctype="multipart/form-data">
                <!-- made a disabled & hidden submit button to prevent enter auto-submitting form -->
                <button type="submit" disabled style="display: none;"></button>
                <tr>
                    <td><a href="<?=ROOT?>character" style="color: white; text-decoration: none;"><button type="button" class="accountButton">← Back</button></a></td>
                    <td><h3>Uploading avatar for <?=$character->pcName?></h3></td>
                    <td><button class="accountButton" type="submit">Upload</button></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="file" name="avatarUpload" id="avatarUpload" class="accountButton"></td>
                    <td></td>
                </tr>
            </form>
        </table>        
    </div>
    <div align="center">
        <h3 id="avatarH3">Current Avatar for <?=$character->pcName?></h3>
        <img id="avatarPreview" style="border: solid black 3px; object-fit: contain; border-radius: 15px 0 15px 0; display: inline;"
            src="<?=ROOT.'img/characters/pcs/user'.$_SESSION['userID'].'pc'.$character->pcID?>.png"
            onerror="noAvatar();">
        <script type="text/javascript">
            function noAvatar() {
                document.getElementById('avatarH3').textContent = "No avatar uploaded yet!";
                document.getElementById('avatarPreview').style = "visibility: hidden;"
            }
        </script>
    </div>
<?php else: ?>

<?php endif; ?>

<?php include_once '../app/components/pagefooter.php'; ?>