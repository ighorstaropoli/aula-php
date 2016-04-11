<?php

include('Conexao.php');

$conn = new Conexao();
$conexao = $conn->getConnection();

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

$query = "INSERT INTO usuario "
        . "(nome, usuario, senha) "
        . "VALUES "
        . "("
        . "'$nome', "
        . "'$usuario', "
        . "'$senha'"
        . ") ";

$stmt = $conexao->prepare($query);
$stmt->execute();

header('Location: index.php');
