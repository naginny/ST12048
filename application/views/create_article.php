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
					<h2>Ziņu pievienošana</h2>
					
					<div class="reg-item">
						<span class="reg-title ">Virsraksts:</span> 
						<textarea rows='2' cols="60" name='title'><?=array_key_exists('title', $_POST) ? $_POST['title'] : ''; ?></textarea>
					</div>
					
					<div class="reg-item">
						<span class="reg-title">Īss apraksts:</span> 
						<textarea rows='4' cols="60" name='summary'><?=array_key_exists('summary', $_POST) ? $_POST['summary'] : ''; ?></textarea>
					</div>
					
					<div class="reg-item">
						<span class="reg-title">Teksts:</span>
						<textarea rows='12' cols="60" name='text'><?=array_key_exists('text', $_POST) ? $_POST['text'] : ''; ?></textarea>
					</div>
					
					<div class="reg-item">
						<span class="reg-title">Avots:</span> 
						<textarea rows='1' cols="60" name='source'><?=array_key_exists('source', $_POST) ? $_POST['source'] : ''; ?></textarea>
					</div>

					<div class="reg-item">
						<input type="submit" value="Pievienot" name="submit">
					</div>
				</div>
			<?=form_close(); ?>
</section>
