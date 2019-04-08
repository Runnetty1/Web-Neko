function toggleSidebar(){
	document.getElementById("sidebar").classList.toggle("active");
}

function toggleAccountPanel(){
	document.getElementById("account-panel").classList.toggle("active");
}

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
let profileDataNames = ['about-data', 'education-data','work-data'];


function viewDataBox(id){
	document.getElementById("about-data").classList.toggle("active");
	disableviewDataBoxes(id);
}

function disableviewDataBoxes(excludeID){
	for (let i = 0; i < profileDataNames.length; i++) {
        if(profileDataNames[i] != excludeID){
			document.getElementById(profileDataNames[i]).classList.toggle("disabled");
		}
    }
}


var adata = {
  name: "about-data",
  loc: "system/layouts/layout_profile_about.php",
  active: "true"
};

var edata = {
  name: "education-data",
  loc: "system/layouts/layout_profile_education.php",
  active: "false"
};

var wdata = {
  name: "education-data",
  loc: "system/layouts/layout_profile_work.php",
  active: "false"
};


function viewdata(user,id){
	//window.location.replace("/user_home?user="+user+"&view="+id");
	let a = "user_home?user="+user+"&view="+id;
	window.location.href = a;
	//myRedirect("/user_home?user="+user+"&view="+id", "arg", "argValue");
}

var myRedirect = function(redirectUrl, arg, value) {
  var form = $('<form action="' + redirectUrl + '" method="post">' +
  '<input type="hidden" name="'+ arg +'" value="' + value + '"></input>' + '</form>');
  $('body').append(form);
  $(form).submit();
};