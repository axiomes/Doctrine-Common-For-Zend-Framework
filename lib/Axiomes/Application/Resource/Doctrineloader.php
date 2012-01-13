<?php
/**
 * (Very Simple) resource plugin simplifying
 * the use of Doctrine's ClassLoader
 *
 * @author feychenie
 */
namespace Axiomes\Application\Resource;

class Doctrineloader extends \Zend_Application_Resource_ResourceAbstract
{

	/**
	 * path\to\Doctrine\Common\ClassLoader.php
	 * @var string
	 */
	protected $classLoaderPath;

	/**
	 * @var array
	 */
	protected $namespaces = array();

    public function setClassLoaderPath($path){
		$this->classLoaderPath = $path;
	}

	public function setNamespaces($definitions){
		$this->namespaces = array_merge($this->namespaces, $definitions);
	}

    public function init()
    {
		if($this->classLoaderPath){
			require_once $this->classLoaderPath;
		}

		if(count($this->namespaces)){
			foreach($this->namespaces as $namespace => $path){
				$this->addLoader($namespace, $path);
			}
		}
		return $this;
	}

	public function addLoader($namespace, $path){
		$loader = new \Doctrine\Common\ClassLoader( $namespace, $path);
		\Zend_Loader_Autoloader::getInstance()->pushAutoloader(array($loader, 'loadClass'), $namespace);
		return $loader;
	}
}
