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

use Zend\View\Helper\AbstractHelper;

/**
 * Tratamentos para String
 *
 * @author adao.goncalves
 */
class String extends AbstractHelper {

    /**
     * @return String no formato UTF-8, independente do formado de entrada
     */
    public function __invoke( $string = null) {
        if ( ! $string ){
            return $this->toUTF8($string);
        }else{
            return $this;
        }
    }

     /**
     * @param string $string
     * @return String no formato UTF-8, independente do formado de entrada
     */
    function toUTF8($string) {
        $current_encoding_auto = mb_detect_encoding($string, 'auto');
        $current_encoding = mb_detect_encoding($string, array('Windows-1252', 'ASCII'));
        if ( in_array($current_encoding, array('ISO-8859-15', 'ISO-8859-1', 'Windows-1252'))){
            $sRetorno = mb_convert_encoding($string, 'UTF-8', 'Windows-1252');
        }elseif( in_array($current_encoding, array('ASCII')) ){
            $sRetorno = @iconv($current_encoding_auto, 'UTF-8', $string);
            if (strlen($sRetorno) === 0 ){
                $sRetorno = mb_convert_encoding($string, 'UTF-8', 'ISO-8859-1' );
            }
        }else{
            $sRetorno = mb_convert_encoding($string, 'UTF-8', 'ISO-8859-1' );
        }
        return $sRetorno;
    }
    
    /**
     * @param string $string
     * @param int $tamanho quantidades de caracteres no retorno
     * @return String no formato UTF-8, uma substring (acrescido de ... )
     * ,caso o $tamanho for maior que o tamanho da string original
     */
    public function truncar( $string, $tamanho ) {
        $tamanho_original = strlen($string);
        if ( $tamanho < $tamanho_original ){
            return substr($string, 0,$tamanho) . '...';
        }else{
            return $string;
        }
    }
    
}