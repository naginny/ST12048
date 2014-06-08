<section class="container transparentBg">
	
	<?php if (is_admin()) : ?>
	
	<form action='<?=site_url('about/updateArticle').'/'.$data['id']; ?>' method='post'>
			<div class="reg-item">
				<textarea rows='30' cols="110" name='text'><?=array_key_exists('text', $data) ? $data['text'] : ''; ?>
				</textarea>
			</div>
			<div class="reg-item">
				<button type='submit'>Saglabāt izmaiņas</button>
			</div>

	</form>
	
	<?php else: ?>
	
		<?php print($data['text']); ?>
	
	<?php endif; ?>
	
</section>

