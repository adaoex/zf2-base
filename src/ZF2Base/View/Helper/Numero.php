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

class Numero extends AbstractHelper {

    /**
     * Retorna número por extenso
     * @param int $number 
     * @return string número por extenso
     */
    public function __invoke($number = null) {
        
        if ( ! $number ){
            return $this;
        }
        
        return $this->porExtenso($number);
    }
    
    /**
     * Retorna número por extenso
     * @param int $number 
     * @return string número por extenso
     */
    public function porExtenso($number) {
        if (! is_numeric($number) ){
            return false;
        }
        
        $fmt = new \NumberFormatter( 'br', \NumberFormatter::SPELLOUT );
        
        return $fmt->format($number);
    }
}
 

