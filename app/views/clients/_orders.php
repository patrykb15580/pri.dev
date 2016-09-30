<h2>W trakcie realizacji</h2>
<table width="100%">
	<tr>
		<td id="first_row" width="60%"></td>
		<td id="first_row" width="25%">Kiedy</td>
		<td id="first_row" width="15%">Wartość punktowa</td>
	</tr>
<?php foreach ($active_orders as $order) { 
	$reward = $order->reward(); ?>
	<tr>
		<td width="60%"><?= $reward->name ?></td>
		<td width="25%"><?= $order->created_at ?></td>
		<td width="15%"><?= $reward->prize ?></td>
	</tr>
<?php } ?>
</table>

<h2>Zrealizowane</h2>
<table width="100%">
	<tr>
		<td id="first_row" width="60%"></td>
		<td id="first_row" width="25%">Kiedy</td>
		<td id="first_row" width="15%">Wartość punktowa</td>
	</tr>
<?php foreach ($completed_orders as $order) { 
	$reward = $order->reward(); ?>
	<tr>
		<td width="60%"><?= $reward->name ?></td>
		<td width="25%"><?= $order->updated_at ?></td>
		<td width="15%"><?= $reward->prize ?></td>
	</tr>
<?php } ?>
</table>

<h2>Anulowane</h2>
<table width="100%">
	<tr>
		<td id="first_row" width="60%"></td>
		<td id="first_row" width="25%">Kiedy</td>
		<td id="first_row" width="15%">Wartość punktowa</td>
	</tr>
<?php foreach ($canceled_orders as $order) { 
	$reward = $order->reward(); ?>
	<tr>
		<td width="60%"><?= $reward->name ?></td>
		<td width="25%"><?= $order->updated_at ?></td>
		<td width="15%"><?= $reward->prize ?></td>
	</tr>
<?php } ?>
</table>