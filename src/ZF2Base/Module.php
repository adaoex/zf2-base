<?php
/*
 * ZF2Base Module (https://github.com/adaoex/zf2-base)
 * 
 * @author      Adão Gonçalves <adao@adao.eti.br>
 * @link        https://github.com/adaoex/zf2-base for the canonical source repository
 * @copyright   Copyright(c) 2015 (http://adao.eti.br)
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace ZF2Base;

use Zend\Mvc\MvcEvent;
use Doctrine\DBAL\Types\Type;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;


class Module {

    public function onBootstrap(MvcEvent $e) {
        // Registro do novo tipo criado para utilização no Doctrine
        Type::addType('varbinary', 'ZF2Base\Types\VarBinary');
    }

    public function getConfig() {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/../../src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        
        return array(
          'factories' => array(
              'ZF2Base\Mail\Transport' => function($sm) {
                $config = $sm->get('Config');
                $transport = new SmtpTransport;
                $options = new SmtpOptions($config['mail']);
                $transport->setOptions($options);
                
                return $transport;
              }
          )  
        );
        
    }
}
