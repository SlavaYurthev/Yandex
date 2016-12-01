/**
 * Yandex Autocomplete
 * 
 * @author Slava Yurthev
 */

if(typeof(sy) == "undefined"){
	var sy = {};
}

if(typeof(sy.yandex) == "undefined"){
	sy.yandex = {};
}

sy.yandex.autocomplete = {
	init:function(){
		sy.yandex.autocomplete.elements.each(function(element){
			if($(element) != undefined && $(element).getAttribute('autocomplete') != 'off'){
				var group = $(element).getAttribute('id').split(':').first();
				var type = $(element).getAttribute('id').split(':').last();
				switch(type){
					case 'city':
						$(element).addEventListener("keyup", function(event){
							sy.yandex.autocomplete.city($(element));
						}, false);
						// postcode trigger
						$(element).addEventListener("change", function(event){
							sy.yandex.autocomplete.trigger(group);
							sy.yandex.autocomplete.onAddressChange();
						}, false);
					break;
					case 'street1':
						$(element).addEventListener("keyup", function(event){
							sy.yandex.autocomplete.street($(element),$(group+':city'));
						}, false);
						// postcode trigger
						$(element).addEventListener("change", function(event){
							sy.yandex.autocomplete.trigger(group);
							sy.yandex.autocomplete.onAddressChange();
						}, false);
					break;
					case 'house':
						$(element).addEventListener("keyup", function(event){
							sy.yandex.autocomplete.house($(element),$(group+':city'),$(group+':street1'));
						}, false);
						// postcode trigger
						$(element).addEventListener("change", function(event){
							sy.yandex.autocomplete.trigger(group);
							sy.yandex.autocomplete.onAddressChange();
						}, false);
					break;
					case 'postcode':
						$(element).addEventListener("change", function(event){
							sy.yandex.autocomplete.onAddressChange(group);
						}, false);
					break;
				}
				var box = new Element('div');
				box.addClassName('sy-autocomplete');
				box.setStyle({'width':$(element).getStyle('width'),'top':$(element).getStyle('height')});
				box.update(new Element('ul'));
				$(element).insert({after:box});
				$(element).up().setStyle({'position':'relative'});
				$(element).setAttribute('autocomplete','off');
			}
		});
	},
	elements: [
		'shipping:city',
		'shipping:street1',
		'shipping:house',
		'shipping:postcode',
		'billing:city',
		'billing:street1',
		'billing:house',
		'billing:postcode',
	],
	controller: document.location.origin+'/sy_yandex_autocomplete/ajax/',
	config: {
		sender_id: 0,
		client_id: 0
	}
};
sy.yandex.autocomplete.city = function(el){
	clearTimeout(window.timeout);
    window.timeout = setTimeout(function () {
        sy.yandex.autocomplete._city(el.value, function(data){
        	sy.yandex.autocomplete.constructor(el,data);
        });
    }, 500);
}
sy.yandex.autocomplete._city = function(str, callback){
	var parameters = {
	    type: "locality",
	    term: str
	};
	sy.yandex.autocomplete.call(parameters, 'autocomplete', callback);
}
sy.yandex.autocomplete.street = function(el,cityEl){
	clearTimeout(window.timeout);
    window.timeout = setTimeout(function () {
        sy.yandex.autocomplete._street(cityEl.value, el.value, function(data){
        	sy.yandex.autocomplete.constructor(el,data);
        });
    }, 500);
}
sy.yandex.autocomplete._street = function(city, str, callback){
	var parameters = {
	    type: "street",
	    locality_name: city,
	    term: str
	};
	sy.yandex.autocomplete.call(parameters, 'autocomplete', callback);
}
sy.yandex.autocomplete.house = function(el,cityEl,streetEl){
	clearTimeout(window.timeout);
    window.timeout = setTimeout(function () {
        sy.yandex.autocomplete._house(cityEl.value, streetEl.value, el.value, function(data){
        	sy.yandex.autocomplete.constructor(el,data);
        });
    }, 500);
}
sy.yandex.autocomplete._house = function(city, street, str, callback){
	var parameters = {
	    type: "house",
	    locality_name: city,
	    street: street,
	    term: str
	};
	sy.yandex.autocomplete.call(parameters, 'autocomplete', callback);
}
sy.yandex.autocomplete.postcode = function(el,cityEl,streetEl,houseEl){
	sy.yandex.autocomplete._postcode(cityEl.value,streetEl.value,houseEl.value, function(data){
		if(typeof(data) == "object" && data.value){
			el.setValue(data.value);
			el.dispatchEvent(new Event('change'));
		}
	});
}
sy.yandex.autocomplete._postcode = function(city, street, house, callback){
	var parameters = {
	    address: city.split(',').first().trim()+", "+street+", "+house
	};
	sy.yandex.autocomplete.call(parameters, 'postcode', callback);
}
sy.yandex.autocomplete.trigger = function(group){
	if($(group+':city').getValue() != "" && $(group+':street1').getValue() != "" && $(group+':house').getValue() != ""){
		sy.yandex.autocomplete.postcode($(group+':postcode'),$(group+':city'),$(group+':street1'),$(group+':house'));
	}
}
sy.yandex.autocomplete.onAddressChange = function(group){
	// Your callback
}
sy.yandex.autocomplete.selectItem = function(el){
	var input = $(el).up('div').previous('input', 0);
	input.setValue($(el).innerHTML);
	$(el).up('ul').update('');
}
sy.yandex.autocomplete.constructor = function(el, response){
	var container = el.next('.sy-autocomplete', 0).select('ul').first();
	container.update('');
	if(response.suggestions && response.suggestions.length>0){
		response.suggestions.each(function(val){
			var li = new Element('li');
			li.setAttribute('onclick',"sy.yandex.autocomplete.selectItem(this)");
			li.update(val.value);
			container.insert({bottom:li});
		});
	}
}
sy.yandex.autocomplete.call = function(parameters, controller, callback){
	parameters.uri = 'https://delivery.yandex.ru/api/last/';
	parameters.sender_id = sy.yandex.autocomplete.config.sender_id;
	parameters.client_id = sy.yandex.autocomplete.config.client_id;
	new Ajax.Request(sy.yandex.autocomplete.controller+controller, {
		method: 'post',
		asynchronous: true,
	    parameters: parameters,
		onSuccess: function(response) {
			if(response.status == "200"){
				if(response.responseJSON.status == 'ok'){
					callback(response.responseJSON.data);
				}
			}
		}
	});
}