<!DOCTYPE HTML>
<html>
	<head>
		<title>
			BS4
		</title>
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,100" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Poiret+One&amp;subset=cyrillic" rel="stylesheet"> 
		<link rel="stylesheet" type="text/css" href="style/main.css">
		<link rel="stylesheet" type="text/css" href="fonts/icofont/icofont.min.css">
		<meta charset="utf8">
	</head>

	<body>
		<nav class="navbar navbar-expand-lg navbar-light navbar-dark fixed-top">
			<div  class="container">
				<a class="navbar-brand" href="#">Strip<span>Hall</span></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item">
							<a class="nav-link" href="#">Девушки</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Афиша</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Программы</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Правила</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Галерея</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Контакты</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>

	    <?php
	      include_once($view);
	    ?>

		<link rel="stylesheet" href="lib/bootstrap/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="lib/bootstrap/js/bootstrap.min.js"></script>

		<link rel="stylesheet" type="text/css" href="lib/lightbox/dist/css/lightbox.min.css">
		<script src="lib/lightbox/dist/js/lightbox.min.js"></script>

		<link rel="stylesheet" type="text/css" href="lib/slick/slick.css"/>
		<link rel="stylesheet" type="text/css" href="lib/slick/slick-theme.css"/>
		<script type="text/javascript" src="lib/slick/slick.min.js"></script>
		<script>
		  $('.girl-play').slick({
			infinite: true,
			speed: 300,
			slidesToShow: 4,
			slidesToScroll: 1,
			responsive: [
			{
			  breakpoint: 1024,
			  settings: {
			    slidesToShow: 3,
			    slidesToScroll: 3,
			    infinite: true,
			  }
			},
			{
			  breakpoint: 700,
			  settings: {
			    slidesToShow: 1,
			    slidesToScroll: 1
			  }
			}
			]
		  });
		</script>

		<script src="lib/gallery/jquery.justifiedGallery.min.js"/></script>
		<link href="lib/gallery/justifiedGallery.min.css" rel="stylesheet"/>
		<script>
			$("#mygallery").justifiedGallery({lastRow : 'justify'}); 
		</script>

		<script src="lib/flipimage/flip.js"></script>
		<script>
			$(".afisha-block").flip({
				axis: 'x',
				trigger: 'hover',
				reverse: true
				});
			$(".afisha-block").css("height",$(".afisha-block").find("img").height());
			console.log($(".afisha-block").find("img").height());
		</script>
	</body>
</html>
