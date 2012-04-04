#Zend Lyout Plugin.
Load module based layout if it exist 

Load your Plugin:   
<pre>
/************************************************************************
 * LayoutPlugin 
 **/  
  $frontController = Zend_Controller_Front::getInstance();
  Zend_Layout::startMvc(array(
      'layoutPath' => APPLICATION_PATH.'/modules/default/layouts/scripts',
      'layout' => 'layout'
 ));
 $layoutModulePlugin = new LayoutPlugin();
 $frontController->registerPlugin($layoutModulePlugin);
</pre>

In your bootsrap: 
<pre>
	protected function _initModules(){
			$front = Zend_Controller_Front::getInstance();
			$handle = opendir(APPLICATION_PATH . '/modules/');
			while (false !== ($file = readdir($handle))) {
			    if ($file != "." && $file != "..") {
			        if(is_dir($file))
			            $front->addControllerDirectory(APPLICATION_PATH . '/modules/'.$file.'/controllers','admin');
			    }
			}
		}
</pre>

in your module there must be a folder named   
/modules/'.$modulname.'/layouts/scripts  
in this folder there must be a phtml file named layout

if in your /modules/'.$modulname.'/layouts/ folder also exist a folder named nav with an xml file inside named navigation, it will loaded as navigation container.  
structure of these file must be as followd:  
<pre>
`<?xml version="1.0" encoding="UTF-8"?>`
	`<configdata>`
		`<nav>`
			`<home>`
				`<label>Home</label>`
				`<module>default</module>`
				`<controller>index</controller>`
				`<action>index</action>`
				`<route>default</route>`
			`</home>`
		`</nav>`
	`</configdata>`
</pre>

to use it call it inside your layout.phtm  with

echo $this->navigation($this->nav)
