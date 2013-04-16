var preEl ;
var orgTColor;
var delayFunction = keyUpDelay();


function HighlightRowText(el, textColor){
  if(typeof(preEl)!='undefined') {
     try{ChangeTextColor(preEl,orgTColor);}catch(e){;}
  }
  orgTColor = el.style.color;

  try{ChangeTextColor(el,textColor);}catch(e){;}
  preEl = el;	
	
}

function ChangeTextColor(a_obj,a_color){  
	for (i=0;i<a_obj.cells.length;i++)
	{
		a_obj.cells[i].style.color=a_color;
    	a_obj.cells[i].style.fontWeight=(a_obj.cells[i].style.fontWeight=='')?'bold':'';
    }
}

/*   end hilight row text */

function keyUpDelay() {
    var timer = 0;  
    return function(func, time) {
        clearTimeout(timer);
        timer = setTimeout(func, time);
    };
}

