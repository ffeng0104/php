<?php
require_once 'controller/InputValidator.php';
require_once 'test/PersistenceEventRegistrationTest.php';
require_once 'model/RegistrationManager.php';
require_once 'model/Participant.php';
require_once 'model/Event.php';
require_once 'model/Registration.php';

class Controller
{
	public function __construct(){
		
	}
	
	public function createParticipant($participant_name){
		$name = InputValidator::validate_input($participant_name);
		if($name == null || strlen($name) == 0){
			throw new Exception("Participant name cannot be empty!");
		}else{
			$pm = new PersistenceEventRegistration();
			$rm = $pm->loadDataFromStore();
			
			$participant = new Participant($name);
			$rm->addParticipant($participant);
			
			$pm->writeDataToStore($rm);
		}
	}
	
	public function createEvent($event_name, $event_date, $starttime, $endtime){
		$ok=0;
        $error="";
        $name = InputValidator::validate_input($event_name);
        $date = InputValidator::validate_input($event_date);
        $start = InputValidator::validate_input($starttime);
        $end = InputValidator::validate_input($endtime);
		if($name == null || strlen($name) == 0){
				$error .= "@1Event name cannot be empty! ";
			$ok=1;	
			}
        $edate=date('Y-m-d', strtotime($event_date));
		$stime=date('H:i', strtotime($starttime));
        $etime=date('H:i', strtotime($endtime));
        $diftance=$endtime-$starttime;
        if($date ==null || strlen($date)==0){
        	$error.="@2Event date must be specified correctly (YYYY-MM-DD)! ";
        	$ok =1;
        }
        if($start ==null || strlen($start)==0){
        	$error.="@3Event start time must be specified correctly (HH:MM)! ";
        	$ok =1;
        }
        if($end ==null || strlen($end)==0){
        	$error.="@4Event end time must be specified correctly (HH:MM)!";
        	$ok =1;
        }
        if($diftance<0){
			$error .= "@4Event end time cannot be before event start time!";
			$ok=1;
		}
        
        if($ok==1){
		      throw new Exception(trim($error));
          }
          
        if($ok==0)
        {
          echo $ok;
  
          $pm = new PersistenceEventRegistration();
			$rm = $pm->loadDataFromStore();
			
			$event = new Event($name,$edate,$stime,$etime);
			$rm->addEvent($event);
			
			$pm->writeDataToStore($rm);  
            
            
            
        }
        
        
	}
	
    public function load_participant()
    {
       $pm = new PersistenceEventRegistration();
		$rm = $pm->loadDataFromStore();
		
		$myparticipant = "";
		foreach ($rm->getParticipants() as $participant){
			
				$myparticipant.= "<option>".$participant->getName()."</option>" ;
				
		} 
        return $myparticipant;
        
    }
    
    public function load_event()
    {
       $pm = new PersistenceEventRegistration();
		$rm = $pm->loadDataFromStore();
		$myevent = "";
		foreach ($rm->getEvents() as $event){
			
            $myevent.="<option>".$event->getName()."</option>";
		}
        return $myevent;
  }
    
    
	public function register($aParticipant, $aEvent){
		$pm = new PersistenceEventRegistration();
		$rm = $pm->loadDataFromStore();
		
		$myparticipant = NULL;
		foreach ($rm->getParticipants() as $participant){
			if(strcmp($participant->getName(), $aParticipant) == 0){
				$myparticipant = $participant;
				break;
			}
		}
		$myevent = NULL;
		foreach ($rm->getEvents() as $event){
			if (strcmp($event->getName(), $aEvent) == 0){
				$myevent = $event;
				break;
			}
		}
		
		$error = "";
		if($myparticipant != NULL && $myevent != NULL) {
			$myregistration = new Registration($myparticipant, $myevent);
			$rm->addRegistration($myregistration);
			$pm->writeDataToStore($rm);
		} else{
			if($myparticipant == NULL){
				$error .= "@1Participant ";
				if ($aParticipant != NULL){
					$error .= $aParticipant;
				}
				$error .= " not found! ";
			}
			
		if ($myevent == NULL){
			$error .= "@2Event ";
			if ($aEvent != NULL){
				$error .= $aEvent;
			}
			$error .= " not found!";
		}
		throw new Exception(trim($error));
	}
}
}
?>