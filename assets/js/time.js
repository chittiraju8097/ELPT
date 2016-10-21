var max_time = 0;
var t;
var ti;
function countdown_timer()
{
	max_time=max_time+1;
	document.getElementById('countdown').innerHTML = max_time;
	clearTimeout(t);
}
t=setInterval('countdown_timer()',1000); 
function alertType()
{
	x=document.getElementById("total").value;
	if(max_time>20)
	{
		var r=confirm("Are you Sure?");
		if(r==true)
		{
			//count=count+1;
//			var increment=count-1;
			ti=max_time;	
			$('#slide_content').load('../../slides/slide'+count+'/Questions.php?count='+count+'&max_time='+ti+'&search_words='+search_words+'&total='+x);
			max_time=-1;
		}
		else
			{
				return false;
			}
	}	
	else
	{
		show_danger('You have to read the content first');
	}
}
