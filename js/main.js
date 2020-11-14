var MSG_TITLE_OK = "Успех";
var MSG_TITLE_ERROR = "Ошибка";
var MSG_RESPONSE_ADD_OK = "Запись добавлена";
var MSG_RESPONSE_ADD_ERR = "Запись не добавлена";
var MSG_RESPONSE_CHANGE_OK = "Запись изменена";
var MSG_RESPONSE_CHANGE_ERR = "Запись не изменена";
var MSG_NOT_ROW_SELECTED = "Нет выделенных строк";
var MSG_RECORD_DELETE_OK = "Запись удалена";
var MSG_RECORD_DELETE_ERR = "Запись не удалена";
var MSG_RECORD_WRITEOFF_OK = "Запись списана";
var MSG_RECORD_WRITEOFF_ERR = "Запись не списана";


function filterGlobal () {
	$('#table_id').DataTable().search(
		$('#global_filter').val()
	).draw();
}
 

function filterColumn ( i ) {
	$('#table_id').DataTable().column( i ).search(
		$('#col_'+i+'_filter').val()
	).draw();
}


function shortID(num, prefix)
{
	var p_prefix = prefix || 0;
	var arrmap = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"
	arrmap.split('');
	var id = num;
	var shortURL = "";

	while(num > 0)
	{
		shortURL += arrmap[num % 62] 
		num = Math.floor(num / 62);
	}

	if(shortURL) return p_prefix + shortURL;
	return shortURL;
}


function sendQRPic(furl)
{
	$.ajax({
		url:     furl, //url страницы (action_ajax_form.php)
		type:     "GET", //метод отправки
		dataType: "html", //формат данных
		async : true,
		cache: false,
	  	crossDomain: true,
		//data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
		//data: fdata,  // Сеарилизуем объект
		// console.log(data);
		success: function(response) { //Данные отправлены успешно
		  //result = $.parseJSON(response);
		 // console.log(result);
		  console.log(response);
		  //$('#result_form').html('Имя: '+result.name+'<br>Телефон: '+result.phonenumber);
	  	},
	  error: function(response) { // Данные не отправлены
		console.log('Ошибка. Данные не отправлены.');
		  //  $('#result_form').html('Ошибка. Данные не отправлены.');
	  }
  });
}


function clear_search() { 
	$( ".ser_Table input" ).val("");
	$('#table_id').DataTable().search( '' ).columns().search( '' ).draw();
}



function htmlEncode(value) { 
	return $('<div/>').text(value).html();
	//.html();
} 


function zerofill(fnumber, flenght)
{
	return String(fnumber).padStart(flenght, "0");
}


function sendingdsdddddddddddddddddddddd(furl, farguments) {
$.ajax({
	  //res.set('Access-Control-Allow-Origin', '*')
	  type: 'POST', 
	  url: furl,
	  cache: false,
	  crossDomain: true,
	  dataType: 'json',
	  data: farguments,
	  async : true,
	   beforeSend: function(){
	 //$("#loading_min").show();
   },
	complete: function(){
	 //$("#loading_min").hide();
   },
	  success: function(json) {
		var str = JSON.parse(JSON.stringify(json));
		console.log(str);


	
		pdfopened(event.timeStamp)

	  },
	  error: function(jqXHR, error, errorThrown)
	  {  
	  //$("#loading_min").hide();
	   
				console.warn("@ cf_api_f module / debug ::");
				console.warn(jqXHR );
				console.warn( error);
				console.warn( errorThrown);

		  }
	});
}


function pdfopened(time)
{
		var win = window.open('/inventory/include/tfpdf/qrsticker.pdf?t='+time, '_blank');
if (win) {
    //Browser has allowed it to be opened
    win.focus();
}
}

function isset(fvar)
{
	return (typeof(fvar) != "undefined" && fvar !== null);
}


