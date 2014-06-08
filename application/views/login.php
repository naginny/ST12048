<section class="container transparentBg">
			<?=form_open(); ?>
				<?php if (!empty($messages)) : ?>
					<ul class="messages">
						<?php foreach($messages as $msg) : ?>
							<li><?=$msg; ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
	
				<div class="login-block">
					<h2>Autorizācijas forma</h2>
					
					<div class="login-item">
						<span class="login-title">E-pasts:</span>
						<input type="text" name="email" value="<?=array_key_exists('email', $_POST) ? htmlspecialchars($_POST['email']) : ''; ?>">
					</div>
					
					<div class="login-item">
						<span class="login-title">Parole:</span> 
						<input type="password" name="password" placeholder="">
					</div>
					
					<div class="login-item">
						<input type="submit" value="Ieiet" name="submit">
					</div>
				</div>
			<?=form_close(); ?>
</section>
