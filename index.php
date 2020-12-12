<!DOCTYPE html>
<html>
	<head lang="en">
		<meta charset="utf-8">
		<title>Railway Management System</title>
		<link rel="icon" href="images/icon.svg"></link>
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
			<div class = "slides" style="position:center">
				<span class="dot" onclick="currentSlide(1)"></span>
			  <span class="dot" onclick="currentSlide(2)"></span>
			  <span class="dot" onclick="currentSlide(3)"></span>
			</div>
		</div>
		<br>
		<div class ="content">
			<h1>News <a> <img src="images/news.jpg" alt="" style="width:50px;height:50px"></a></h1>
			<div class ="news-grid">
				<div class="blockcontent">
					<div class="card1" id="Front news">
						<div class="card1-content">
							<h3>Health</h3>
							<a href="https://e.vnexpress.net/photo/news/how-vietnam-produces-its-domestic-covid-19-vaccine-4205025.html"><img src="images/cov.png" alt="" style="width:100%; height:150px"> </a>
							<p>Stay safe and always wear mask.</p>
						</div>
					</div>
					<div class="card1" id="Health">
						<div class="card1-content">
								<h3>Life</h3>
							<a href="https://thanhnien.vn/suc-khoe/dieu-gi-xay-ra-khi-ban-an-moi-ngay-mot-trai-chuoi-1315452.html"><img src="images/health.jpg" alt="" style="width:100%; height:150px"> </a>
							<br>
							<p>Take care of your body and stay alert. </p>
						</div>
					</div>
					<div class="card1" id="Travel">
						<div class="card1-content">
							<h3>Travel</h3>
							<a href="https://e.vnexpress.net/news/travel/food/ha-tinh-s-unique-steamed-rice-rolls-with-spring-roll-stuffing-4204927.html"><img src="images/travel.jpg" alt="" style="width:100%; height:150px"> </a>
							<p>Discover your favorite places.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="content">
			<h1>Announcement <a> <img src="images/Ann.png" alt="" style="width:50px;height:50px"></a></h1>
			<div class="news-grid"  style="background-color:white; margin-left:5%;margin-right:5%">
				<div class="blockcontent" >
					<h2> Update </h2>
						<p>Currently no issues.</p>
				</div>
			</div>
		</div>
		<br>
		<?php require_once('footer.php'); ?>
	</body>
</html>
