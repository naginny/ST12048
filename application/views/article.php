<section class="container transparentBg">
	<div class='article_cont'>
		<h3><?=$data['title']; ?></h3>
		
		<div class="article">
			<?=$data['text']; ?>
		</div>
		
		<div class="info">
			<?php if (!empty($data['source'])) : ?>
				Avots: <?php print($data['source']); ?>
			<?php endif; ?>
			<?=$data['dateAdded']; ?>
		</div>
		
	</div>
	<?php if (is_admin()) : ?>
		<a style="color: red;" href="<?=site_url('news/delete').'/'.$data['id']; ?>">[Dzēst]</a>
	<?php endif; ?>
</section>
