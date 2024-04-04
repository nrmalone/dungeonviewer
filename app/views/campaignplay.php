<?php include_once '../app/components/pageheader.php'; ?>

<?php if (isset($_SESSION['message'])) {
    echo '<div class="accountDiv" style="margin-left: 2%; margin-top: 2%; max-width: max-content;"><p><strong>' . $_SESSION['message'] . '</strong></p></div>';
    unset($_SESSION['message']);
}
?>

<div align="center" style="margin: 2vh;">
    <h1 style="display: inline;">Playing <em><?=$data['campaign'][0]->campaignName?></em></h1>
    <h4 style="display: inline; margin-left: 3vw;"><a class="defaultLink" href="<?=ROOT?>campaign">← Back</a>&emsp;&emsp;<a class="defaultLink" style="margin-left: 3vw;">&#10683; Leave</a></h4>
</div>
<div align="center" style="margin: auto;">
    <div class="forest" style="width: 80vw; display: inline-block; margin: none; border: 0.75vw solid #6A0F0F; border-radius: 1vw 1vw 1vw 1vw;">
        <table>
            <?php for ($y=1; $y<=20; ++$y): ?>
                <tr>
                <?php for ($x=1; $x<=25; ++$x): ?>
                    <td style="margin: none; border: 1px solid black; width: 4vw; height: (4*(10/8))vw; max-width: 4vw; max-height: (4*(10/8))vw;">
                        <div id="div:<?='x'.$x.':y'.$y?>" style="aspect-ratio: 1000/800; margin: none;">
                            <input id="cell:<?='x'.$x.':y'.$y?>" type="radio" name="currentCell" value="cell:<?'x'.$x.':y'.$y?>" style="display: none;"><label for="cell:<?='x'.$x.':y'.$y?>"><p style="font-size: 8pt; margin: none; display: contents; overflow: hidden; display: block; text-align: end; vertical-align: bottom;"><?='x'.$x.' y'.$y?></p></label>
                        </div>
                    </td>
                <?php endfor; ?>
                </tr>
            <?php endfor; ?>
        </table>
    </div>
    <div class="mapRightMenu" style="margin: none; display: inline-block; vertical-align: top; max-width: max-content;">
        <table>
            <tr style="text-wrap: balance;">
                <td style="font-size: 14pt;">
                    <?=$data['pc'][0]->pcName?>
                </td>
                <td>
                    <span>HP: <p id="currentHP" style="display: inline; margin: none;"><?=$data['pc'][0]->pcHP?></p>/<?=$data['pc'][0]->pcHP?></span>
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
                    <?=$data['pc'][0]->pcSTR?>
                </td>
            </tr>
            <tr>
                <td align="right">
                    DEX
                </td>
                <td>
                    <?=$data['pc'][0]->pcDEX?>
                </td>
            </tr>
            <tr>
                <td align="right">
                    CON
                </td>
                <td>
                    <?=$data['pc'][0]->pcCON?>
                </td>
            </tr>
            <tr>
                <td align="right">
                    INT
                </td>
                <td>
                    <?=$data['pc'][0]->pcINT?>
                </td>
            </tr>
            <tr>
                <td align="right">
                    WIS
                </td>
                <td>
                    <?=$data['pc'][0]->pcWIS?>
                </td>
            </tr>
            <tr>
                <td align="right">
                    CHA
                </td>
                <td>
                    <?=$data['pc'][0]->pcCHA?>
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

                </td>
                <td>

                </td>
            </tr>
        </table>
    </div>
</div>


<?php include_once '../app/components/pagefooter.php'; ?>