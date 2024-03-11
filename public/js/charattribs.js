currentURL = window.location.href;
characterURL = currentURL.replace('createcharacter', '');

let pointsPool = 27;

function decAttr(attr) {
    switch (attr) {
        case 'strength':
            strengthP = document.getElementById('strength');
            currentstrength = parseInt(strengthP.textContent);
            if ((currentstrength == 15) && (pointsPool<=21)) {
                newstrength = 14;
                pointsPool += 2;
            } else if ((currentstrength > 8) && (currentstrength < 15) && (pointsPool<=26)) {
                newstrength = currentstrength - 1;
                pointsPool += 1;
            } else {
                newstrength = currentstrength;
            }
            strengthInput = document.getElementById('strengthInput');
            strengthInput.value = newstrength;
            strengthP.textContent = newstrength;
            
            remainingPts = document.getElementById('remainingPts');
            remainingPts.textContent = 'Remaining Pts: ' + pointsPool;
        break;

        case 'dexterity':
            dexterityP = document.getElementById('dexterity');
            currentdexterity = parseInt(dexterityP.textContent);
            if ((currentdexterity == 15) && (pointsPool<=21)) {
                newdexterity = 14;
                pointsPool += 2;
            } else if ((currentdexterity > 8) && (currentdexterity < 15) && (pointsPool<=26)) {
                newdexterity = currentdexterity - 1;
                pointsPool += 1;
            } else {
                newdexterity = currentdexterity;
            }
            dexterityInput = document.getElementById('dexterityInput');
            dexterityInput.value = newdexterity;
            dexterityP.textContent = newdexterity;
            
            remainingPts = document.getElementById('remainingPts');
            remainingPts.textContent = 'Remaining Pts: ' + pointsPool;
        break;

        case 'constitution':
            constitutionP = document.getElementById('constitution');
            currentconstitution = parseInt(constitutionP.textContent);
            if ((currentconstitution == 15) && (pointsPool<=21)) {
                newconstitution = 14;
                pointsPool += 2;
            } else if ((currentconstitution > 8) && (currentconstitution < 15) && (pointsPool<=26)) {
                newconstitution = currentconstitution - 1;
                pointsPool += 1;
            } else {
                newconstitution = currentconstitution;
            }
            constitutionInput = document.getElementById('constitutionInput');
            constitutionInput.value = newconstitution;
            constitutionP.textContent = newconstitution;
            
            remainingPts = document.getElementById('remainingPts');
            remainingPts.textContent = 'Remaining Pts: ' + pointsPool;
        break;

        case 'intelligence':
            intelligenceP = document.getElementById('intelligence');
            currentintelligence = parseInt(intelligenceP.textContent);
            if ((currentintelligence == 15) && (pointsPool<=21)) {
                newintelligence = 14;
                pointsPool += 2;
            } else if ((currentintelligence > 8) && (currentintelligence < 15) && (pointsPool<=26)) {
                newintelligence = currentintelligence - 1;
                pointsPool += 1;
            } else {
                newintelligence = currentintelligence;
            }
            intelligenceInput = document.getElementById('intelligenceInput');
            intelligenceInput.value = newintelligence;
            intelligenceP.textContent = newintelligence;
            
            remainingPts = document.getElementById('remainingPts');
            remainingPts.textContent = 'Remaining Pts: ' + pointsPool;
        break;

        case 'wisdom':
            wisdomP = document.getElementById('wisdom');
            currentwisdom = parseInt(wisdomP.textContent);
            if ((currentwisdom == 15) && (pointsPool<=21)) {
                newwisdom = 14;
                pointsPool += 2;
            } else if ((currentwisdom > 8) && (currentwisdom < 15) && (pointsPool<=26)) {
                newwisdom = currentwisdom - 1;
                pointsPool += 1;
            } else {
                newwisdom = currentwisdom;
            }
            wisdomInput = document.getElementById('wisdomInput');
            wisdomInput.value = newwisdom;
            wisdomP.textContent = newwisdom;
            
            remainingPts = document.getElementById('remainingPts');
            remainingPts.textContent = 'Remaining Pts: ' + pointsPool;
        break;

        case 'charisma':
            charismaP = document.getElementById('charisma');
            currentcharisma = parseInt(charismaP.textContent);
            if ((currentcharisma == 15) && (pointsPool<=21)) {
                newcharisma = 14;
                pointsPool += 2;
            } else if ((currentcharisma > 8) && (currentcharisma < 15) && (pointsPool<=26)) {
                newcharisma = currentcharisma - 1;
                pointsPool += 1;
            } else {
                newcharisma = currentcharisma;
            }
            charismaInput = document.getElementById('charismaInput');
            charismaInput.value = newcharisma;
            charismaP.textContent = newcharisma;
            
            remainingPts = document.getElementById('remainingPts');
            remainingPts.textContent = 'Remaining Pts: ' + pointsPool;
        break;
    }
}

