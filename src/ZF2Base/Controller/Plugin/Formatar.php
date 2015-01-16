<?php
/*
 * ZF2Base Module (https://github.com/adaoex/zf2-base)
 * 
 * @author      Adão Gonçalves <adao@adao.eti.br>
 * @link        https://github.com/adaoex/zf2-base for the canonical source repository
 * @copyright   Copyright(c) 2015 (http://adao.eti.br)
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace ZF2Base\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class Formatar extends AbstractPlugin {

    /**
     * Formatação de número de CEP para o formato 99999-999
     *
     * @param  string $cep 
     * @return string no formato 99999-999
     * @throws Exception
     */
    function cep($cep) {
        /* limpar tudo que não for digito */
        $cep = preg_replace('/[^0-9]/', '', trim($cep));
        if (strlen($cep) != 8) {
            return $cep;
        }
        /* formatar cnpj */
        return substr($cep, 0, 5) . '-' . substr($cep, 5, 3);
    }
    
    /**
     * Formatação de número de CPF para o formato '999.999.999-99'
     *
     * @param  string $cpf 
     * @return string no formato '999.999.999-99'
     * @throws Exception
     */
    function cpf($cpf) {
        /* limpar tudo que não for digito */
        $cpf = preg_replace('/[^0-9]/', '', trim($cpf));
        if (strlen($cpf) != 11) {
            /* quantidade de numeros inválidos para cpf */
            return $cpf;
        }
        /* formatado */
        return substr($cpf, 0, 3)
                . '.' . substr($cpf, 3, 3)
                . '.' . substr($cpf, 6, 3) 
                . '-' . substr($cpf, 9, 3);
    }

    /**
     * Formatação de número de CNPJ para o formato '99.999.999/9999-99'
     *
     * @param  string $cnpj
     * @return string no formato '99.999.999/9999-99'
     * @throws Exception
     */
    public function cnpj($cnpj) {
        /* limpar tudo que não for digito */
        $cnpj = preg_replace('/[^0-9]/', '', trim($cnpj));
        if (strlen($cnpj) != 14) {
            /* quantidade de numeros inválidos para cnpj */
            return $cnpj;
        }
        /* formatar cnpj */
        return substr($cnpj, 0, 2) 
                . '.'. substr($cnpj, 2, 3) 
                . '.'.substr($cnpj, 5, 3) 
                . '/'.substr($cnpj, 8, 4) 
                . '-'.substr($cnpj, 12, 2);
    }
    
    function telefone($numero) {
            /* limpar tudo que não for digito */
        $numero = preg_replace('/[^0-9]/', '', trim($numero));
        
        if (strlen($numero) > 8) {
            $numero_formatado = '('.substr($numero, 0, 2).')';
            $numero_formatado .= substr($numero, 2, 4) . '-';
            $numero_formatado .= substr($numero, 6, 4);
        }
        return $numero_formatado;
    }
}