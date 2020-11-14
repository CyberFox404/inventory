<? //$tablehead = apianswer("get.inventorynamelist={}")["data"]; ?>
<table class="ser_Table" cellpadding="3" cellspacing="0" border="0" style="width: 100%; margin: 0 auto 2em auto;">
	<thead>
	</thead>
	<tbody>
		<tr id="filter_global">
			<td>Общий поиск</td>
			<td align="center">
				<input type="text" class="global_filter" id="global_filter" autocomplete="off">
			</td>
		</tr>

		<?
		foreach ($tablehead as $item => $val) {
			$t_item_name = $val["column_name"];
			$t_item_comment = mb_ucfirst($val["column_comment"]);
		?>

		<tr data-column="<?=$item;?>" id="<?=$t_item_name ?>">
			<td><?=$t_item_comment;?></td>
			<td align="center">
				<input type="text" class="column_filter" id="col_<?=$item;?>_filter" autocomplete="off">
			</td>
		</tr>

		<?}?>

	</tbody>
</table>  

<button type="button" class="btn btn-warning ser_table_clear">
	<?=$btnicon["сбросить"]["ico"]?>
	<span>Сбросить</span>
</button>

  




