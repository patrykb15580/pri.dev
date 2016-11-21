<table width="100%">
	<tr>
		<td id="first_row" width="55%">Nazwa konkursu</td>
		<td id="first_row" width="30%">Czas trwania</td>
		<td id="first_row" class="text_align_right" width="15%">Liczba odpowiedzi</td>
	</tr>
<?php foreach ($contests as $contest) {
	$path_show = $router->generate('show_contests', ['promotors_id' => $params['promotors_id'], 'contest_id' => $contest->id]);

	$from_day = intval(date('d', strtotime($contest->from_at)));
	$from_month = PolishMonthName::NAMES_VARIETLY[date('m', strtotime($contest->from_at))];
	$from_year = date('Y', strtotime($contest->from_at));

	$from_at = $from_day." ".$from_month." ".$from_year;

	$to_day = intval(date('d', strtotime($contest->to_at)));
	$to_month = PolishMonthName::NAMES_VARIETLY[date('m', strtotime($contest->to_at))];
	$to_year = date('Y', strtotime($contest->to_at));
	
	$to_at = $to_day." ".$to_month." ".$to_year;?>
	<tr class="result">
		<td width="55%"><a href="<?= $path_show ?>"><b><?= $contest->name ?></b></a></td>
		<td width="30%"><?= $from_at." - ".$to_at ?></td>
		<td class="text_align_right" width="15%"><b><?= count($contest->answers()) ?></td>
	</tr>
<?php } ?>	
</table>
