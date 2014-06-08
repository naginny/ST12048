<section class="container transparentBg">
	
	<div class='newAd'>
			<?php if (!$user) : ?>
				<p>Iesniegt sludinājumus var tikai reģistrēti lietotāji</p>
			<?php else : ?>
				<a href="<?=site_url('ads/createNewAd'); ?>">Iesniegt sludinājumu</a>
			<?php endif; ?>
	</div>
	
	<div class='ads_search'>
		
		Kategorija: 
		<select name='category' form='searchForm'>
			<?php foreach($categories as $id => $category) : ?>
				<option value="<?=$id; ?>"<?php if (isset($_POST['category']) && $id == $_POST['category']){ print('selected');} ?>><?=$category; ?></option>
			<?php endforeach; ?>
		</select>
		
		Tips: 
		<select name='type' form='searchForm'>
			<?php foreach($types as $id => $type) : ?>
				<option value="<?=$id; ?>"<?php if (isset($_POST['type']) && $id == $_POST['type']){ print('selected');} ?>><?=$type; ?></option>
			<?php endforeach; ?>
		</select>
		
		Pilsēta: 
		<select name='city' form='searchForm'>
			<?php foreach($cities as $id => $city) : ?>
				<option value="<?=$id; ?>"<?php if (isset($_POST['city']) && $id == $_POST['city']){ print('selected');} ?>><?=$city; ?></option>
			<?php endforeach; ?>
		</select>
		
		<form action='' method='post' id='searchForm'>
			<?php if ($user) : ?>
				<input type="checkbox" name='authorId' value='<?= $user['id']; ?>' <?php if (isset($_POST['authorId'])){ print('checked');}?>>Tikai mani
			<?php endif; ?>
			<button type='submit' value='submit'>Atlasīt</button>
		</form>
	</div>
	
	<div class='ads_list'>
		<?php foreach ($ads as $id => $ad) : ?>
			<div class='ad_item'>
				<a href="<?=site_url('ad'); ?>?id=<?=$ad['id']; ?>"><?=$ad['text']; ?></a>
				<div class='ad_info_cont'>
					<div class='ad_info'><?php print(' | '.$categories[$ad['category']]);?></div>
					<div class='ad_info'><?php print(' | '.$types[$ad['type']]);?></div>
					<div class='ad_info'><?php print(' | '.$cities[$ad['city']]);?></div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
		
	<div class='pagination'>
		<?php print $this->pagination->create_links();?>
	</div>
</section>
