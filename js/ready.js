var multy_select = false;

/*
	Multiple modals overlay
*/
 $(document).on('show.bs.modal', '.modal', function (event) {
    var zIndex = 1040 + (10 * $('.modal:visible').length);
    $(this).css('z-index', zIndex);
    setTimeout(function() {
        $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
    }, 0);
});


$('input.global_filter').on( 'keyup click', function () {
	filterGlobal();
} );


$('input.column_filter').on( 'keyup click', function () {
	filterColumn( $(this).parents('tr').attr('data-column') );
} );


$('#table_id').on('click', 'tbody tr', function() {
	if(multy_select)
	{
		$(this).toggleClass('selected');

	} else {
		var tdata = table.row(this).data();
		$('#modal_change').data('rows', this);
		$('#modal_change').data('gid', tdata.id);
		$('#modal_change').modal('show');
	}
})


/*
	Обработчик внутреннего номера инвентаря
*/
$('#modal_add_inventor input').on( 'keyup click', function () {
	var modal = $('#modal_add_inventor');
	var shortID_Num = shortID(modal.find('[data-id="inventory_number"]').val(), "PC-");
	modal.find('[data-id="inner_number"]').val(shortID_Num);
	modal.find('[data-id="inner_number_h"]').val(shortID_Num);
} );


<? if($rhin !=  "0"){?>

$('#table_id').DataTable().column( 0 ).search("<?=$rhin?>").draw();
$('#col_0_filter').val("<?=$rhin?>");

<?}?>


<? if($rhpn != "0"){?>

$('#table_id').DataTable().column( 1 ).search("<?=$rhpn?>").draw();
$('#col_1_filter').val("<?=$rhpn?>");

<?}?>


$('#modal_add_inventor').on('show.bs.modal', function () {
	//$("#modal_add_inventor .selectpicker").val('default').selectpicker("refresh");
	//$(this).find("input,textarea,select").val('').end();
	$(this).find('[data-id="location"]').val('00000000000000000001').selectpicker("refresh");
})

$('#modal_add_inventor').on('hide.bs.modal', function () {
	$("#modal_add_inventor .selectpicker").val('default').selectpicker("refresh");
	$(this).find("input,textarea,select").val('').end();
})


$('#modal_scanner').on('show.bs.modal', function ()
{
	Instascan.Camera.getCameras().then(function (cameras)
	{
		app.cameras = cameras;
		if (cameras.length > 0) {
			app.activeCameraId = cameras[0].id;
			app.scanner.start(cameras[0]);
		} else {
			console.error('Камера не найдена.');
		}
	}).catch(function (e) {
		console.error(e);
	});
})


$('#modal_scanner').on('hide.bs.modal', function ()
{
	app.scanner.stop();
})


$('#modal_change').on('hide.bs.modal', function ()
{
	var gid = $(this).data('gid');
	$('#'+gid).removeClass('selected');
	$("#modal_change .selectpicker").val('default').selectpicker("refresh");
	$(this).find("input,textarea,select").val('').end();
	$(this).data('gid', 0);
})


$('#modal_change').on('show.bs.modal', function (event)
{

	//$("#modal_change .selectpicker").selectpicker("refresh");

//var sp = $("# [data-id='" + ans.response.table + "'");


	//$(this).find('.selectpicker').selectpicker("refresh");
	//$(this).find('.selectpicker').val('default').selectpicker("refresh");

	
	//sp.val(zf).selectpicker("refresh");


	var gid = $(this).data('gid');
	var rows = $(this).data('rows');
	var data = table.row( rows ).data();
	var t_f = $( this );

	t_f.find('input').each(function(index, obj)
	{
		var named = $(obj).data('id');
		var gnam = data[named];

		if(isset(gnam)) $( this ).val(gnam);
		if(named === "inner_number_h") $( this ).val(data.inner_number);
	});

	t_f.find('select').each(function(index, obj)
	{
		var t_s = $( this );
		var named = $(obj).data('id');
		var gnam = $.trim(data[named]);

		if(isset(gnam))
		{
			t_s.find('option').each(function(index, obj)
			{
				var val = $(obj).val();
				var text = $.trim($(obj).text());

				if(text == gnam)
				{
					t_s.val(val).selectpicker("refresh");
					return false;
				}
			})
		}
	});

	finalURL = '/inventory/include/qrpic/?d=' + data.inner_number;
	$('#qr-code').attr('src', finalURL); 
	$('#'+gid).addClass('selected');
})


/*
	Обработчик модального окна добавления элемента
*/
$('#modal_add_element').on('show.bs.modal', function (event)
{
	$('#add_val_i').val('');
	$('#add_val_if').val('');

	var button = $(event.relatedTarget); // Button that triggered the modal
	var recipient = button.data('whatever'); // Extract info from data-* attributes
	var modal = $(this);
	modal.find('#add_val_if').val(recipient);
})


