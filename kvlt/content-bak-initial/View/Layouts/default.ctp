<!DOCTYPE html>
<html>
<head>

	<?$url_robots = $_SERVER['SERVER_NAME'];
	if (strpos($url_robots,'staging.') !== false) {?>
		<meta name="robots" content="noindex, nofollow">
	<?}?>

	<title><?=(!empty($meta_title)?$meta_title:'');?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="<?=(!empty($meta_description)?$meta_description:'');?>">
	<link type="text/css" href="/css/style.css?id=<?=rand();?>" media="all" rel="stylesheet" />
	<link type="text/css" href="/css/style_responsive.css?id=<?=rand();?>" media="all" rel="stylesheet" />
	<link rel="icon" type="image/png" href="/favicon.png">

	<!--Facebook Meta -->
	<meta property="og:title" content="meta title" />
	<meta property="og:description" content="meta description" />
	<meta property="og:image" content="link to image" />
	<meta property="og:url" content="put url here" />
	<meta property="og:image:width" content="1200" />
	<meta property="og:image:height" content="630" />
	<meta property="og:type" content="website" />
	<meta property="fb:app_id" content="erase if not connected to fb app"/>
	<!--
		Image Sizes
		Use images that are at least 1200 x 630 pixels for the best display on high resolution devices.
		At the minimum, you should use images that are 600 x 315 pixels to display link page posts with larger images.
		Images can be up to 8MB in size.

		Small Images
		If your image is smaller than 600 x 315 px, it will still display in the link page post, but the size will be much smaller.
	-->
	<!--Facebook Meta End-->

	<!--Twitter Card -->
		<meta name="twitter:card" content="summary" />
		<meta name="twitter:site" content="@twitterhandle" />
		<meta name="twitter:title" content="meta title" />
		<meta name="twitter:description" content="meta description" />
		<meta name="twitter:image" content="link to image" />
	<!--Twitter Card End-->

</head>

<body>
<!-- Navigation -->
<section id="nav_bar">
	<div class="container clearfix">
		<img src="" alt="" />
		<div id="nav_toggle">
			<hr /><hr /><hr />
		</div>
		<nav role="navigation">
			<ul role="menubar">
				<li role="presentation"><a href=""></a></li>
				<li role="presentation"><a href=""></a></li>
			</ul>
		</nav>
	</div>
</section>
<!-- Navigation -->

<?php echo $this->fetch('content'); ?>

<!-- Sub Footer -->
<section class="sub_footer">
	<div class="container">
	</div>
</section>
<!-- Sub Footer -->

<!-- Footer -->
<footer>
	<div class="container">
	</div>
</footer>
<!-- Footer -->

<?if(!empty($_GET['success'])) {echo $this->Element('modal');}	?>

<!-- Browser detect and add class to document -->
<script>
var doc = document.documentElement;
        doc.setAttribute('data-useragent',  navigator.userAgent);
        doc.setAttribute('data-platform', navigator.platform );
        doc.className += ((!!('ontouchstart' in window) || !!('onmsgesturechange' in window))?' touch':'');
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="/js/script.js?id=<?=rand();?>"></script>

</body>
</html>
