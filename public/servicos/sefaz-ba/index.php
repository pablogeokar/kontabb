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

echo curl_grab_page('https://www.sefaz.ba.gov.br/servicos/AmpliadaBA/Result.asp','','off');
 * 
 */

include './HttpClient.class.php';

$client = new HttpClient('https://www.sefaz.ba.gov.br/');
$client->cookie_host = 'https://www.sefaz.ba.gov.br/';
$client->persist_cookies = true;

?>
 