/*
	Обработчик кнопки мультивыбор
*/
$( ".btn_multi_select" ).click(function()
{

	if($( this ).hasClass( "btn-selected" ))
	{
		$( this ).removeClass( "btn-selected" );
		$( this ).addClass( "btn-unselected" );

		$( this ).find("i").removeClass( "fa-check-double" );
		$( this ).find("i").addClass( "fa-check" );

		$( "#multicolumnbtn" ).hide();

	} else 
	{
		$( this ).removeClass( "btn-unselected" );
		$( this ).addClass( "btn-selected" );

		$( this ).find("i").removeClass( "fa-check" );
		$( this ).find("i").addClass( "fa-check-double" );

		$( "#multicolumnbtn" ).show();
	}

	multy_select = !multy_select;

	if(!multy_select) $('#table_id tr').removeClass('selected');

	heightTable();

});


/*
	Обработчик кнопки добавления элеманта
*/
$( "#add_val_btn" ).click(function() {
	var table = $('#add_val_if').val();
	var name = $('#add_val_i').val();
	cf_api.cf_answer = "cfapi_add_val";
	var v_cfapi = 'add.val={"table":"'+table+'", "name":"'+name+'"}';
	cf_api.comm( v_cfapi );
});


/*
	Обработчик кнопки добавления инвентаря
*/
$("#btn_send").click(function() {
	sendinventor('add');
});


/*
	Обработчик кнопки изменения инвентаря
*/
$("#btn_change").click(function() {
	sendinventor('change');

});


/*
	Обработчик кнопки очищения полей поиска
*/
$(".ser_table_clear").click(function() {
	clear_search();
});


$("#btn_modal_scanner").click(function() {
	clear_search();
});


/*
	Добавление иконок к кнопкам 
*/
$(".buttons-colvis span").before('<i class="fas fa-columns"></i>');
$(".btn_refresh span").before('<?=$btnicon["обновить"]["ico"]?>');
$(".buttons-pdf span").before('<i class="fas fa-file-pdf"></i>');
$(".buttons-excel span").before('<i class="fas fa-file-excel"></i>');
$(".buttons-print span").before('<i class="fas fa-print"></i>');
$(".btn_multi_select span").before('<i class="fas fa-check"></i>');
$( "#table_id_filter" ).before( "<div id='multicolumnbtn'></div>" );
$( "#multicolumnbtn" ).append( '<button type="button" class="btn btn-primary" id="btn_multi_print"><?=$btnicon["печатьстикеров"]["ico"]?><span>Печать стикеров</span></button>' );
$( "#multicolumnbtn" ).append( '<button type="button" class="btn btn-warning" id="btn_multi_writeoff"><?=$btnicon["списать"]["ico"]?><span>Списать</span></button>' );
$( "#multicolumnbtn" ).append( '<button type="button" class="btn btn-danger" id="btn_multi_del"><?=$btnicon["удалить"]["ico"]?><span>Удалить</span></button>' );
$( "#multicolumnbtn" ).append( "<div id='multicolumnbtnmisc'></div>" );
$( "#multicolumnbtnmisc" ).append( '<button type="button" class="btn btn-info" id="btn_multi_selectall"><?=$btnicon["выделитьвсе"]["ico"]?><span>Выделить все</span></button>' );
$( "#multicolumnbtnmisc" ).append( '<button type="button" class="btn btn-info" id="btn_multi_select"><?=$btnicon["выделить"]["ico"]?><span>Выделить страницу</span></button>' );
$( "#multicolumnbtnmisc" ).append( '<button type="button" class="btn btn-info" id="btn_multi_unselect"><?=$btnicon["снятьвыделение"]["ico"]?><span>Снять выделение</span></button>' );


$("#btn_multi_selectall").click(function()
{
	$('#table_id').DataTable().rows().select();
});



$("#btn_multi_select").click(function()
{
	$('#table_id tr').addClass('selected');
});


$("#btn_multi_unselect").click(function()
{
	$('#table_id').DataTable().rows().deselect();   
});


$(".btn_refresh").click(function()
{
	table.ajax.reload(); 
});



/*
	Обработчик кнопки печати QR-стикеров
*/
$("#btn_multi_print").click(function()
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
		});

		sendingdsdddddddddddddddddddddd("/inventory/include/tfpdf/pdfcreate.php", items);
    } else
    {
    	toastr.error(MSG_NOT_ROW_SELECTED, MSG_TITLE_ERROR, {timeOut: 5000});
    }
});

$("#btn_multi_writeoff").click(function()
{
	btn_multi_writeoff();
});


$("#btn_modal_writeoff").click(function()
{
	btn_multi_writeoff();
});


$("#btn_writeoff_record").click(function()
{
	btn_writeoff_record();
});


/*
	Обработчик кнопки для вызова окна подтверждения удаления
*/
$("#btn_multi_del").click(function()
{
	btn_multi_del();
});


