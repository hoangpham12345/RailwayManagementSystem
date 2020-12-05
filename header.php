<header id="top">
	<div id="visual-header" href= "index.php">
		<table id="headerTable" style="margin :'80px' " >
			<tr>
				<td id="icon1" width="75px"><img src='images/icon1.svg' width='60px' height='60px'></td>
				<td id="title1"><p style = "font-family:'Times New Roman', Times, serif;font-size: 300%;font-color:black">Railway Management System</p></td>
				<td id="Menu-bar">
					<div class="container" onclick="myFunction(this) " style="right:100px;">
						<button onclick="myFunction1()" class="dropbtn">
							<div class="bar1"></div>
							<div class="bar2"></div>
							<div class="bar3"></div>
						</button>
						<div id="myDropdown" class="dropdown-content">
    					<a href="index.php">Home</a>
    					<a href="about.php">About</a>
    					<a href="booking.php">Booking</a>
						</div>

					</div>
				</td>
			</tr>
			<script>
			function myFunction1() {
  			document.getElementById("myDropdown").classList.toggle("show");
			}
			function myFunction(x) {
			  x.classList.toggle("change");
				window.onclick = function(event) {
					if (!event.target.matches('.dropbtn')) {
						var dropdowns = document.getElementsByClassName("dropdown-content");
						var i;
						for (i = 0; i < dropdowns.length; i++) {
							var openDropdown = dropdowns[i];
							if (openDropdown.classList.contains('show')) {
									openDropdown.classList.remove('show');
									 x.classList.toggle("change");
							}
						}
					}
				}
			}
			</script>
		</table>
		<nav>
			<ul>
			<li><a href="index.php">HOME</a></li>
			<li><a href="booking.php">BOOKING</a></li>
			<li><a href="about.php">ABOUT</a></li>
			</ul>
		</nav>
	</div>
</header>
