<section class="container transparentBg">
	<?=form_open(); ?>
		<?php if (!empty($messages)) : ?>
			<ul class="messages">
				<?php foreach($messages as $msg) : ?>
				<li><?=$msg; ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>

		<div class="reg-block">

			<h2>Reģistrācijas forma</h2>

			<div class="reg-item">
				<span class="reg-title ">E-pasts:</span> 
				<input type="text" name="email" value="<?=array_key_exists('email', $_POST) ? htmlspecialchars($_POST['email']) : ''; ?>">
			</div>

			<div class="reg-item">
				<span class="reg-title">Parole:</span> 
				<input type="password" name="password" placeholder="">
			</div>

			<div class="reg-item">
				<span class="reg-title">Parole atkārtoti:</span> 
				<input type="password" name="password_repeat" placeholder="">
			</div>

			<div class="reg-item">
				<input type="submit" value="Reģistrēties" name="submit">
			</div>
		</div>
	<?=form_close(); ?>
</section>