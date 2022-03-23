<?php

    $hostname = "localhost";
    $bancodedados = "crud_clientes";
    $usuario = "mamp";
    $senha = "";

    $mysqli = new mysqli($hostname,$usuario,$senha,$bancodedados);

    if ( $mysqli->connect_errno) {
        echo "Falha ao conectar: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }

    function formatar_data($data){
        return implode('/',array_reverse(explode('-',$data)));
    }

    function formatar_telefone($telefone){
        $add = substr($telefone,0,2);
        $parte1 = substr($telefone,2,5);
        $parte2 = substr($telefone,7);
        return "($add) $parte1-$parte2";
    }

?>