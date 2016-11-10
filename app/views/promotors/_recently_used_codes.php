<h1 class="stats-title">Kody użyte przez ostatnie 7 dni</h1>
<div id="stats_box">
Ilość użytych kodów: <?= count($promotor->recentlyUsedCodes()) ?><br /><br />
<table width="100%">
	<tr>
		<td id="first_row">
			Kod
		</td>
		<td id="first_row">
			Klient
		</td>
		<td id="first_row">
			Data użycia
		</td>
		<td id="first_row">
			Akcja promocyjna
		</td>
		<td id="first_row">
			Paczka kodów
		</td>
	</tr>
	<?php
		foreach ($promotor->recentlyUsedCodes() as $code) { ?>
			<tr class="result">
				<td>
					<?= $code->code ?>
				</td>
				<td>
					<?= $code->client()->name ?>
				</td>
				<td>
					<?= $code->used ?>
				</td>
				<td>
					<?= $code->promotionAction()->name ?>
				</td>
				<td>
					<?= $code->package()->name ?>
				</td>
			</tr>
		<?php }
	?>
</table>
</div>
<br /><br /><br />