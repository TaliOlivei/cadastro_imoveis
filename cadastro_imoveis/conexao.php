<?php // Aqui é aonde começa 

//variaveis no php começam com $
//as variaveis do PHP: 
$host = "localhost"; //nome do servidor
$usuario = "root"; //nome do usuario do banco de dados
$senha = ""; // a senha para entra no banco de dados
$banco = "cadastro_imoveis"; // o nome do bando de dados 

//Criando a conexão 
// A classe pode interagi com o dados de dados (conectar e descontar)
$conexao = new mysqli($host, $usuario, $senha, $banco); 

//verificando se a conexão irá dá correto: 
    //Ei, PHP, pega a propriedade connect_error que está dentro do objeto $conexao.
    if($conexao->connect_error){
        die("Erro na conexão: ". $conexao->connect_error);
    }
    // Se for bem sucedido irá mostra isso na tela. 
    echo "Conectando com sucesso!"; 
?>