

window.onload=function(  ){
	document.querySelector('.menu-button').onclick=function(){
		var list=this.parentNode.querySelector('ul');
		if (getComputedStyle(this).display==='block'){
			if (list.style.display!='block') {
				list.style.display='block';
			} else {
				list.removeAttribute('style');
			};
		};
	};
	
	document.querySelector('nav').onmouseleave=function(){
		
		if (getComputedStyle(this.querySelector('.menu-button')).display==='block'){	
			this.querySelector('ul').removeAttribute('style');
		};
	};
}