<?php
/**
 * // caminho do arquivo: \busca.php
 */
/**
 * Includes necessárias
 */
include ('verifica_sessao.php');
include ('includes/header.php');
include ('includes/menu.php');
include('classes/ConnectionFactory.php');

/**
 * Instancia a classe de conexão com o banco de dados
 */
$conn = new Conexao();

/**
 * Se retornar uma string, significa que deu erro ao acessar o banco
 * caso contrário, retorna uma conexão válida
 */
if (gettype($conn->getConnection()) == 'string') {
    echo $conn->getConnection();
} else {
    $conexao = $conn->getConnection();
}

/**
 * Recupera os dados informados no formulário
 */
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);

/**
 * Monta a estrutura da string SQL com as variáveis recuperadas
 * Usando INNER JOIN, pois existem duas tabelas
 */
$query = "SELECT contato.id, contato.nome, contato.email, contato.telefone "
        . "FROM contato "
        . "INNER JOIN usuario "
        . "ON contato.id_usuario = usuario.id "
        . "WHERE "
        . "contato.nome LIKE '%$nome%' AND contato.id_usuario = "
        . $_SESSION['usuario']['id'] . " "
        . "ORDER BY contato.nome ASC";

/**
 * Prepara a string SQL
 */
$stmt = $conexao->prepare($query);

/**
 * Executa a consulta
 */
$stmt->execute();

/**
 * Verifica se houve algum retorno do banco de dados
 * Caso seja verdade, cria uma sessão de identificação
 * Caso contrário, destroi todas as sessões e envia para a página de login
 */
if ((int) $stmt->fetchColumn() === 0) {
    $mensagem = '<p style="text-align: center; padding-top: 200px;">';
    $mensagem.= 'O termo [<strong>' . $nome . '</strong>] ';
    $mensagem.= 'não foi localizado!</p>';

    echo($mensagem);
} else {

    /**
     * Se passou no teste anterior, então executa a consulta novamente e
     * armazena o resultado na variável contatos
     */
    $stmt->execute();
    $contatos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    /**
     * Percorre o array retornado pelo banco de dados e atribui os 
     * valores desejados em uma sessão que será recuperada posteriormente
     */
    ?>

    <table>
        <h3>Contato(s) localizado(s)</h3>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
            </tr>
        </thead>
        <tbody>
            <?php
            /**
             * Percorre os registros retornados do banco de dados e
             * apresenta no navegador
             */
            foreach ($contatos as $contato) {
                ?>
                <tr>
                    <td><?php echo($contato['id']); ?></td>
                    <td><?php echo($contato['nome']); ?></td>
                    <td><?php echo($contato['email']); ?></td>
                    <td><?php echo($contato['telefone']); ?></td>
                    <td>Editar</td> <!-- a ser implementado -->
                    <td>Excluir</td> <!-- a ser implementado -->
                </tr>
            <?php }
            ?>
        </tbody>
    </table>
    <?php
}
include 'includes/footer.php';
