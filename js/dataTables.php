<?
require_once($_SERVER['DOCUMENT_ROOT'] . '/inventory/include/fs.php');
$tablelist = apianswer('get.inventorynamelist={}')["data"];
//$tablelist = apianswer('get.inventorynamelist={}');
//session_start();
//var_dump(session_name() . '=' . session_id());
//var_dump($tablelist);
//exit();
$sty = "";
foreach ($tablelist as $key => $value)
{
	$stx = array('data' => $value["column_name"] );
	$sty .= json_encode($stx) . ",";
}
$table_m = "var table = ";
$table_up = "
	$('#table_id').DataTable( {
		dom: 'Bfrtip',
		buttons: [
			{ extend: 'colvis', text: 'Отображаемые столбцы', className: 'btn btn-secondary' },
			{ extend: 'excel', text: 'Excel', className: 'btn btn-success' },
			{
				extend: 'pdfHtml5',
				text: 'PDF',
				orientation: 'landscape',
				className: 'btn btn-danger',
				pageSize: 'LEGAL'
			},
			{
				extend: 'print',
				text: 'Печать',
				orientation: 'landscape',
				className: 'btn btn-primary',
				customize: function(win)
				{
					$(win.document.body).css( 'font-size', '10pt' );

					$(win.document.body).find( 'table' )
						.addClass( 'compact' )
						.css( 'font-size', 'inherit' );
		 		}
			},
			{  text: 'Обновить', className: 'btn btn-info btn_refresh'},
			{  text: 'Операции', className: 'btn btn-warning btn-unselected btn_multi_select'},
		],
		scrollCollapse: true,
		'fixedHeader': true,
		'iDisplayLength': 50,
		'bStateSave': true,	
		'scrollX': true,
 		'ajax': '/inventory/include/gettable.php',
		'rowId': 'id',
		'columns': [
		";
$table_down = "
		]

	});";
$alltext = $table_up . $sty . $table_down;
$alltext = str_clear($alltext);
$alltext = str_replace("  ", " ", $alltext);
$alltext = str_replace(",]", "]", $alltext );
echo $table_m . $alltext;
?>