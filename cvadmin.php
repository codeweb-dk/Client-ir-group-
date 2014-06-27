<?php
require_once( dirname(__FILE__).'/form.lib.php' );

define( 'PHPFMG_USER', "me@aminiis.dk" ); // must be a email address. for sending password to you.
define( 'PHPFMG_PW', "a6bacf" );

?>
<?php
/**
 * GNU Library or Lesser General Public License version 2.0 (LGPLv2)
*/

# main
# ------------------------------------------------------
error_reporting( E_ERROR ) ;
phpfmg_admin_main();
# ------------------------------------------------------




function phpfmg_admin_main(){
    $mod  = isset($_REQUEST['mod'])  ? $_REQUEST['mod']  : '';
    $func = isset($_REQUEST['func']) ? $_REQUEST['func'] : '';
    $function = "phpfmg_{$mod}_{$func}";
    if( !function_exists($function) ){
        phpfmg_admin_default();
        exit;
    };

    // no login required modules
    $public_modules   = false !== strpos('|captcha|', "|{$mod}|", "|ajax|");
    $public_functions = false !== strpos('|phpfmg_ajax_submit||phpfmg_mail_request_password||phpfmg_filman_download||phpfmg_image_processing||phpfmg_dd_lookup|', "|{$function}|") ;   
    if( $public_modules || $public_functions ) { 
        $function();
        exit;
    };
    
    return phpfmg_user_isLogin() ? $function() : phpfmg_admin_default();
}

function phpfmg_ajax_submit(){
    $phpfmg_send = phpfmg_sendmail( $GLOBALS['form_mail'] );
    $isHideForm  = isset($phpfmg_send['isHideForm']) ? $phpfmg_send['isHideForm'] : false;

    $response = array(
        'ok' => $isHideForm,
        'error_fields' => isset($phpfmg_send['error']) ? $phpfmg_send['error']['fields'] : '',
        'OneEntry' => isset($GLOBALS['OneEntry']) ? $GLOBALS['OneEntry'] : '',
    );
    
    @header("Content-Type:text/html; charset=$charset");
    echo "<html><body><script>
    var response = " . json_encode( $response ) . ";
    try{
        parent.fmgHandler.onResponse( response );
    }catch(E){};
    \n\n";
    echo "\n\n</script></body></html>";

}


function phpfmg_admin_default(){
    if( phpfmg_user_login() ){
        phpfmg_admin_panel();
    };
}



function phpfmg_admin_panel()
{    
    phpfmg_admin_header();
    phpfmg_writable_check();
?>    
<table cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td valign=top style="padding-left:280px;">

<style type="text/css">
    .fmg_title{
        font-size: 16px;
        font-weight: bold;
        padding: 10px;
    }
    
    .fmg_sep{
        width:32px;
    }
    
    .fmg_text{
        line-height: 150%;
        vertical-align: top;
        padding-left:28px;
    }

</style>

<script type="text/javascript">
    function deleteAll(n){
        if( confirm("Are you sure you want to delete?" ) ){
            location.href = "admin.php?mod=log&func=delete&file=" + n ;
        };
        return false ;
    }
</script>


<div class="fmg_title">
    1. Email Traffics
</div>
<div class="fmg_text">
    <a href="admin.php?mod=log&func=view&file=1">view</a> &nbsp;&nbsp;
    <a href="admin.php?mod=log&func=download&file=1">download</a> &nbsp;&nbsp;
    <?php 
        if( file_exists(PHPFMG_EMAILS_LOGFILE) ){
            echo '<a href="#" onclick="return deleteAll(1);">delete all</a>';
        };
    ?>
</div>


<div class="fmg_title">
    2. Form Data
</div>
<div class="fmg_text">
    <a href="admin.php?mod=log&func=view&file=2">view</a> &nbsp;&nbsp;
    <a href="admin.php?mod=log&func=download&file=2">download</a> &nbsp;&nbsp;
    <?php 
        if( file_exists(PHPFMG_SAVE_FILE) ){
            echo '<a href="#" onclick="return deleteAll(2);">delete all</a>';
        };
    ?>
</div>

<div class="fmg_title">
    3. Form Generator
</div>
<div class="fmg_text">
    <a href="http://www.formmail-maker.com/generator.php" onclick="document.frmFormMail.submit(); return false;" title="<?php echo htmlspecialchars(PHPFMG_SUBJECT);?>">Edit Form</a> &nbsp;&nbsp;
    <a href="http://www.formmail-maker.com/generator.php" >New Form</a>
</div>
    <form name="frmFormMail" action='http://www.formmail-maker.com/generator.php' method='post' enctype='multipart/form-data'>
    <input type="hidden" name="uuid" value="<?php echo PHPFMG_ID; ?>">
    <input type="hidden" name="external_ini" value="<?php echo function_exists('phpfmg_formini') ?  phpfmg_formini() : ""; ?>">
    </form>

		</td>
	</tr>
</table>

<?php
    phpfmg_admin_footer();
}



function phpfmg_admin_header( $title = '' ){
    header( "Content-Type: text/html; charset=" . PHPFMG_CHARSET );
?>
<html>
<head>
    <title><?php echo '' == $title ? '' : $title . ' | ' ; ?>PHP FormMail Admin Panel </title>
    <meta name="keywords" content="PHP FormMail Generator, PHP HTML form, send html email with attachment, PHP web form,  Free Form, Form Builder, Form Creator, phpFormMailGen, Customized Web Forms, phpFormMailGenerator,formmail.php, formmail.pl, formMail Generator, ASP Formmail, ASP form, PHP Form, Generator, phpFormGen, phpFormGenerator, anti-spam, web hosting">
    <meta name="description" content="PHP formMail Generator - A tool to ceate ready-to-use web forms in a flash. Validating form with CAPTCHA security image, send html email with attachments, send auto response email copy, log email traffics, save and download form data in Excel. ">
    <meta name="generator" content="PHP Mail Form Generator, phpfmg.sourceforge.net">

    <style type='text/css'>
    body, td, label, div, span{
        font-family : Verdana, Arial, Helvetica, sans-serif;
        font-size : 12px;
    }
    </style>
</head>
<body  marginheight="0" marginwidth="0" leftmargin="0" topmargin="0">

<table cellspacing=0 cellpadding=0 border=0 width="100%">
    <td nowrap align=center style="background-color:#024e7b;padding:10px;font-size:18px;color:#ffffff;font-weight:bold;width:250px;" >
        Form Admin Panel
    </td>
    <td style="padding-left:30px;background-color:#86BC1B;width:100%;font-weight:bold;" >
        &nbsp;
<?php
    if( phpfmg_user_isLogin() ){
        echo '<a href="admin.php" style="color:#ffffff;">Main Menu</a> &nbsp;&nbsp;' ;
        echo '<a href="admin.php?mod=user&func=logout" style="color:#ffffff;">Logout</a>' ;
    }; 
?>
    </td>
</table>

<div style="padding-top:28px;">

<?php
    
}


function phpfmg_admin_footer(){
?>

</div>

<div style="color:#cccccc;text-decoration:none;padding:18px;font-weight:bold;">
	:: <a href="http://phpfmg.sourceforge.net" target="_blank" title="Free Mailform Maker: Create read-to-use Web Forms in a flash. Including validating form with CAPTCHA security image, send html email with attachments, send auto response email copy, log email traffics, save and download form data in Excel. " style="color:#cccccc;font-weight:bold;text-decoration:none;">PHP FormMail Generator</a> ::
</div>

</body>
</html>
<?php
}


function phpfmg_image_processing(){
    $img = new phpfmgImage();
    $img->out_processing_gif();
}


# phpfmg module : captcha
# ------------------------------------------------------
function phpfmg_captcha_get(){
    $img = new phpfmgImage();
    $img->out();
    //$_SESSION[PHPFMG_ID.'fmgCaptchCode'] = $img->text ;
    $_SESSION[ phpfmg_captcha_name() ] = $img->text ;
}



function phpfmg_captcha_generate_images(){
    for( $i = 0; $i < 50; $i ++ ){
        $file = "$i.png";
        $img = new phpfmgImage();
        $img->out($file);
        $data = base64_encode( file_get_contents($file) );
        echo "'{$img->text}' => '{$data}',\n" ;
        unlink( $file );
    };
}


