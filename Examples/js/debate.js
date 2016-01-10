// THIS JAVASCRIPT WAS DONE BY GAVIN FAHEY
// THIS IS THE FUNCTION THAT POPS OPEN THE POPUP DIV IN THE HTML AND CLOSES IT
var a = document.getElementsByClassName("popup");

var b = document.getElementsByClassName("first_login");

function signUp()
{
	if(a[0].style.zIndex != "1")
	{
		if(b[0].style.zIndex = "1")
		{
			b[0].style.zIndex = "-1";
		}

		a[0].style.zIndex = "1";		
	}
	else
	{
		a[0].style.zIndex = "-1";
	}
}

function login()
{
	if(b[0].style.zIndex != "1")
	{
		if(a[0].style.zIndex = "1")
		{
			a[0].style.zIndex = "-1";
		}
		
		b[0].style.zIndex = "1";		
	}
	else
	{
		b[0].style.zIndex = "-1";
	}
}

var c = document.getElementsByClassName("sub-menu");

function menu()
{
	if(c[0].style.opacity != "1")
	{
		c[0].style.opacity = "1";
		c[0].style.zIndex = "1";
	}
	else
	{
		c[0].style.opacity = "0";
		c[0].style.zIndex = "-1";
	}
}

function send_post()
{
	var hr = new XMLHttpRequest();
	var url = "send_post.php";
	var fn = document.getElementById("post").value;
	var vars = "post="+fn;
	hr.open("POST", url, true);
	hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	hr.onreadystatechanged = function()
	{
		if (hr.readyState == 4 && hr.status == 200)
		{
			var return_data = hr.responseText;
			document.getElementById("status").innerHTML = return_data;
		}
	}
	hr.send(vars);
	document.getElementById("status").innerHTML = "processing...";
}

function dark()
{
	var g = document.getElementsByClassName("postDebate");

	if(g[0].style.zIndex != "10")
	{
		g[0].style.zIndex = "10";
		g[0].style.opacity = "1";
		g[0].style.boxShadow ="0px 0px 1px 5000px rgba(0,0,0,0.8)";
	}
	else
	{
		g[0].style.zIndex = "-1";
		g[0].style.opacity = "0";
		g[0].style.boxShadow = "";
	}
}