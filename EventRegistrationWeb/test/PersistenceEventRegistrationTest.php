<?php
require_once 'PHPUnit/Autoload.php';
require_once 'persistence/PersistenceEventRegistration.php';
require_once 'model/RegistrationManager.php';
require_once 'model/Participant.php';
class PersistenceEventRegistrationTest extends PHPUnit_Framework_TestCase
{
	protected $pm;
	protected function setUp(){
		$this->pm = new PersistenceEventRegistration();
	}
	
	protected function tearDown()
	{	
	}
	
	public function testPersistence(){
		$rm = RegistrationManager::getInstance();
		$participant = new Participant("Frank");
		$rm->addParticipant($participant);
		
		$this->pm->writeDataToStore($rm);
		$rm->delete();
		
		$this->assertEquals(0,count($rm->getParticipants()));
		$rm = $this->pm->loadDataFromStore();
		
		$this->assertEquals(1,count($rm->getParticipants()));
		$myParticipant = $rm->getParticipant_index(0);
		$this->assertEquals("Frank", $myParticipant->getName());
		
	}
}