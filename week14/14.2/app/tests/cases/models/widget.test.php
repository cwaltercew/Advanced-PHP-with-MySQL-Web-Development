<?php
/* Widget Test cases generated on: 2010-11-23 15:11:51 : 1290547851*/
App::import('Model', 'Widget');

class WidgetTestCase extends CakeTestCase {
	var $fixtures = array('app.widget');

	function startTest() {
		$this->Widget =& ClassRegistry::init('Widget');
	}

	function endTest() {
		unset($this->Widget);
		ClassRegistry::flush();
	}

}
?>