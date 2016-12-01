/**
 * Yandex Delivery
 * 
 * @author Slava Yurthev
 */
Ajax.Responders.register({
    onComplete: function(request, transporter) {
    	if(typeof(sy.yandex.delivery) != 'undefinded'){
    		sy.yandex.delivery.init();
    	}
    }
});
window.onload = function(){
	if(typeof(sy.yandex.delivery) != 'undefinded'){
		sy.yandex.delivery.init();
	}
}