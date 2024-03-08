<?php require_once '../app/components/pageheader.php'; ?>

<?php if (isset($_SESSION['message'])) {
    echo '<div class="accountDiv" style="margin-left: 2%; margin-top: 2%; max-width: max-content;"><strong>' . $_SESSION['message'] . '</strong></p></div>';
    unset($_SESSION['message']);
}
?>

<?php /*
DONE: name, race, class, alignment
NEED: level, AC, STR, DEX, CON, INT, WIS, CHA
*/ ?>

<div style="justify-content: center; max-width: max-content; margin: auto;">
    <div class="pcDiv" style="max-width: 100%; max-height: 50%;">
        <form>
            <!-- left half character creation -->
            <table style="display: inline;">
                <tr align="center">
                    <td class="pcCreationText">Name:&nbsp;</td>
                    <td align="left"><input class="textField" name="name" type="text"></td>
                </tr>
                <tr align="center">
                    <td class="pcCreationText">Race:&nbsp;</td>
                    <td align="left"><select class="textField" name="race">
                        <?php foreach($data['defaultRaces'] as $race) {
                            echo '<option value="' . $race . '">' . $race . '</option>';
                        } ?>
                    </select></td>
                </tr>
                <tr align="center">
                    <td class="pcCreationText">Class:&nbsp;</td>
                    <td align="left"><select class="textField" name="class">
                        <?php foreach($data['defaultClasses'] as $class) {
                            echo '<option value = "' . $class . '">' . $class . '</option>';
                        } ?>
                    </select></td>
                </tr>
                <tr align="center">
                    <td class="pcCreationText">Alignment:&nbsp;</td>
                    <td align="left">
                        <table>
                            <tr align="left">
                        <?php for ($i=0; $i<count($data['alignments']); $i++) {
                            if($i === 3) {
                                echo '</tr><tr align="left">';
                            }
                            if ($i === 6) {
                                echo '</tr><tr align="left">';
                            }
                            if ($data['alignments'][$i] === 'True Neutral') {
                                echo '<td class="pcAlignment"><input id="' . $data['alignments'][$i] . '" type="radio" name="alignment" value="' . $data['alignments'][$i] . '" checked><label for="' . $data['alignments'][$i] . '">' . $data['alignments'][$i] . '</label></td>';
                            } else {
                                echo '<td class="pcAlignment"><input id="' . $data['alignments'][$i] . '" type="radio" name="alignment" value="' . $data['alignments'][$i] . '""><label for="' . $data['alignments'][$i] . '">' . $data['alignments'][$i] . '</label></td>';
                            }
                        }
                        echo '</tr>';
                        ?>
                        </table>
                    </td>
                </tr>
            </table>
            <!-- right side character creation -->
            <table style="display: inline;">
                <tr>
                    <td class="pcCreationText">Level:</td>
                    <td><input class="textField" type="number" min="1" max="20" value="1"></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php require_once '../app/components/pagefooter.php'; ?>