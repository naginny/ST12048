<section class="container">
	
	<?php if (is_admin()) : ?>
		<a style="color:red;" href="<?=site_url('news/createArticle'); ?>">[Pievienot ziņas]</a>
	<?php endif; ?>
	
	<section class="news_container">
		<?php
		foreach ($data as $item)
		{
			print('<div class="news_item">');
			print('<a href="'.site_url('article').'?id='.$item['id'].'">'.$item['title'].'</a>');
			print('<p>'.$item['summary'].'</p>');
			print('<div class="date">'.$item['dateAdded'].'</div>');
			print('</div>');
		}
		
		?>
		<div class='pagination'>
			<?php print $this->pagination->create_links();?>
		</div>
	</section>
</section>
