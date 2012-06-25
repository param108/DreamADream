function deleteDream(elem) {
    var parent = elem.parentNode;
    var parentparent = parent.parentNode;
    parentparent.removeChild(parent);
}
function createDream(input) {
    newDiv = document.createElement('div');
    newPara = document.createElement('p');
    newPara.appendChild(document.createTextNode(input.value));
    var buttonnode= document.createElement('input');
    buttonnode.setAttribute('type','button');
    buttonnode.setAttribute('name','X');
    buttonnode.setAttribute('value','X');
    buttonnode.setAttribute('class','dreamBtn');
    // For IE
    buttonnode.setAttribute('className','dreamBtn');
    buttonnode.onclick = function() { deleteDream(buttonnode); }
    newPara.appendChild(buttonnode);
    newDiv.appendChild(newPara);
    return newDiv;
}
function addDream() {
    var myTextField = document.getElementById('dreamText');
    myTextField.innerHTML="";
    if (myTextField.value == "") {
	alert("Would you please enter some text?")
	return false;
    }
    //have a valid dream add it to the DreamTable
    var myDreamTable=document.getElementById('DreamTable');
    var newDream=createDream(myTextField);
    myDreamTable.appendChild(newDream);
    myTextField.value = "";
    return false;
}

function TextHandlerEnter(ev) {
    var key;
    if (window.event)
	key = window.event.keyCode;
    else
	key = ev.which
    if (key == 13) {
	var submit = document.getElementById("FinalSubmit");
	submit.click();
	ev.keyCode = 0;
	var textArea = document.getElementById("dreamText");
	textArea.value = "";	
	return false;
    }
}

function clearDream() {
    var myTextField = document.getElementById('dreamText');
    myTextField.innerHTML="";
}