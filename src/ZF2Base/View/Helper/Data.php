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

use Zend\I18n\View\Helper\DateFormat;

class Data extends DateFormat {

    /**
     * @var string|Datetime
     */
    protected $data;
    
    /**
     * Set string|Datetime
     *
     * @return Helper\Data no formato 'pt_BR'
     */
    public function __invoke( $date, $dateType = 2, $timeType = -1, $locale = NULL, $pattern = NULL ) {
        
        if ( ! $date ){
            $this->setData(new \DateTime());
        }else{
            $this->setData($date);
            return parent::__invoke($this->data, \IntlDateFormatter::MEDIUM, \IntlDateFormatter::NONE, 'pt_BR', null);
        }
        
        return $this;
        
    }
    
    /**
     * Retorna Date formatado 
     *
     * @param  string|null $date
     * @return string|Plugin\Formatar
     */
    public function porExtenso($date) {
        $this->setData($date);
        $meses = array (
            1 => "Janeiro", 2 => "Fevereiro", 3 => "Março", 4 => "Abril", 
            5 => "Maio", 6 => "Junho", 7 => "Julho", 8 => "Agosto", 
            9 => "Setembro", 10 => "Outubro", 11 => "Novembro", 12 => "Dezembro"
        );
        
        if ( ! $this->data instanceof \DateTime ){
            return 'data inválida!';
        }
        
        return $this->data->format('d').' de '. $meses[ $this->data->format('n') ] .' de '.$this->data->format('Y');
    }
    
    /**
     * Retorna data e hora
     *
     * @param  string|null $date
     * @return string|Plugin\Formatar
     */
    public function dataHora($date) {
        $this->setData($date);
        if ( ! $this->data instanceof \DateTime ){
            return 'data inválida!';
        }
        return parent::__invoke($this->data, \IntlDateFormatter::MEDIUM, \IntlDateFormatter::MEDIUM, 'pt_BR', null);
    }
    
    /**
     * Set data
     * 
     * @return Data|AbstractHelper
     */
    protected function setData( $date ) {
        if ( ! $date instanceof \DateTime ){
            $this->data = new \DateTime($date);
        }else{
            $this->data = $date;
        }
        return $this;
    }

}