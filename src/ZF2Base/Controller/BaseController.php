<?php
/*
 * ZF2Base Module (https://github.com/adaoex/zf2-base)
 * 
 * @author      Adão Gonçalves <adao@adao.eti.br>
 * @link        https://github.com/adaoex/zf2-base for the canonical source repository
 * @copyright   Copyright(c) 2015 (http://adao.eti.br)
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace ZF2Base\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Session\Container;
use Zend\Paginator\Paginator,
    Zend\Paginator\Adapter\ArrayAdapter;

abstract class BaseController extends AbstractActionController {

    /**
     * @var $session Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @var $session Zend\Session\Container
     */
    protected $session;

    /**
     * @var ZF2Base\Service\AbstractService instancia de AbstractService
     */
    protected $service;
    
    protected $entity;
    
    protected $form;
    
    protected $route;
    
    protected $controller;
    
    /**
     * @return Doctrine\ORM\EntityManager
     */
    protected function getEm() {
        if (null === $this->em){
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->em;
    }

    /**
     * @return Zend\Session\Container
     */
    protected function getSession() {
        if ($this->session === null){
            $this->session = new Container('zf2-base');
        }
        return $this->session;
    }


    /**
     * Seta variáveis para o layout
     */
    public function onDispatch(\Zend\Mvc\MvcEvent $e) {
        /**
         * Chamada do parent no inicio do método para primeiro setar
         * os valores das variáveis antes de renderizar a tela
         */
        parent::onDispatch($e);

    }

    public function indexAction() {
        
        $list = $this->getEm()
                ->getRepository($this->entity)
                ->findAll();
        
        $page = $this->params()->fromRoute('page');
        
        $paginator = new Paginator(new ArrayAdapter($list));
        $paginator->setCurrentPageNumber($page)
                ->setDefaultItemCountPerPage(10);
        
        return new ViewModel(array('data'=>$paginator,'page'=>$page));
        
    }

    public function novoAction()
    {
        $form = new $this->form();
        $request = $this->getRequest();
        
        if($request->isPost())
        {
            $form->setData($request->getPost());
            if($form->isValid())
            {
                $service = $this->getServiceLocator()->get($this->service);
                $service->insert($request->getPost()->toArray());
                
                return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));
            }
        }
        
        return new ViewModel(array('form'=>$form));
    }
    
    public function editarAction()
    {
        $form = new $this->form();
        $request = $this->getRequest();
        
        $repository = $this->getEm()->getRepository($this->entity);
        $entity = $repository->find($this->params()->fromRoute('id',0));
        
        if($this->params()->fromRoute('id',0)){
            $form->setData($entity->toArray());
        }
        if($request->isPost())
        {
            $form->setData($request->getPost());
            if($form->isValid())
            {
                $service = $this->getServiceLocator()->get($this->service);
                $service->update($request->getPost()->toArray());
                
                return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));
            }
        }
        
        return new ViewModel(array('form'=>$form));
    }
    
    public function removerAction()
    {
        $service = $this->getServiceLocator()->get($this->service);
        if($service->delete($this->params()->fromRoute('id',0))){
                return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));
        }
    }
    
}