function phpfmg_dd_lookup(){
    $paraOk = ( isset($_REQUEST['n']) && isset($_REQUEST['lookup']) && isset($_REQUEST['field_name']) );
    if( !$paraOk )
        return;
        
    $base64 = phpfmg_dependent_dropdown_data();
    $data = @unserialize( base64_decode($base64) );
    if( !is_array($data) ){
        return ;
    };
    
    
    foreach( $data as $field ){
        if( $field['name'] == $_REQUEST['field_name'] ){
            $nColumn = intval($_REQUEST['n']);
            $lookup  = $_REQUEST['lookup']; // $lookup is an array
            $dd      = new DependantDropdown(); 
            echo $dd->lookupFieldColumn( $field, $nColumn, $lookup );
            return;
        };
    };
    
    return;
}


function phpfmg_filman_download(){
    if( !isset($_REQUEST['filelink']) )
        return ;
        
    $info =  @unserialize(base64_decode($_REQUEST['filelink']));
    if( !isset($info['recordID']) ){
        return ;
    };
    
    $file = PHPFMG_SAVE_ATTACHMENTS_DIR . $info['recordID'] . '-' . $info['filename'];
    phpfmg_util_download( $file, $info['filename'] );
}


class phpfmgDataManager
{
    var $dataFile = '';
    var $columns = '';
    var $records = '';
    
    function phpfmgDataManager(){
        $this->dataFile = PHPFMG_SAVE_FILE; 
    }
    
    function parseFile(){
        $fp = @fopen($this->dataFile, 'rb');
        if( !$fp ) return false;
        
        $i = 0 ;
        $phpExitLine = 1; // first line is php code
        $colsLine = 2 ; // second line is column headers
        $this->columns = array();
        $this->records = array();
        $sep = chr(0x09);
        while( !feof($fp) ) { 
            $line = fgets($fp);
            $line = trim($line);
            if( empty($line) ) continue;
            $line = $this->line2display($line);
            $i ++ ;
            switch( $i ){
                case $phpExitLine:
                    continue;
                    break;
                case $colsLine :
                    $this->columns = explode($sep,$line);
                    break;
                default:
                    $this->records[] = explode( $sep, phpfmg_data2record( $line, false ) );
            };
        }; 
        fclose ($fp);
    }
    
    function displayRecords(){
        $this->parseFile();
        echo "<table border=1 style='width=95%;border-collapse: collapse;border-color:#cccccc;' >";
        echo "<tr><td>&nbsp;</td><td><b>" . join( "</b></td><td>&nbsp;<b>", $this->columns ) . "</b></td></tr>\n";
        $i = 1;
        foreach( $this->records as $r ){
            echo "<tr><td align=right>{$i}&nbsp;</td><td>" . join( "</td><td>&nbsp;", $r ) . "</td></tr>\n";
            $i++;
        };
        echo "</table>\n";
    }
    
    function line2display( $line ){
        $line = str_replace( array('"' . chr(0x09) . '"', '""'),  array(chr(0x09),'"'),  $line );
        $line = substr( $line, 1, -1 ); // chop first " and last "
        return $line;
    }
    
}
# end of class



# ------------------------------------------------------
class phpfmgImage
{
    var $im = null;
    var $width = 73 ;
    var $height = 33 ;
    var $text = '' ; 
    var $line_distance = 8;
    var $text_len = 4 ;

    function phpfmgImage( $text = '', $len = 4 ){
        $this->text_len = $len ;
        $this->text = '' == $text ? $this->uniqid( $this->text_len ) : $text ;
        $this->text = strtoupper( substr( $this->text, 0, $this->text_len ) );
    }
    
    function create(){
        $this->im = imagecreate( $this->width, $this->height );
        $bgcolor   = imagecolorallocate($this->im, 255, 255, 255);
        $textcolor = imagecolorallocate($this->im, 0, 0, 0);
        $this->drawLines();
        imagestring($this->im, 5, 20, 9, $this->text, $textcolor);
    }
    
    function drawLines(){
        $linecolor = imagecolorallocate($this->im, 210, 210, 210);
    
        //vertical lines
        for($x = 0; $x < $this->width; $x += $this->line_distance) {
          imageline($this->im, $x, 0, $x, $this->height, $linecolor);
        };
    
        //horizontal lines
        for($y = 0; $y < $this->height; $y += $this->line_distance) {
          imageline($this->im, 0, $y, $this->width, $y, $linecolor);
        };
    }
    
    function out( $filename = '' ){
        if( function_exists('imageline') ){
            $this->create();
            if( '' == $filename ) header("Content-type: image/png");
            ( '' == $filename ) ? imagepng( $this->im ) : imagepng( $this->im, $filename );
            imagedestroy( $this->im ); 
        }else{
            $this->out_predefined_image(); 
        };
    }

    function uniqid( $len = 0 ){
        $md5 = md5( uniqid(rand()) );
        return $len > 0 ? substr($md5,0,$len) : $md5 ;
    }
    
    function out_predefined_image(){
        header("Content-type: image/png");
        $data = $this->getImage(); 
        echo base64_decode($data);
    }
    
