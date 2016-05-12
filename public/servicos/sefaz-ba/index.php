<?php
/*
//http://scriptasy.com/php_11/tutorial-curl-login_44.html
error_reporting (E_ALL | E_STRICT);
set_time_limit(0);


function curl_login($url,$data,$proxy,$proxystatus){
	    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    if ($proxystatus == 'on') {
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, TRUE);
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
    }
    curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
    curl_setopt($ch, CURLOPT_URL, $url);
    ob_start();      // prevent any output
    $temp=curl_exec ($ch); // execute the curl command
    ob_end_clean();  // stop preventing output
	preg_match("/<input type=.*?hidden.*?name.*?v.*?value=(.*?)>/i",$temp,$matches);
	
	//echo $matches[1];
	$value=substr($matches[1],1,6);
	$values="v=".$value."&".$data;
	$data=$values;
	echo $data;
	
	
    $fp = fopen("cookie.txt", "w");
    fclose($fp);
	 $ch = curl_init();
    curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
    curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
    curl_setopt($ch, CURLOPT_TIMEOUT, 40);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    if ($proxystatus == 'on') {
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, TRUE);
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
    }
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    ob_start();      // prevent any output
    return curl_exec ($ch); // execute the curl command
    ob_end_clean();  // stop preventing output
    curl_close ($ch);
    unset($ch);    
}                   

function curl_grab_page($site,$proxy,$proxystatus){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    if ($proxystatus == 'on') {
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, TRUE);
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
    }
    curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)");
    curl_setopt($ch, CURLOPT_URL, $site);
    ob_start();      // prevent any output
    return curl_exec ($ch); // execute the curl command
    ob_end_clean();  // stop preventing output
    curl_close ($ch);
} 

//curl_login('https://www.sefaz.ba.gov.br/scripts/login/loginnow.asp/','usr=7501161100&snh=pca3010&tip_usuario=&script_name=%2Fservicos%2FAmpliadaBA%2FResult.asp&x=14&y=11','','off');

echo curl_grab_page('https://sistemasweb.sefaz.ba.gov.br/sistemas/NFENC/SSL/ASLibrary/Login?ReturnUrl=%2fsistemas%2fnfenc%2fModulos%2fAutenticado%2fRestrito%2fNFENC_consulta_destinatario.aspx','','off');
 
*/
?>

<?php

$site = 'https://sistemasweb.sefaz.ba.gov.br/sistemas/NFENC/SSL/ASLibrary/Login?ReturnUrl=%2fsistemas%2fnfenc%2fModulos%2fAutenticado%2fRestrito%2fNFENC_consulta_destinatario.aspx';

$login = null;
$senha = null;

if ( isset($_GET['login']) && isset($_GET['senha']))
{
    $login = $_GET['login'];
    $senha = $_GET['senha'];    
}


/**
 * Get a web file (HTML, XHTML, XML, image, etc.) from a URL.  Return an
 * array containing the HTTP server response header fields and content.
 */
function get_web_page( $url )
{
    $options = array(
        CURLOPT_RETURNTRANSFER => true,     // return web page
        CURLOPT_HEADER         => false,    // don't return headers
        CURLOPT_FOLLOWLOCATION => true,     // follow redirects
        CURLOPT_ENCODING       => "",       // handle all encodings
        CURLOPT_USERAGENT      => "spider", // who am i
        CURLOPT_AUTOREFERER    => true,     // set referer on redirect
        CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
        CURLOPT_TIMEOUT        => 120,      // timeout on response
        CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
        CURLOPT_SSL_VERIFYPEER => false,     // Disabled SSL Cert checks
        CURLOPT_SSLVERSION     => 3 
    );

    $ch      = curl_init( $url );
    curl_setopt_array( $ch, $options );
    $content = curl_exec( $ch );
    $err     = curl_errno( $ch );
    $errmsg  = curl_error( $ch );
    $header  = curl_getinfo( $ch );
    curl_close( $ch );

    $header['errno']   = $err;
    $header['errmsg']  = $errmsg;
    $header['content'] = $content;
    return $content;
}

$conteudo = get_web_page($site);
$conteudoTratado = str_replace("href=\"/", "href=\"https://sistemasweb.sefaz.ba.gov.br/", $conteudo);
$conteudoTratado = str_replace("src=\"/", "src=\"https://sistemasweb.sefaz.ba.gov.br/", $conteudoTratado);
$conteudoTratado = str_replace("<form method=\"post\" action=\"#\"", "<form method=\"post\" action=\"https://sistemasweb.sefaz.ba.gov.br/sistemas/NFENC/SSL/ASLibrary/Login?ReturnUrl=%2fsistemas%2fnfenc%2fModulos%2fAutenticado%2fRestrito%2fNFENC_consulta_destinatario.aspx\"", $conteudoTratado);
$conteudoTratado = str_replace('"ctl00$PHCentro$userLogin"', '"ctl00$PHCentro$userLogin" value="'.$login.'"', $conteudoTratado);
$conteudoTratado = str_replace('"ctl00$PHCentro$userPass"', '"ctl00$PHCentro$userPass" value="'.$senha.'"', $conteudoTratado);


echo $conteudoTratado;


?>
 
