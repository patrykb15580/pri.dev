<div id="login_box">
	<div class="login_left_block">
		<h1 class="green_font">
			Koniec z hasłami!
		</h1>
		Aby zalogować się do panelu wystarczy kliknąć w dowolny link w dowolnej wiadomości email od nas.
	</div>
	<div class="login_right_block">
		<p class="extra_bold medium_font">
			Skasowałeś wszystkie wiadomości od nas?
		</p>
		Nie ma problemu, wpisz poniżej Twój adres e-mail a po chwili otrzymasz na swoją pocztę wiadomość z linkiem do logowania.
		<br /><br />
		<form>
			<label>
				E-mail
			</label>
			<br /><input type="text" name="client_email">
			<br /><input class="login_submit" type="submit" value="Wyślij link do logowania">
		</form>
		<br /><br />
		<a class="bottom_left_text" href="<?= $router->generate('promotor_login', []) ?>">Zaloguj jako promotor</a>
	</div>
</div>