<?php
/*
 * ZF2Base Module (https://github.com/adaoex/zf2-base)
 * 
 * @author      Adão Gonçalves <adao@adao.eti.br>
 * @link        https://github.com/adaoex/zf2-base for the canonical source repository
 * @copyright   Copyright(c) 2015 (http://adao.eti.br)
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace ZF2Base\Types;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * Class of custom varBinary data type to SQL Server 2008
 * @since  1.0
 * @author Thálisson de Oliveira <thalisson.lopes@mutua.com.br>
 * @copyright Copyright (c) 2013 Mútua de Assistência dos Profissionais do CREA
 */
class VarBinary extends Type{

    const VARBINARY = 'varbinary'; // modify to match your type name

    public function getSqlDeclaration(array $fieldDeclaration, AbstractPlatform $platform){
        // return the SQL used to create your column type. To create a portable column type, use the $platform.
    	return $platform->getDoctrineTypeMapping('VARBINARY');
    }

    /**
     * Method return DataBase data
     * @param Binary $value
     * @param AbstractPlatform $platform
     * @return Binary from Database
     */
    public function convertToPHPValue($value, AbstractPlatform $platform){
        // This is executed when the value is read from the database. Make your conversions here, optionally using the $platform.

    	if($value === null)
    		$params = null;
    	else
    		$params = $value;

    	return $params;
    }

    /**
     * Method send DataBase data
     * @param Binary $value
     * @param AbstractPlatform $platform
     * @return Database return communication
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform){
        // This is executed when the value is written to the database. Make your conversions here, optionally using the $platform.

    	if($value === null){
    		$params = null;
    	}else{
    		$fileStream = fopen($value, "r");
    		$params = array(
                            $fileStream,
                            SQLSRV_PARAM_IN,
                            SQLSRV_PHPTYPE_STREAM(SQLSRV_ENC_BINARY),
                            SQLSRV_SQLTYPE_VARBINARY('max')
    		);
    	}

    	return $params;
    }

    public function getName(){
        return self::VARBINARY; // modify to match your constant name
    }
}