    // Use predefined captcha random images if web server doens't have GD graphics library installed  
    function getImage(){
        $images = array(
			'4D6E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAX0lEQVR4nGNYhQEaGAYTpI37poiGMIQyhgYgi4WItDI6Ojogq2MMEWl0bUAVY50CEmOEiYGdNG3atJWpU1eGZiG5LwCkDs280FCQ3kAHVLdgFcNwC1Y3D1T4UQ9icR8AEC3KoLafbG0AAAAASUVORK5CYII=',
			'AE67' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7GB1EQxlCGUNDkMRYA0QaGB0dGkSQxESmiDSwNqCKBbSCxIA0kvuilk4NWzp11cosJPeB1Tk6tCLbGxoK0hswhQHDvIAAdDFGR0cHVDGwm1HEBir8qAixuA8AolDL0onRi9sAAAAASUVORK5CYII=',
			'66AF' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7WAMYQximMIaGIImJTGFtZQhldEBWF9Ai0sjo6Igq1iDSwNoQCBMDOykyalrY0lWRoVlI7guZItqKpA6it1Wk0TUUixiaOpBb0PWC3IwuNlDhR0WIxX0A++PKnP/ImHIAAAAASUVORK5CYII=',
			'EEA3' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXUlEQVR4nGNYhQEaGAYTpIn7QkNEQxmmMIQ6IIkFNIg0MIQyOgSgiTE6OoBkUMRYgWQAkvtCo6aGLV0VtTQLyX1o6hBioQFYzcMUC0RxC8jNQHUobh6o8KMixOI+AKVvzmXBGz6bAAAAAElFTkSuQmCC',
			'20FE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7WAMYAlhDA0MDkMREpjCGsDYwOiCrC2hlbUUXY2gVaXRFiEHcNG3aytTQlaFZyO4LQFEHhowOmGKsDZh2iDRguiU0FOjmBkYUNw9U+FERYnEfAHOuyFmFZ2PaAAAAAElFTkSuQmCC',
			'4272' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nM2QMQ6AMAgA6cAP6n9Y3DEpi6+hQ39Q+wOXvlLcqDpqIrddSLgA/TYKf+KbvhoSCm/kXcICyszOhRQz6ULROayQyWx0fa313eir6+MKJ9nfEAE2yqWFAtnm4FBRbXNwk8waJP3hf+/x0HcAYGzMGDX4fLUAAAAASUVORK5CYII=',
			'1281' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7GB0YQxhCGVqRxVgdWFsZHR2mIouJOog0ujYEhKLqZWh0dHSA6QU7aWXWqqWrQoEYyX1AdVMYEepgYgGsDQFoYowOmGKsDeh6RUNEQx1CGUIDBkH4URFicR8A5MDI1bXy3wgAAAAASUVORK5CYII=',
			'AA6C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7GB0YAhhCGaYGIImxBjCGMDo6BIggiYlMYW1lbXB0YEESC2gVaXQFmYDkvqil01amTl2Zhew+sDpHRwdke0NDRUNdGwJRxCDmBWLY4YjmFpCYA5qbByr8qAixuA8Ao3PMWpgOPJIAAAAASUVORK5CYII=',
			'0C00' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXUlEQVR4nGNYhQEaGAYTpIn7GB0YQxmmMLQii7EGsDY6hDJMdUASE5ki0uDo6BAQgCQW0CrSwNoQ6CCC5L6opdNWLV0VmTUNyX1o6nCKYbMDm1uwuXmgwo+KEIv7AAIBzBEm72DzAAAAAElFTkSuQmCC',
			'D00F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAW0lEQVR4nGNYhQEaGAYTpIn7QgMYAhimMIaGIIkFTGEMYQhldEBWF9DK2sro6IgmJtLo2hAIEwM7KWrptJWpqyJDs5Dch6YOjxgWO7C4BepmFLGBCj8qQizuAwCeBcrPhjzyQQAAAABJRU5ErkJggg==',
			'CC5A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7WEMYQ1lDHVqRxURaWRtdGximOiCJBTSKNADFAgKQxRpEGlinMjqIILkvatW0VUszM7OmIbkPpI6hIRCmDlksNATDDlR1ILc4OjqiiIHczBDKiCI2UOFHRYjFfQC3ecxvzoM1cAAAAABJRU5ErkJggg==',
			'D930' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYklEQVR4nGNYhQEaGAYTpIn7QgMYQxhDGVqRxQKmsLayNjpMdUAWaxVpdGgICAhAF2t0dBBBcl/U0qVLs6auzJqG5L6AVsZAJHVQMQageYFoYiyYdmBxCzY3D1T4URFicR8A0PvPFLWBvaoAAAAASUVORK5CYII=',
			'1CB0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXklEQVR4nGNYhQEaGAYTpIn7GB0YQ1lDGVqRxVgdWBtdGx2mOiCJiTqINLg2BAQEoOgVaWBtdASSCPetzJq2amkoiES4D00dQqwhEEMM0w4sbgnBdPNAhR8VIRb3AQAsZsqk6dgGVgAAAABJRU5ErkJggg==',
			'76C5' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpIn7QkMZQxhCHUMDkEVbWVsZHQIdUFS2ijSyNgiiik0RaWBtYHR1QHZf1LSwpatWRkUhuY/RQbSVFUiLIOllbRBpdEUTEwGLCTogiwU0gNwSEBCAIgZys8NUh0EQflSEWNwHAELXyvkNmZWEAAAAAElFTkSuQmCC',
			'ADB4' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7GB1EQ1hDGRoCkMRYA0RaWRsdGpHFRKaINLo2BLQiiwW0AsUaHaYEILkvaum0lamhq6KikNwHUefogKw3NBRkXmBoCLp5QJeg2QFyC5oYppsHKvyoCLG4DwDFxtAvhDK1/wAAAABJRU5ErkJggg==',
			'672A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAeklEQVR4nGNYhQEaGAYTpIn7WANEQx1CGVqRxUSmMDQ6OjpMdUASC2hhaHRtCAgIQBZrAOkLdBBBcl9k1Kppq1ZmZk1Dcl/IFIYAhlZGmDqIXiCfYQpjaAiKGGsDQwCqOpEpIg2MDqhirAEiDayhgShiAxV+VIRY3AcAbPTLNoaPGK4AAAAASUVORK5CYII=',
			'5631' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7QkMYQxhDGVqRxQIaWFtZGx2mooqJNALJUGSxwACRBoZGB5hesJPCpk0LWzV11VIU97WKtiKpg4qJNDo0BKDai0VMZArYLShirAFgN4cGDILwoyLE4j4AYfrNI/7d3lAAAAAASUVORK5CYII=',
			'6F23' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAc0lEQVR4nGNYhQEaGAYTpIn7WANEQx1CGUIdkMREpog0MDo6OgQgiQW0iDSwNgQ0iCCLgXkBDQFI7ouMmhq2amXW0iwk94UAzWNoZWhAMa8VKDaFAdU8kFgAqhjYLQ6MKG5hDQC6JTQAxc0DFX5UhFjcBwDarMynnuUmngAAAABJRU5ErkJggg==',
			'9438' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7WAMYWhlDGaY6IImJTGGYytroEBCAJBbQyhDK0BDoIIIixujKgFAHdtK0qUuXrpq6amoWkvtYXUVaGdDMY2gVDXVAM0+glaEV3Q6gW1rR3YLNzQMVflSEWNwHAKpRzIoq6EgkAAAAAElFTkSuQmCC',
			'73B5' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7QkNZQ1hDGUMDkEVbRVpZGx0dUFS2MjS6NgSiik1hAKlzdUB2X9SqsKWhK6OikNzH6ABS59AggqSXtQFkXgCKmEgDxA5kMaAKkN6AABQxkJsZpjoMgvCjIsTiPgCV2MwEqp+GEAAAAABJRU5ErkJggg==',
			'A061' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7GB0YAhhCGVqRxVgDGEMYHR2mIouJTGFtZW1wCEUWC2gVaXRtgOsFOylq6bSVqVNXLUV2H1idowOKHaGhIL0BrajmgexAFwO7BU0M7ObQgEEQflSEWNwHAMlDzD9Lbm0pAAAAAElFTkSuQmCC',
			'B5D5' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nM3QMQ7AIAhAUR24gb0PHdwxkaGeBgdvoEdw8ZR1xNSxTQrbizE/mPEYMX/aT/qYDga2TMqoOoF8on5HZZqE1aqL0zyqPk6t93GlpPqomuyFxC3/7cxNC7hYhQIZSfcx2QhsGv7gfi/upu8GWRfOIj5frt0AAAAASUVORK5CYII=',
			'158E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7GB1EQxlCGUMDkMRYHUQaGB0dHZDViQLFWBsCHVD1ioQgqQM7aWXW1KWrQleGZiG5j9GBodERzTyQmCumeVjEWFsx3BLCGILu5oEKPypCLO4DAIxUxvzSyFAVAAAAAElFTkSuQmCC',
			'35FF' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXklEQVR4nGNYhQEaGAYTpIn7RANEQ1lDA0NDkMQCpog0sDYwOqCobMUiNkUkBEkM7KSVUVOXLg1dGZqF7L4pDI2uGOZhExPBEAuYwtqKbq9oAGMIhlsGKPyoCLG4DwBAuMjnSoLLOgAAAABJRU5ErkJggg==',
			'7C09' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7QkMZQxmmMEx1QBZtZW10CGUICEARE2lwdHR0EEEWmyLSwNoQCBODuClq2qqlq6KiwpDcx+gAUhcwFVkvawNYrAFZTKQBZIcDih0BDZhuCWjA4uYBCj8qQizuAwATscxANMnEiwAAAABJRU5ErkJggg==',
			'B9FA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7QgMYQ1hDA1qRxQKmsLayNjBMdUAWaxVpdG1gCAhAUQcSY3QQQXJfaNTSpamhK7OmIbkvYApjIJI6qHkMIL2hIShiLI0Y6sBuQRUDuxlNbKDCj4oQi/sACGrMnx6oWe0AAAAASUVORK5CYII=',
			'2F94' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7WANEQx1CGRoCkMREpog0MDo6NCKLBbSKNLACSWQxBojYlABk902bGrYyMyoqCtl9ASINDCGBDsh6GR2AYg2BoSHIbmkA2gt0CYpbGsBuQRELDQXqRXPzQIUfFSEW9wEAbQjNLUpG2UYAAAAASUVORK5CYII=',
			'2A99' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdklEQVR4nGNYhQEaGAYTpIn7WAMYAhhCGaY6IImJTGEMYXR0CAhAEgtoZW1lbQh0EEHW3SrS6IoQg7hp2rSVmZlRUWHI7gsQaXQICZiKrJfRQTTUoSGgAVmMtUGk0bEhAMUOEZAYmltCQ4Hmobl5oMKPihCL+wCgUcwVUxUR4AAAAABJRU5ErkJggg==',
			'99BC' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7WAMYQ1hDGaYGIImJTGFtZW10CBBBEgtoFWl0bQh0YEEXa3R0QHbftKlLl6aGrsxCdh+rK2MgkjoIbGUAm4csJtDKgmEHNrdgc/NAhR8VIRb3AQDyn8vpYVF5HwAAAABJRU5ErkJggg==',
			'113F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXUlEQVR4nGNYhQEaGAYTpIn7GB0YAhhDGUNDkMRYHRgDWBsdHZDViTqwBjA0BDqg62VAqAM7aWXWqqhVU1eGZiG5D00dQgybeVjEMNwSwgp0MSOK2ECFHxUhFvcBAKrMxU4rCfOxAAAAAElFTkSuQmCC',
			'955C' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdElEQVR4nM2QsQ2AMAwEHQn3FGYfU9AbiQwRpkiKbEDYgIYpgc5WKEHw313zp4e9SoQ/9RU/lM6j5yKK0UIRIwgpJvlijhvLJiyOtd9ayraFMGs/HCBxHNks55q1mdJwMr1BC2bXs3FBcRN4MM5f/fdgb/wOlILK3NrkrakAAAAASUVORK5CYII=',
			'31A9' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7RAMYAhimMEx1QBILmMIYwBDKEBCArLKVNYDR0dFBBFlsCkMAa0MgTAzspJVRq6KWroqKCkN2H1hdwFQUva1AsdCABgyxhgAUOwIgelHcIgrUCTIP2c0DFX5UhFjcBwBexso35mQPrQAAAABJRU5ErkJggg==',
			'AE7D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7GB1EQ1lDA0MdkMRYA0SAZKBDAJKYyBSImAiSWEArkNfoCBMDOylq6dSwVUtXZk1Dch9Y3RRGFL2hoUBeACOGeYwOmGKsQNEAFDGgmxsYUdw8UOFHRYjFfQAIlMtPqdqErQAAAABJRU5ErkJggg==',
			'9905' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7WAMYQximMIYGIImJTGFtZQhldEBWF9Aq0ujo6Igh5toQ6OqA5L5pU5cuTV0VGRWF5D5WV8ZA14aABhFkm1sZGtHFBFpZwHaIYLiFIQDZfRA3M0x1GAThR0WIxX0ACTnLWVpaiGsAAAAASUVORK5CYII=',
			'5E77' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7QkNEQ1lDA0NDkMQCGkTgJD6xwAAgr9EBKIpwX9i0qWGrlq5amYXsvlaguikMrSg2g8QCgKLIdgDFGB2AokhiIlNEGlhBokhirAFAN6OJDVT4URFicR8AO9rLmxiiEXwAAAAASUVORK5CYII=',
			'7838' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAYUlEQVR4nGNYhQEaGAYTpIn7QkMZQxhDGaY6IIu2srayNjoEBKCIiTQ6NAQ6iCCLTWFtZUCog7gpamXYqqmrpmYhuY/RAUUdGLI2YJongkUsoAHTLQENWNw8QOFHRYjFfQAtAM0cqAspkAAAAABJRU5ErkJggg==',
			'710D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7QkMZAhimMIY6IIu2MgYwhDI6BKCIsQYwOjo6iCCLTWEIYG0IhIlB3BS1KmrpqsisaUjuY3RAUQeGrA2YYkA2hh1AN2C4JaCBNRTDzQMUflSEWNwHAFJayGlQsQo3AAAAAElFTkSuQmCC',
			'21A9' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAc0lEQVR4nM2QvRGAIAxGQ5ENGAg2+CxiwTQ0bABuYMOUipx34bTU03zdu/y8C9VLRfpTXvFjEChTcYrZbEBCgGJIDOO9s3o6EThOJ+tOSw1rDWHWfmh9KHrWuJ0JomYcj77hhu1scBFhafu081f/ezA3fhvm2cnWHbEzcQAAAABJRU5ErkJggg==',
			'C40A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpIn7WEMYWhmmADGSmEgrw1SGUIapDkhiAY0MoYyODgEByGINjK6sDYEOIkjui1q1dOnSVZFZ05DcFwA0EUkdVEw01LUhMDQE1Y5WRkdHFHVAt7QCbUYRg7gZVWygwo+KEIv7AFJFy2BCEOTGAAAAAElFTkSuQmCC',
			'F2CE' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpIn7QkMZQxhCHUMDkMQCGlhbGR0CHRhQxEQaXRsE0cQYgGKMMDGwk0KjVi1dumplaBaS+4DqprAi1MHEAjDFGB1YMewAqUJ3i2ioA5qbByr8qAixuA8AyqjLC1SboocAAAAASUVORK5CYII=',
			'7201' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbklEQVR4nGNYhQEaGAYTpIn7QkMZQximMLSiiLaytjKEMkxFFRNpdHR0CEURm8LQ6NoQANMLcVPUqqVLV0UtRXYfowPDFFaEOjBkbWAIQBcTAapkdHRAEQsAqQxlQBMTDXWYwhAaMAjCj4oQi/sAW+bLo6ExIeEAAAAASUVORK5CYII=',
			'55B0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7QkNEQ1lDGVqRxQIaRBpYGx2mOqCLNQQEBCCJBQaIhLA2OjqIILkvbNrUpUtDV2ZNQ3ZfK0OjK0IdQqwhEEUsoFUEKIZqh8gU1lZ0t7AGMIagu3mgwo+KEIv7AKRszUjold63AAAAAElFTkSuQmCC',
			'0EDD' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWElEQVR4nGNYhQEaGAYTpIn7GB1EQ1lDGUMdkMRYA0QaWBsdHQKQxESmAMUaAh1EkMQCWlHEwE6KWjo1bOmqyKxpSO5DU4dTDJsd2NyCzc0DFX5UhFjcBwDIv8sYE/lYIQAAAABJRU5ErkJggg==',
			'0ABD' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7GB0YAlhDGUMdkMRYAxhDWBsdHQKQxESmsLayNgQ6iCCJBbSKNLoC1YkguS9q6bSVqaErs6YhuQ9NHVRMNNQVzTyRKUB1aGKsARC9yG5hdACKobl5oMKPihCL+wDBw8wr723oPAAAAABJRU5ErkJggg==',
			'FB6F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAV0lEQVR4nGNYhQEaGAYTpIn7QkNFQxhCGUNDkMQCGkRaGR0dHRhQxRpdGzDEWlkbGGFiYCeFRk0NWzp1ZWgWkvvA6rCaF0iMGBa3gN2MIjZQ4UdFiMV9AA22y0AZ/C4OAAAAAElFTkSuQmCC',
			'884F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAX0lEQVR4nGNYhQEaGAYTpIn7WAMYQxgaHUNDkMREprC2MrQ6OiCrC2gVaXSYiioGVhcIFwM7aWnUyrCVmZmhWUjuA6ljbcQ0zzU0ENOORix2oIlB3YwiNlDhR0WIxX0AtPHK7pKI+LYAAAAASUVORK5CYII=',
			'F23E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7QkMZQxhDGUMDkMQCGlhbWRsdHRhQxEQaHRoC0cQYGh0Q6sBOCo1atXTV1JWhWUjuA6qbwoBhHkMAA4Z5jA6YYqwNmG4RDXVEc/NAhR8VIRb3AQAefcwgHe4doQAAAABJRU5ErkJggg==',
			'CFAD' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7WENEQx2mMIY6IImJtIo0MIQyOgQgiQU0ijQwOjo6iCCLNYg0sDYEwsTATopaNTVs6arIrGlI7kNThxALRRNrxFQHcgtIDNktrCFgMRQ3D1T4URFicR8AHovMV+YR03kAAAAASUVORK5CYII=',
			'3AC9' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcklEQVR4nGNYhQEaGAYTpIn7RAMYAhhCHaY6IIkFTGEMYXQICAhAVtnK2sraIOgggiw2RaTRtYERJgZ20sqoaStTV62KCkN2H1gdw1QUva2ioUCxBlQxkDoBFDsCgHod0dwiGiDS6IDm5oEKPypCLO4DABBtzGs50T4GAAAAAElFTkSuQmCC',
			'E28E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7QkMYQxhCGUMDkMQCGlhbGR0dHRhQxEQaXRsC0cQYGh0R6sBOCo1atXRV6MrQLCT3AdVNwTSPIYAVwzxGB0wx1gZ0vaEhoqEOaG4eqPCjIsTiPgBrRsq/lthE8wAAAABJRU5ErkJggg==',
			'3F18' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZUlEQVR4nGNYhQEaGAYTpIn7RANEQx2mMEx1QBILmCLSwBDCEBCArLJVpIExhNFBBFkMpG4KXB3YSSujpoatmrZqahay+1DVwc1jmIJmHhaxACx6RQOAbgl1QHHzQIUfFSEW9wEAXaTLlXeWt6gAAAAASUVORK5CYII=',
			'C305' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaUlEQVR4nGNYhQEaGAYTpIn7WENYQximMIYGIImJtIq0MoQyOiCrC2hkaHR0dEQVa2BoZW0IdHVAcl/UqlVhS1dFRkUhuQ+iLqBBBFVvoyu6GNQOEQy3MAQguw/iZoapDoMg/KgIsbgPAGyOy8cFdPMrAAAAAElFTkSuQmCC',
			'FD1F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAVklEQVR4nGNYhQEaGAYTpIn7QkNFQximMIaGIIkFNIi0MoQwOjCgijU6YhFzmAIXAzspNGrayqxpK0OzkNyHpo5UsVYGDDHREMZQRxSxgQo/KkIs7gMALCDLYYboaP4AAAAASUVORK5CYII=',
			'2793' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7WANEQx1CGUIdkMREpjA0Ojo6OgQgiQW0MjS6NgQ0iCDrbmVoZQWKBSC7b9qqaSszo5ZmIbsvAAhD4OrAkNGB0YEBzTxWIGREExMBQkY0t4SGAlWguXmgwo+KEIv7AEvwzCUZAlE8AAAAAElFTkSuQmCC',
			'7AF0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7QkMZAlhDA1pRRFsZQ1gbGKY6oIixtgLFAgKQxaaINLo2MDqIILsvatrK1NCVWdOQ3AdUgawODFkbREPRxUQaQOpQ7QiAiKG4BSqG6uYBCj8qQizuAwB6J8v6Ud6DSAAAAABJRU5ErkJggg==',
			'1A7F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7GB0YAlhDA0NDkMRYHRhDGBoCHZDViTqwtqKLMTqINDo0OsLEwE5amTVtZdbSlaFZSO4Dq5vCiKZXNNQhAF1MBGgapphrA6qYaAim2ECFHxUhFvcBAGtwx4slFX21AAAAAElFTkSuQmCC',
			'0442' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdUlEQVR4nM3QMQ6AIAwF0O/ADfA+ZXCviSzcQE8BQ28gR2DQUxq2Ehw1oX/7SdOX4u4mYqT84psIgkSZVGcYGULMqrMnPLIjqzqWacFK0SpfKKVc+3EH5WOxYhIlanZnv3gWtDeq5URrqR33Zue3Af73YV58D3E7zGdCPbAWAAAAAElFTkSuQmCC',
			'738A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7QkNZQxhCGVpRRFtFWhkdHaY6oIgxNLo2BAQEIItNYQCqc3QQQXZf1KqwVaErs6YhuY/RAUUdGLI2gMwLDA1BEhOBiKGoC2gQwdAb0AByMyOK2ECFHxUhFvcBAJyjyujh9qDJAAAAAElFTkSuQmCC',
			'67A3' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAdklEQVR4nGNYhQEaGAYTpIn7WANEQx2mMIQ6IImJTGFodAhldAhAEgtoYWh0dHRoEEEWa2BoZQWSAUjui4xaNW3pqqilWUjuC5nCEICkDqK3ldGBNTQA1TygaSB1IihuEQGKBaK4hTUAJBaA4uaBCj8qQizuAwBI383790/SqwAAAABJRU5ErkJggg==',
			'D1DD' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAV0lEQVR4nGNYhQEaGAYTpIn7QgMYAlhDGUMdkMQCpjAGsDY6OgQgi7WyBrA2BDqIoIgxIIuBnRS1FIQis6YhuQ9NHWliUxgw3BIKdDG6mwcq/KgIsbgPAD9ly3GVdKtsAAAAAElFTkSuQmCC',
			'175A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7GB1EQ11DHVqRxVgdGBpdGximOiCJiULEAgJQ9DK0sk5ldBBBct/KrFXTlmZmZk1Dch9QXQBDQyBMHVQMKNoQGBqCIsbawIqhTqSB0dERRUw0BMgLZUQRG6jwoyLE4j4AxQ7IZFapv7AAAAAASUVORK5CYII=',
			'DC91' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAX0lEQVR4nGNYhQEaGAYTpIn7QgMYQxlCGVqRxQKmsDY6OjpMRRFrFWlwbQgIRRdjBZLI7otaOm3VysyopcjuA6ljCAloRdfL0IAp5oguBnELihjUzaEBgyD8qAixuA8A5ujOZu85LyUAAAAASUVORK5CYII=',
			'A4C2' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcElEQVR4nGNYhQEaGAYTpIn7GB0YWhlCHaY6IImxBjBMZXQICAhAEhOZwhDK2iDoIIIkFtDK6MoKkkNyX9RSIADRSO4LaBVpBaprRLYjNFQ01LUBaDeKeQxAdQJT0MVAbkEXYwh1DA0ZBOFHRYjFfQAZJMxgaUn4eQAAAABJRU5ErkJggg==',
			'5FE3' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXElEQVR4nGNYhQEaGAYTpIn7QkNEQ11DHUIdkMQCGkQaWBsYHQIwxBiAJEIsMAAiFoDkvrBpU8OWhq5amoXsvlYUdShiyOYFYBETmYLpFlaQvWhuHqjwoyLE4j4AoqPMZLhhixQAAAAASUVORK5CYII=',
			'48B5' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpI37pjCGsIYyhgYgi4WwtrI2Ojogq2MMEWl0bQhEEWOdAlbn6oDkvmnTVoYtDV0ZFYXkvgCwOocGESS9oaEg8wJQxBimQOxAFQPrDUBxH9jNDFMdBkP4UQ9icR8AwGLMKYU277QAAAAASUVORK5CYII=',
			'1F0D' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXUlEQVR4nGNYhQEaGAYTpIn7GB1EQx2mMIY6IImxOog0MIQyOgQgiYkCxRgdHUEySHpFGlgbAmFiYCetzJoatnRVZNY0JPehqcMrhs0ODLeEAMXQ3DxQ4UdFiMV9AP3GyBAgMW6qAAAAAElFTkSuQmCC',
			'81EC' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAW0lEQVR4nGNYhQEaGAYTpIn7WAMYAlhDHaYGIImJTGEMYG1gCBBBEgtoZQWKMTqwoKhjAIshu29p1KqopaErs5Ddh6YOah5uMUw7UN0CdEkoupsHKvyoCLG4DwBtx8hk4uAmPwAAAABJRU5ErkJggg==',
			'51BD' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7QkMYAlhDGUMdkMQCGhgDWBsdHQJQxFgDWBsCHUSQxAIDGMDqRJDcFzZtVdTS0JVZ05Dd14qiDiGGZl4AFjGRKQwYbgG6JBTdzQMVflSEWNwHAE99ycZxw6/jAAAAAElFTkSuQmCC',
			'45AF' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpI37poiGMkxhDA1BFgsRaWAIZXRAVscIFGN0dEQRY50iEsLaEAgTAztp2rSpS5euigzNQnJfwBSGRleEOjAMDQWKhaKKMUwRwVDHMIW1lRVDjDEEQ2ygwo96EIv7AJLMyljy3PUrAAAAAElFTkSuQmCC',
			'379A' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAeklEQVR4nGNYhQEaGAYTpIn7RANEQx1CGVqRxQKmMDQ6OjpMdUBW2crQ6NoQEBCALDaFoZW1IdBBBMl9K6NWTVuZGZk1Ddl9UxgCGELg6qDmMTowNASGhqCIsTYwNqCqC5gi0sAIdAyymGgAkBfKiGreAIUfFSEW9wEAOIHLG6Vm0HUAAAAASUVORK5CYII=',
			'14BD' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7GB0YWllDGUMdkMRYHRimsjY6OgQgiYk6MISyNgQ6iKDoZXQFqRNBct/KrKVLl4auzJqG5D5GB5FWJHVQMdFQVwzzgG7BJobulhBMNw9U+FERYnEfAJVDyJ2J1lbqAAAAAElFTkSuQmCC',
			'03DD' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXklEQVR4nGNYhQEaGAYTpIn7GB1YQ1hDGUMdkMRYA0RaWRsdHQKQxESmMDS6NgQ6iCCJBbQytLIixMBOilq6KmzpqsisaUjuQ1MHE8MwD5sd2NyCzc0DFX5UhFjcBwBB5ct+In2y6gAAAABJRU5ErkJggg==',
			'9E29' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAc0lEQVR4nGNYhQEaGAYTpIn7WANEQxlCGaY6IImJTBFpYHR0CAhAEgtoFWlgbQh0EEETY0CIgZ00berUsFUrs6LCkNzH6gpU0cowFVkvA0jvFKBdSGICILEABhQ7wG5xYEBxC8jNrKEBKG4eqPCjIsTiPgBpRcqrOBvnvQAAAABJRU5ErkJggg==',
			'9CAC' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7WAMYQxmmMEwNQBITmcLa6BDKECCCJBbQKtLg6OjowIImxtoQ6IDsvmlTp61auioyC9l9rK4o6iAQpDcUVUwAKOYKVIdsB8gtrg0BKG4BuZm1IQDFzQMVflSEWNwHAAiqzDMlrM98AAAAAElFTkSuQmCC',
			'B872' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7QgMYQ1hDA6Y6IIkFTGFtBZIBAchirSKNDg2BDiLo6oCiIkjuC41aGbZq6apVUUjuA6ubAlKJZl4AQysDmpijA1Almh2sDQwBGG5uYAwNGQThR0WIxX0A3ITODB5z2CIAAAAASUVORK5CYII=',
			'B84E' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXklEQVR4nGNYhQEaGAYTpIn7QgMYQxgaHUMDkMQCprC2MrQ6OiCrC2gVaXSYiiYGUhcIFwM7KTRqZdjKzMzQLCT3gdSxNmKa5xoaiGkHujqQHWhi2Nw8UOFHRYjFfQCehsyPN/MImQAAAABJRU5ErkJggg==',
			'6A3F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7WAMYAhhDGUNDkMREpjCGsDY6OiCrC2hhbWVoCEQVaxBpdECoAzspMmrayqypK0OzkNwXMgVFHURvq2ioA7p5rUB1aGIiQL2uaHpZA0QaHUMZUcQGKvyoCLG4DwBVG8uyIzd6ygAAAABJRU5ErkJggg==',
			'FEAA' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAWklEQVR4nGNYhQEaGAYTpIn7QkNFQxmmMLQiiwU0iDQwhDJMdUATY3R0CAhAE2NtCHQQQXJfaNTUsKWrIrOmIbkPTR1CLDQwNAS3eXjEREPRxQYq/KgIsbgPAD85zSLmE4ebAAAAAElFTkSuQmCC',
			'6704' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAc0lEQVR4nM3QwQ2AIAyF4cehG+A+ZYOawEGmKYlsQNzAC1PKEdSjRtvbnzT5UtTLKP60r/hIpsAFKl2zBYkDUt9kRXKO89AUmVSKdL4l1m2vMcbO5wuEdObhNhtuLfihkRrHJ4tVhNFH0trJ/NX/Htwb3wGqzs4UamYjkAAAAABJRU5ErkJggg==',
			'71AD' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7QkMZAhimMIY6IIu2MgYwhDI6BKCIsQYwOjo6iCCLTWEIYG0IhIlB3BS1KmrpqsisaUjuY3RAUQeGrA1AsVBUMZEGTHUBULEAFDHWUKAYqpsHKPyoCLG4DwAvGMlSwcTCTAAAAABJRU5ErkJggg==',
			'B730' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7QgNEQx1DGVqRxQKmMDS6NjpMdUAWa2VodGgICAhAVQcUdXQQQXJfaNSqaaumrsyahuQ+oLoAJHVQ8xgdGBoC0cRYQSSaHSINrGhuCQ0QaWBEc/NAhR8VIRb3AQBFEs6HA9F73wAAAABJRU5ErkJggg==',
			'5C88' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZElEQVR4nGNYhQEaGAYTpIn7QkMYQxlCGaY6IIkFNLA2Ojo6BASgiIk0uDYEOoggiQUGiDQwItSBnRQ2bdqqVaGrpmYhu68VRR1cjBXNvIBWTDtEpmC6hTUA080DFX5UhFjcBwAsDczb+mwzwAAAAABJRU5ErkJggg==',
			'E710' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAa0lEQVR4nGNYhQEaGAYTpIn7QkNEQx2mMLQiiwU0MDQ6hDBMdUATcwxhCAhAFWtlmMLoIILkvtCoVdNWTVuZNQ3JfUB1AUjqoGKMDphirA0MU9DtEAGJobglNESkgTHUAcXNAxV+VIRY3AcA78rMvj7odc8AAAAASUVORK5CYII=',
			'6701' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAcUlEQVR4nGNYhQEaGAYTpIn7WANEQx2mMLQii4lMYWh0CGWYiiwW0MLQ6OgIFEUWa2BoZW0IgOkFOykyatW0pauiliK7L2QKQwCSOojeVkYHTDHWBkZHBzS3iDQwhKK6jzUAKDaFITRgEIQfFSEW9wEAdBPMVwf8B7gAAAAASUVORK5CYII=',
			'BD32' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAY0lEQVR4nGNYhQEaGAYTpIn7QgNEQxhDGaY6IIkFTBFpZW10CAhAFmsVaXRoCHQQQVXX6AAUFUFyX2jUtJVZU1etikJyH1RdowOGeQGtDJhiUxiwuAXTzYyhIYMg/KgIsbgPAL3zz8gflvzbAAAAAElFTkSuQmCC',
			'9EE6' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXElEQVR4nGNYhQEaGAYTpIn7WANEQ1lDHaY6IImJTBFpYG1gCAhAEgtoBYkxOghgEUN237SpU8OWhq5MzUJyH6srWB2KeQxQvSJIYgJYxLC5BZubByr8qAixuA8A84rKWdzv/ekAAAAASUVORK5CYII=',
			'1598' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaklEQVR4nGNYhQEaGAYTpIn7GB1EQxlCGaY6IImxOog0MDo6BAQgiYkCxVgbAoEksl6RENaGAJg6sJNWZk1dujIzamoWkvsYHRgaHUICUMwDi2Ga1+iIIcbaiuGWEMYQdDcPVPhREWJxHwC6lcmCLCX8GQAAAABJRU5ErkJggg==',
			'07E5' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7GB1EQ11DHUMDkMRYAxgaXYEyyOpEpmCKBbQytLI2MLo6ILkvaumqaUtDV0ZFIbkPqC6AFWQGil5GB3QxkSmsDUDzHJDFWANEgGIMAcjuA6lgDXWY6jAIwo+KEIv7ALm+ykJN1hAsAAAAAElFTkSuQmCC',
			'B909' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbUlEQVR4nGNYhQEaGAYTpIn7QgMYQximMEx1QBILmMLayhDKEBCALNYq0ujo6OgggqJOpNG1IRAmBnZSaNTSpamroqLCkNwXMIUx0LUhYCqK3lYGoN6ABlQxFqAdDmh2YLoFm5sHKvyoCLG4DwAEnc2whRjGQQAAAABJRU5ErkJggg==',
			'B8A2' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAaElEQVR4nGNYhQEaGAYTpIn7QgMYQximMEx1QBILmMLayhDKEBCALNYq0ujo6OgggqaOtSGgQQTJfaFRK8OWrooCQoT7oOoaHdDMcw0NaGVAFwOqZsC0IwDdzawNgaEhgyD8qAixuA8AJunOwLVkDckAAAAASUVORK5CYII=',
			'23D0' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZ0lEQVR4nGNYhQEaGAYTpIn7WANYQ1hDGVqRxUSmiLSyNjpMdUASC2hlaHRtCAgIQNbdytDK2hDoIILsvmmrwpauisyahuy+ABR1YMjoADIPVYy1AdMOkQZMt4SGYrp5oMKPihCL+wBuI8xrW/0yfwAAAABJRU5ErkJggg==',
			'9792' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAeUlEQVR4nM2QsQ2AMAwEP0V6irCPU9AbiTRswBZOkQ1IdiBTElE5ghIk/N0V/yej3k7wp3ziZ3kMFJBJMbcjek/MinFCnGQm17NkhcUpv5JrOba1rsrPTmAsHPUGkqGrQbGhtRnhHZ2LE9Nceue2GExYfvC/F/PgdwIxdMvsDYeouAAAAABJRU5ErkJggg==',
			'E70F' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAZklEQVR4nGNYhQEaGAYTpIn7QkNEQx2mMIaGIIkFNDA0OoQyOjCgiTk6OqKLtbI2BMLEwE4KjVo1bemqyNAsJPcB1QUgqYOKMTpgirE2MGLYIdLAgOaW0BCg2BRUsYEKPypCLO4DAIWPypkbdKuBAAAAAElFTkSuQmCC',
			'5C12' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAc0lEQVR4nM2QwQ2AIAxF2wMbMFDZoCbUg9PAgQ0qQzClaEys0aMm8Ln0pWlfCu3xEoyUX/wkooDCSoZxcpkiMN+YTyEiecMm7pVC8sZvrrW1/hfrV46+bHecrFgX7ox0n3jFa3dRYMsco6AEiQPc78O8+G32ScywkmewPgAAAABJRU5ErkJggg==',
			'CDDF' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAV0lEQVR4nGNYhQEaGAYTpIn7WENEQ1hDGUNDkMREWkVaWRsdHZDVBTSKNLo2BKKKNaCIgZ0UtWraytRVkaFZSO5DU4dbDIsd2NwCdTOK2ECFHxUhFvcBAAZVy/OYLX54AAAAAElFTkSuQmCC',
			'FBBC' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAVUlEQVR4nGNYhQEaGAYTpIn7QkNFQ1hDGaYGIIkFNIi0sjY6BIigijW6NgQ6sGCoc3RAdl9o1NSwpaErs5Ddh6YOxTxsYph2oLsF080DFX5UhFjcBwDp082lMqZwpQAAAABJRU5ErkJggg==',
			'ED04' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAXElEQVR4nGNYhQEaGAYTpIn7QkNEQximMDQEIIkFNIi0MoQyNKKJNTo6OrSii7k2BEwJQHJfaNS0lamroqKikNwHURfogKk3MDQE0w5sbkERw+bmgQo/KkIs7gMAv1zP39DeQ5oAAAAASUVORK5CYII=',
			'6647' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7WAMYQxgaHUNDkMREprC2MrQ6NIggiQW0iDQyTEUTA/ECHYA0wn2RUdPCVmZmrcxCcl/IFNFW1kaHVmR7A1pFGl1DA6agizk0OgQwoLul0dEBi5tRxAYq/KgIsbgPAGMlzQBHh0r3AAAAAElFTkSuQmCC',
			'34A8' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAb0lEQVR4nGNYhQEaGAYTpIn7RAMYWhmmMEx1QBILAPIZQhkCApBVtjKEMjo6Ooggi01hdGVtCICpAztpZdTSpUtXRU3NQnbfFJFWJHVQ80RDXUMDUc1rZQCqQxUDugVDL8jNQDEUNw9U+FERYnEfADQOzHdcNMzPAAAAAElFTkSuQmCC',
			'7D82' => 'iVBORw0KGgoAAAANSUhEUgAAAEkAAAAhAgMAAADoum54AAAACVBMVEX///8AAADS0tIrj1xmAAAAbElEQVR4nGNYhQEaGAYTpIn7QkNFQxhCGaY6IIu2irQyOjoEBKCKNbo2BDqIIItNEWl0dHRoEEF2X9S0lVmhQArJfYwOYHWNyHawNoDMC2hFdosIRGwKslhAA8QtqGIgNzOGhgyC8KMixOI+ANtdzM1PMk/aAAAAAElFTkSuQmCC'        
        );
        $this->text = array_rand( $images );
        return $images[ $this->text ] ;    
    }
    