function sendinventor(type)
{
	var modal = 0;

	if(type === "add"){
		modal = $("#modal_add_inventor");
	} else  {
		modal = $("#modal_change");
	}

	var se_error = 0;
	var in_count = 0;
	var in_error = 0;

	if (modal.find('[data-id="type"]').find('option').filter(':selected').val() === "") se_error++;
	if (modal.find('[data-id="location"]').find('option').filter(':selected').val() === "") se_error++;

    modal.find( ".column_at" ).each(function( index ) {
 		in_count++;
		if ($( this ).val() == 0) in_error++;
	});

	if (se_error > 0)
	{
		toastr.error('Заполните поля', 'Ошибка', {timeOut: 5000});
		return;
	}

	if((in_count - in_error) < 1 )
	{
		toastr.error('Заполните поля', 'Ошибка', {timeOut: 5000})
		return;
	}

	if( !modal.find('[data-id="inventory_number"]').val() )
	{
		modal.find('[data-id="inventory_number"]').val(0);
		modal.find('[data-id="inner_number"]').val(0);
		modal.find('[data-id="inner_number_h"]').val(0);
	}

	var formdata = modal.find('[data-id="ajax_form"]').serializeArray();
	var data = {};
	$(formdata ).each(function(index, obj){
	    data[obj.name] = obj.value;
	});

	var myJSON = JSON.stringify(data);
	var v_cfapi = 0;

  	if(type === "add"){
		v_cfapi = 'add.inventory=' + myJSON;
		cf_api.cf_answer = "cfapi_add_elem";
		url = "/inventory/include/qrpic/?e=10&d="+data["inner_number"];
		sendQRPic(url);
	} else  {
		v_cfapi = 'add.inventoryupdate=' + myJSON;
		cf_api.cf_answer = "cfapi_change_elem";
	}
	
	cf_api.comm( v_cfapi );
}


function btn_multi_del()
{
	var tabtr = $('#table_id tr.selected');
	var selected = tabtr.length;

	if(selected)
	{
		var button = $(event.relatedTarget); // Button that triggered the modal
		var items = "";
		tabtr.each(function(index, obj)
		{
			items += "id:";
			items += obj.id;
			items += " / inner_number:";
			items += $('#' + obj.id +' td:eq(1)').text();
			items += "<br>";
		})

		$('#modal_confirm_delete').find('.debug-id').html(items);
		$('#modal_confirm_delete').modal('show');
    } else
    {
    	toastr.error(MSG_NOT_ROW_SELECTED, MSG_TITLE_ERROR, {timeOut: 5000})
    }
}


function btn_delete_record()
{
	var tabtr = $('#table_id tr.selected');
	var selected = tabtr.length;

	if(selected)
	{
		var items = {};
		var ind = 0;
		tabtr.each(function(index, obj)
		{
			items[ind] = obj.id;
			ind++;
		})

		cf_api.cf_answer = "cfapi_del_rec";
		var v_cfapi = 'set.del=' + JSON.stringify(items);
		cf_api.comm( v_cfapi );

	} else
	{
		toastr.error(MSG_NOT_ROW_SELECTED, MSG_TITLE_ERROR, {timeOut: 5000})
	}
}



function btn_multi_writeoff()
{
	var tabtr = $('#table_id tr.selected');
	var selected = tabtr.length;

	if(selected)
	{
		var button = $(event.relatedTarget); // Button that triggered the modal
		var items = "";
		tabtr.each(function(index, obj)
		{
			items += "id:";
			items += obj.id;
			items += " / inner_number:";
			items += $('#' + obj.id +' td:eq(1)').text();
			items += "<br>";
		})

		$('#modal_confirm_writeoff').find('.debug-id').html(items);
		$('#modal_confirm_writeoff').modal('show');
    } else
    {
    	toastr.error(MSG_NOT_ROW_SELECTED, MSG_TITLE_ERROR, {timeOut: 5000})
    }
}


function btn_writeoff_record()
{
	var tabtr = $('#table_id tr.selected');
	var selected = tabtr.length;

	if(selected)
	{
		var items = {};
		var ind = 0;
		tabtr.each(function(index, obj)
		{
			items[ind] = obj.id;
			ind++;
		})

		cf_api.cf_answer = "cfapi_writeoff_rec";
		var v_cfapi = 'set.writeoff=' + JSON.stringify(items);
		cf_api.comm( v_cfapi );

	} else
	{
		toastr.error(MSG_NOT_ROW_SELECTED, MSG_TITLE_ERROR, {timeOut: 5000})
	}
}


function heightTable()
{
	var size = (
	($("#table_id_wrapper").outerHeight() - $(".dataTables_scrollBody").outerHeight()) + 
	$("#bth_conteiner").outerHeight()
	);
	$(".dataTables_scrollBody").css( {"height": $(window).height()  - size	} );
}

