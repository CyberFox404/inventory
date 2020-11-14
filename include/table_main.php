
<div id="table_id_main">  
	<table id="table_id" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<?foreach ($tablehead as $item => $val) {
				$t_item_comment = mb_ucfirst($val["column_comment"]);?>
				<th><?=$t_item_comment;?></th>
				<?}?>
			</tr>
		</thead>
		<tbody>
		</tbody>
		<tfoot>
			<tr>
				<?foreach ($tablehead as $item => $val) {
				$t_item_comment = mb_ucfirst($val ["column_comment"]);?>
				<th><?=$t_item_comment;?></th>
				<?}?>
			</tr>
		</tfoot>
	</table>
</div>