    function out_processing_gif(){
        $image = dirname(__FILE__) . '/processing.gif';
        $base64_image = "R0lGODlhFAAUALMIAPh2AP+TMsZiALlcAKNOAOp4ANVqAP+PFv///wAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQFCgAIACwAAAAAFAAUAAAEUxDJSau9iBDMtebTMEjehgTBJYqkiaLWOlZvGs8WDO6UIPCHw8TnAwWDEuKPcxQml0Ynj2cwYACAS7VqwWItWyuiUJB4s2AxmWxGg9bl6YQtl0cAACH5BAUKAAgALAEAAQASABIAAAROEMkpx6A4W5upENUmEQT2feFIltMJYivbvhnZ3Z1h4FMQIDodz+cL7nDEn5CH8DGZhcLtcMBEoxkqlXKVIgAAibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkphaA4W5upMdUmDQP2feFIltMJYivbvhnZ3V1R4BNBIDodz+cL7nDEn5CH8DGZAMAtEMBEoxkqlXKVIg4HibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpjaE4W5tpKdUmCQL2feFIltMJYivbvhnZ3R0A4NMwIDodz+cL7nDEn5CH8DGZh8ONQMBEoxkqlXKVIgIBibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpS6E4W5spANUmGQb2feFIltMJYivbvhnZ3d1x4JMgIDodz+cL7nDEn5CH8DGZgcBtMMBEoxkqlXKVIggEibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpAaA4W5vpOdUmFQX2feFIltMJYivbvhnZ3V0Q4JNhIDodz+cL7nDEn5CH8DGZBMJNIMBEoxkqlXKVIgYDibbK9YLBYvLtHH5K0J0IACH5BAUKAAgALAEAAQASABIAAAROEMkpz6E4W5tpCNUmAQD2feFIltMJYivbvhnZ3R1B4FNRIDodz+cL7nDEn5CH8DGZg8HNYMBEoxkqlXKVIgQCibbK9YLBYvLtHH5K0J0IACH5BAkKAAgALAEAAQASABIAAAROEMkpQ6A4W5spIdUmHQf2feFIltMJYivbvhnZ3d0w4BMAIDodz+cL7nDEn5CH8DGZAsGtUMBEoxkqlXKVIgwGibbK9YLBYvLtHH5K0J0IADs=";
        $binary = is_file($image) ? join("",file($image)) : base64_decode($base64_image); 
        header("Cache-Control: post-check=0, pre-check=0, max-age=0, no-store, no-cache, must-revalidate");
        header("Pragma: no-cache");
        header("Content-type: image/gif");
        echo $binary;
    }

}
# end of class phpfmgImage
# ------------------------------------------------------
# end of module : captcha


