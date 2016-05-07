<?php


$site = "http://www8.receita.fazenda.gov.br/SimplesNacional/controleAcesso/Autentica.aspx?id=5";

$cnpj = null;
$cpf_responsavel = null;
$codigo_acesso = null;

if ( isset($_GET['cnpj']) && isset($_GET['cpf']) && isset($_GET['codigo']))
{
    $cnpj =             $_GET['cnpj'];
    $cpf_responsavel =  $_GET['cpf'];
    $codigo_acesso =    $_GET['codigo'];
}


//Carrego a página com o formulário da Receita e salvo na variável $conteudo
$ch = curl_init();
$timeout = 0;
curl_setopt($ch, CURLOPT_URL, $site);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$conteudo = curl_exec($ch);
curl_close($ch);

$conteudoTratado = str_replace("Autentica.aspx?id=5", "http://www8.receita.fazenda.gov.br/SimplesNacional/controleAcesso/Autentica.aspx?id=5", $conteudo);
$conteudoTratado = str_replace("../", "http://www8.receita.fazenda.gov.br/SimplesNacional/", $conteudoTratado);
$conteudoTratado = str_replace("img src=\"/", "img src=\"http://www8.receita.fazenda.gov.br/", $conteudoTratado);
$conteudoTratado = str_replace("\"ContentPlaceHolder_txtCNPJ\"", "\"ContentPlaceHolder_txtCNPJ\" value=\"$cnpj\"", $conteudoTratado);
$conteudoTratado = str_replace("\"ContentPlaceHolder_txtCPFResponsavel\"", "\"ContentPlaceHolder_txtCPFResponsavel\" value=\"$cpf_responsavel\"", $conteudoTratado);
$conteudoTratado = str_replace("<input name=\"ctl00\$ContentPlaceHolder\$txtCodigoAcesso\" type=\"password\"", "<input name=\"ctl00\$ContentPlaceHolder\$txtCodigoAcesso\" type=\"text\"", $conteudoTratado);
$conteudoTratado = str_replace("\"ContentPlaceHolder_txtCodigoAcesso\"", "\"ContentPlaceHolder_txtCodigoAcesso\" value=\"$codigo_acesso\"", $conteudoTratado);



echo $conteudoTratado;

?>
