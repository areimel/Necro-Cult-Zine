<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html lang="EN">
<head>

	<!-- Meta -->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Necro Cult | Underground Music for Underground People</title>


	<!-- EVOCATION OF CSS -->
		<link rel="stylesheet" href="/css/styles.css?i=<?=rand();?>">
		<link rel="stylesheet" href="/css/style_responsive.css?i=<?=rand();?>">
		<link rel="stylesheet" href="/css/animations.css?i=<?=rand();?>">
	
    
    <!-- INVOCATION OF CSS -->
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" />
	    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.min.css" />

	<!-- ON-PAGE CSS -->
		<style type="text/css">
			.preload *{
				transition: 0s !important;
				display: none !important;
			}
		</style>
</head>
<body class="preload">

	<div id="grain_filter"></div>
	
	<nav>
		<div class="main">
			<a class="menu_button">
				<i class="fas fa-times"></i>
			</a>
			<a href="/" class="logo">Necro Cult</a>
			<span id=nav_tagline></span>
		</div>
		<div class="links">
			<a href="#">
				<i class="fas fa-cross"></i>
				Full Issues
				<i class="fas fa-cross"></i>
			</a>
			<a href="#">
				<i class="fas fa-cross"></i>
				Reviews
				<i class="fas fa-cross"></i>
			</a>
			<a href="#">
				<i class="fas fa-cross"></i>
				News
				<i class="fas fa-cross"></i>
			</a>
			<a href="#">
				<i class="fas fa-cross"></i>
				Blog
				<i class="fas fa-cross"></i>
			</a>
			<a href="#">
				<i class="fas fa-cross"></i>
				Dev
				<i class="fas fa-cross"></i>
			</a>
		</div>
		
	</nav>

	<div class="body_wrapper">

		<header id=header>
			<a class="menu_button">
				<i class="fas fa-bars"></i>
			</a>
			<a href="/" class="logo">Necro Cult</a>
		</header>

		<!--<div class="overlay"></div>
		<div class="scanline"></div>-->

		<?php echo $this->Flash->render(); ?>

		<?php echo $this->fetch('content'); ?>

		<footer>
			<a href="/" class="logo">Necro Cult</a>
		</footer>

	</div>
	


	<div id="achievement_notification">
		<div class="icon">
			<div class="inner">
				<i class="fas fa-dice-d20"></i>
			</div>
			
		</div>
		<div class="copy">
			<p class="header">Achievement Unlocked:</p>
			<p class="title">Clicker of Buttons</p>
			<p class="description">You have clicked the button.  The adventure begins!</p>
		</div>
	</div>
	

	<!-- JS Resources -->
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/headroom/0.9.4/headroom.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/headroom/0.9.4/jQuery.headroom.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>

		<script src="/js/scripts.js?i=<?=rand();?>"></script>



</body>
</html>
