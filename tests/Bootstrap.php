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

ini_set('error_reporting', E_ALL);

if (file_exists(getcwd() . '/../vendor/autoload.php')) {
    $loader = include getcwd() . '/../vendor/autoload.php';
} elseif (file_exists(getcwd() . '/../../../autoload.php')) {
    $loader = include getcwd() . '/../../../autoload.php';
} else {
    throw new RuntimeException('vendor/autoload.php could not be found. Did you run `php composer.phar install`?');
}

/* var $loader \Composer\Autoload\ClassLoader */
$loader->add('ZF2BaseTest\\', __DIR__);
