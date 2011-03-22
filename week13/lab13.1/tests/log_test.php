<?php
require_once(dirname(__FILE__) . '/simpletest/autorun.php');
require_once('../classes/log.php');

class TestOfLogging extends UnitTestCase {
    function __construct() {
        parent::__construct('Log test');
    }

    function testFirstLogMessagesCreatesFileIfNonexistent() {
        @unlink(dirname(__FILE__) . '/../temp/test.log');
        $log = new Log(dirname(__FILE__) . '/../temp/test.log');
        $this->assertFalse(file_exists(dirname(__FILE__) . '/../temp/test.log'));
        $log->message('Should write this to a file');
        $this->assertTrue(file_exists(dirname(__FILE__) . '/../temp/test.log'));
        @unlink('../temp/test.log');
    }
    function testAppendingToFile() {
        @unlink('../temp/test.log');
        $log = new Log('../temp/test.log');
        $log->message('Test line 1');
        $messages = file('../temp/test.log');
        $this->assertWantedPattern('/Test line 1/', $messages[0]);
        $log->message('Test line 2');
        $messages = file('../temp/test.log');
        $this->assertWantedPattern('/Test line 2/', $messages[1]);
        @unlink('../temp/test.log');
    }



}



?>
