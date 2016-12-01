/**
 * Yandex Autocomplete
 * 
 * @author Slava Yurthev
 */
Ajax.Responders.register({
    onComplete: function(request, transporter) {
    	if(typeof(sy.yandex.autocomplete) != 'undefinded'){
    		sy.yandex.autocomplete.init();
    	}
    }
});
window.onload = function(){
	if(typeof(sy.yandex.autocomplete) != 'undefinded'){
		sy.yandex.autocomplete.init();
	}
}