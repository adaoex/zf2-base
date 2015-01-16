<?php
/*
 * ZF2Base Module (https://github.com/adaoex/zf2-base)
 * 
 * @author      Adão Gonçalves <adao@adao.eti.br>
 * @link        https://github.com/adaoex/zf2-base for the canonical source repository
 * @copyright   Copyright(c) 2015 (http://adao.eti.br)
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 */

return array(
    'modules' => array(
        'ZF2Base',
    ),
    'module_listener_options' => array(
        'config_glob_paths' => array(
            __DIR__ .'/../../config/testing.config.php',
        ),
        'module_paths' => array(),
    ),
);