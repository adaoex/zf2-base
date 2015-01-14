# ZF2Base
Módulo 'Base' para projeto que utilize Zend Framework 2 
em complemento ao [Zend Skeleton Application](https://github.com/zendframework/ZendSkeletonApplication)

## Requisitos (Requirements)
 * [Zend Framework 2](https://github.com/zendframework/zf2)
 * [DoctrineORM](https://github.com/doctrine/DoctrineORMModule)

## Instalação (Instalation)
	
## Módulo

### Form\Validator
	Classes que extendem 'Zend\Validator\AbstractValidator'
	```sh
	ZF2Base\Form\Validator\Cnpj
	ZF2Base\Form\Validator\Cpf
	ZF2Base\Form\Validator\CpfCnpj
	```

### View\Helpers
	```sh
	ZF2Base\View\Helper\String
	```
		Uso
		Nas views (arquivos .phtml)
		
		Retorna String no formato UTF-8, independente do formado de entrada
		```php 
		$this->string( [$string] ); 
		```
		
		retorna string no formato UTF-8, uma substring (acrescido de ... ), caso o $tamanho for maior que o tamanho da string original
		```php
		$this->string()->truncar( $string, $tamanho );
		```
	
### ZF2Base\View\Helper\Numero
	
	Retorna número por extenso
	```php
	$this->numero( [$numero] );
	```
	OU
	```php
	$this->numero()->porExtenso( $numero );
	```
	
### ZF2Base\View\Helper\Moeda
	Retorna número no formato brasileiro (locale: pt_BR, currency: BRL)
	```php
	$this->moeda( $numero ); 
	```
	OU 
	```php
	$this->moeda()->formataBr( $numero );
	
	$this->moeda()=>porExtenso( $numero );
	```
	
### ZF2Base\View\Helper\Formatar
	
	Retorna string formatada
	```php
		$this->formata()->cep( $string );
		$this->formata()->cnpj( $string );
		$this->formata()->cpf( $string );
		$this->formata()->telefone( $string );
	```
	
### ZF2Base\View\Helper\Data
	Tratamentos para Datas
	```php
		$this->data()->porExtenso( $data );
		$this->data()->dataHora( $data );
	```
	
### Mail

	Configurações em ..\config\autoload\global.php
	```php
		return array(
			'mail' => array(
				'name' => 'smtp.googlemail.com',
				'host' => 'smtp.googlemail.com',
				'connection_class' => 'login',
				'connection_config' => array(
					'username' => 'email@gmail.com',
					'password' => '123',
					'ssl' => 'tls',
					'port' => 465,
					'from' => 'email@gmail.com'
				)
			)
		);
	```
	
	Utilização em Controllers
	```php
		$transport = $this->getServiceLocator()->get("ZF2Base\Mail\Transport");
		$view = $service = $this->getServiceLocator()->get("View");
		$mail = new Mail($transport, $view, 'page-template');
		$mail->setSubject( ... )
				->setTo( ... )
				->setData( ... )
				->prepare()
				->send();
	```
	
### ZF2Base\Controller

	
	- BaseController 
		* Get Zend\Session; 
		* Get EntityManager; 
		* CRUD Controller;
		* Zend\Paginator;