# module user
# ------------------------------------------------------
function phpfmg_user_isLogin(){
    return ( isset($_SESSION['authenticated']) && true === $_SESSION['authenticated'] );
}


function phpfmg_user_logout(){
    session_destroy();
    header("Location: admin.php");
}

function phpfmg_user_login()
{
    if( phpfmg_user_isLogin() ){
        return true ;
    };
    
    $sErr = "" ;
    if( 'Y' == $_POST['formmail_submit'] ){
        if(
            defined( 'PHPFMG_USER' ) && strtolower(PHPFMG_USER) == strtolower($_POST['Username']) &&
            defined( 'PHPFMG_PW' )   && strtolower(PHPFMG_PW) == strtolower($_POST['Password']) 
        ){
             $_SESSION['authenticated'] = true ;
             return true ;
             
        }else{
            $sErr = 'Login failed. Please try again.';
        }
    };
    
    // show login form 
    phpfmg_admin_header();
?>
<form name="frmFormMail" action="" method='post' enctype='multipart/form-data'>
<input type='hidden' name='formmail_submit' value='Y'>
<br><br><br>

<center>
<div style="width:380px;height:260px;">
<fieldset style="padding:18px;" >
<table cellspacing='3' cellpadding='3' border='0' >
	<tr>
		<td class="form_field" valign='top' align='right'>Email :</td>
		<td class="form_text">
            <input type="text" name="Username"  value="<?php echo $_POST['Username']; ?>" class='text_box' >
		</td>
	</tr>

	<tr>
		<td class="form_field" valign='top' align='right'>Password :</td>
		<td class="form_text">
            <input type="password" name="Password"  value="" class='text_box'>
		</td>
	</tr>

	<tr><td colspan=3 align='center'>
        <input type='submit' value='Login'><br><br>
        <?php if( $sErr ) echo "<span style='color:red;font-weight:bold;'>{$sErr}</span><br><br>\n"; ?>
        <a href="admin.php?mod=mail&func=request_password">I forgot my password</a>   
    </td></tr>
</table>
</fieldset>
</div>
<script type="text/javascript">
    document.frmFormMail.Username.focus();
</script>
</form>
<?php
    phpfmg_admin_footer();
}


