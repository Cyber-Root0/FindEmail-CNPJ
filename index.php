<html>
    <head>
        <meta charset="UTF-8">
        <title>Buscar Emails Por Cnpj</title>
    
    </head>
    <body>
        <div class="body">
            <div class="form">
                <center>
                    <h1>Buscador de Emails Por Cnpj</h1>
                    <form action="" method="POST">
                        <textarea name="cnpj" placeholder="Digite aqui os Cnpjs" style="height: 300px;width: 500px;"></textarea><br>
                        <input type="submit" value="Buscar">
                    </form>
                </center>
            </div>
        </div>
        <?php

function consulta($str){
   // $url="http://brasilapi.simplescontrole.com.br/cnpj/consulta-cnpj/?cnpj=$str&access-token=FWuajX_lozDCQGMkIJ5r43mhE5cMpa5O&_format=json";
    //$ch = curl_init($url);
    //curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
    //$res = curl_exec($ch);
    //curl_close($ch);
    //$json=json_decode($res);

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch,CURLOPT_URL,"http://brasilapi.simplescontrole.com.br/cnpj/consulta-cnpj/?cnpj=$str&access-token=FWuajX_lozDCQGMkIJ5r43mhE5cMpa5O&_format=json");
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13");
$data = curl_exec($ch);
curl_close($ch);

    
    $json=json_decode($data);
    if (isset($json->return->dados->email)){
    $email=$json->return->dados->email;
    }
    if (!empty($email)){
        return $email;
    }
}


if (!empty($_POST['cnpj'])){
$lines= trim($_POST['cnpj']);
$lines=explode("\n",$lines);
    foreach ($lines as $cnpj){
        $i=trim($cnpj);
        $res=consulta($i);
        if (!empty($res)){
        echo $res."<br>";
        }

    }

}



?>
    </body>
</html>