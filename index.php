<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Railway Management System</title>
		<link rel="icon" href="images/icon.svg"></link>
		<link rel="stylesheet" type="text/css" href="stylesheet/index.css"></link>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.10.2/p5.js"></script>
		<script src="scripts/slideshow.js"></script>
		<script>
			window.addEventListener("load", function(){autoShowSlides()}, false);
		</script>
	</head>
	<body>
		<!-- <iframe id="loader" src="https://hoangpham12345.github.io/RMS-audios/loader.html" title="RMS-loader"
			        height=100% width=100% scrolling="no" style="position: absolute; border: none; z-index: 2; display:block"></iframe> -->
		<!-- <div id="page_content" style="display:block"> -->
			<?php require_once('header.php'); ?>

			<div class="slideshow-container" style="text-align:center">
				<div class="mySlides fade">
					<img src="images/slideshow/img1.jpg">
				</div>
				<div class="mySlides fade">
					<img src="images/slideshow/img2.jpg">
				</div>
				<div class="mySlides fade">
					<img src="images/slideshow/img3.jpg">
				</div>
				<br>
				<div style="text-align:center">
					<span class="dot" onclick="currentSlide(1)"></span>
					<span class="dot" onclick="currentSlide(2)"></span>
					<span class="dot" onclick="currentSlide(3)"></span>
				</div>
			</div>

			<?php require_once('footer.php'); ?>
		<!-- </div> -->

	</body>
</html>
