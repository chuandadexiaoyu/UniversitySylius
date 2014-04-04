var AnimatedHeader = (function(){
	var docElem = document.documentElement,
	    header =document.querySelector('.fisher-header'),
	    didScroll = false,
	    changeHeaderOn = 200;

	    function init(){
	    	window.addEventListener('scroll', function(event){
	    		if( !didScroll ){
	    			didScroll = true;
	    			setTimeout(scrollPage, 250);
	    		}
	    	}, false);
	    }

	    function scrollPage(){
	    	var sy = scrollY();
	    	if(sy >= changeHeaderOn){
	    		classie.add(header, 'fisher-header-shrink');
	    	}
	    	else{
	    		classie.remove(header, 'fisher-header-shrink');
	    	}

	    	didScroll = false;
	    }

	    function scrollY(){
	    	return window.pageYOffset || docElem.scrollTop;
	    }

	    init();
})();