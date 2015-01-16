<?php
/*
 * ZF2Base Module (https://github.com/adaoex/zf2-base)
 * 
 * @author      Adão Gonçalves <adao@adao.eti.br>
 * @link        https://github.com/adaoex/zf2-base for the canonical source repository
 * @copyright   Copyright(c) 2015 (http://adao.eti.br)
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace ZF2Base\Service;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;

abstract class AbstractService 
{

    /**
     *
     * @var EntityManager
     */
    protected $em;
    
    protected $entity;
    
    public function __construct(EntityManager $em) 
    {
        $this->em = $em;
    }
    
    public function insert(array $data)
    {
        $entity = new $this->entity($data);
        $this->em->persist($entity);
        $this->em->flush();
        $this->em->refresh($entity);
        return $entity;
    }
    
    public function update(array $data)
    {
        $entity = $this->em->getReference($this->entity, $data['id']);
        (new Hydrator\ClassMethods())->hydrate($data, $entity);
        
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }
    
    public function delete($id)
    {
        $entity = $this->em->getReference($this->entity, $id);
        if($entity)
        {
            $this->em->remove($entity);
            $this->em->flush();
            return $id;
        }
    }
    
}
