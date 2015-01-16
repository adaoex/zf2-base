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

class Formatar extends AbstractHelper {

    /**
     * Formatar plugin
     *
     * @var ZF2Base\Controller\Plugin\Formatar
     */
    protected $pluginFormatar;
    
    /**
     * Returns the formatar plugin controller
     *
     * @return Helper\Formatar
     */
    public function __invoke($valor = null) {
        $this->getPluginFormatar();
        if ($valor == null){
            return $this;
        }
        return $valor;
        
    }
    
    /**
     * Returna CEP formatado via plugin controller
     *
     * @param  string|null $cep
     * @return string|Plugin\Formatar
     */
    public function cep($cep) {
        return $this->pluginFormatar->cep($cep);
    }
    
    /**
     * Returna CPF formatado via plugin controller
     *
     * @param  string|null $cpf
     * @return string|Plugin\Formatar
     */
    public function cpf($cpf) {
        return $this->pluginFormatar->cpf($cpf);
    }
    
    /**
     * Returna CNPJ formatado via plugin controller
     *
     * @param  string|null $cnpj
     * @return string|Plugin\Formatar
     */
    public function cnpj($cnpj) {
        return $this->pluginFormatar->cnpj($cnpj);
    }
    
    /**
     * Returna número de telefone formatado via plugin controller
     *
     * @param  string|null $telefone
     * @return string|Plugin\Formatar
     */
    function telefone($numero) {
        return $this->pluginFormatar->telefone($numero);
    }
    
    /**
     * Get plugin Formatar
     * 
     * @return ZF2Base\Controller\Plugin\Formatar
     */
    protected function getPluginFormatar() {
        if (null === $this->pluginFormatar) {
            $this->setPluginFormatar(new \ZF2Base\Controller\Plugin\Formatar());
        }
        return $this->pluginFormatar;
    }

    /**
     * Set plugin Formatar
     * 
     * @return AbstractHelper
     */
    protected function setPluginFormatar(\ZF2Base\Controller\Plugin\Formatar $pluginFormatar) {
        $this->pluginFormatar = $pluginFormatar;
        return $this;
    }

}