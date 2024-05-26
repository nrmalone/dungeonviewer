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
                    <td style="margin: none; border: 1px solid black; width: 4vw; height: (4*(10/8))vw; max-width: 4vw; max-height: (4*(10/8))vw; aspect-ratio:1/1;">
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
            <!-- display all PCs for the DM to manage -->
            <tr style="text-wrap: balance;">
                <td style="font-size: 14pt;">
                    PC name
                </td>
                <td>

                </td>
            </tr>
        </table>
    </div>
</div>
<script type="text/javascript">
    var conn = new WebSocket('ws://localhost:8080');
    conn.onopen = function(e) {
        console.log("Connection established!");
    };

    conn.onmessage = function(e) {
        console.log(e.data);
    }


</script>


<?php include_once '../app/components/pagefooter.php'; ?>