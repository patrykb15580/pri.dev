<?php 
foreach ($client->promotors() as $promotor) { 
	$path_rewards = $router->generate('client_index_rewards', ['client_id' => $params['client_id'], 'promotors_id' => $promotor->id]);
	$balance = PointsBalance::where('client_id=? AND promotor_id=?', ['client_id'=>$client->id, 'promotor_id'=>$promotor->id]);
	$balance = $balance[0];
	$avatar = $promotor->avatar();?>
	<div class="client-view-item-box">
		<?php 
			if (empty($avatar)) { ?>
				<div class="client-view-avatar"></div>
			<?php } else { ?>
				<img class="client-view-avatar" src="/system/promotor_avatars/<?= $promotor->id ?>/small/<?= $avatar->file_name ?>">
			<?php }
		?>
		<p class="client-view-item-title"><?= $promotor->name ?></p>
		<table width="100%">
			<tr>
				<td class="first-row" width="80%">Nazwa akcji</td>
				<td class="text_align_right first-row" width="20%">Twoje punkty</td>
			</tr>
		<?php foreach ($promotion_actions as $promotion_action) { 
			if ($promotion_action->promotors_id == $promotor->id) { ?>
				<tr class="result">
					<td width="80%"><b><?= $promotion_action->name ?></b></td>
					<td class="text_align_right" width="20%"><?= $client->promotionActionsValues()[$promotion_action->id] ?> pkt</td>
				</tr>
			<?php } } ?>
			<tr id="last_row"><td width="80%"><a href="<?= $path_rewards ?>"><button class="client-view-item-button">Katalog nagród</button></a></td><td class="text_align_right" width="20%">razem <p class="client-balance"><?= $balance->balance ?> pkt</p></td></tr>	
		</table>
	</div>
<?php } ?>