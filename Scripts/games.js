var an_f = false;

$(document).ready(function(){
		
	loadCell();	
	
	$(document.body).on("keyup",".elem_filter_namesearch", function(){
    var t = $(this);
    var tVal = t.val().toLowerCase();
    var elements = $(".all");
	
    if(!tVal.length){
        elements.show();
    }
    elements.hide();
    elements.filter(function(){
        var str = $(this).data("jkname").toLowerCase();
			if(str.indexOf(tVal) !== -1){
				return true;
			}
		}).show();
	});
	
	$(document.body).on("click", "#anim_filter", function(){   
		if(an_f == false)
		{
			$('#Filter').show();
			an_f = true;
		}
		else
		{
			$('#Filter').hide();
			an_f = false;
		}
	});
});





function loadCell(){	
	var inCells=document.getElementsByClassName('all');
	for (var i=0;i<inCells.length;i++){
		for (var prop in inCells[i].dataset){
			var dest=inCells[i].getElementsByClassName(prop);
			if (dest.length>0)
				dest[0].innerHTML=inCells[i].dataset[prop];
		}
	}	
	var SF=document.getElementById('Filter');
	var checkList=SF.getElementsByTagName('ul');	
	for (i=0; i<inCells.length; i++){
		for (var key in inCells[i].dataset)
		{
			var cur=document.getElementById(key);
			if (cur != null)
			{	
				var curList=cur.getElementsByTagName('li');
				var flag=0;
				for (var j=0;j<curList.length;j++){
					if (curList[j].dataset.name==inCells[i].dataset[key])
					{
						flag=1;
					}
				}	
				if (flag==0){
				var newItem=document.createElement('li');
				var newInput=document.createElement('input');
				newInput.dataset.key=key;//				
				newInput.dataset.name=inCells[i].dataset[key];
				newInput.type='checkbox';
				newItem.addEventListener("click", clicker);
				newItem.appendChild(newInput);
				
				newItem.dataset.name=inCells[i].dataset[key];
				newItem.innerHTML+=inCells[i].dataset[key];
				cur.appendChild(newItem);
				}
			}
		}
	}		
}

function clicker(e)
{		
	var SF=document.getElementById('Filter');
	var cellList=document.getElementsByClassName('all');
	var aCheckSum=[];
	
	for (var i=0;i<cellList.length;i++)
	{
		cellList[i].style.display='none';
		//cellList[i].FadeOut();
		aCheckSum[i]=0;
	}
	
	var uList=SF.getElementsByTagName('ul');
	var checkSum=0;
	var curSum;
	for (var i=0;i<uList.length;i++)
	{
		var inF=uList[i].getElementsByTagName('input');
		
		curSum=0;
		for (var j=0;j<inF.length;j++)
		{
			if (inF[j].checked==true)
			{
				curSum=1;
			}
		}	
		if (curSum==1)
		{
			checkSum++;
			for (var j=0;j<inF.length;j++)
			{
				if (inF[j].checked==true)
				{
					for (var k=0;k<cellList.length;k++)
					{
						if (cellList[k].dataset[inF[j].dataset.key]==inF[j].dataset.name)
							aCheckSum[k]++;
					}
				}
			}

		}
		
	}
	for (var i=0;i<cellList.length;i++)
	{
		if (aCheckSum[i]==checkSum)
		{
			cellList[i].style.display='inline-block';
			//cellList[i].FadeIn();
		}
	}
	tryChecker();
}

function tryChecker(){

	var SF=document.getElementById('Filter');
	var cList=SF.getElementsByTagName('input');
	
	for (var i=0;i<cList.length;i++)
	{
		if (cList[i].checked==true)
		{
			cList[i].checked=false;
			var res=tryClicker();
			cList[i].checked=true;
			if (res==0)
			{
				cList[i].disabled=1;
			}
			else
				cList[i].disabled=0;
		}
		else
		{
			cList[i].checked=true;
			var res=tryClicker();
			cList[i].checked=false;
			if (res==0)
			{
				cList[i].disabled=1;
			}
			else{cList[i].disabled=0;
			}
		}
	}
	}

function tryClicker()
{	
	var SF=document.getElementById('Filter');
	var cellList=document.getElementsByClassName('all');
	var aCheckSum=[];
	
	for (var i=0;i<cellList.length;i++)
	{
		aCheckSum[i]=0;
	}
	
	var uList=SF.getElementsByTagName('ul');
	var checkSum=0;
	var curSum;
	for (var i=0;i<uList.length;i++)
	{
		var inF=uList[i].getElementsByTagName('input');
		
		curSum=0;
		for (var j=0;j<inF.length;j++)
		{
			if (inF[j].checked==true)
			{
				curSum=1;
			}
		}

		if (curSum==1)
		{
			checkSum++;
			for (var j=0;j<inF.length;j++)
			{
				if (inF[j].checked==true)
				{
					for (var k=0;k<cellList.length;k++)
					{
						if (cellList[k].dataset[inF[j].dataset.key]==inF[j].dataset.name)
							aCheckSum[k]++;
					}
				}
			}

		}
		
	}

var result=0;
	for (var i=0;i<cellList.length;i++)
	{
		if (aCheckSum[i]==checkSum)
		{
		result++;
		}
	}
	return result;
}