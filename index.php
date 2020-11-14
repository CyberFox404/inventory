<?
require_once($_SERVER['DOCUMENT_ROOT'] . '/inventory/include/users.php'); 
$user = new users;

if(!$user->authorized()) 
{
//	echo "333";
	$user->loginpage();

}

//var_dump($user->authorized());

//exit();

//$cryP = date('mdYdym');
//$CdsDSx = base64_encode(pack('H*',md5(utf8_encode($cryP))));;
//define("__enter__", $CdsDSx);


require_once($_SERVER['DOCUMENT_ROOT'] . '/inventory/include/fs.php');
$tablehead = apianswer("get.inventorynamelist={}")["data"];
$rhin = isset($_GET['rhin']) ? $_GET['rhin'] : "";
$rhpn = isset($_GET['rhpn']) ? $_GET['rhpn'] : "";
?>

<? require_once($_SERVER['DOCUMENT_ROOT'] . '/inventory/include/header.php');?>
<div id="maincont">
	<div id="bodyconteiner">
		<div id="search_panel">
			<div id="sptext">
			 <div id="table_head">  
				<?require_once($_SERVER['DOCUMENT_ROOT'] . '/inventory/include/table_search.php');?> 	
				</div>
			</div>
			<div id="spbtn"><i class="fas fa-search"></i></div>
		</div>
		<div id="bth_conteiner">
			<button type="button" class="btn btn-primary" id="btn_modal_scanner" data-toggle="modal" data-target="#modal_scanner">
				<?=$btnicon["сканировать"]["ico"]?>
				<span>Сканировать</span>
			</button>

			<button type="button" class="btn btn-success" id="btn_modal_add" data-toggle="modal" data-target="#modal_add_inventor">
				<?=$btnicon["добавить"]["ico"]?>
					<span>Добавить</span>
			</button>

			<button type="button" class="btn btn-warning ser_table_clear">
				<?=$btnicon["сбросить"]["ico"]?>
				<span>Сбросить</span>
			</button>

			<a href="/inventory/user/logout">	
			<button type="button" class="btn btn-danger" id="user_logout">
				<?=$btnicon["выход"]["ico"]?>
				<span>Выход</span>
			</button>
			</a>
		</div>
		<div id="con_modal">
			<?require_once($_SERVER['DOCUMENT_ROOT'] . '/inventory/include/modal.php');?>
		</div>
			<?require_once($_SERVER['DOCUMENT_ROOT'] . '/inventory/include/table_main.php');?>
	</div>  
</div>
<? require_once($_SERVER['DOCUMENT_ROOT'] . '/inventory/include/footer.php');?>