function phpfmg_mail_request_password(){
    $sErr = '';
    if( $_POST['formmail_submit'] == 'Y' ){
        if( strtoupper(trim($_POST['Username'])) == strtoupper(trim(PHPFMG_USER)) ){
            phpfmg_mail_password();
            exit;
        }else{
            $sErr = "Failed to verify your email.";
        };
    };
    
    $n1 = strpos(PHPFMG_USER,'@');
    $n2 = strrpos(PHPFMG_USER,'.');
    $email = substr(PHPFMG_USER,0,1) . str_repeat('*',$n1-1) . 
            '@' . substr(PHPFMG_USER,$n1+1,1) . str_repeat('*',$n2-$n1-2) . 
            '.' . substr(PHPFMG_USER,$n2+1,1) . str_repeat('*',strlen(PHPFMG_USER)-$n2-2) ;


    phpfmg_admin_header("Request Password of Email Form Admin Panel");
?>
<form name="frmRequestPassword" action="admin.php?mod=mail&func=request_password" method='post' enctype='multipart/form-data'>
<input type='hidden' name='formmail_submit' value='Y'>
<br><br><br>

<center>
<div style="width:580px;height:260px;text-align:left;">
<fieldset style="padding:18px;" >
<legend>Request Password</legend>
Enter Email Address <b><?php echo strtoupper($email) ;?></b>:<br />
<input type="text" name="Username"  value="<?php echo $_POST['Username']; ?>" style="width:380px;">
<input type='submit' value='Verify'><br>
The password will be sent to this email address. 
<?php if( $sErr ) echo "<br /><br /><span style='color:red;font-weight:bold;'>{$sErr}</span><br><br>\n"; ?>
</fieldset>
</div>
<script type="text/javascript">
    document.frmRequestPassword.Username.focus();
</script>
</form>
<?php
    phpfmg_admin_footer();    
}


