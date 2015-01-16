<?php
/*
 * ZF2Base Module (https://github.com/adaoex/zf2-base)
 * 
 * @author      Adão Gonçalves <adao@adao.eti.br>
 * @link        https://github.com/adaoex/zf2-base for the canonical source repository
 * @copyright   Copyright(c) 2015 (http://adao.eti.br)
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace ZF2Base\Mail;

use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Message;

use Zend\View\Model\ViewModel;

use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;

/**
 * Mail
 * Classe utilizada para enviar e-mail em qualquer parter da aplicação
 */
class Mail 
{
    protected $transport;
    protected $view;
    protected $body;
    protected $message;
    protected $subject;
    protected $to;
    protected $bcc;
    protected $cc;
    protected $data;
    protected $page;
    
    public function __construct(SmtpTransport $transport, $view, $page) 
    {
        $this->transport = $transport;
        $this->view = $view;
        $this->page = $page;
        $this->bcc = array();
        $this->cc = array();
    }
    
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }
    
    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }
    
    public function setBcc($bcc)
    {
        $this->bcc = $bcc;
        return $this;
    }
    
    public function setCc($cc)
    {
        $this->cc = $cc;
        return $this;
    }
    
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
    
    public function renderView($page, array $data)
    {
        $model = new ViewModel;
        $model->setTemplate("mailer/{$page}.phtml");
        $model->setOption('has_parent',true);
        $model->setVariables($data);
        
        return $this->view->render($model);
    }
    
    public function prepare()
    {
        $html = new MimePart($this->renderView($this->page, $this->data));
        $html->type = \Zend\Mime\Mime::TYPE_HTML;
        $html->encoding = \Zend\Mime\Mime::ENCODING_8BIT;
        $html->charset = "utf-8";
        
        $body = new MimeMessage();
        $body->setParts(array($html));
        $this->body = $body;
        
        $config = $this->transport->getOptions()->toArray();
        
        $this->message = new Message;
        $this->message->addFrom($config['connection_config']['from'])
                ->addTo($this->to)
                ->addBcc($this->bcc)
                ->addCc($this->cc)
                ->setSubject($this->subject)
                ->setBody($this->body);
        
        return $this;
    }
    
    public function send()
    {
        $this->transport->send($this->message);
    }
    
}
