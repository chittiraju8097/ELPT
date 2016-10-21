function marks() {
	var score=0;
	var r=confirm("Are you Sure?");
	if(r==true)
	{
		for(var j=1;j<=4;j++)
		{
			var radios = document.getElementsByName("q"+j);
			var found = 1;
			for (var i = 0; i < radios.length; i++) {       
				if (radios[i].checked) 
				{
					if(radios[i].value == ans[j])
						score=score+1;
					found = 0;
					break;
				}
			}
			   if(found==1)
			   {
				 alert("Please Answer the Question "+j);
				 return;
			   } 
		   }
//		  document.location.href='check.php?count='+count+'&max_time='+max_time+'&search_words='+search_words+'&total='+x+'&score='+score;
		  $('#content1').load('../../lyrics.php?count='+count+'&max_time='+ti+'&search_words='+search_words+'&total='+x+'&score='+score);
    }		  
	}