function phpfmg_mail_password(){
    phpfmg_admin_header();
    if( defined( 'PHPFMG_USER' ) && defined( 'PHPFMG_PW' ) ){
        $body = "Here is the password for your form admin panel:\n\nUsername: " . PHPFMG_USER . "\nPassword: " . PHPFMG_PW . "\n\n" ;
        if( 'html' == PHPFMG_MAIL_TYPE )
            $body = nl2br($body);
        mailAttachments( PHPFMG_USER, "Password for Your Form Admin Panel", $body, PHPFMG_USER, 'You', "You <" . PHPFMG_USER . ">" );
        echo "<center>Your password has been sent.<br><br><a href='admin.php'>Click here to login again</a></center>";
    };   
    phpfmg_admin_footer();
}


function phpfmg_writable_check(){
 
    if( is_writable( dirname(PHPFMG_SAVE_FILE) ) && is_writable( dirname(PHPFMG_EMAILS_LOGFILE) )  ){
        return ;
    };
?>
<style type="text/css">
    .fmg_warning{
        background-color: #F4F6E5;
        border: 1px dashed #ff0000;
        padding: 16px;
        color : black;
        margin: 10px;
        line-height: 180%;
        width:80%;
    }
    
    .fmg_warning_title{
        font-weight: bold;
    }

</style>
<br><br>
<div class="fmg_warning">
    <div class="fmg_warning_title">Your form data or email traffic log is NOT saving.</div>
    The form data (<?php echo PHPFMG_SAVE_FILE ?>) and email traffic log (<?php echo PHPFMG_EMAILS_LOGFILE?>) will be created automatically when the form is submitted. 
    However, the script doesn't have writable permission to create those files. In order to save your valuable information, please set the directory to writable.
     If you don't know how to do it, please ask for help from your web Administrator or Technical Support of your hosting company.   
</div>
<br><br>
<?php
}


