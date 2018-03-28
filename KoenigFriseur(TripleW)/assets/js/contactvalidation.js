//determine whether the form is valid
function validation() {
	document.getElementById("nameerror").innerHTML = "";
	document.getElementById("emailerror").innerHTML = "";
	document.getElementById("messageerror").innerHTML = "";
	document.getElementById("recaptchaerror").innerHTML = "";
	var valid = true;
	var emailValid = true;
	
	if(document.forms[0].elements[3].value == "") {
		document.getElementById("recaptchaerror").innerHTML = "*Please click the validatebox!";
		return false;
	}
	
	//determine whether email is valid
	if (document.forms[0].elements[1].value == "") {
		document.getElementById("emailerror").innerHTML = "*Please fill your Email!";
		valid = false;
		emailValid = false
	} else {
		var x = "" + document.forms[0].elements[1].value;
		var attr = x.indexOf("@");
		if (attr < 1) {
			document.getElementById("emailerror").innerHTML = "*Email address not valid!";
			valid = false;
			emailValid = false
		} else {
			var dot = x.substring(attr).indexOf(".");
			if (dot < 2) {
				document.getElementById("emailerror").innerHTML = "*Email address not valid!";
				valid = false;
				emailValid = false
			} else {
				if ((dot + 2) >= x.substring(attr).length) {
					document.getElementById("emailerror").innerHTML = "*Email address not valid!";
					valid = false;
					emailValid = false
				}
			}
		}
	}
	
	//determine whether name is filled
	if (document.forms[0].elements[0].value == "") {
		document.getElementById("nameerror").innerHTML = "*Please fill your name!";
		valid = false;
		if (emailValid == true) {
			document.getElementById("emailerror").innerHTML = "Email valid.";
			document.getElementById("emailerror").style.color = "#f9f9f9";
		}
	}
	
	//determine whether message is filled
	if (document.forms[0].elements[2].value == "") {
		document.getElementById("messageerror").innerHTML = "*Please write your message!";
		valid = false;
	}
	
	if (valid == false) {
		return false;
	} else {
		return true;
	}
}