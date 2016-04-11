<?php

// caminho do arquivo: \funcoes\Utils.php

/**
 * Biblioteca de funções de uso geral
 */

/**
 * Função que gera uma lista com estados
 *
 * @param string $get_post
 * @param string $tipo [abv|null]
 * @return retorna uma lista com os estados
 */
function getEstados($get_post, $tipo = 'abv') {
    $selecao = array('UF' => 'Estado');

    /**
     * Verifica se a lista devese ser abreviada ou por extenso
     */
    if ($tipo = 'abv') {
        $opcoes['UF'] = array(
            'AC' => 'AC', 'AL' => 'AL', 'AP' => 'AP',
            'AM' => 'AM', 'BA' => 'BA', 'CE' => 'CE', 'DF' => 'DF',
            'ES' => 'ES', 'GO' => 'GO', 'MA' => 'MA', 'MT' => 'MT',
            'MS' => 'MS', 'MG' => 'MG', 'PA' => 'PA', 'PB' => 'PB',
            'PR' => 'PR', 'PE' => 'PE', 'PI' => 'PI', 'RJ' => 'RJ',
            'RN' => 'RN', 'RS' => 'RS', 'RO' => 'RO', 'RR' => 'RR',
            'SC' => 'SC', 'SP' => 'SP', 'SE' => 'SE', 'TO' => 'TO'
        );
    } else {
        $opcoes['UF'] = array(
            'AC' => 'Acre', 'AL' => 'Alagoas', 'AP' => 'Amapá',
            'AM' => 'Amazonas', 'BA' => 'Bahia', 'CE' => 'Ceará',
            'DF' => 'Distrito Federal', 'ES' => 'Espírito Santo',
            'GO' => 'Goiás', 'MA' => 'Maranhão', 'MT' => 'Mato Grosso',
            'MS' => 'Mato Grosso do Sul', 'MG' => 'Minas Gerais',
            'PA' => 'Pará', 'PB' => 'Paraíba', 'PR' => 'Paraná',
            'PE' => 'Pernambuco', 'PI' => 'Piauí', 'RJ' => 'Rio de Janeiro',
            'RN' => 'Rio Grande do Norte', 'RS' => 'Rio Grande do Sul',
            'RO' => 'Rondônia', 'RR' => 'Roraima', 'SC' => 'Santa Catarina',
            'SP' => 'São Paulo', 'SE' => 'Sergipe',
            'TO' => 'Tocantins'
        );
    }
    if (strlen($get_post) == 0) {
        $get_post = 'SP';
    }
    return SelectBox($opcoes, $get_post, $selecao);
}

/**
 * Função que monta uma lista de valores com a opção de selecionado (SelectBox)
 * @param type $option
 * @param type $selected
 * @param type $optgroup
 * @return string
 */
function SelectBox($option, $selected = '', $optgroup = NULL) {
    $returnStatement = '';

    if ($selected == '') {
        $returnStatement .=
                '<option value="" selected="selected"></option>' . "\n";
    }

    if (isset($optgroup)) {
        foreach ($optgroup as $optgroupKey => $optgroupValue) {
            $returnStatement .= '<optgroup label="' .
                    $optgroupValue . '">' . "\n";

            foreach ($option[$optgroupKey] as $optionKey => $optionValue) {
                if ($optionKey == $selected) {
                    $returnStatement .= '<option selected="selected" value="' .
                            $optionKey . '">' . $optionValue . '</option>' . "\n";
                } else {
                    $returnStatement .= '<option value="' . $optionKey . '">' .
                            $optionValue . '</option>' . "\n";
                }
            }
            $returnStatement .= '</optgroup>' . "\n";
        }
    } else {
        foreach ($option as $key => $value) {
            if ($key == $selected) {
                $returnStatement .= '<option selected="selected" value="' .
                        $key . '">' . $value . '</option>' . "\n";
            } else {
                $returnStatement .= '<option value="' . $key . '">' . $value .
                        '</option>' . "\n";
            }
        }
    }
    return $returnStatement;
}

/**
 * Função que retorna uma lista de 1 a 31
 *
 * @param int $get_post
 * @param int $ano_inicial
 * @return int lista de anos
 */
function getDias($get_post) {
    $selecao = array('DIAS' => "Dia");
    for ($i = 1; $i < 32; $i++) {
        $tmpArray[$i] = $i;
    }
    $opcoes['DIAS'] = $tmpArray;
    return SelectBox($opcoes, $get_post, $selecao);
}

/**
 * Função que retorna a lista de meses
 *
 * @param int $get_post
 * @param int $mes_inicial
 * @return int lista de anos
 */
function getMes($get_post, $mes_inicial = NULL) {
    $selecao = array('MES' => 'Mês');
    $opcoes['MES'] = array(
        'Janeiro' => 'Janeiro',
        'Fevereiro' => 'Fevereiro',
        'Março' => 'Março',
        'Abril' => 'Abril',
        'Maio' => 'Maio',
        'Junho' => 'Junho',
        'Julho' => 'Julho',
        'Agosto' => 'Agosto',
        'Setembro' => 'Setembro',
        'Outubro' => 'Outubro',
        'Novembro' => 'Novembro',
        'Dezembro' => 'Dezembro',
    );

    if (strlen($get_post) == 0) {
        $get_post = 'Janeiro';
    }
    return SelectBox($opcoes, $get_post, $selecao);
}

/**
 * Função que retorna uma lista de anos entre 1970 e o atual
 *
 * @param int $get_post
 * @param int $ano_inicial
 * @return int lista de anos
 */
function getAnos($get_post, $ano_inicial = 1970) {
    $selecao = array('YEAR' => "Ano");
    for ($i = date("Y"); $i >= $ano_inicial; $i--) {
        $tmpArray[$i] = $i;
    }
    $opcoes['YEAR'] = $tmpArray;
    return SelectBox($opcoes, $get_post, $selecao);
}

/**
 * Função que escreve uma data fornecida em extenso em portugues
 * 
 * @param date $data [dd/mm/aaaa]
 * @return string data extenso
 */
function getDataExtenso($data) {
    $dia = intval(substr($data, 0, 2)); // pega o valor do dia da tabela 
    $mes = intval(substr($data, 3, 2)); // pega o valor do mês da tabela 
    $ano = substr($data, 6, 4); // pega o valor do ano da tabela

    if ($dia < 10) {
        $dia = intval(substr($dia, 0, 1));
    } else {
        $dia = intval(substr($dia, 0, 2));
    }
    $meses = array(
        1 => 'Janeiro',
        'Fevereiro',
        'Março',
        'Abril',
        'Maio',
        'Junho',
        'Julho',
        'Agosto',
        'Setembro',
        'Outubro',
        'Novembro',
        'Dezembro'
    );
    $dataextenso = $dia . " de " . $meses[$mes] . " de " . $ano;
    return $dataextenso;
}

/**
 * 
 * @param date $data 00/00/00
 * @param int $tipo 1-toMysql 2-mySqlTo
 * @return date data formatada toMysql(0000-00-00) mysqlTo (00/00/00)
 */
function mysqlData($data, $tipo) {
    if ($tipo == 1) {
        $dia = substr($data, 0, 2);
        $mes = substr($data, 3, 2);
        $ano = substr($data, 6, 4);
        return $ano . '-' . $mes . "-" . $dia;
    } else {
        $dia = substr($data, 8, 2); // 1970-12-10
        $mes = substr($data, 5, 2);
        $ano = substr($data, 0, 4);
        return $dia . '/' . $mes . "/" . $ano;
    }
}
