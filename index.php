<?php
?>
    <!DOCTYPE html>
	<html lang="en">
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/datatable_bootstrap.css">
        <link rel="stylesheet" href="css/style.css">

		<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.2/jquery.ui.touch-punch.min.js"></script>
		<script type="text/javascript"  src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.4.4/underscore-min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/backbone.js/1.0.0/backbone-min.js"></script>
        <script type="text/javascript" src="js/lib/DataTables-1.9.4/media/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="js/lib/datatable_bootstrap.js"></script>
        <script type="text/javascript" src="js/app.js"></script>
        <script type="text/javascript" src="js/router.js"></script>
        <script type="text/javascript" src="js/view/home.js"></script>
        <script type="text/javascript" src="js/view/actor.js"></script>
        <script type="text/javascript" src="js/view/movie.js"></script>
		<script type="text/javascript">
			$(function() {
                App.initialize();
			});
        </script>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-41620747-1', 'homeserver.com');
            ga('send', 'pageview');
        </script>
	</head>
	<body>
        <!-- Fixed navbar -->
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="brand" href="">Movie Finder</a>
                    <form class="navbar-search pull-right">
                        <input id="searchMain" autocomplete="off" type="text" class="span2 search-query" placeholder="Search">
                    </form>
                </div>
            </div>
        </div>

	    <!-- Part 1: Wrap all page content here -->
	    <div id="wrap">
	      <!-- Begin page content -->
            <div class="container view" id="homeContainer">
              <div class="row">
                  <div class="span12 thumbnail">
                      <div id="myCarousel" class="carousel slide">
                          <ol class="carousel-indicators">
                              <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                              <li data-target="#myCarousel" data-slide-to="1"></li>
                              <li data-target="#myCarousel" data-slide-to="2"></li>
                              <li data-target="#myCarousel" data-slide-to="3"></li>
                              <li data-target="#myCarousel" data-slide-to="4"></li>
                              <li data-target="#myCarousel" data-slide-to="5"></li>
                          </ol>
                          <!-- Carousel items -->
                          <div class="carousel-inner">
                          </div>
                          <!-- Carousel nav -->
                          <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                          <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="span5">
                      <h2>News</h2>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis auctor viverra magna nec luctus. Vivamus aliquet lorem massa, quis pharetra nisl aliquet quis. Praesent egestas vitae mi bibendum vulputate. In consequat arcu et ligula adipiscing, facilisis feugiat dui luctus. In quis mauris in nunc dapibus pulvinar ac vel odio.</p>
                      <p>Morbi aliquet enim sit amet velit ullamcorper, vitae blandit urna auctor. Nunc ac nisl non sapien faucibus venenatis et quis ipsum. Cras convallis dignissim sapien, vel vehicula tellus. Nam volutpat, orci nec auctor feugiat, nisi arcu volutpat justo, id semper quam dolor ut dui. Vivamus tincidunt ante id augue placerat, in dapibus leo porta. Aliquam vitae facilisis nunc, et vestibulum nibh. Aenean pharetra quis arcu eu porta.</p>
                  </div>
                  <div class="span5 offset1">
                      <h2>Featured Story</h2>
                      <p>Nulla vel tellus leo. Nulla facilisi. Aliquam pharetra, est vel feugiat interdum, nisl mauris vulputate neque, vitae tincidunt nunc nibh et mauris. Donec quis justo lacinia, pretium felis id, semper nunc. Vivamus nec rutrum elit. Proin tristique purus posuere, posuere erat nec, porta sapien. In a semper metus. Mauris aliquet felis vitae magna molestie vulputate.</p>
                  </div>
              </div>
            </div>


            <div class="container view" id="movieContainer">
              <div class="row">
                  <div class="span9">
                      <h1 class="title"></h1>
                      <div class="description"></div>
                  </div>

                  <div class="span3">
                      <img class="profile-image img-polaroid pull-right"/>
                  </div>
              </div>
            </div>

            <div class="container view" id="actorContainer">
                <div class="row">
                    <div class="span9">
                        <h1 class="title"></h1>
                        <div class="description"></div>
                    </div>

                    <div class="span3">
                        <img class="profile-image img-polaroid pull-right"/>
                    </div>
                </div>


                <div class="row">
                    <div class="span12"></div>
                </div>
                <h3>Filmography</h3>
                <div class="row">
                    <div class="span12">
                      <table class="table table-hover table-striped" id="filmography">
                          <tbody>
                          </tbody>
                      </table>
                    </div>
                </div>
	        </div>
            <div id="push"></div>
        </div>
        <div id="footer">
            <div class="container">
                <p class="muted credit">Copyright &copy; 2013 MovieFinder, Inc. &nbsp;&nbsp;&nbsp;Powered by themoviedb.org</p>
            </div>
        </div>
	</body>
</html>
