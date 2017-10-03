<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Event Registration</title>
		<style>
			.error {color: #FF0000;}
		</style>
	</head>
	<body>
		<?php 
		require_once 'model/Participant.php';
		require_once 'model/Event.php';
		require_once 'model/Registration.php';
		require_once 'model/RegistrationManager.php';
        require_once 'controller/Controller.php';
		
		session_start();

		?>
        
        <form action="register.php" method="post">
			<p>Name? 
            
            <select name="participantspinner">
                <?php 
                $c = new Controller();
                echo $c->load_participant();
                
                ?>
            </select>
			<span class="error">
			<?php 
			if (isset($_SESSION['errorRegisterParticipant']) && !empty($_SESSION['errorRegisterParticipant'])){
				echo " * " . $_SESSION["errorRegisterParticipant"];
			}
			?>
			</span></p>
            
            <p>Event? 
            
            <select name="eventspinner">
            
                <?php 
                $c = new Controller();
                echo $c->load_event();
                
                ?>
            </select>
			<span class="error">
			<?php 
			if (isset($_SESSION['errorRegisterEvent']) && !empty($_SESSION['errorRegisterEvent'])){
				echo " * " . $_SESSION["errorRegisterEvent"];
			}
			?>
			</span></p>
			<p><input type="submit" value="Register"/></p>
		</form>
        <!--/////////////////////////////////////////////////////////////////////////////////////// -->
		<form action="addparticipant.php" method="post">
			<p>Name? <input type="text" name="participant_name" />
			<span class="error">
			<?php 
			if (isset($_SESSION['errorParticipantName']) && !empty($_SESSION['errorParticipantName'])){
				echo " * " . $_SESSION["errorParticipantName"];
			}
			?>
			</span></p>
			<p><input type="submit" value="Add Participant"/></p>
		</form>
        
        
        <!--/////////////////////////////////////////////////////////////////////////////////////// -->
		<form action="addevent.php" method="post">
			<p>Name? <input type="text" name="event_name" />
			<span class="error">
			<?php 
			if (isset($_SESSION['erroreventname']) && !empty($_SESSION['erroreventname'])){
				echo " * " . $_SESSION["erroreventname"];
			}
			?>
			</span></p>
            
            <p>Date? <input type="date" name="event_date" value="<?php echo date('Y-m-d'); ?>" />
			<span class="error">
			<?php 
			if (isset($_SESSION['erroreventdate']) && !empty($_SESSION['erroreventdate'])){
				echo " * " . $_SESSION["erroreventdate"];
			}
			?>
			</span></p>
            
            <p>Start Time? <input type="time" name="starttime" value="<?php echo date('H:i'); ?>" />
			<span class="error">
			<?php 
			if (isset($_SESSION['erroreventstarttime']) && !empty($_SESSION['erroreventstarttime'])){
				echo " * " . $_SESSION["erroreventstarttime"];
			}
			?>
			</span></p>
            
            <p>End Time? <input type="time" name="endtime" value="<?php echo date('H:i'); ?>" />
			<span class="error">
			<?php 
			if (isset($_SESSION['erroreventendtime']) && !empty($_SESSION['erroreventendtime'])){
				echo " * " . $_SESSION["erroreventendtime"];
			}
			?>
			</span></p>
            
            
			<p><input type="submit" value="Add Event"/></p>
		</form>

</body>
</html>