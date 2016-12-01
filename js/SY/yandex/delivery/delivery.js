/**
 * Yandex Delivery
 * 
 * @author Slava Yurthev
 */

if(typeof(sy) == "undefined"){
	var sy = {};
}

if(typeof(sy.yandex) == "undefined"){
	sy.yandex = {};
}

sy.yandex.delivery = {
	init:function(){
		if($('s_method_sy_yandex_delivery_widget') != undefined && 
			$('s_method_sy_yandex_delivery_widget').getAttribute('init') != 'true'){
			// If widget not load yeat - set disabled
			if(sy.yandex.delivery.widgetLoad != true){
				$('s_method_sy_yandex_delivery_widget').setAttribute('disabled','disabled');
			}
			// On click event
			$('s_method_sy_yandex_delivery_widget').observe('click', function(event){
				Event.stop(event);
				if(sy.yandex.delivery.widgetLoad == true && sy.yandex.delivery.city() != false){
					ydwidget.cartWidget.open();
				}
			});
			$('s_method_sy_yandex_delivery_widget').setAttribute('init','true');
		}
	},
	widget: {
		el: 'yandex_widget_container',
		onLoad: function(){
			sy.yandex.delivery.widgetLoad = true;
			if($('s_method_sy_yandex_delivery_widget') != undefined){
				$('s_method_sy_yandex_delivery_widget').removeAttribute('disabled');
			}
		},
		getCity: function(){
			return {value:sy.yandex.delivery.city()};
		},
		itemsDimensions: function(){
			return sy.yandex.delivery.dimensions;
		},
		onDeliveryChange: function(delivery){
			var priceBox = new Element('span');
			priceBox.addClassName('price');
			priceBox.update(delivery.costWithRules+' руб.');
			var label = delivery.delivery.name+' - '+priceBox.outerHTML;
			$('s_method_sy_yandex_delivery_widget').up().select('label').first().update(label);
			$('s_method_sy_yandex_delivery_widget').checked = true;
			new Ajax.Request(sy.yandex.delivery.controller+'update', {
				method: 'post',
			    parameters: {
			    	price: delivery.costWithRules,
			    	name: delivery.delivery.name,
			    	description: ydwidget.cartWidget.view.helper.getDeliveryDescription(delivery)
			    },
			    onComplete: function(){
			    	sy.yandex.delivery.onDeliveryChange(delivery);
			    }
			});
			ydwidget.cartWidget.close();
		},
		createOrderFlag: function(){
			return $('s_method_sy_yandex_delivery_widget').checked;
		},
		order: {
			order_items: function(){
				return sy.yandex.delivery.items;
			},
			recipient_first_name: function(){
				return sy.yandex.delivery.formfield('firstname');
			},
			recipient_last_name: function(){
				return sy.yandex.delivery.formfield('lastname');
			},
			recipient_phone: function(){
				return sy.yandex.delivery.formfield('telephone');
			},
			deliverypoint_street: function(){
				return sy.yandex.delivery.formfield('street1');
			},
			deliverypoint_house: function(){
				return sy.yandex.delivery.formfield('house');
			},
			deliverypoint_index: function(){
				return sy.yandex.delivery.formfield('postcode');
			}
		}
	},
	items: [],
	dimensions: [],
	controller: document.location.origin+'/sy_yandex_delivery/ajax/',
	widgetLoad: false
}
sy.yandex.delivery.save = function(callback){
	if(sy.yandex.delivery.widget.createOrderFlag() == true){
		ydwidget.cartWidget.order.createOrder().done(function(){
			new Ajax.Request(sy.yandex.delivery.controller+'getLastId', {
				onComplete: function(resp){
					ydwidget.cartWidget.order.confirmOrder({'order_num':resp.responseJSON.id}).done(function(yandex){
						if(yandex.status != 'error'){
							new Ajax.Request(sy.yandex.delivery.controller+'setOrderId', {
								parameters: {
	                            	id: resp.responseJSON.id,
	                            	order_id: yandex.data.order.id
	                            },
	                            onComplete: function(){
	                                callback();
	                            }
							});
						}
						else{
							callback();
						}
					});
				}
			});
		});
	}
	else{
		callback();
	}
}
sy.yandex.delivery.city = function(){
	var city = sy.yandex.delivery.formfield('city');
	var region = sy.yandex.delivery.formfield('region');
	if(region != false){
		city += ', '+region;
	}
	return city;
}
sy.yandex.delivery.formfield = function(name){
	var value = false;
	if($('billing:'+name) != undefined && $('billing:'+name).getValue() != ""){
		value = $('billing:'+name).getValue();
	}
	if($('shipping:'+name) != undefined && $('shipping:'+name).getValue() != ""){
		value = $('shipping:'+name).getValue();
	}
	return value;
}
sy.yandex.delivery.onDeliveryChange = function(delivery){
	// Your event
}