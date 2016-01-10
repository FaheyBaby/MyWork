// THIS JAVASCRIPT WAS DONE BY GAVIN FAHEY
// THIS IS THE FUNCTION THAT POPS OPEN THE POPUP DIV IN THE HTML AND CLOSES IT
function signUp()
{
	var x = document.getElementsByClassName("popup");

	if(x[0].style.zIndex != "1")
	{
		x[0].style.zIndex = "1";		
	}
	else
	{
		x[0].style.zIndex = "-1";
	}
}

function login()
{
	var y = document.getElementsByClassName("first_login");

	if(y[0].style.zIndex != "1")
	{
		y[0].style.zIndex = "1";		
	}
	else
	{
		y[0].style.zIndex = "-1";
	}
}