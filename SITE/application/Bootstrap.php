<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {

    //Função que faz o auload das classes. O nome da classe deve ser definido conforme o diretorio ex: /db/AclGrupo.php a classe será new Db_AclGrupo();
    protected function _initAutoload() {
        //cria alguns autoloads customizados
        $autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => '',
            'basePath' => dirname(__FILE__),
            'resourceTypes' => array(
                'business' => array(
                    'path' => 'business/',
                    'namespace' => 'Business'
                ),
                'db' => array(
                    'path' => 'db/',
                    'namespace' => 'Db'
                ),
                'filter' => array(
                    'path' => 'filter/',
                    'namespace' => 'Filter'
                )
            )
        ));
    }

    protected function _initCss() {
        if (APPLICATION_ENV !== "libra") {
            return;
        }
        require_once APPLICATION_PATH . "/library_php/lessphp/lessc.inc.php";

        if ($handle = opendir(APPLICATION_PATH . "/../public_html/css/less")) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $sLess = APPLICATION_PATH . "/../public_html/css/less/" . $entry;
                    if (pathinfo($sLess, PATHINFO_EXTENSION) == 'less') {
                        $cssFile = str_replace('less', 'css', $entry);
                        $sCss = APPLICATION_PATH . "/../public_html/css/" . $cssFile;
                        $oLessc = new lessc($sLess);
                        file_put_contents($sCss, $oLessc->parse());
                    }
                }
            }
            closedir($handle);
        }
    }

    protected function _initLocale() {
        $registry = Zend_Registry::getInstance();
        $locale = new Zend_Locale('pt_BR');
        $registry->set('Zend_Locale', $locale);
    }

    protected function _initDoctype() {
        $this->bootstrap('view');
        $view = $this->getResource('view');
        //CRIA UM REGISTOR DO VIEW PARA DISPONIBILIZA-LO DE FORMA FACIL EM TODA A APLICAÇÃO
        Zend_Registry::set('view', $view);
    }

    protected function _initPlugins() {

        $bootstrap = $this->getApplication();
        if ($bootstrap instanceof Zend_Application) {
            $bootstrap = $this;
        }
        $bootstrap->bootstrap('FrontController');
        $front = $bootstrap->getResource('FrontController');
        $front->registerPlugin(new Plugin_ScriptPath());
        $front->registerPlugin(new Plugin_Inicializacao());
        $front->registerPlugin(new Plugin_LanguageRouteDetector());
    }

    protected function _initRouter() {
        $this->bootstrap('FrontController');
        $front = $this->getResource('FrontController');
        $front->addModuleDirectory(APPLICATION_PATH . '/modules');
        $router = $front->getRouter();

        $router->addRoute(
                'language', new Zend_Controller_Router_Route(
                ':lang/:controller/:action/*', array(
            'lang' => 'pt',
            'controller' => 'index',
            'action' => 'index',
            'module' => 'site'
                ), array(
            'lang' => '[a-z]{2}',
                )
        ));
        $router->addRoute(
                'language', new Zend_Controller_Router_Route(
                '/busca/*', array(
            'module' => 'site',
            'controller' => 'pagina',
            'action' => 'busca'
                )
        ));

        $router->addRoute('noticia_detalhe', new Zend_Controller_Router_Route(
                'noticia/:permalink', array(
            'module' => 'site', 'controller' => 'pagina', 'action' => 'noticiadetalhe', 'permalink' => ':permalink'
                )
        ));
        $router->addRoute('pagina_detalhe', new Zend_Controller_Router_Route(
                'pagina/institucional/:permalink', array(
            'module' => 'site', 'controller' => 'pagina', 'action' => 'institucional', 'permalink' => ':permalink'
                )
        ));
    }

    protected function _initMail() {

        $config = array(
            'auth' => 'login',
            'username' => 'teste@libradesign.com.br',
            'password' => 'adlibra200165',
            'ssl' => 'ssl',
            'port' => '465'
        );
        $mailTransport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);
        Zend_Mail::setDefaultTransport($mailTransport);
        Zend_Mail::setDefaultFrom('teste@libradesign.com.br', 'Libra');
    }

    protected function _initCache() {
        Zend_Db_Table_Abstract::setDefaultMetadataCache(Business_Cache::getCache(3));
    }

    protected function _initZFDebug() {
        if ($_GET['debug'] == 1) {
            $autoloader = Zend_Loader_Autoloader::getInstance();
            $autoloader->registerNamespace('ZFDebug');
            $options = array(
                'plugins' => array(
                    'Variables',
                    'File' => array('base_path' => APPLICATION_PATH),
                    'Memory',
                    'Time',
                    'Registry',
                    'Exception'
                )
            );
            if ($this->hasPluginResource('db')) {
                $this->bootstrap('db');
                $db = $this->getPluginResource('db')->getDbAdapter();
                $options['plugins']['Database']['adapter'] = $db;
            }
            if ($this->hasPluginResource('cache')) {
                $this->bootstrap('cache');
                $cache = $this - getPluginResource('cache')->getDbAdapter();
                $options['plugins']['Cache']['backend'] = $cache->getBackend();
            }

            $debug = new ZFDebug_Controller_Plugin_Debug($options);

            $this->bootstrap('frontController');
            $frontController = $this->getResource('frontController');
            $frontController->registerPlugin($debug);
        }
    }

}
