<div class="confirm-code-top">
	<?php
		$avatar = PromotorAvatar::findBy('promotor_id', $promotor->id);
		if (!empty($avatar)) { ?>
			<img class="code-info-avatar" src="/system/promotor_avatars/<?= $promotor->id ?>/small/<?= $avatar->file_name ?>">
		<?php } else { ?>
			<div class="code-info-avatar"></div>
		<?php } 
	?>
	<div class="code-info-title">
		<?= $promotor->name ?>
		<br />
		<p><?= $promotion_action->name ?></p>
	</div>
	<hr>
	<table class="code-info-table">
		<tr>
			<td class="left-first" width="50%">Kod</td>
			<td class="right-first" width="50%">Wartość kodu</td>
		</tr>
		<tr>
			<td class="left"><?= $params['code'] ?></td>
			<td class="right">+ <?= $package->codes_value ?> pkt</td>
		</tr>
	</table>
</div>
<div class="confirm_code_message" class="green_font">
	<i class="fa fa-smile-o fa-5x" aria-hidden="true"></i>
	<p>Gratulacje,</p>
	<?= $package->codes_value ?> punktów zostało dopisanych do Twojego konta.
</div>
<div class="confirm_code_bottom">
	<b class="dark_font">Sprawdź aktualny stan punktów.</b>
	<br><br>
	Wystarczy kliknąć<br />
	w dowolny link w dowolnej wiadomości email potwierdzającej dodanie punktów.
</div>
<?php	
	$router = Config::get('router');
	$path = $router->generate('start_page', []);
?>
<a class="text_center white_font" href="<?= $path ?>">Powrót</a>
<script type="text/javascript" src="/assets/javascript/hashEmailFormGuardianInitialize.js"></script>