/*
изменение адреса
cf_api.url = 'http://' + window.location.hostname + window.parent.location.pathname + 'cf_api/';
*/

var cf_api_f = function() {};

cf_api_f.prototype = {

	module: {
		author: 'Sergey Shatilov aka CyberFox',
		dateCreated: '2016.04.23',
		dateModified: '2020.11.01',
		version: '1.0.20201101',
		description: 'Ля ля ля',
		site: ''
	},
	
	connection: {
		css: {
			f1: 'Петя',
			f2: 'Вася'
		},
		js: {
			f1: 'Петя',
			f2: 'Вася'
		},
		help: {
			f1: 'Петя',
			f2: 'Вася'
		},
	},
	
	cf_debug: true,
	cf_answer: "default",
	url: "default",

	comm: function(v_arguments){

		if (this.url == "default") {
			__url = location.protocol + "//" + document.location.hostname + '/inventory/mapi/';
			//__url = 'https://' + document.location.hostname + '/mapi/';
		} else {
			__url = this.url;
		}

		$.ajax({
			//res.set('Access-Control-Allow-Origin', '*')
			type: 'POST', 
			url: __url,
			cache: false,
			crossDomain: true,
			dataType: 'json',
			data: v_arguments,
			success: function(json) {
				var str = JSON.parse(JSON.stringify(json));
				if (cf_api.cf_debug) {
					console.info("@ cf_api_f module / debug ::" )
					console.info(str)
				};
				//if (cf_api.cf_debug) {console.log(" ")};
				if (cf_api.cf_answer != "default") {
					eval(cf_api.cf_answer)( str ); // call принимает каждый аргумент индивидуально и меняет контекст
				}
			},
			error: function(jqXHR, error, errorThrown) {  
               if (cf_api.cf_debug) {
               	console.warn("@ cf_api_f module / debug ::")
               	console.warn(jqXHR )
               	console.warn( error)
               	console.warn( errorThrown)
               };
          }
		});
	}
};

var cf_api = new cf_api_f(); 

$(function(){
	$('[cf_api]').click(function (e) {
		var v_cfapi = $(this).attr( "cf_api" );
		cf_api.comm( v_cfapi );
	});
})