
<!--
	Модальное окно для сканирования QR-кода
-->
<div class="modal fade" id="modal_scanner" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<form method="post" id="ajax_form" action="" >
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Сканирование QR-кода</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<? require_once($_SERVER['DOCUMENT_ROOT'] . '/inventory/include/camera.php');?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary right" data-dismiss="modal">Закрыть</button>
				</div>
			</form>	
		</div>
	</div>
</div>


<!--
	Модальное окно для добавления инвентарного объекта
-->
<div class="modal fade modalh" id="modal_add_inventor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<form method="post" data-id="ajax_form" action="" >
	 			<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle"><?=$btnicon["добавить"]["ico"]?>Добавление инвентарного объекта</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  				<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

				<?
				foreach ($tablehead as $item => $val)
				{
					$t_item_name = $val["column_name"];
					$t_item_comment = mb_ucfirst($val["column_comment"]);
					$tableexist = apianswer('get.tableexist={"table":"'.$t_item_name.'"}')["answer"];
				?>

					<div class="myrow">

					<? if($tableexist) {?>
						<? $tablelist = apianswer('get.val={"table":"'.$t_item_name.'"}')["data"]; ?>

						<div class="mycol mfirst"><?=$t_item_comment;?></div>
						<div class="mycol msecond">
					  		<select class="selectpicker" data-live-search="true" title="Выберите вариант" name="<?=$t_item_name;?>" data-id="<?=$t_item_name;?>">

							<?foreach ($tablelist as $key => $val) {?>

								<option data-tokens="ketchup mustard" value="<?=$val["id"]?>">
								<?=$val["name"]?>
								</option>

							<?}?>

							</select>
						</div>
						<div class="mycol mthird">
			  				<div class="add_val" data-name="<?=$t_item_name;?>" data-toggle="modal" data-target="#modal_add_element" data-whatever="<?=$t_item_name;?>">
								<i data-feather="plus-square"></i>
							</div>
						</div>

					<?} else {?>

						<?if(!preg_match("/time/", $t_item_name)) {?>

						<div class="mycol mfirst"><?=$t_item_comment;?></div>
						<div class="mycol msecond">
			  	
						<? if($t_item_name == "inner_number") { ?>

							<input type="text" class="column_filterd" data-id="inner_number_h" name="<?=$t_item_name;?>" disabled>
							<input type="text" class="column_filterd" data-id="inner_number" name="inner_number" hidden>
						
						<?} else {?>
							
							<input type="text" class="column_filterd column_at" data-id="<?=$t_item_name;?>" name="<?=$t_item_name;?>" autocomplete="off">

						<?}?>

						</div>
						<div class="mycol mthird"></div>

						<?}?>
					<?}?>

					</div>

				<?}?>

	  			</div>
	 			 <div class="modal-footer">
					<button type="button" id="btn_send" class="btn btn-success right" value="Отправить" /><?=$btnicon["добавить"]["ico"]?><span>Добавить</span></button>
					<button type="button" class="btn btn-secondary right" data-dismiss="modal">Закрыть</button>
				</div>
			</form>	
		</div>
	</div>
</div>


<!--
	Модальное окно для изменения инвентарного объекта
-->
<div class="modal fade modalh" id="modal_change" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<form method="post" data-id="ajax_form" action="" >
	 			<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle"><?=$btnicon["изменить"]["ico"]?>Изменение инвентарного объекта</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  				<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

				<?
				foreach ($tablehead as $item => $val)
				{
					$t_item_name = $val["column_name"];
					$t_item_comment = mb_ucfirst($val["column_comment"]);
					$tableexist = apianswer('get.tableexist={"table":"'.$t_item_name.'"}')["answer"];
				?>				

					<? if($tableexist) {?>
						<? $tablelist = apianswer('get.val={"table":"'.$t_item_name.'"}')["data"]; ?>

						<div class="myrow">

						<div class="mycol mfirst"><?=$t_item_comment;?></div>
						<div class="mycol msecond">
					  		<select class="selectpicker" data-live-search="true" title="Выберите вариант" name="<?=$t_item_name;?>" data-id="<?=$t_item_name;?>">

							<?foreach ($tablelist as $key => $val) {?>

								<option value="<?=$val["id"]?>">
								<?=$val["name"]?>
								</option>

							<?}?>

							</select>
						</div>
						<div class="mycol mthird">
			  				<div class="add_val" data-name="<?=$t_item_name;?>" data-toggle="modal" data-target="#modal_add_element" data-whatever="<?=$t_item_name;?>">
								<i data-feather="plus-square"></i>
							</div>
						</div>
						</div>

					<?} else {?>

						<?if(!preg_match("/time/", $t_item_name)) {?>
							<div class="myrow">

						<div class="mycol mfirst"><?=$t_item_comment;?></div>
						<div class="mycol msecond">
			  	
						<? if($t_item_name == "inner_number") { ?>

							<input type="text" class="column_filterd" data-id="inner_number_h" name="<?=$t_item_name;?>" disabled>
							<input type="text" class="column_filterd" data-id="inner_number" name="inner_number" hidden>
						
						<?} else {?>
							
							<input type="text" class="column_filterd column_at" data-id="<?=$t_item_name;?>" name="<?=$t_item_name;?>" autocomplete="off">

						<?}?>

						</div>
						<div class="mycol mthird"></div>
						</div>

						<?}?>
					<?}?>				
				<?}?>

	  			<div id="qr_generate">
					<img id="qr-code" src="" class="qr-code img-thumbnail img-responsive" /> 
	  			</div>
	  			</div>
	 			 <div class="modal-footer">
					<button type="button" class="btn btn-danger" id="btn_modal_del_rec"><?=$btnicon["удалить"]["ico"]?><span>Удалить</span></button>
					<button type="button" class="btn btn-warning" id="btn_modal_writeoff"><?=$btnicon["списать"]["ico"]?><span>Списать</span></button>
					<button type="button" id="btn_change" class="btn btn-info right"><?=$btnicon["изменить"]["ico"]?><span>Изменить</span></button>
					<button type="button" class="btn btn-secondary right" data-dismiss="modal">Закрыть</button>
				</div>
			</form>	
		</div>
	</div>
</div>


<!--
	Модальное окно для добавления элеманта списка
-->
<div class="modal fade" id="modal_add_element" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Добавления элеманта</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="myrow">
					<div class="mycol mfirst">Название  элемента</div>
					<div class="mycol msecond">
						<input type="text" class="" id="add_val_i" autocomplete="off">
						<input type="text" class="" id="add_val_if" autocomplete="off" hidden>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
				<button type="button" class="btn btn-success right" id="add_val_btn"><?=$btnicon["добавить"]["ico"]?><span>Добавить</span></button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modal_confirm_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-trash-alt"></i>Удаления объектов</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Вы собираетесь удалить запись (записи):</p>
				<p class="debug-id"></p>
				<p>Процедура необратима, Вы хотите продолжить?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
				<button class="btn btn-danger btn-ok right" id="btn_delete_record"><?=$btnicon["удалить"]["ico"]?>
					<span>Удалить</span>
				</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modal_confirm_writeoff" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle"><?=$btnicon["списать"]["ico"]?>Списание объектов</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Вы собираетесь списать запись (записи):</p>
				<p class="debug-id"></p>
				<p>Вы хотите продолжить?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
				<button class="btn btn-warning btn-ok right" id="btn_writeoff_record"><?=$btnicon["списать"]["ico"]?>
					<span>Списать</span>
				</button>
			</div>
		</div>
	</div>
</div>