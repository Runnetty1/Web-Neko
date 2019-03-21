function toggleSidebar(){
	document.getElementById("sidebar").classList.toggle("active");
}

function toggleAccountPanel(){
	document.getElementById("account-panel").classList.toggle("active");
}
//Make sure this is not visible for randoms!!
function generateSerial() {

    let subChars1 = 'ACDFGHIJLMPQRSTUVXYZ';
	let subChars2 = '124569BCDEFGHIJKLNOPQRUVWXYZbcdefghijklmnopqruvwxyz';
	let subChars3 = '1234567890BCDEFGJKLMNOPQTUVXYZbcdefgjklmnopqtuv';
    
	randomSerial = genSubString(subChars1)+"-"+genSubString(subChars2)+"-"+genSubString(subChars3);
	
	
  document.getElementById('serial').value = randomSerial;
  document.getElementById('serialh').value = randomSerial;
    
}

function genSubString( chars){
	let subString ="";
	let randomNumber;
	for (let i = 0; i < 5; i++) {
        
        randomNumber = Math.floor(Math.random() * chars.length);
        
        subString += chars.substring(randomNumber, randomNumber + 1);
    }
	return subString;
}