<section class="container transparentBg">
	<div class='ad_cont'>
		<h3>Sludinājums</h3>
		
		<h4>Sludinājuma teksts:</h3>
		<div>
			<?=$data['text'];?>
		</div>
		<?php if (!empty($data['price'])) : ?>
			<div>
				Cena (Eiro): <?php print($data['price']); ?>
			</div>
		<?php endif; ?>
		
		<h4>Kontaktinformācija:</h3>
		<?php if (!empty($data['phone'])) : ?>
			<div>
				Telefona numurs: <?php print($data['phone']); ?>
			</div>
		<?php endif; ?>
		
		<?php if (!empty($data['email'])) : ?>
			<div>
				E-pasts: <?php print($data['email']); ?>
			</div>
		<?php endif; ?>
		
		<div>
			Sludinājums iesniegts: <?php print($data['dateAdded']); ?>
		</div>
		
		<?php if (is_admin() || $data['authorId'] == $user['id']) : ?>
			<a style="color: red;" href="<?=site_url('ads/delete').'/'.$data['id']; ?>">[Dzēst]</a>
		<?php endif; ?>
	</div>
</section>
