<?php require_once '../app/components/pageheader.php';
if(isset($_SESSION['message'])) {
    echo '<div class="accountDiv" style="margin-left: 2%; margin-top: 2%; max-width: max-content;"><strong>' . $_SESSION['message'] . '</strong></p></div>';
    unset($_SESSION['message']);
}?>
<div style="justify-content: center; max-width: max-content; margin: auto;">
<!--
DONE: name, race, class, alignment, level, STR, DEX, CON, INT, WIS, CHA, AC
NEED: attribute modifiers, backstory, equipment, lifestyle, gold
-->
    <div style="margin-top: 55px;">
        <h1 align="center">Character Creation</h1>
        <div class="pcDiv" style="max-width: 100%; max-height: 50%; padding-top: 10px;">
            <form method="POST">
                <!-- made a disabled & hidden submit button to prevent enter auto-submitting form -->
                <button type="submit" disabled style="display: none;"></button>
                <!-- left half character creation -->
                <table style="display: inline; padding-left: 10px;">
                    <!-- Systems Reference Guide -->
                    <tr align="center">
                        <td style="border: 1px solid white; border-radius: 10px 0 0 0;">Need help<br> building a<br>character?</td>
                        <td align="left" style="border: 1px solid white; border-radius: 0 10px 0 0;">Check out the <a href="https://dnd.wizards.com/products/rpg_playershandbook" style="color: white; text-decoration: none; text-decoration: underline;" target="_blank">Player's Handbook</a> or the <a href="https://media.wizards.com/2023/downloads/dnd/SRD_CC_v5.1.pdf" style="color: white; text-decoration: none; text-decoration: underline;" target="_blank">SRD 5.1</a><br><span style="font-size: 10pt;"><em>We recommend the handbook since it directly supports<br> the publishers of D&D and contains important tips/context.</em></span></td>
                    </tr>
                    <tr>
                        <!-- spacer -->
                        <td style="padding-top: 1em;"></td>
                    </tr>
                    <!-- Name -->
                    <tr align="center">
                        <td class="pcCreationText">Name:&nbsp;</td>
                        <td align="left"><input class="textField" name="name" type="text" maxlength="16" required></td>
                    </tr>
                    <!-- Race -->
                    <tr align="center">
                        <td class="pcCreationText">Race:&nbsp;</td>
                        <td align="left"><select class="textField" name="race">
                            <?php foreach ($data['defaultRaces'] as $race) {
                                echo '<option value="' . $race . '">' . $race . '</option>';
                            }?>
                        </select></td>
                        <!--
                        <td align="left"><select class="textField" name="race">
                            <option value="Dragonborn">Dragonborn</option>
                            <option value="Dwarf">Dwarf</option>
                            <option value="Elf">Elf</option>
                            <option value="Gnome">Gnome</option>
                            <option value="Half-Elf">Half-Elf</option>
                            <option value="Halfling">Halfling</option>
                            <option value="Half-Orc">Half-Orc</option>
                            <option value="Human">Human</option>
                            <option value="Tiefling">Tiefling</option>
                        </select></td>
                        -->                            
                    </tr>
                    <!-- Class -->
                    <tr align="center">
                        <td class="pcCreationText">Class:&nbsp;</td>
                        <td align="left"><select class="textField" name="class">
                            <!--
                            <option value="Barbarian">Barbarian</option>
                            <option value="Bard">Bard</option>
                            <option value="Cleric">Cleric</option>
                            <option value="Druid">Druid</option>
                            <option value="Fighter">Fighter</option>
                            <option value="Monk">Monk</option>
                            <option value="Paladin">Paladin</option>
                            <option value="Ranger">Ranger</option>
                            <option value="Rogue">Rogue</option>
                            <option value="Sorcerer">Sorcerer</option>
                            <option value="Warlock">Warlock</option>
                            <option value="Wizard">Wizard</option>
                            -->
                        <!-- Commenting out this section. Reading the classes and alignments from $data
                        was causing header conflicts when trying to redirect after submission -->
                            <?php foreach($data['defaultClasses'] as $pcClass) {
                                echo '<option value="' . $pcClass . '">' . $pcClass . '</option>';
                            }?>
                        </select></td>
                    </tr>

                    <!-- Character Level -->
                    <tr align="center">
                        <td class="pcCreationText">Level:&nbsp;</td>
                        <td align="left"><select class="textField" name="level">
                            <?php for ($i=1; $i<21; $i++) {
                                echo '<option value = ' . $i . '>' . $i . '</option>';
                            } ?>
                        </select></td>
                        <td></td>
                    </tr>

                    <!-- Alignment -->
                    <tr align="center">
                        <td class="pcCreationText">Alignment:&nbsp;</td>
                        <td align="left">
                            <table>
                                <!--
                                <tr align="left">
                                    <td class="pcAlignment"><input id="lawfulGood" type="radio" name="alignment" value="Lawful Good"><label for="lawfulGood">Lawful Good</label></td>
                                    <td class="pcAlignment"><input id="neutralGood" type="radio" name="alignment" value="Neutral Good"><label for="neutralGood">Neutral Good</label></td>
                                    <td class="pcAlignment"><input id="lawfulGood" type="radio" name="alignment" value="Lawful Good"><label for="lawfulGood">Chaotic Good</label></td>
                                </tr>
                                <tr align="left">
                                    <td class="pcAlignment"><input id="lawfulNeutral" type="radio" name="alignment" value="Lawful Neutral"><label for="lawfulNeutral">Lawful Neutral</label></td>
                                    <td class="pcAlignment"><input id="trueNeutral" type="radio" name="alignment" value="True Neutral" checked><label for="trueNeutral">True Neutral</label></td>
                                    <td class="pcAlignment"><input id="chaoticGood" type="radio" name="alignment" value="Chaotic Good"><label for="chaoticGood">Chaotic Good</label></td>
                                </tr>
                                <tr align="left">
                                    <td class="pcAlignment"><input id="lawfulEvil" type="radio" name="alignment" value="Lawful Evil"><label for="lawfulEvil">Lawful Evil</label></td>
                                    <td class="pcAlignment"><input id="neutralEvil" type="radio" name="alignment" value="Neutral Evil"><label for="neutralEvil">Neutral Evil</label></td>
                                    <td class="pcAlignment"><input id="chaoticEvil" type="radio" name="alignment" value="Chaotic Evil"><label for="chaoticEvil">Chaotic Evil</label></td>
                                </tr>
                                -->
                                <!-- Commenting out this section. Reading the classes and alignments from $data
                                was causing header conflicts when trying to redirect after submission -->
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
                    <tr>
                        <td align="center" class="pcCreationText">Backstory:&nbsp;</td>
                        <!-- Can't get text wrapping working... disabled & removed from SQL for now -->
                        <td><input type="textarea" maxlength="2000" class="textField" style="width: 85%; height: 65px; word-wrap: break-word; overflow: scroll;" disabled></td>
                    </tr>
                </table>

                <!-- right side character creation -->
                <table style="display: inline; padding-right: 10px;">
                    <!-- Attributes -->
                    <!-- STR -->
                    <tr align="center">
                        <td style="text-decoration: underline;"><br>Attributes</td>
                    </tr>
                    <tr align="center">
                        <td class="pcCreationText">Strength:&nbsp;</td>
                        <td>
                            <p style="margin: 0;" id="strength">8</p><input type="hidden" id="strengthInput" name="strength">
                            <button class="attributeButton" type="button" onclick="decAttr('strength')">-</button>
                            <button class="attributeButton" type="button" onclick="incAttr('strength')">+</button>
                        </td>
                        <td style="font-size: 10pt;"><strong>Basic Point Buy Rules:</strong></td>
                    </tr>
                    <!-- DEX -->
                    <tr align="center">
                        <td class="pcCreationText">Dexterity:&nbsp;</td>
                        <td>
                            <p style="margin: 0;" id="dexterity">8</p><input type="hidden" id="dexterityInput" name="dexterity">
                            <button class="attributeButton" type="button" onclick="decAttr('dexterity')">-</button>
                            <button class="attributeButton" type="button" onclick="incAttr('dexterity')">+</button>
                        </td>
                        <td style="font-size: 10pt;">Min 8, Max 15 per attr.</td>
                    </tr>
                    <!-- CON -->
                    <tr align="center">
                        <td class="pcCreationText">Constitution:&nbsp;</td>
                        <td>
                            <p style="margin: 0;" id="constitution">8</p><input type="hidden" id="constitutionInput" name="constitution">
                            <button class="attributeButton" type="button" onclick="decAttr('constitution')">-</button>
                            <button class="attributeButton" type="button" onclick="incAttr('constitution')">+</button>
                        </td>
                        <td style="font-size: 10pt;">Buying 14→15 costs 2pts</td>
                    </tr>
                    <!-- INT -->
                    <tr align="center">
                        <td class="pcCreationText">Intelligence:&nbsp;</td>
                        <td>
                            <p style="margin: 0;" id="intelligence">8</p><input type="hidden" id="intelligenceInput" name="intelligence">
                            <button class="attributeButton" type="button" onclick="decAttr('intelligence')">-</button>
                            <button class="attributeButton" type="button" onclick="incAttr('intelligence')">+</button>
                        </td>
                        <td style="font-size: 10pt;"><p style="margin: 0;" id="remainingPts">Remaining Pts: 27</p></td>
                    </tr>
                    <!-- WIS -->
                    <tr align="center">
                        <td class="pcCreationText">Wisdom:&nbsp;</td>
                        <td>
                            <p style="margin: 0;" id="wisdom">8</p><input type="hidden" id="wisdomInput" name="wisdom">
                            <button class="attributeButton" type="button" onclick="decAttr('wisdom')">-</button>
                            <button class="attributeButton" type="button" onclick="incAttr('wisdom')">+</button>
                        </td>
                        <td style="font-size: 10pt;">We'll auto-calculate modifiers later</td>
                    </tr>
                    <!-- CHA -->
                    <tr align="center">
                        <td class="pcCreationText">Charisma:&nbsp;</td>
                        <td>
                            <p style="margin: 0;" id="charisma">8</p><input type="hidden" id="charismaInput" name="charisma">
                            <button class="attributeButton" type="button" onclick="decAttr('charisma')">-</button>
                            <button class="attributeButton" type="button" onclick="incAttr('charisma')">+</button>
                        </td>
                        <td style="font-size: 10pt;"></td>
                    </tr>
                    
                    <!-- Armor -->
                    <tr align="center">
                        <td class="pcCreationText">Armor:&nbsp;</td>
                        <td><select class="textField" name="armor">
                            <option value="0">None</option>
                            <optgroup label="Light Armor">
                                <option value="11">Padded</option>
                                <option value="11">Leather</option>
                                <option value="12">Studded leather</option>
                            </optgroup>
                            <optgroup label="Medium Armor">
                                <option value="12">Hide</option>
                                <option value="13">Chain shirt</option>
                                <option value="14">Scale mail</option>
                                <option value="14">Breastplate</option>
                                <option value="15">Half plate</option>
                            </optgroup>
                            <optgroup label="Heavy Armor">
                                <option value="14">Ring mail</option>
                                <option value="16">Chain mail</option>
                                <option value="17">Splint</option>
                                <option value="18">Plate</option>
                            </optgroup>
                        </select></td>
                        <td align="left"><input type="checkbox" class="textField" id="shield" name="shield" value="2"><label for="shield" style="font-size: 10pt;" >Shield (+2)</label></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="center">
                            <button class="accountButton" style="margin-top: 15px;">Submit</button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>

<script src="<?=ROOT?>js/charattribs.js"></script>

<?php require_once '../app/components/pagefooter.php'; ?>