<?php
class LayoutPlugin extends Zend_Controller_Plugin_Abstract {
 
	public function preDispatch(Zend_Controller_Request_Abstract $request){
		if($request->getModuleName()!=null){
		    $modulname = $request->getModuleName();
		    $layoutpath = false;
		    $layout = Zend_Layout::getMvcInstance();
			if(file_exists(APPLICATION_PATH . '/modules/'.$modulname.'/layouts'))
			{
			    $layoutpath = APPLICATION_PATH . '/modules/'.$modulname.'/layouts/scripts';
			    $layoutfile =  'layout';
			    if($layout->getMvcEnabled()){
			        $layout->setLayoutPath($layoutpath);
			        if($layout !== null){
			            $layout->setLayout($layoutfile);
			        }
			    }
			}
			if(file_exists(APPLICATION_PATH . '/modules/'.$modulname.'/layouts/nav/navigation.xml')){
                            $configNav = new Zend_Config_Xml(
                                    APPLICATION_PATH. '/modules/'
                                    .$request->getModuleName()
                                    .'/layouts/nav/navigation.xml', 'nav');
                            $navigation = new Zend_Navigation($configNav);
                            $view = $layout->getView();
                            $view->nav = $navigation;
			}
			set_include_path(implode(PATH_SEPARATOR, array(
			        realpath(APPLICATION_PATH . '/../application/modules/'.$modulname.'/models/'),
			        realpath(APPLICATION_PATH . '/../application/modules/'.$modulname.'/forms/'),
			        get_include_path(),
			)));
                        
		}
		else{
			$layout = Zend_Layout::getMvcInstance();
			$modulname = $request->getModuleName();
			if($request->getModuleName()==null) $modulname = 'default';
			if ($modulname == '') $modulname = 'default';
 			$configNav = new Zend_Config_Xml(
                                APPLICATION_PATH
                                . '/modules/'
                                .$modulname
                                .'/layouts/nav/navigation.xml', 'nav');
			$navigation = new Zend_Navigation($configNav);
			$view = $layout->getView();
			$view->nav = $navigation;
			set_include_path(implode(PATH_SEPARATOR, array(
    			realpath(APPLICATION_PATH . '/../application/modules/'.$modulname.'/models/'),
    			realpath(APPLICATION_PATH . '/../application/modules/'.$modulname.'/forms/'),
    			get_include_path(),
			)));
		}
	}
}