<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->

    <head>
        <title>Send dit CV</title>
        
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
		
		
		<!============================js file=============== --->
		
					<!------- all js file---->
		 <script src="js/1.8.3/jquery.min.js"></script>
	     <script src="bootstrap/js/bootstrap.min.js"></script>
		 <script type="text/javascript" src="js/jquery.validate.min.js"></script>
		 <script type="text/javascript" src="js/jquery.form.js"></script>
		 <script type="text/javascript" src="js/cv.js"></script>
				 
	 
		
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
											<li><a href="services.php"><i class="icon-thumbs-up"></i>Services</a> </li>
											<li class="dropdown active"><a href="ledige-vikariater.php" data-toggle="dropdown" class="dropdown-toggle">Jobsøgere<b class="caret"></b></a> 
											<ul class="list-unstyled dropdown-menu">
												<li><a href="ledige-vikariater.php">Ledige vikariater</a></li>
												<li class="active"><a href="cvsend.php">Send dit CV</a></li>
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
			                     <img src="images/irhome.png" class="img-responsive" alt="" /><br/>
			                    <?php

									// if the from is loaded from WordPress form loader plugin, 
									// the phpfmg_display_form() will be called by the loader 
									if( !defined('FormmailMakerFormLoader') ){
									    # This block must be placed at the very top of page.
									    # --------------------------------------------------
										require_once( dirname(__FILE__).'/form.lib.php' );
									    phpfmg_display_form();
									    # --------------------------------------------------
									};
									
									
									function phpfmg_form( $sErr = false ){
											$style=" class='form_text' ";
									
									?>

			                     <br/>
			                     <div id='frmFormMailContainer'>

								<form name="frmFormMail" id="frmFormMail" target="submitToFrame" action='<?php echo PHPFMG_ADMIN_URL . '' ; ?>' method='post' enctype='multipart/form-data' onsubmit='return fmgHandler.onSubmit(this);'>
								
								<input type='hidden' name='formmail_submit' value='Y'>
								<input type='hidden' name='mod' value='ajax'>
								<input type='hidden' name='func' value='submit'>
			                     <div class="col-md-4">
			                       
			                     			<div class="form-group">
										      
										        <label for="InputName">Fornavn</label>
										        <div id="InputFornavn_validate"></div><br/>
										        <div class="input-group">
										        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
										        <input type="text" class="form-control"  name="field_0"  id="field_0" value="<?php  phpfmg_hsc("field_0", ""); ?>" class='text_box' placeholder="Indtast fornavn" required>
										        </div>
										     </div>
										     <div class="form-group">
										      
										        <label for="InputName">Post nr. og by</label>
										        <div id="InputPostnr_validate"></div><br/>
										        <div class="input-group">
										        <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
										        <input type="text" class="form-control" name="field_3"  id="field_3" value="<?php  phpfmg_hsc("field_3", ""); ?>" class='text_box' placeholder="Indtast postnr og by" required >
										        </div>
										     </div>
										     <div class="form-group">
										        <label for="InputName"></label>
										        <div class="input-control checkbox">
                                                    <label>
                                                       <input type="checkbox" name="ledig" value="yes"/>
                                                       <span> Jeg er ledig nu </span>
                                                       <?php phpfmg_checkboxes( 'field_6', "Yes" );?>
                                                    </label>
                                                </div>
										     </div><br/>
										     <div class="form-group">
										        <label for="InputName">Jeg er udelukkende interesseret i fast job indenfor</label>
										        <div class="input-control radio default-style">
												<?php phpfmg_radios( 'field_8', "Kantine|Kontor|Andet" );?>

                                                </div>
										     </div><br/><br/>
										     <div class="form-group">
										        
										        <label for="InputName">Kontor</label><br/>
										        
										        <?php phpfmg_checkboxes( 'field_11', "Reception| Kundeservice| Piccoline| Sekretær| Korrespondet| Bogholderi| Regnskab| Tasteopgaver" );?>
										    </div>

				                     
			                     </div>
			                     <div class="col-md-4">
			                                <div class="form-group">
										      
										        <label for="InputName">Efternavn</label>
										        <div id="InputEfternavn_validate"></div><br/>
										        <div class="input-group">
										        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
										        <input type="text" class="form-control" name="field_1"  id="field_1" value="<?php  phpfmg_hsc("field_1", ""); ?>" class='text_box' placeholder="Indtast efternavn" required >
										        </div>
										     </div>
										     <div class="form-group">
										      
										        <label for="InputName">Telefon</label>
										        <div id="InputTelefon_validate"></div><br/>
										        <div class="input-group">
										        <span class="input-group-addon"><span class="glyphicon glyphicon-phone-alt"></span></span>
										        <input type="number" class="form-control" name="field_4"  id="field_4" value="<?php  phpfmg_hsc("field_4", ""); ?>" class='text_box' placeholder="Indtast telefon" required >
										        </div>
										     </div>
										     <div class="form-group">
										      
										        <label for="InputName">Jeg er ledig pr. den </label>
										        <div id="InputLedigprden_validate"></div><br/>
										        <div class="input-group">
										        <span class="input-group-addon"><span class="glyphicon glyphicon-ok-sign"></span></span>
										        <input type="text" class="form-control" name="field_7"  id="field_7" value="<?php  phpfmg_hsc("field_7", ""); ?>" class='text_box'>
										        </div>
										     </div>
										     <div class="form-group">
										      
										        <label for="InputName">Andet</label>
										        <div id="InputMessage_validate"></div><br/>
										        <div class="input-group">
										        <textarea name="field_9" id="field_9" rows=4 cols=25 class='text_area'<?php  phpfmg_hsc("field_9"); ?> class="form-control" placeholder="Enter your message" rows="6" cols="50"></textarea>
										        </div>
										     </div>
										     
										     <div class="form-group">
										        
										        <label for="InputName">Andet</label><br/>
										        <?php phpfmg_checkboxes( 'field_12', "Rengøring| Hjemmepleje| Lager| Lager/truck| Chauffør| Industri / Produktion" );?>
										     </div>
				                     
			                     </div>
			                     <div class="col-md-4">
			                                <div class="form-group">
										      
										        <label for="InputName">Adresse</label>
										        <div id="InputAdresse_validate"></div><br/>
										        <div class="input-group">
										        <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
										        <input type="text" class="form-control" name="field_2"  id="field_2" value="<?php  phpfmg_hsc("field_2", ""); ?>" class='text_box' placeholder="Indtast adresse" required >
										        </div>
										     </div>
										     <div class="form-group">
										      
										        <label for="InputName">Email</label>
										        <div id="InputEmail_validate"></div><br/>
										        <div class="input-group">
										        <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
										        <input type="email" class="form-control" name="field_5"  id="field_5" value="<?php  phpfmg_hsc("field_5", ""); ?>" class='text_box' placeholder="Indtast email" required >
										        </div>
										     </div>
										     <div class="form-group">
										        <label for="InputName"></label>
										        <div class="input-control checkbox">
                                                    <label>
                                                       <input type="checkbox" name="varevikar" value="vikarvare"/>
                                                       <span> Jeg vil gerne være vikar  </span>
                                                    </label>
                                                </div>
										     </div><br/>
										     <div class="form-group">
										        <label for="InputName">Jeg har erfaring med (sæt gerne flere krydser)</label>
										        <label for="InputName">Kantine</label><br/>
										        <?php phpfmg_checkboxes( 'field_10', "Opvask| Salatbar| Rengøring| Servering| Kokke opgaver| Smørrebrød| Buffet og lune retter| Lederjob" );?>
                                                
										     </div>
										     <div class="form-group">
										      
										        <label for="InputName">Vedhæft CV </label>
										        
										        <div class="input-group file-input">
										       <input type="file" name="field_13"  id="field_13" value="" class='text_box' onchange="fmgHandler.check_upload(this);">
										        </div>
										     </div> 
										    <div class="form-group">
										      
										        <label for="InputName">Vedhæft evt. billede </label>
										        
										        <div class="input-group file-input">
										        <input type="file" name="field_14"  id="field_14" value="" class='text_box' onchange="fmgHandler.check_upload(this);">
										        </div>
										    </div>
			                     </div>  
										     
										     <input type='submit' value='Submit' class='form_button' class="btn btn-primary pull-right"><br/><br/>
										     <div id='err_required' class="form_error" style='display:none;'>
											    <label class='form_error_title'>Please check the required fields</label>
											</div>
											
											                <span id='phpfmg_processing' style='display:none;'>
											                    <img id='phpfmg_processing_gif' src='<?php echo PHPFMG_ADMIN_URL . '?mod=image&amp;func=processing' ;?>' border=0 alt='Processing...'> <label id='phpfmg_processing_dots'></label>
											                </span>
				                     
			                     </div>
			                     </form>
			                     <iframe name="submitToFrame" id="submitToFrame" src="javascript:false" style="position:absolute;top:-10000px;left:-10000px;" /></iframe>
			                     
			                     <div id='thank_you_msg' class='alert alert-success' style='display:none;'>
									<span class='glyphicon glyphicon-send'></span>Succes! Din besked er blevet sendt.
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
			
				   
			   <?php
			
								    phpfmg_javascript($sErr);
								
								} 
                             function phpfmg_form_css(){
    $formOnly = isset($GLOBALS['formOnly']) && true === $GLOBALS['formOnly'];
?>
<style type='text/css'>
<?php 
if( !$formOnly ){

}; // if
?>




.form_required{
    color:red;
    margin-right:8px;
}



.form_error_title{
    font-weight: bold;
    color: red;
}

#frmFormMailContainer input[type="submit"]{
    padding: 10px 25px; 
    font-weight: bold;
    margin-bottom: 10px;
    background-color: #FAFBFC;
    float:right !important;
    margin-right: 170px;
    border: none;
    background: #284391;
    color:#FFF;
}

.form_choice_text{
	padding:5px !important;
	font-weight: normal!important;
	
}


.form_error{
    background-color: #F4F6E5;
    border: 1px dashed #ff0000;
    padding: 10px;
    margin-bottom: 10px;
}

.form_error_highlight{
    background-color: #F4F6E5;
    border-bottom: 1px dashed #ff0000;
}

div.instruction_error{
    color: red;
    font-weight:bold;
}


<?php phpfmg_text_align();?>    



</style>

<?php
}
?>

			    
		</div>  
    
    <!-- <script src="bootstrap/js/bootstrap.file-input.js"></script>
     <script>
	     $('input[type=file]').bootstrapFileInput();
         $('.file-inputs').bootstrapFileInput();
     </script>-->
     
     
     
</body>

</html>