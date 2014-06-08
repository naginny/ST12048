<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php print($title); ?></title>
	<link rel="stylesheet" type="text/css" href="<?=base_url('css/main.css');?>"/>
	
	<link href='http://fonts.googleapis.com/css?family=Crafty+Girls' rel='stylesheet' type='text/css'>
	<script src="<?=base_url('js/jquery.min.js');?>"></script>
	<script src="<?=base_url('js/jquery.nicescroll.js');?>"></script>
	
	<script>
		$(document).ready(function()
		{  
			$("html").niceScroll();
		});
	</script>
	
</head>
<body>
    <header>
		<div class="welcome-msg">
			<?php print('Sveiki, '); (array_key_exists('email', $user) ? print($user['email']) : print('viesis'));?>
			
		</div>
        <div id="logo">
			<h1>HARMONIJA</h1>
			<h3>Labdarības Organizācija</h3>
		<img src="<?=base_url('img/plant2.png');?>" alt="logo">
		</div>
		
        <nav>
            <ul id="mainmenu">
                    <li><a href="<?=site_url('news'); ?>">Ziņas</a></li>
                    <li><a href="<?=site_url('about'); ?>">Par mums</a></li>
                    <li><a href="<?=site_url('ads'); ?>">Sludinājumi</a></li>
                    <li><a href="<?=site_url('contacts'); ?>">Kontakti</a></li>
					<?php if (is_admin()) : ?>
						<li><a href="<?=site_url('users/listUsers'); ?>">Lietotāji</a></li>
					<?php endif; ?>
					<?php if (!$user) : ?>
						<li><a href="<?=site_url('auth/login'); ?>">Ieiet</a></li><li><a href="<?=site_url('auth/register'); ?>">Reģistrēties</a></li>
					<?php else : ?>
						<li><a href="<?=site_url('auth/logout'); ?>">Iziet</a></li>
					<?php endif; ?>
			</ul>
        </nav>
	</header>
	
