<?php include_once '../app/components/pageheader.php'; ?>

<?php if (isset($_SESSION['message'])) {
    echo '<div class="accountDiv" style="margin-left: 2%; margin-top: 2%; max-width: max-content;"><p><strong>' . $_SESSION['message'] . '</strong></p></div>';
    unset($_SESSION['message']);
}
?>

<div style="height: 80vh; margin: auto; display: inline; background-image: url('<?=ROOT?>/img/maps/forest.jpg');">
    <div style="display: inline; margin: none;">
        <table>
            <?php for ($y=20; $y>0; --$y): ?>
                <tr>
                <?php for ($x=20; $x>0; --$x): ?>
                    <td>
                        <div style="max-width: 4vh; max-height: 4vh; margin: none;"><p>test<?="x".$x." & y".$y?></p></div>
                    </td>
                <?php endfor; ?>
                </tr>
            <?php endfor; ?>
        </table>
    </div>
    <div style="margin: none;">
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