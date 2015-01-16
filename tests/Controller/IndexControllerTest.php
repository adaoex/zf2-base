<?php
/*
 * ZF2Base Module (https://github.com/adaoex/zf2-base)
 * 
 * @author      Adão Gonçalves <adao@adao.eti.br>
 * @link        https://github.com/adaoex/zf2-base for the canonical source repository
 * @copyright   Copyright(c) 2015 (http://adao.eti.br)
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace ZF2BaseTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractControllerTestCase;

class IndexControllerTest extends AbstractControllerTestCase
{
    public function setUp()
    {
        $this->setApplicationConfig(
            include  __DIR__ .'/../TestConfiguration.php'
        );
        parent::setUp();
    }

    /* testes plugins */
    public function testPluginData()
    {
        $this->expectOutputString('data');
        print 'data';
    }
    
    public function testPluginFormatar()
    {
        $this->expectOutputString('formata');
        print 'formata';
    }
    
}