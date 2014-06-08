</section>
</body>
<footer>
	<p>(c) Harmonija labdarības organizācija</p>
	<img src='<?=base_url('img/official.png');?>'>
	<?php if ($user) : ?>
		<a href='<?=site_url('users/deleteUser').'/'.$user['id']; ?>'>
			<button type='button'>Dzēst savu profilu</button>
		</a>
	<?php endif; ?>
</footer>
</html>

