<?php require_once '../app/components/pageheader.php'; ?>

<?php if (isset($_SESSION['message'])) {
    echo '<div class="accountDiv" style="margin-left: 2%; margin-top: 2%; max-width: max-content;"><strong>' . $_SESSION['message'] . '</strong></p></div>';
    unset($_SESSION['message']);
}
?>

<div style="justify-content: center; max-width: max-content; margin: auto;">
    <?php if ($data['pcs'] !== false): ?>
        <?php foreach ($data['pcs'] as $character): ?>
            <div class="pcDiv" style="max-width: 100%; max-height: 50%; padding-top: 10px; margin-top: 5%; border-bottom: 5px solid #6A0F0F;">
                <table style="display: inline; padding-left: 10px;">
                    <tr align="center">
                        <td><h4 style="margin: 0;"><?=$character->pcName?></h4></td>
                        <td style="font-size: 10pt;">STR <?=$character->pcSTR?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="font-size: 10pt;">DEX <?=$character->pcDEX?></td>
                    </tr>
                    <tr>
                        <td style="display: inline;">Level <?=$character->pcLevel?></td>
                        <td style="font-size: 10pt;">CON <?=$character->pcCON?></td>
                    </tr>
                    <tr>
                        <td><?=$character->pcRace?></td>
                        <td style="font-size: 10pt;">INT <?=$character->pcINT?></td>
                    </tr>
                    <tr>
                        <td><?=$character->pcClass?></td>
                        <td style="font-size: 10pt;">WIS <?=$character->pcWIS?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="font-size: 10pt;">CHA <?=$character->pcCHA?></td>
                    </tr>
                </table>
                <table style="display: inline; padding: 0 10px 0 10px">
                    <tr>
                        <td align="center"><a href="<?=ROOT?>character/editcharacter/<?=$character->pcID?>" style="color: white; text-decoration: none; text-decoration: underline;">Edit <?=$character->pcName?></a>&emsp;&emsp;<a href="<?=ROOT?>character/modeler/<?=$character->pcID?>" style="color: white; text-decoration: none; text-decoration: underline;">Create avatar for <?=$character->pcName?></a></td>
                    </tr>
                    <tr>
                        <td><img style="margin-left: 2.5%; width: 30vw; border: solid black 3px;  border-radius: 15px 0 15px 0; display: inline; aspect-ratio: 1/1; object-fit: cover;" src="<?php
                            $charImgFolder = ROOT . 'img/characters/';
                            $imgpath = $charImgFolder . 'u' . $_SESSION['userID'] . 'p' . $character->pcID . '.png';
                            if (file_exists($imgpath)) { echo $imgpath; } else { echo $charImgFolder . 'defaultPC.png'; } ?>"></td>
                    </tr>
                </table>
            </div>    
        <?php endforeach; ?>
    <?php else: ?>
        <h1>No characters to display</h1>
        <h2 align="center"><a href="<?=ROOT?>character/createcharacter" style="color: white; text-decoration: none; text-decoration: underline;">Create Character</a></h2>
    <?php endif; ?>
    <?php if (is_array($data['pcs']) && (count($data['pcs']) < 5)): ?>
        <h2 align="center"><a href="character/createcharacter" style="text-decoration: none; text-decoration: underline;">Create Character</a></h2>
    <?php endif; ?>
</div>

<?php require_once '../app/components/pagefooter.php'; ?>