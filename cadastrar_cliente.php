<?php
    function limpar_texto($str){
        return preg_replace("/[^0-9]/","",$str);
    }
    
    if(count($_POST) > 0){
        include('conexao.php');
        $erro = false;
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $nascimento = $_POST['nascimento'];

        if (empty($nome) ) {
            $erro = "Preencha o nome";
        }

        if (empty($email) || !filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $erro = "Preencha o e-mail";
        }

        if (!empty($nascimento)) {
            $pedacos = explode("/",$nascimento);
            if (count($pedacos) == 3) {
                $nascimento = implode('-',array_reverse($pedacos));
            }else{
                $erro = "A data de nascimento deve seguir o padrao dia/mes/ano.";
            }
        }

        if (!empty($telefone)) {
            $telefone = limpar_texto($telefone);
            if (strlen($telefone) != 11) {
                $erro = "O telefone deve ser preechido no padrao (11) 99999-9999";
            }
        }

        if ($erro) {
            echo "<p><b>Erro: $erro</b></p>";
        }else{
            $sqlcode = "INSERT INTO clientes (nome,email,telefone,nascimento,data) 
            VALUES ('$nome','$email','$telefone','$nascimento',NOW())";
            $deu_certo = $mysqli->query($sqlcode) or die($mysqli->error);

            if($deu_certo){
                echo "<p><b>Cliente cadastrado com sucesso</b></p>";
                unset($_POST);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Cadastrar cliente </title>
</head>
<body>
    <a href="clientes.php">Voltar para a lista</a>
    <form action="" method="POST">

        <p>
            <label>Nome: </label>
            <input value ="<?php if (isset($_POST['nome'])) echo $_POST['nome']; ?> " name="nome" type="text"><br>
        </p>
        
        <p>
            <label>E-mail: </label>
            <input value ="<?php if (isset($_POST['email'])) echo $_POST['email']; ?> "name="email" type="text"><br>
        </p>
    
        <p>
            <label>Telefone:</label>
            <input value ="<?php if (isset($_POST['telefone'])) echo $_POST['telefone']; ?> "placeholder="(11) 99999-9999" name="telefone" type="text"><br>
        </p>
    
        <p>
            <label>Data de nascimento: </label>
            <input value ="<?php if (isset($_POST['nascimento'])) echo $_POST['nascimento']; ?> " name="nascimento" type="text"><br>
        </p>
    
        <p>
            <button type="submit">Salvar cliente</button>
        </p>


    </form>

</body>
</html>