function incAttr(attr) {
    switch (attr) {
        case 'strength':
            strengthP = document.getElementById('strength');
            currentstrength = parseInt(strengthP.textContent);
            if ((currentstrength == 14) && (pointsPool >= 2)) {
                newstrength = currentstrength + 1;
                pointsPool -= 2;
            } else if ((currentstrength >= 8) && (currentstrength < 14) && (pointsPool>0)) {
                newstrength = currentstrength + 1;
                pointsPool -= 1;
            } else {
                newstrength = currentstrength;
            }
            strengthInput = document.getElementById('strengthInput');
            strengthInput.value = newstrength;
            strengthP.textContent = newstrength;
            
            remainingPts = document.getElementById('remainingPts');
            remainingPts.textContent = 'Remaining Pts: ' + pointsPool;
        break;

        case 'dexterity':
            dexterityP = document.getElementById('dexterity');
            currentdexterity = parseInt(dexterityP.textContent);
            if ((currentdexterity == 14) && (pointsPool >= 2)) {
                newdexterity = currentdexterity + 1;
                pointsPool -= 2;
            } else if ((currentdexterity >= 8) && (currentdexterity < 14) && (pointsPool>0)) {
                newdexterity = currentdexterity + 1;
                pointsPool -= 1;
            } else {
                newdexterity = currentdexterity;
            }
            dexterityInput = document.getElementById('dexterityInput');
            dexterityInput.value = newdexterity;
            dexterityP.textContent = newdexterity;
            
            remainingPts = document.getElementById('remainingPts');
            remainingPts.textContent = 'Remaining Pts: ' + pointsPool;
        break;

        case 'constitution':
            constitutionP = document.getElementById('constitution');
            currentconstitution = parseInt(constitutionP.textContent);
            if ((currentconstitution == 14) && (pointsPool >= 2)) {
                newconstitution = currentconstitution + 1;
                pointsPool -= 2;
            } else if ((currentconstitution >= 8) && (currentconstitution < 14) && (pointsPool>0)) {
                newconstitution = currentconstitution + 1;
                pointsPool -= 1;
            } else {
                newconstitution = currentconstitution;
            }
            constitutionInput = document.getElementById('constitutionInput');
            constitutionInput.value = newconstitution;
            constitutionP.textContent = newconstitution;
            
            remainingPts = document.getElementById('remainingPts');
            remainingPts.textContent = 'Remaining Pts: ' + pointsPool;
        break;

        case 'intelligence':
            intelligenceP = document.getElementById('intelligence');
            currentintelligence = parseInt(intelligenceP.textContent);
            if ((currentintelligence == 14) && (pointsPool >= 2)) {
                newintelligence = currentintelligence + 1;
                pointsPool -= 2;
            } else if ((currentintelligence >= 8) && (currentintelligence < 14) && (pointsPool>0)) {
                newintelligence = currentintelligence + 1;
                pointsPool -= 1;
            } else {
                newintelligence = currentintelligence;
            }
            intelligenceInput = document.getElementById('intelligenceInput');
            intelligenceInput.value = newintelligence;
            intelligenceP.textContent = newintelligence;
            
            remainingPts = document.getElementById('remainingPts');
            remainingPts.textContent = 'Remaining Pts: ' + pointsPool;
        break;

        case 'wisdom':
            wisdomP = document.getElementById('wisdom');
            currentwisdom = parseInt(wisdomP.textContent);
            if ((currentwisdom == 14) && (pointsPool >= 2)) {
                newwisdom = currentwisdom + 1;
                pointsPool -= 2;
            } else if ((currentwisdom >= 8) && (currentwisdom < 14) && (pointsPool>0)) {
                newwisdom = currentwisdom + 1;
                pointsPool -= 1;
            } else {
                newwisdom = currentwisdom;
            }
            wisdomInput = document.getElementById('wisdomInput');
            wisdomInput.value = newwisdom;
            wisdomP.textContent = newwisdom;
            
            remainingPts = document.getElementById('remainingPts');
            remainingPts.textContent = 'Remaining Pts: ' + pointsPool;
        break;

        case 'charisma':
            charismaP = document.getElementById('charisma');
            currentcharisma = parseInt(charismaP.textContent);
            if ((currentcharisma == 14) && (pointsPool >= 2)) {
                newcharisma = currentcharisma + 1;
                pointsPool -= 2;
            } else if ((currentcharisma >= 8) && (currentcharisma < 14) && (pointsPool>0)) {
                newcharisma = currentcharisma + 1;
                pointsPool -= 1;
            } else {
                newcharisma = currentcharisma;
            }
            charismaInput = document.getElementById('charismaInput');
            charismaInput.value = newcharisma;
            charismaP.textContent = newcharisma;
            
            remainingPts = document.getElementById('remainingPts');
            remainingPts.textContent = 'Remaining Pts: ' + pointsPool;
        break;
    }
}