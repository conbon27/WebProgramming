function submitf() {
	var name1 = document.conform.fname;
	var email = document.conform.email;
	var textbox = document.conform.message;

if(fname_validation(name1))
{
}
if(ValidateEmail(email))
{
}
if(message_val(textbox))
{
}
return false;
}

function fname_validation(name1)
{
var name1_len = name1.value.length;
if (name1_len == 0 )
{
window.alert("Please enter your name");
name1.focus();
return false;
}
else if(name1_len<=9)
{
window.alert("The Name field must contain at least 10 characters!")
return false;
    }else {
        return true;
    }	
}
function ValidateEmail(email)
{
var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
if(email.value.match(mailformat))
{
return true;
}
else
{
window.alert("Please enter a valid email address");
email.focus();
return false;
}
if(email_len<=9)
{
window.alert("The email field must contain at least 10 characters!")
return false;
    }else {
        return true;
    }	
}
function message_val(textbox)
{
	var text_len=textbox.value.length;
	if(text_len<=24)
	{
		window.alert("The Query field must contain at least 25 characters!")
	return false;
	textbox.focus();
	}else {
		return true;
	}
}

