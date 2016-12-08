<?php	
	$router = Config::get('router');
	$path = $router->generate('start_page', []);
?>
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
			<td class="left-first" width="100%">Kod</td>
		</tr>
		<tr>
			<td class="left"><?= $params['code'] ?></td>
		</tr>
	</table>
</div>
<div class="confirm_code_message" class="green_font">
	<i class="fa fa-smile-o fa-5x" aria-hidden="true"></i>
	<br />
	Dziękujemy za wzięcie udziału w konkursie.
</div>
<div class="confirm_code_bottom">
	<a href="<?= $path ?>"><button>Wpisz następny kod</button></a>
</div>
<a class="text_center white_font" href="<?= $path ?>">Powrót</a>
<script type="text/javascript" src="/assets/javascript/hashEmailFormGuardianInitialize.js"></script>