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

return array(
    'controller_plugins' => array(
        'invokables' => array(
            'Formatar' => 'ZF2Base\Controller\Plugin\Formatar',
            'Data' => 'ZF2Base\Controller\Plugin\Data',
        )
    ),
);