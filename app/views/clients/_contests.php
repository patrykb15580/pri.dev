<?php 
foreach ($client->promotors() as $promotor) { 
	$i = 0;
	foreach ($contests as $contest) { 
		if ($contest->promotor_id == $promotor->id) { 
			$i++;
		}
	}
	if ($i !== 0) { 
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
					<td class="first-row" width="50%">Nazwa konkursu</td>
					<td class="first-row" width="50%">Odpowiedź</td>
				</tr>
			<?php foreach ($contests as $contest) { 
				if ($contest->promotor_id == $promotor->id) { ?>
					<tr class="result">
						<td width="30%"><?= $contest->name ?></td>
						<td width="70%"><?= nl2br(($client->contestAnswer($contest->id))->answer) ?></td>
					</tr>
				<?php } } ?>
				<tr id="last_row"><td width="50%">Liczba konkursów: <b><?= $i ?></b></td><td width="50%"></td></tr>	
			</table>
		</div>
	<?php } 
}
?>