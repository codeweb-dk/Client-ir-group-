<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->

    <head>
        <title>Services</title>
        
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
											<li class="active"><a href="services.php"><i class="icon-thumbs-up"></i>Services</a> </li>
											<li class="dropdown"><a href="ledige-vikariater.php" data-toggle="dropdown" class="dropdown-toggle">Jobsøgere<b class="caret"></b></a> 
											<ul class="list-unstyled dropdown-menu">
												<li><a href="ledige-vikariater.php">Ledige vikariater</a></li>
												<li><a href="cvsend.php">Send dit CV</a></li>
											</ul></li>
											<li><a href="for-virksomheder.php"><i class="icon-popup-1"></i>For virksomheder</a> </li>	
											<li><a href="kontakt.php"><i class="icon-mail"></i>Kontakt</a> </li>
										</ul>
									</div>
		
								</nav>
							</div>
			   </header>
			   <!-- end header -->	
			   <!--start main content-->
			   <section id="mainContent">
			       <div class="container">
			            <div class="row homeContent">
			                 <div class="col-md-9 col-sm-9 col-xs-9">
			                     <img src="images/services.png" class="img-responsive" alt="" />
			                       <?php
									
									     require("sources/connection.php");
										// Load in the content of the current viewing page from the MySQL database
										//$page = (isset($_GET['page'])) ? $_GET['page'] : "1";    
							            mysqli_set_charset($conn, "utf8");
										$sql = "SELECT * FROM pages WHERE name='Services'";
										
										$result = $conn->query($sql) or die(mysqli_error());
										if($result){
											$row = $result->fetch_object();
											echo $row->content;
										}
	
		                            ?>
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
     
     
</body>

</html>