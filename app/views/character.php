<?php require_once '../app/components/pageheader.php'; ?>

<?php if (isset($_SESSION['message'])) {
    echo '<div class="accountDiv" style="margin-left: 2%; margin-top: 2%; max-width: max-content;"><strong>' . $_SESSION['message'] . '</strong></p></div>';
    unset($_SESSION['message']);
}
?>

<div style="justify-content: center; max-width: max-content; margin: auto;">
    <?php if (is_array($data['pcs']) && (count($data['pcs']) < 5)): ?>
        <h2 align="center"><a href="character/createcharacter" style="text-decoration: none; text-decoration: underline;">Create Character</a></h2>
    <?php endif; ?>
    <?php if ($data['pcs'] !== false): ?>
        <?php foreach($data['pcs'] as $character): ?>
            <div align="center" style="width: 95%; height = (100%/<?=count($data['pcs'])?>); background-color: #B51A1A; border: solid 5px #6A0F0F; border-radius: 10px 10px 10px 10px;">
                <table style="margin-left: 2.5%; width: 70%;">
                    <tr>
                        <td><h4><?=$character->pcName?></h4></td>
                        <td>Level <?=$character->pcLevel?> <?=$character->pcRace?> <?=$character->pcClass?></td>
                        <td><?=$character->pcAlignment?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
                <img style="margin-left: 2.5%; width: 25%; border-radius: 5% 0 5% 0; border: solid black 5px;" src="
                <?php
                $charImgFolder = ROOT . 'img/characters/';
                $imgpath = $charImgFolder . $_SESSION['userID'] . $character->pcID . '.png';
                if (file_exists($imgpath)) { echo $imgpath; } else { echo $charImgFolder . 'defaultPC.png'; }
                ?>
                ">
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <h1>No characters to display</h1>
        <h2 align="center"><a href="<?=ROOT?>character/createcharacter" style="color: white; text-decoration: none; text-decoration: underline;">Create Character</a></h2>
    <?php endif; ?>
</div>

<?php require_once '../app/components/pagefooter.php'; ?>