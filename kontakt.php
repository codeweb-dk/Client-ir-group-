<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->

    <head>
        <title>Kontakt</title>
        
        <meta charset="utf-8" />
	    <meta name="Author" content="IRGROUP" />
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    
	    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7, IE=9" />
		<meta name="Description" content="IR Group er et dansk vikar- og rengøringsbureau, erhvervslivet professionel, lynhurtig og effektiv assistance indenfor rengøring, personaleudvælgelse og vikarløsninger." />
		<meta content="IR Group er et dansk vikar- og rengøringsbureau, erhvervslivet professionel, Renovation, personaleudvælgelse og vikarløsninger, rengøring, Opvask, Tjenere, Køkkenassistenter, Kokke." name="keywords"></meta>
		<meta property="og:title" content="Codeweb" />
		<meta property="og:description" content="IR Group er et dansk vikar- og rengøringsbureau, erhvervslivet professionel, lynhurtig og effektiv assistance indenfor rengøring, personaleudvælgelse og vikarløsninger." />
		<meta property="og:url" content="http://www.irgroup.dk/" />
		<meta name="robots" CONTENT="index, follow">
		<link rel="shortcut icon" href="images/fav.png">
		
		<!================================ main CSS=========  --->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		
		<!================================ Reset CSS =======  --->
		<link href="css/layout.css" rel="stylesheet" media="screen">
		
		<!==========================Google font ============ --->
		<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans"></link>
		
		<!========================= Kontakt form JS ================== --->
		
		
		

		
		<!========================= Google map ========================= ---->
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
			    <script>
			// The following example creates a marker in Stockholm, Sweden
			// using a DROP animation. Clicking on the marker will toggle
			// the animation between a BOUNCE animation and no animation.
			
					var stockholm = new google.maps.LatLng(55.674696, 12.562382);
					var parliament = new google.maps.LatLng(55.674696, 12.562382);
					var marker;
					var map;
					
					function initialize() {
					  var mapOptions = {
					    zoom: 13,
					    center: stockholm
					  };
					
					  map = new google.maps.Map(document.getElementById('map-canvas'),
					          mapOptions);
					
					  marker = new google.maps.Marker({
					    map:map,
					    draggable:true,
					    animation: google.maps.Animation.DROP,
					    position: parliament,
					    title: 'IR Group ApS'

					  });
					  google.maps.event.addListener(marker, 'click', toggleBounce);
					}
					
					function toggleBounce() {
					
					  if (marker.getAnimation() != null) {
					    marker.setAnimation(null);
					  } else {
					    marker.setAnimation(google.maps.Animation.BOUNCE);
					  }
					}
					
					google.maps.event.addDomListener(window, 'load', initialize);
			
			    </script>




    </head>
    <!---head end-->
    <!--body start-->
    <body>
	    <div id="globlWrapper">
	         <div id="header-top"></div>
		     <header id="mainHeader" role="banner">
						<div class="container">
							<nav class="navbar navbar-default scrollMenu irNavigation" role="navigation">
								<div class="navbar-header">
									<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
									<a class="navbar-brand navbar-logo" href="index.php"><img src="images/irlogo.png" height="75px" width="90px" alt="IR Group"/></a> 
								</div>
									<div class="collapse navbar-collapse navbar-ex1-collapse" id="scrollTarget">
										<ul class="nav navbar-nav pull-right irNav">
											<li><a href="index.php"><i class="icon-home-outline"></i>Home</a> </li>
											<li><a href="about-ir.php"><i class="icon-comment"></i>Om IR Group</a> </li>
											<li><a href="services.php"><i class="icon-thumbs-up"></i>Services</a> </li>
											<li class="dropdown"><a href="ledige-vikariater.php" data-toggle="dropdown" class="dropdown-toggle">Jobsøgere<b class="caret"></b></a> 
											<ul class="list-unstyled dropdown-menu">
												<li><a href="ledige-vikariater.html">Ledige vikariater</a></li>
												<li><a href="cvsend.php">Send dit CV</a></li>
											</ul></li>
											<li><a href="for-virksomheder.php"><i class="icon-popup-1"></i>For virksomheder</a> </li>	
											<li class="active"><a href="kontakt.php"><i class="icon-mail"></i>Kontakt</a> </li>
										</ul>
									</div>
		
								</nav>
							</div>
			   </header>
			   <!-- end header -->	
			   <!--start main content-->
			   <section id="mainContent">
			       <div class="container">
			            <div class="row homeContent kontaktinfo">
			                 <div class="col-md-9 col-sm-9 col-xs-9">
			                     <div id="map-canvas"></div>


			                     <h5>Kontakt Os</h5>
			                     <p>Vores telefoner er åbne 24 timer i døgnet, 7 dage om ugen – året rundt! Og du kan derfor altid få fat i os, når du har brug for hjælp.</p>
			                     <p>Professionelle vikarløsninger – hver gang!  </p>
			                     <div id ="wrap" class="row">
										  <div class="col-md-12">
										    
											<!--<div id="response" class="alert alert-success"><strong><span class="glyphicon glyphicon-send"></span> Success! Message sent. (If form ok!)</strong></div>	  
										    <div id="error" class="alert alert-danger"><span class="glyphicon glyphicon-alert"></span><strong> Error! Please check the inputs. (If form error!)</strong></div>-->
										  </div>
										  <div id="response"></div>
										  <form role="form" action="processForm.php" method="post" id="contactform">
										    <div class="col-lg-8 col-md-8">
										      <div class="well well-sm"><strong><i class="glyphicon glyphicon-ok form-control-feedback"></i> Required Field</strong></div>
										      <div class="form-group">
										      
										        <label for="InputName">Firmanavn</label>
										        <div id="InputFirmname_validate"></div><br/>
										        <div class="input-group">
										          <input type="text" class="form-control" name="InputFirmName" id="InputFirmName" placeholder="indtaste FirmNavn">
										          <span class="input-group-addon"></span></div>
										      </div>
										      
										      <div class="form-group">
										      
										        <label for="InputName">Full Navn</label>
										        <div id="InputName_validate"></div><br/>
										        <div class="input-group">
										          <input type="text" class="form-control" name="InputName" id="InputName" placeholder="indtaste Navn" required >
										          <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span></div>
										      </div>
										      <div class="form-group">
										      
										        <label for="InputEmail">Email</label>
										        <div id="InputEmail_validate"></div><br/>
										        <div class="input-group">
										          <input type="email" class="form-control" id="InputEmail" name="InputEmail" placeholder="indtaste Email" required  >
										          <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span></div>
										      </div>
										      <div class="form-group">
										        <label for="InputEmail">Adresse</label>
										        <div id="InputAdress_validate"></div><br/>
										        <div class="input-group">
										          <input type="text" class="form-control" id="InputAdress" name="InputAdress" placeholder="indtaste Adresse" required  >
										          <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span></div>
										      </div>
										      <div class="form-group">
										        <label for="InputEmail">Post nr. og by </label>
										        <div id="InputPostNr_validate"></div><br/>
										        <div class="input-group">
										          <input type="text" class="form-control" id="InputPostNr" name="InputPostNr" placeholder="indtaste Post nr og by" required  >
										          <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span></div>
										      </div>
										      <div class="form-group">
										        <label for="InputMessage">Kommentar</label>
										        <div id="InputMessage_validate"></div><br/>
										        <div class="input-group">
										
										          <textarea name="InputMessage" id="InputMessage" class="form-control" placeholder="indtaste Kommentar" rows="5" required></textarea>
										          <span class="input-group-addon"><i class="glyphicon glyphicon-ok form-control-feedback"></i></span></div>
										      </div>
										      
										      <input type="submit" name="send" id="send" value="Submit" class="btn btn-primary pull-right">
										    </div>
										  </form>
										  <hr class="featurette-divider hidden-lg">
										  
										  <?php
		
										     require("sources/connection.php");
											// Load in the content of the current viewing page from the MySQL database
											//$page = (isset($_GET['page'])) ? $_GET['page'] : "1";    
								            mysqli_set_charset($conn, "utf8");
											$sql = "SELECT * FROM pages WHERE name='Contact'";
											
											$result = $conn->query($sql) or die(mysqli_error());
											if($result){
												$row = $result->fetch_object();
												echo $row->content;
											}

											?>
			                     </div>
			                 </div>
									  <div class="col-md-3 col-sm-3 col-xs-12 serviceArea">
			                           <a href="#"><img src="images/p2.png" class="img-responsive" alt="" /></a>
			                          <ul class="serviceList list-unstyled">
			                              <li class="listTitle">Services fra IR Group</li>
				                          <li class="list1"><a href="#">Hotel / Restaurant</a></li>
				                          <li class="list2"><a href="rengoring.php">Rengøring</a></li>
				                          <li class="list3"><a href="kantine.php">Kantine</a></li>
				                          <li class="list4"><a href="#">Kontor</a></li>
				                         
				                          <!--<li class="list6"><a href="#">Transport</a></li>
				                          <li class="list7"><a href="#">Lager</a></li>-->
				                          <li class="serviceButton"><a href="services.html"><button type="button" class="btn btn-primary">Gå til Services </button></a></li>

				                          
			                          </ul>
			                          <div class ="quicklinks">
				                        <h5>Quick links</h5>
				                        <div class="frblock">
					                        <h6>Søger du job?</h6>
					                        <a href="cvsend.php"> >> Lav dit CV online her </a>
				                        </div>
				                        <div class="scblock">
					                        <h6>Find ny medarbejder</h6>
					                        <a href="kontakt.php"> >> Kontakt vores rekrutteringskonsulenter </a>
				                        </div>
				                        <div class="thblock">
					                        <h6>For medarbejdere</h6>
					                        <a href="timeseddel .pdf"> >> Her kan du udfylde din timeseddel </a>
				                        </div>
			                        </div> 
			                 
			                 </div>
			            </div>
			       </div>
			   </section> 
		<?php
		
		     require("sources/connection.php");
			// Load in the content of the current viewing page from the MySQL database
			//$page = (isset($_GET['page'])) ? $_GET['page'] : "1";    
            mysqli_set_charset($conn, "utf8");
			$sql = "SELECT * FROM pages WHERE name='Footer'";
			
			$result = $conn->query($sql) or die(mysqli_error());
			if($result){
				$row = $result->fetch_object();
				echo $row->content;
			}
			?>    
		</div>  

    <!------- all js file---->
     <script src="js/1.8.3/jquery.min.js"></script>
     <script src="bootstrap/js/bootstrap.min.js"></script>
     <script type="text/javascript" src="js/jquery.validate.min.js"></script>
	 <script type="text/javascript" src="js/jquery.form.js"></script>
	 <script type="text/javascript" src="js/contact.js"></script>
     
     
</body>

</html>