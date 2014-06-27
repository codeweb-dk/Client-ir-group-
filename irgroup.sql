-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 16, 2014 at 12:50 AM
-- Server version: 5.5.25
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `irgroup`
--

-- --------------------------------------------------------

--
-- Table structure for table `kontakt`
--

CREATE TABLE `kontakt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `mainmail` varchar(100) NOT NULL,
  `bcmail` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `kontakt`
--

INSERT INTO `kontakt` (`id`, `name`, `mainmail`, `bcmail`) VALUES
(1, 'cv', 'me@aminiis.dk', 'himelhunny@yahoo.com'),
(2, 'gkontakt', 'himelhunny@yahoo.com', 'me@aminiis.dk');

-- --------------------------------------------------------

--
-- Table structure for table `nav`
--

CREATE TABLE `nav` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `nav`
--

INSERT INTO `nav` (`id`, `name`, `url`, `title`) VALUES
(1, 'Home', 'index.php?page=1', 'Home Page'),
(2, 'About Us', 'index.php?page=2', 'About Page'),
(3, 'Services By Us', 'index.php?page=3', 'Services by us Page'),
(4, 'License', 'index.php?page=4', 'License Page'),
(5, 'Contact Us', 'index.php?page=5', 'Contact Us Page');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `content`) VALUES
(1, 'Home', '<h5>Velkommen til IR Group</h5>\r\n<p>IR Group er et dansk vikar- og reng&oslash;ringsbureau, der str&aelig;ber efter at tilbyde erhvervslivet professionel, lynhurtig og effektiv assistance indenfor reng&oslash;ring, personaleudv&aelig;lgelse og vikarl&oslash;sninger.</p>\r\n<h6>Det rigtige match</h6>\r\n<p>En af vores vigtigste ressourcer er selvf&oslash;lgelig vores mange dedikerede vikarer og medarbejdere, der hver dag s&aelig;tter en &aelig;re i at udf&oslash;re et godt stykke arbejde. Vi clearer alle medarbejdere, og du kan altid regne med, at vi sender dig motiverede og dygtige vikarer/medarbejdere med mange &aring;rs erfaring.</p>\r\n<div class="row clearfix homeContentMiddle">\r\n<div class="col-md-4 col-sm-4 col-xs-12 part1"><img class="img" src="images/p1.png" alt="" />\r\n<h6>S&oslash;ger du job?</h6>\r\n<a href="cvsend.php"> &gt;&gt; Lav dit CV online her</a></div>\r\n<div class="col-md-4 col-sm-4 col-xs-12 .col-md-offset-3 part2 "><img class="img" src="images/p3.png" alt="" />\r\n<h6>Find ny medarbejder</h6>\r\n<a href="kontakt.html"> &gt;&gt; Kontakt rekrutteringskonsulenter</a></div>\r\n<div class="col-md-4 col-sm-4 col-xs-12 part3"><img class="img" src="images/p4.png" alt="" />\r\n<h6>For medarbejder</h6>\r\n<a href="timeseddel .pdf"> &gt;&gt; udfylde din timeseddel</a></div>\r\n</div>'),
(10, 'Footer', '<div id="homeFooter">\r\n<div class="container clearfix">\r\n<div class="row">\r\n<div class="col-md-3 footerContent">\r\n<h6>Praktiske links</h6>\r\n<ul class="list-unstyled">\r\n<li><a href="www.rejseplanen.dk"> www.rejseplanen.dk</a></li>\r\n<li><a href="www.krak.dk"> www.krak.dk</a></li>\r\n<li><a href="www.dsb.dk"> www.dsb.dk</a></li>\r\n</ul>\r\n</div>\r\n<div class="col-md-3 footerContent">\r\n<h6>For jobs&oslash;gere</h6>\r\n<ul class="list-unstyled">\r\n<li><a href="ledige-vikariater.php"> &gt;&gt; Ledige vikariate</a></li>\r\n<li><a href="cvsend.php"> &gt;&gt; Send dit CV</a></li>\r\n</ul>\r\n<h6>For medarbejdere</h6>\r\n<ul class="list-unstyled">\r\n<li><a href="timeseddel .pdf"> &gt;&gt; en timeseddel (PDF)</a></li>\r\n</ul>\r\n</div>\r\n<div class="col-md-3 footerContent">\r\n<h6>Services</h6>\r\n<ul class="list-unstyled">\r\n<li><a href="hotel.php"> &gt;&gt; Hotel / Restaurant</a></li>\r\n<li><a href="rengoring.php"> &gt;&gt; Reng&oslash;ring</a></li>\r\n<li><a href="kantine.php"> &gt;&gt; Kantine</a></li>\r\n<li><a href="kontor.php"> &gt;&gt; Kontor</a></li>\r\n</ul>\r\n</div>\r\n<div class="col-md-3 footerContent">\r\n<h6>Kontakt Os</h6>\r\n<strong>IR Group ApS</strong><br /> Vester Farimagsgade 6, 1 sal<br /> 1606 K&oslash;benhavn V<br /> P: (+45) 70 20 73 20\r\n</div>\r\n</div>\r\n</div>\r\n<div id="footerBottom">\r\n<p>Copyright &copy; 2014 IR Group ApS. All rights reserved.</p>\r\n</div>\r\n</div>'),
(2, 'About', '<h5>Om IR Group</h5>\r\n<p>IR Group er et dansk vikar- og reng&oslash;ringsbureau, der str&aelig;ber efter at tilbyde erhvervslivet professionel, lynhurtig og effektiv assistance inden for reng&oslash;ring, personaleudv&aelig;lgelse og vikarl&oslash;sninger.</p>\r\n<h6>H&oslash;j kvalitet</h6>\r\n<p>Vi l&aelig;gger stor v&aelig;gt p&aring; h&oslash;j kvalitet og unik kundeservice, og derfor &oslash;nsker vi at brande os som en serviceminded og h&aring;rdtarbejdende akt&oslash;r, der er let at samarbejde med, n&aring;r du som kunde skal v&aelig;lge leverand&oslash;r.</p>\r\n<h6>Det rigtige match</h6>\r\n<p>En af vores vigtigste ressourcer er selvf&oslash;lgelig vores mange dedikerede vikarer og medarbejdere, der hver dag s&aelig;tter en &aelig;re i at udf&oslash;re et godt stykke arbejde. Vi clearer alle medarbejdere, og du kan altid regne med, at vi sender dig motiverede og dygtige vikarer/medarbejdere med mange &aring;rs erfaring.</p>\r\n<p>Et rigtigt match og h&oslash;j kvalitet, er det eneste du som kunde kan bruge til noget!</p>'),
(3, 'Services', '<h5>Rekruttering &amp; personaleudv&aelig;lgelse</h5>\r\n<p>IR Group leverer dygtige og kompetente medarbejder baseret p&aring; en grundig ans&aelig;ttelsesprocedure. Vi indkalder hver eneste kandidat til en personlig samtale hvor vi sammen gennemg&aring;r kvalikationer og kompetencer - og l&aelig;rer hinanden at kende.</p>\r\n<p>Vores emnebank indeholder masser af erfarne og engagerede ressourcer, der alle br&aelig;nder efter at rykke ud til opgaver, bl.a. inden for:</p>\r\n<div class="row">\r\n<div class="col-md-4"><img class="img" src="images/p6.png" alt="" />\r\n<h6><a href="#">Kontor</a></h6>\r\n<ul class="list-unstyled">\r\n<li>Bogholderi/regnskab</li>\r\n<li>Sekret&aelig;ropgaver</li>\r\n<li>Reception/omstilling</li>\r\n<li>Indtastning</li>\r\n<li>Tekstbehandling</li>\r\n<li>Korrespondance</li>\r\n<li>Vagt</li>\r\n</ul>\r\n</div>\r\n<div class="col-md-4"><img class="img" src="images/p7.png" alt="" />\r\n<h6><a href="rengoring.html">Reng&oslash;ring</a></h6>\r\n<ul class="list-unstyled">\r\n<li>Kontorreng&oslash;ring</li>\r\n<li>Industrireng&oslash;ring</li>\r\n<li>Trappevask</li>\r\n<li>Stuepiger</li>\r\n<li>Oldfruer</li>\r\n</ul>\r\n</div>\r\n<div class="col-md-4"><img class="img" src="images/p8.png" alt="" />\r\n<h6><a href="#">Hotel / Restaurant</a></h6>\r\n<ul class="list-unstyled">\r\n<li>Kantineleder</li>\r\n<li>K&oslash;kkenassistenter</li>\r\n<li>Kokke</li>\r\n<li>Sm&oslash;rrebr&oslash;dsjomfruer</li>\r\n<li>Bordd&aelig;kning og servering</li>\r\n<li>Ekspedition</li>\r\n<li>Opvask</li>\r\n<li>Tjenere</li>\r\n</ul>\r\n</div>\r\n<div class="col-md-4"><img class="img" src="images/p17.png" alt="" />\r\n<h6><a href="#">Kantine</a></h6>\r\n<ul class="list-unstyled">\r\n<li>Opvask</li>\r\n<li>Servicering</li>\r\n<li>Reng&oslash;ring</li>\r\n</ul>\r\n</div>\r\n</div>'),
(4, 'Ledige', '<h5>Ledige vikariater hos IR Group</h5>\r\n<p>IR Group tilbyder sp&aelig;ndende udfordringer med mulighed for at m&oslash;de nye kolleger, opgaver og arbejdspladser med forskellige kulturer.</p>\r\n<h6>Ordnede forhold</h6>\r\n<p>Alle ansatte har arbejds- og opholdstilladelse, og IR Group overholder alle g&aelig;ldende overenskomster med fagforeninger og Dansk Erhverv.</p>\r\n<p>I klar tekst: Vi s&aelig;tter en &aelig;re i at have styr p&aring; tingene!</p>'),
(5, 'Contact', '<div class="col-lg-3 col-md-3 col-md-push-1">\r\n<h5>Kontorplacering</h5>\r\n<div id="adress"><p> <strong>IR Group ApS</strong><br /> Vester Farimagsgade 6, 1 sal<br /> 1606 K&oslash;benhavn V<br /> P:</abbr> (+45) 70 20 73 20 </p></div>\r\n</div>'),
(6, 'Cvsend', ' <div class="col-md-3 col-sm-3 col-xs-3 serviceArea">\r\n                                    <a href="#"><img src="images/p2.png" class="img-responsive" alt="" /></a>\r\n			                          <ul class="serviceList list-unstyled">\r\n			                              <li class="listTitle">Services fra IR Group</li>\r\n				                          <li class="list1"><a href="#">Hotel / Restaurant</a></li>\r\n				                          <li class="list2"><a href="rengoring.html">Rengøring</a></li>\r\n				                          <li class="list3"><a href="kantine.html">Kantine</a></li>\r\n				                          <li class="list4"><a href="#">Kontor</a></li>\r\n				                         \r\n				                          <!--<li class="list6"><a href="#">Transport</a></li>\r\n				                          <li class="list7"><a href="#">Lager</a></li>-->\r\n				                          <li class="serviceButton"><a href="services.html"><button type="button" class="btn btn-primary">Gå til Services </button></a></li>\r\n\r\n				                          \r\n			                          </ul>\r\n			                          <div class ="quicklinks">\r\n				                        <h5>Quick links</h5>\r\n				                        <div class="frblock">\r\n					                        <h6>Søger du job?</h6>\r\n					                        <a href="cvsend.php"> >> Lav dit CV online her </a>\r\n				                        </div>\r\n				                        <div class="scblock">\r\n					                        <h6>Find ny medarbejder</h6>\r\n					                        <a href="kontakt.html"> >> Kontakt vores rekrutteringskonsulenter </a>\r\n				                        </div>\r\n				                        <div class="thblock">\r\n					                        <h6>For medarbejdere</h6>\r\n					                        <a href="timeseddel .pdf"> >> Her kan du udfylde din timeseddel </a>\r\n				                        </div>\r\n			                        </div> \r\n			                 \r\n			                 </div>\r\n			            </div>\r\n			       </div>\r\n			   </section> \r\n<footer id="homeFooter">\r\n			     <div class="container clearfix">\r\n				     <div class="row">\r\n					     <div class="col-md-3 footerContent">\r\n\r\n					     <h6>Praktiske links</h6>\r\n					     <ul class="list-unstyled">\r\n						     <li><a href="www.rejseplanen.dk"> www.rejseplanen.dk</a></li>\r\n						     <li><a href="www.krak.dk"> www.krak.dk</a></li>\r\n						     <li><a href="www.dsb.dk"> www.dsb.dk</a></li>\r\n					     </ul>\r\n						     \r\n					     </div>\r\n					     <div class="col-md-3 footerContent">\r\n					     <h6>For jobsøgere</h6>\r\n						<ul class="list-unstyled">\r\n						     <li><a href="ledige-vikariater.html"> >> Ledige vikariate</a></li>\r\n						     <li><a href="cvsend.php"> >> Send dit CV</a></li>\r\n					     </ul>\r\n					     <h6>For medarbejdere</h6>\r\n						<ul class="list-unstyled">\r\n						     <li><a href="timeseddel .pdf"> >> en timeseddel (PDF)</a></li>\r\n						     \r\n					     </ul>\r\n					     </div>\r\n					     <div class="col-md-3 footerContent">\r\n					     <h6>Services</h6>\r\n						<ul class="list-unstyled">\r\n						     <li><a href="#"> >> Hotel / Restaurant</a></li>\r\n						     <li><a href="rengoring.html"> >> Rengøring</a></li>\r\n						     <li><a href="kantine.html"> >> Kantine</a></li>\r\n						     <li><a href="#"> >> Kontor</a></li>\r\n\r\n					     </ul>\r\n					     </div>\r\n					     <div class="col-md-3 footerContent">\r\n						   <h6>Kontakt Os</h6>\r\n						   <address>\r\n                               <strong>IR Group ApS</strong><br>\r\n                                Vester Farimagsgade 6, 1 sal<br>\r\n                                1606 København V<br>\r\n                                <abbr title="Phone">P:</abbr> (+45) 70 20 73 20\r\n                             </address>\r\n                             <!--<h6>Join, follow or subscribe</h6>\r\n                             <div class="socialMedia">\r\n	                             <ul class="list-unstyled list-inline">\r\n	                             <li><a class="facebook" href="#"></a></li>\r\n	                             <li><a class="twitter" href="#"></a></li>\r\n	                             <li><a class="linkedin" href="#"></a></li>\r\n		                             \r\n	                             </ul>\r\n                             </div>-->\r\n					     </div>\r\n				     </div>\r\n\r\n			     </div>\r\n			      <div id="footerBottom">\r\n				      <p>Copyright © 2014 IR Group ApS. All rights reserved.</p>\r\n			      </div>   \r\n			   </footer> \r\n			    \r\n	 \r\n'),
(7, 'Forvirkasom', '<h5>Tillid  og samarbejde</h5>\r\n<p>Vi arbejder meget gerne t&aelig;t sammen med vores kunder, fordi langt de fleste businessudfordringer og hverdagsopgaver l&oslash;ses bedst via daglig pingpong og sparring.</p>\r\n<p>Vi s&oslash;rger for at lytte til dine behov og indarbejder dem i vores rutiner, der blandt andet omfatter tjeklister, inspekt&oslash;rbes&oslash;g, kontaktbog mellem kunde/vikar, etc.</p>\r\n<p>S&aring;dan kvalitetssikrer vi de services, vi arbejder med &ndash; og s&aring;dan ved du som kunde, at du altid bliver h&oslash;rt og f&aring;r en skr&aelig;ddersyet l&oslash;sning, der passer netop til dine behov.</p>\r\n<h6>Seri&oslash;sitet</h6>\r\n<p>Hos IR Group mener vi det alvorligt, n&aring;r det handler om at skille sig ud og yde top kvalitet og unik kundeservice. Det er der mange leverand&oslash;rer, der skriver om. Vi g&oslash;r noget ved det &ndash; hver dag!</p>\r\n<h6>Ordnede forhold</h6>\r\n<p>Alle ansatte har arbejds- og opholdstilladelse, og IR Group overholder alle g&aelig;ldende overenskomster med fagforeninger og Dansk Erhverv. I klar tekst: Vi s&aelig;tter en &aelig;re i at have styr p&aring; tingene!</p>\r\n<p><a href="kontakt.php"> &gt;&gt; Kontakt en af vore rekrutteringskonsulenter</a></p>'),
(8, 'Rengoring', '<h5>Reng&oslash;ring - med blik for detaljer og ansvar for kvaliteten</h5>\r\n<p>Professionel reng&oslash;ring handler om at have blik for detaljerne og udvise ansvarlighed. Derfor besk&aelig;ftiger vi kun erfarne medarbejdere &ndash; udarbejder pr&aelig;cise reng&oslash;ringsplaner &ndash; og benytter milj&oslash;godkendte produkter.</p>\r\n<p>IR Group kan l&oslash;se alle reng&oslash;ringsopgaver - b&aring;de sm&aring; som store.</p>\r\n<p>Vi d&aelig;kker alle almindelige reng&oslash;ringsopgaver, uanset om der er tale om kontorer, institutioner, hoteller, restaurationer eller produktionsvirksomheder.</p>\r\n<p>Udover den daglige reng&oslash;ring kan vi tilbyde ekstraopgaver som eksempelvis:</p>\r\n<ul>\r\n<li>Hovedreng&oslash;ring</li>\r\n<li>H&aring;ndv&aelig;rkerreng&oslash;ring</li>\r\n<li>Slutreng&oslash;ring</li>\r\n<li>Gardinrens</li>\r\n<li>T&aelig;pperens</li>\r\n<li>Polishbehandling</li>\r\n<li>Oliering af tr&aelig;gulve</li>\r\n</ul>\r\n<p>Hvor meget og hvor ofte aftales individuelt. Der sammens&aelig;ttes altid en reng&oslash;ringsplan der passer til jeres dagligdag, krav og behov.</p>'),
(9, 'Kantine', '<h5>Personale - til kantine, opvask og servicering</h5>\r\n<p>Hvis i mangler hj&aelig;lp til h&aring;ndtering og servicering af mad i jeres virksomhed, s&aring; kan IR Group s&oslash;rge for at levere friske, kompentente, og h&aring;rdtarbejdende medarbejdere der altid s&aelig;tter en stor &aelig;re i at udf&oslash;re et godt stykke arbejde.</p>\r\n<p>Alle vore kantine medarbejdere har en solid baggrund indenfor denne brance samt hygiejne-bevis, hvilket g&oslash;r dem forberedt til at klare de udfordringer som dukker op i l&oslash;bet af en arbejdsdag.</p>\r\n<p>I beh&oslash;ver ikke at t&aelig;nke p&aring; sygdom eller ferie, da vi altid s&oslash;rger for at der st&aring;r en medarbejder parat til at klare de daglige opgave.</p>');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'username', '5f4dcc3b5aa765d61d8327deb882cf99');