function phpfmg_log_view(){
    $n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
    $files = array(
        1 => PHPFMG_EMAILS_LOGFILE,
        2 => PHPFMG_SAVE_FILE,
    );
    
    phpfmg_admin_header();
   
    $file = $files[$n];
    if( is_file($file) ){
        if( 1== $n ){
            echo "<pre>\n";
            echo join("",file($file) );
            echo "</pre>\n";
        }else{
            $man = new phpfmgDataManager();
            $man->displayRecords();
        };
     

    }else{
        echo "<b>No form data found.</b>";
    };
    phpfmg_admin_footer();
}


function phpfmg_log_download(){
    $n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
    $files = array(
        1 => PHPFMG_EMAILS_LOGFILE,
        2 => PHPFMG_SAVE_FILE,
    );

    $file = $files[$n];
    if( is_file($file) ){
        phpfmg_util_download( $file, PHPFMG_SAVE_FILE == $file ? 'form-data.csv' : 'email-traffics.txt', true, 1 ); // skip the first line
    }else{
        phpfmg_admin_header();
        echo "<b>No email traffic log found.</b>";
        phpfmg_admin_footer();
    };

}


function phpfmg_log_delete(){
    $n = isset($_REQUEST['file'])  ? $_REQUEST['file']  : '';
    $files = array(
        1 => PHPFMG_EMAILS_LOGFILE,
        2 => PHPFMG_SAVE_FILE,
    );
    phpfmg_admin_header();

    $file = $files[$n];
    if( is_file($file) ){
        echo unlink($file) ? "It has been deleted!" : "Failed to delete!" ;
    };
    phpfmg_admin_footer();
}


function phpfmg_util_download($file, $filename='', $toCSV = false, $skipN = 0 ){
    if (!is_file($file)) return false ;

    set_time_limit(0);


    $buffer = "";
    $i = 0 ;
    $fp = @fopen($file, 'rb');
    while( !feof($fp)) { 
        $i ++ ;
        $line = fgets($fp);
        if($i > $skipN){ // skip lines
            if( $toCSV ){ 
              $line = str_replace( chr(0x09), ',', $line );
              $buffer .= phpfmg_data2record( $line, false );
            }else{
                $buffer .= $line;
            };
        }; 
    }; 
    fclose ($fp);
  

    
    /*
        If the Content-Length is NOT THE SAME SIZE as the real conent output, Windows+IIS might be hung!!
    */
    $len = strlen($buffer);
    $filename = basename( '' == $filename ? $file : $filename );
    $file_extension = strtolower(substr(strrchr($filename,"."),1));

    switch( $file_extension ) {
        case "pdf": $ctype="application/pdf"; break;
        case "exe": $ctype="application/octet-stream"; break;
        case "zip": $ctype="application/zip"; break;
        case "doc": $ctype="application/msword"; break;
        case "xls": $ctype="application/vnd.ms-excel"; break;
        case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
        case "gif": $ctype="image/gif"; break;
        case "png": $ctype="image/png"; break;
        case "jpeg":
        case "jpg": $ctype="image/jpg"; break;
        case "mp3": $ctype="audio/mpeg"; break;
        case "wav": $ctype="audio/x-wav"; break;
        case "mpeg":
        case "mpg":
        case "mpe": $ctype="video/mpeg"; break;
        case "mov": $ctype="video/quicktime"; break;
        case "avi": $ctype="video/x-msvideo"; break;
        //The following are for extensions that shouldn't be downloaded (sensitive stuff, like php files)
        case "php":
        case "htm":
        case "html": 
                $ctype="text/plain"; break;
        default: 
            $ctype="application/x-download";
    }
                                            

    //Begin writing headers
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: public"); 
    header("Content-Description: File Transfer");
    //Use the switch-generated Content-Type
    header("Content-Type: $ctype");
    //Force the download
    header("Content-Disposition: attachment; filename=".$filename.";" );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".$len);
    
    while (@ob_end_clean()); // no output buffering !
    flush();
    echo $buffer ;
    
    return true;
 
    
}
?>