<?php include_once '../app/components/pageheader.php'; ?>

<?php if (isset($_SESSION['message'])) {
    echo '<div class="accountDiv" style="margin-left: 2%; margin-top: 2%; max-width: max-content;"><p><strong>' . $_SESSION['message'] . '</strong></p></div>';
    unset($_SESSION['message']);
}
?>

<div align="center" style="margin: 2vh;">

</div>
<div  align="center" style="margin: auto;">
    <div class="forest" style=" width: 80vw; display: inline-block; margin: none;">
        <table>
            <?php for ($y=1; $y<=20; ++$y): ?>
                <tr>
                <?php for ($x=1; $x<=25; ++$x): ?>
                    <td>
                        <div id="div:<?='x'.$x.':y'.$y?>" style="max-width: 3vw; max-height: 3vw; margin: none;">
                            <input id="cell:<?='x'.$x.':y'.$y?>" type="radio" name="currentCell" value="cell:<?'x'.$x.':y'.$y?>"><label for=""></label>
                        </div>
                    </td>
                <?php endfor; ?>
                </tr>
            <?php endfor; ?>
        </table>
    </div>
    <div style="width: 10vw; margin: none; display: inline-block; vertical-align: top;">
        <table>
            <tr>
                <td>
                    test
                </td>
                <td>
                    test
                </td>
            </tr>
            <tr>
                <td>
                    blah
                </td>
                <td>
                    blah
                </td>
            </tr>
        </table>
    </div>
</div>


<?php include_once '../app/components/pagefooter.php'; ?>