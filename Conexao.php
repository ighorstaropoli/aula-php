<?php

// caminho do arquivo: \classes\ConnectionFactory.php

/**
 * Define o código de página para caracteres especiais
 */
define('DB_CHARSET', 'utf8');

/**
 * Classe de conexão com o banco de dados
 * Esta classe cria uma conexão do tipo ConnectionFactory (fábrica de conexões)
 */
class Conexao {

    // Atributos da classe
    public $con = null; // variável de retorno da conexão
    public $dbType = 'mysql'; // tipo do banco de dados
    public $host = 'localhost';
    public $user = 'root';
    public $password = '';
    public $db = 'agenda';
    public $persistent = false; // conexão não persistente

    // Método construtor da classe

    public function Conexao($persistent = false) {
        // Verifica a persistência da conexao
        if ($persistent != false) {
            $this->persistent = true;
        }
    }

    // Método que retorna uma conexão
    public function getConnection() {
        try {
            // Realiza a conexão com PDO
            $this->con = new PDO(
                    $this->dbType . ":host=" .
                    $this->host . ";dbname=" .
                    $this->db, $this->user, $this->password, array(
                PDO::ATTR_PERSISTENT => $this->persistent,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . DB_CHARSET
                    )
            );

            // conexão realizada com sucesso, retorna conectado
            return $this->con;
        } catch (PDOException $ex) {
            // caso ocorra um erro, retorna o erro
            return $ex->getMessage();
        }
    }

    // Método que desconecta
    public function Close() {
        if ($this->con != null) {
            $this->con = null;
        }
    }

}
