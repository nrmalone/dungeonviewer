//create custom element
//https://medium.com/samsung-internet-dev/how-to-create-custom-elements-in-html-ae8d5a834eb2#:~:text=Custom%20Elements%20are%20a%20way,class%20must%20respond%20to%20changes.

//check if image exists
//https://www.kirupa.com/html5/checking_if_a_file_exists.htm

class CharacterElement extends HTMLElement {
    static get observedAttributes() {
        return ['id', 'userID', 'pcID'];
    }

    get userID() {
        return this.getAttribute('userID');
    }
    get pcID() {
        return this.getAttribute('pcID');
    }

    attributeChangedCallback(attrName, oldVal, newVal) {
        this.render();
    }

    render() {
        var characterElem = '<div>';
        
        if (doesFileExist('../img/characters/'+this.userID+'p'+this.pcID+'.png' != false)) {
            characterElem += '<img style="object-fit: contain;" src="../img/characters/u'+this.userID+'p'+this.pcID+'.png">';
        } else {
            characterElem += '<img style="object-fit: contain;" src="../img/characters/defaultpfp.jpg">'            
        }

        characterElem += '</div>';
    }
}

function doesFileExist(urlToFile) {
    var xhr = new XMLHttpRequest();
    xhr.open('HEAD', urlToFile, false);
    xhr.send();

    if (xhr.status == "404") {
        return false;
    } else {
        return true;
    }
}