/*
	Обработчик кнопки удаления строк окна подтверждения
*/
$("#btn_delete_record").click(function()
{
	btn_delete_record();
});


$("#btn_modal_del_rec").click(function()
{
	btn_multi_del();
});


$(".buttons-colvis").click(function()
{
	if($(this).hasClass('sel'))
	{
		$(this).removeClass('sel');
		$( ".dt-button-background" ).remove();
		$( ".dt-button-collection" ).remove();
	} else {
		$(this).addClass('sel');	
	}
	heightTable();
});


$(window).resize(function ()
{ 
	heightTable();
});



/*
	Обработчик callback фунции 
*/
cfapi_add_val = function (ans) {
	if (ans.response.errno === 0)
	{
		toastr.success(MSG_RESPONSE_ADD_OK, MSG_TITLE_OK, {timeOut: 5000});
		$('#modal_add_element').modal('hide');
		var zf = zerofill(ans.response.id, 20);

		var mai = $("#modal_add_inventor [data-id='" + ans.response.table + "'");
		var mc = $("#modal_change [data-id='" + ans.response.table + "'");

		mai.append('<option value="'+zf+'">'+ans.response.answer+'</option>');
		mai.val('default').selectpicker("refresh");
		mai.val(zf).selectpicker("refresh");

		mc.append('<option value="'+zf+'">'+ans.response.answer+'</option>');
		mc.val('default').selectpicker("refresh");
		mc.val(zf).selectpicker("refresh");


		

	} else {
		toastr.error(MSG_RESPONSE_ADD_ERR, MSG_TITLE_ERROR, {timeOut: 5000});
			
	}
}


cfapi_add_elem = function (ans) {
	if (ans.response.errno)
	{
		toastr.error(MSG_RESPONSE_ADD_ERR, MSG_TITLE_ERROR, {timeOut: 5000});
	} else {
		toastr.success(MSG_RESPONSE_ADD_OK, MSG_TITLE_OK, {timeOut: 5000});
		$('#modal_add_inventor').modal('hide');
		table.ajax.reload();
	}
}


cfapi_change_elem = function (ans) {
	if (ans.response.errno)
	{
		toastr.error(MSG_RESPONSE_CHANGE_ERR, MSG_TITLE_ERROR, {timeOut: 5000});
	} else {
		toastr.success(MSG_RESPONSE_CHANGE_OK, MSG_TITLE_OK, {timeOut: 5000});
		$('#modal_change').modal('hide');
		table.ajax.reload();
	}
}


cfapi_del_rec = function (ans) {
	if (ans.response.errno)
	{
		toastr.error(MSG_RECORD_DELETE_ERR, MSG_TITLE_ERROR, {timeOut: 5000});
	} else {
		toastr.success(MSG_RECORD_DELETE_OK, MSG_TITLE_OK, {timeOut: 5000});
		$('#modal_change').modal('hide');
		$('#modal_confirm_delete').modal('hide');
		table.ajax.reload();
	}
}

cfapi_writeoff_rec = function (ans) {
	if (ans.response.errno)
	{
		toastr.error(MSG_RECORD_WRITEOFF_ERR, MSG_TITLE_ERROR, {timeOut: 5000});
	} else {
		toastr.success(MSG_RECORD_WRITEOFF_OK, MSG_TITLE_OK, {timeOut: 5000});
		$('#modal_change').modal('hide');
		$('#modal_confirm_writeoff').modal('hide');
		table.ajax.reload();
	}
}








//$('.dataTables_scrollBody').css({'height': $(window).height() - ( $(".bth_conteiner").height() + $(".dt-buttons").height()}) ;




//	scrollY:        '300px',






	heightTable();
	

$("#search_panel").css( {"left": "-=" + $("#search_panel").width()} );
$("#spbtn").animate( {"left": 0}, 300, "linear" );
$//("#spoverlay").hide();



$("#spoverlay").click(function()
{
	if($("#search_panel").hasClass('open'))
	{
		$("#search_panel").removeClass('open');
		$("#search_panel").animate( {"left": "-" + $("#search_panel").width()}, 300, "linear" );
		$("#spbtn").animate( {"left": 0}, 300, "linear" );
		$("#spoverlay").fadeOut();
	}
});


$("#spbtn").click(function()
{
	if($("#search_panel").hasClass('open'))
	{
		$("#search_panel").removeClass('open');
		$("#search_panel").animate( {"left": "-" + $("#search_panel").width()}, 300, "linear" );
		$("#spbtn").animate( {"left": 0}, 300, "linear" );
		$("#spoverlay").fadeOut();
	} else
	{
		$("#search_panel").addClass('open');
		$("#search_panel").animate( {"left": 0}, 300, "linear" );
		$("#spbtn").animate( {"left": $("#search_panel").width()}, 300, "linear" );
		$("#spoverlay").fadeIn();
	}
});