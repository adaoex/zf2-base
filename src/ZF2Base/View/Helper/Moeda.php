<?php
/*
 * ZF2Base Module (https://github.com/adaoex/zf2-base)
 * 
 * @author      Adão Gonçalves <adao@adao.eti.br>
 * @link        https://github.com/adaoex/zf2-base for the canonical source repository
 * @copyright   Copyright(c) 2015 (http://adao.eti.br)
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace ZF2Base\View\Helper;

use \Zend\I18n\View\Helper\CurrencyFormat;

/**
 * Tratamentos para moedas no formato brasileiro
 */
class Moeda extends CurrencyFormat {

    /**
     * Retorna número no formato brasileiro (locale: pt_BR, currency: BRL)
     */
    public function __invoke( $number, $curreny= null,$dec = null, $loc = null, $pattern = null ) {
        if (! $number) {
            return $this;
        }
        return $this->formataBr($number);
    }

     /**
      * Retorna número no formato brasileiro (locale: pt_BR, currency: BRL)
      * 
      * @param number $number 
      * @return string no formato brasileiro (locale: pt_BR, currency: BRL)
      */
    function formataBr($number) {
        return parent::__invoke($number, 'BRL', null, 'pt_BR', null);
    }
    
    /**
      * Retorna número no formato brasileiro (locale: pt_BR, currency: BRL) por extenso
      * 
      * @param number $number 
      * @return string no formato brasileiro (locale: pt_BR, currency: BRL) por extenso
      */
    public function porExtenso($number) {
        if (! is_numeric($number) ){
            return false;
        }
        $numero_extenso = '';
	$arr = explode(".", $number);
	$inteiro = $arr[0];
        if ( isset($arr[1]) ){
            $decimos = (strlen($arr[1])==1?$arr[1].'0':$arr[1]);
        }
        
        $fmt = new \NumberFormatter( 'br', \NumberFormatter::SPELLOUT );
        if ( is_array($arr) ){
            $numero_extenso = $fmt->format( $inteiro ). ' reais';
            if ( isset($decimos) && $decimos > 0 ){
                $numero_extenso .= ' e '.$fmt->format($decimos) . ' centavos';
            }
        }
        return $numero_extenso;
    }   
}