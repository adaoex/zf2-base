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

class Data extends AbstractPlugin {

    /**
     * @param DateTime/string $date - data no formato dd/mm/yyyy
     * @return DateTime - data como string para o banco de dados
     */
    public function toDatabase( $date ){
        if ( is_null( $date ) || $date == '' ){
            return null;
        }
        if ( ! $date instanceof \DateTime ){
            if (! strlen($date) > 9 ){
                return null;
            }
            else{
                $arr = explode('/', $date);
                $strDate = $arr[2].'-'.$arr[1].'-'.$arr[0]; /* format: yyyy-mm-dd */
                $_date = new \DateTime( $strDate );
            }
        }
        return $_date;
    }
    
    /**
     * @param DateTime/string $date 
     * @return String - data como string para a aplicação
     */
    public function toApplication( $date ){
        if ( is_null( $date ) || $date == '' ){
            return null;
        }
        if ( $date instanceof \DateTime ){
            return $date->format('d/m/Y');
        }else{
            $_date = new \DateTime($date);
            return $_date->format('d/m/Y');
        }
    }
    
    /**
     * @param DateTime/string $date 
     * @return String - data como string para a aplicação
     */
    public function toDatetimeApplication( $date ){
        if ( is_null( $date ) || $date == '' ){
            return null;
        }
        
        if ( $date instanceof \DateTime ){
            $date->setTimezone( new \DateTimeZone('America/Sao_Paulo') );
            return $date->format('d/m/Y H:m:s');
        }else{
            $_date = new \DateTime($date);
            $_date->setTimezone( new \DateTimeZone('America/Sao_Paulo') );
            return $_date->format('d/m/Y H:m:s');
        }
    }
    
    /**
     * @return DateTime - data e hora em formato string para o banco de dados
     */
    static public function toDatetimeDatabase( $date ){
        if ( is_null( $date ) || $date == '' ){
            return null;
        }
        if ( ! $date instanceof \DateTime ){
            if (! strlen($date) > 9 ){
                return null;
            }
            else{
                $datePart1 = substr($date, 0, 10);
                $datePart2 = str_replace($datePart1, '', $date);
                $arr = explode('/', $datePart1);
                $strDate = $arr[2].'-'.$arr[1].'-'.$arr[0]; /* format: yyyy-mm-dd H:m:s*/
                $_date = new \DateTime( $strDate );
            }
            
            $arr = explode('/', $date);
            $strDate = $arr[2].'-'.$arr[1].'-'.$arr[0]. ' ' .$datePart2; /* format: yyyy-mm-dd H:m:s */
            $_date = new \DateTime( $strDate );
        }
        return $_date;
    }
    
    /**
     * @param DateTime/string $date 
     * @return String - data como string para a aplicação
     */
    public function porExtenso( $date ){
        if ( is_null( $date ) || $date == '' ){
            return '';
        }
        if ( ! $date instanceof \DateTime ){
            $_date = new \DateTime($date);
        }else{
            $_date = $date;
        }
        $meses = array (1 => "Janeiro", 2 => "Fevereiro", 3 => "Março",
            4 => "Abril", 5 => "Maio", 6 => "Junho", 7 => "Julho", 
            8 => "Agosto", 9 => "Setembro", 10 => "Outubro", 
            11 => "Novembro", 12 => "Dezembro");
        
        return $_date->format('d').' de '. $meses[ $_date->format('n') ] .' de '.$_date->format('Y');
    }
    
}