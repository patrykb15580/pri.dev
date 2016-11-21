<?php
	$contest_answer_path = $router->generate('give_answer', ['id'=>$contest->id]);
	$promotor = $contest->promotor();
	$avatar = $promotor->avatar();
?>
<div class="answer-box">
	<div class="answer-form-top">
		<?php if (empty($avatar)) { ?>
			<div class="answer-form-avatar"></div>			
		<?php } else { ?>
			<img class="answer-form-avatar" src="/system/promotor_avatars/<?= $promotor->id ?>/small/<?= $avatar->file_name ?>">
		<?php } ?>
		<div class="answer-form-title">
			<p><?= $promotor->name ?></p>
			<?= $contest->name ?>
		</div>
		<br /><br />
		Pytanie konkursowe:<br />
		<b><?= $contest->question ?></b>
	</div>
	<form class="answer-form guardian-initialize" method="POST" action="<?= $contest_answer_path ?>">
		Odpowiedź<br />
		<textarea rows="4" name="answer[answer]" required="required"></textarea><br />
		Email<br />
		<input type="email" name="client[email]" required="required"><br />
		Nazwa<br />
		<input type="text" name="client[name]" required="required"><br />
		Numer telefonu<br />
		<input type="text" name="client[phone_number]" required="required"><br />
		<input type="submit" value="Wyślij">
	</form>
</div>