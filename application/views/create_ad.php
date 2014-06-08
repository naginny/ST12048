<section class="container transparentBg">
			<?=form_open(); ?>
			<?php if (!empty($messages)) : ?>
			<ul class="messages">
				<?php foreach($messages as $msg) : ?>
				<li><?=$msg; ?></li>
				<?php endforeach; ?>
			</ul>
			<?php endif; ?>
			<div class="add-block">
				<h2>Jauns sludinājums</h2>

				<div class="add-item">
					<span class="add-title">Kategorija:</span> 
					<select name='category'>
						<?php foreach($categories as $id => $category) : ?>
							<option value="<?=$id; ?>"<?= $id == $curCategory ? 'selected' : ''; ?>><?=$category; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="add-item">
					<span class="add-title">Tips:</span> 
					<select name='type'>
					<?php foreach($types as $id => $type) : ?>
						<option value="<?=$id; ?>"<?php if (isset($_POST['type']) && $id == $_POST['type']){ print('selected');} ?>><?=$type; ?></option>
					<?php endforeach; ?>
					</select>
				</div>
				<div class="add-item">
					<span class="add-title">Pilsēta:</span> 
					<select name='city'>
					<?php foreach($cities as $id => $city) : ?>
						<option value="<?=$id; ?>"<?php if (isset($_POST['city']) && $id == $_POST['city']){ print('selected');} ?>><?=$city; ?></option>
					<?php endforeach; ?>
					</select>
				</div>
				
				
				<div class="add-item">
					<span class="add-title">Teksts:</span>
					<textarea rows='12' cols="60" name='text'></textarea>
				</div>
				
				<div class='add-item'>
					<span class='add-title'>Cena (Eiro):</span>
					<input type='text' name='price'>
				</div>
				
				<div class='add-item'>
					<span class='add-title'>Telefona numurs:</span>
					<input type='text' name='phone'>
				</div>
				
				<div class='add-item'>
					<span class='add-title'>E-pasts:</span>
					<input type='text' name='email'>
				</div>

				<div class="add-item">
					<input type="submit" value="Iesniegt" name="submit">
				</div>
		    </div>
			<?=form_close(); ?>
</section>
