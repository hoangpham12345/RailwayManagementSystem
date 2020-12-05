<!DOCTYPE html>
<html>
	<head lang="en">
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="stylesheet/index.css"></link>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.10.2/p5.js"></script>
		<script src="scripts/slideshow.js"></script>
		<script>
			window.onload = function(){
				autoShowSlides();
			}
		</script>
	</head>
	<body>
		<?php require_once('header.php'); ?>
		<div class="slideshow-container" style="text-align:center">
			<div class="mySlides fade" id="pic1">
 				<img src="images/train_test.jpg">
			</div>
			<div class="mySlides fade">
			  <img src="images/slideshow/image4_test.jpg">
			</div>
			<div class="mySlides fade">
			  <img src="images/slideshow/img1_test.jpg" >
			</div>
			<br>
			<div class = "slides" style="test-align:center">
				<span class="dot" onclick="currentSlide(1)"></span>
			  <span class="dot" onclick="currentSlide(2)"></span>
			  <span class="dot" onclick="currentSlide(3)"></span>
			</div>
		</div>
		<div id = "Content2">
				<h2>
					It's an on-going project to help the customers be at ease whenever they take the trains.</h2>
				<h2>
					Easy to navigate the map for booking and to book with clear and direct information.
				</h2>

		</div>
		<?php require_once('footer.php'); ?>
	</body>
</html>
