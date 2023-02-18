<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

function dbAccess($params) {

	try {

		// Establish connection with the localhost
		$pdo = new PDO("mysql:host=localhost;dbname=github_projects", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

		// Establish connection with the localhost
		// $pdo = new PDO("mysql:host=localhost;dbname=dlnr", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

		// Prepare various SQL statements through a loop
		foreach ($params['dba'] as $key => $value) { $stmt = $pdo->prepare($params['dba'][$key]); }

		// Execute bindParam after SQL statement
		$stmt->execute($params['bindParam']);

		return $stmt;
		
	} catch (PDOException $e) {

		echo "Connection failed: " . $e->getMessage();
  
	}

	return $params;

}

function dataView($params) {

	// Read/pull data from pavreservations table
	$params['dba']['s'] = "SELECT * FROM pavreservations";

	$stmt          = dbAccess($params);
	$results       = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $results;

}

function reservationError($params) {

	$params = generateAuthKey($params);

	// Read/pull data from pavreservations to handle reservation error
	$params['dba']['s'] = "SELECT * FROM pavreservations WHERE confirmID = :confirmID";
	$params['bindParam'] = array(
		':confirmID' => $_GET[$params['authKey']]
	);
	
	$stmt = dbAccess($params);

	// Count number of rows to check amount of times the confirmation ID appears (must only show once)
	$params['rowCount'] = $stmt->rowCount();

	return $params;

}

function fieldGuides($params) {

	// Read/pull data from fieldGuides JSON
	$params['json'] 		= file_get_contents('field-guides.json');
	$params['decodedJSON'] 	= json_decode($params['json'], true);

	return $params;

}
 
function getAccomplishments($params, $accType) {

	// Read/pull accomplishments data from accomplishments tables
	$params['dba']['s']     = "SELECT * FROM accomplishments WHERE accType = :accType ORDER BY accYear DESC";
	$params['bindParam']    = array(
		':accType'  => $accType
	);

	$stmt       = dbAccess($params);
	$results    = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $results;

}

function getLocations($params) {

	// Read/pull locations data from locations table 
	$params['dba']['s'] = "SELECT * FROM facilitylocations";

	$stmt          = dbAccess($params);
	$results       = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $results;

}

function getLocationCodes($params, $locCode) {

	$params['dba']['s'] = "SELECT * FROM facilitylocations WHERE locCode = :locCode";
	$params['bindParam'] = array(':locCode' => $locCode);
	
	$stmt = dbAccess($params);
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $results;

}

function getPavDetails($params, $locName, $resStart, $resEnd) {

	$params['dba']['s'] = "SELECT * FROM pavreservations WHERE pavName = :pavName AND :resStart BETWEEN resStart AND resEnd AND :resEnd BETWEEN resStart AND resEnd OR pavName = :pavName AND resStart = :resEnd OR pavName = :pavName AND :resEnd BETWEEN resStart AND resEnd OR pavName = :pavName AND :resStart BETWEEN resStart AND resEnd AND resEnd <= :resEnd OR pavName = :pavName AND :resStart <= resEnd AND :resEnd >= resStart";
	$params['bindParam'] = array(
		':pavName'	=> $locName,
		':resStart'	=> $resStart,
		':resEnd'	=> $resEnd
	);

	$stmt = dbAccess($params);
	$params['rowCount'] = $stmt->rowCount();

	return $params;

}

function countTotalNumOfReservations($params, $pavName) {

	$params['dba']['s'] = "SELECT * FROM reservationaudit WHERE pavName = :pavName";
	$params['bindParam'] = array(':pavName' => $pavName);
	
	$stmt = dbAccess($params);
	$params['rowCount'] = $stmt->rowCount();

	return $params;

}

function filterParams($dirty) {

	$map = array(
		// Windows codepage 1252
		"\xC2\x82" => "'", // U+0082⇒U+201A single low-9 quotation mark
		"\xC2\x84" => '"', // U+0084⇒U+201E double low-9 quotation mark
		"\xC2\x8B" => "'", // U+008B⇒U+2039 single left-pointing angle quotation mark
		"\xC2\x91" => "'", // U+0091⇒U+2018 left single quotation mark
		"\xC2\x92" => "'", // U+0092⇒U+2019 right single quotation mark
		"\xC2\x93" => '"', // U+0093⇒U+201C left double quotation mark
		"\xC2\x94" => '"', // U+0094⇒U+201D right double quotation mark
		"\xC2\x9B" => "'", // U+009B⇒U+203A single right-pointing angle quotation mark

		// Regular Unicode     // U+0022 quotation mark (")
							   // U+0027 apostrophe     (')
		"\xC2\xAB"     => '"', // U+00AB left-pointing double angle quotation mark
		"\xC2\xBB"     => '"', // U+00BB right-pointing double angle quotation mark
		"\xE2\x80\x98" => "'", // U+2018 left single quotation mark
		"\xE2\x80\x99" => "'", // U+2019 right single quotation mark
		"\xE2\x80\x9A" => "'", // U+201A single low-9 quotation mark
		"\xE2\x80\x9B" => "'", // U+201B single high-reversed-9 quotation mark
		"\xE2\x80\x9C" => '"', // U+201C left double quotation mark
		"\xE2\x80\x9D" => '"', // U+201D right double quotation mark
		"\xE2\x80\x9E" => '"', // U+201E double low-9 quotation mark
		"\xE2\x80\x9F" => '"', // U+201F double high-reversed-9 quotation mark
		"\xE2\x80\xB9" => "'", // U+2039 single left-pointing angle quotation mark
		"\xE2\x80\xBA" => "'", // U+203A single right-pointing angle quotation mark
	);

	// assign keys and values to variables for better efficiency
	// to check data
	$a = array_keys($map);
	$b = array_values($map);

	foreach ($_REQUEST as $key => $value) {

		// Check what type of data is passing through
		if ($key == 'grade' || $key == 'noStudents' || $key == 'allotedTime') {

			// Decode any HTML that was entered in the input field
			// Strip any HTML tags in the input field
			$dirty[$key]    = html_entity_decode($value);
			$sanitize[$key] = strip_tags($dirty[$key]);

			// Sanitize and filter input
			$params[$key]   = filter_var(str_replace($a, $b, trim($sanitize[$key])), FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK);

		} elseif ($key == 'email') {

			$dirty[$key]    = html_entity_decode($value);
			$sanitize[$key] = strip_tags($dirty[$key]);

			// Sanitize input
			$params[$key]   = filter_var(str_replace($a, $b, trim($sanitize[$key])), FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK);

		} else {

			$dirty[$key]    = html_entity_decode($value);
			$sanitize[$key] = strip_tags($dirty[$key]);
			
			// Sanitize input
			$params[$key]   = filter_var(str_replace($a, $b, trim($sanitize[$key])), FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK);

		}

	}

	return $dirty;

}

function generateAuthKey($params) {

	// Check if a week has passed, generate a new authentication key
	if (date('w') <= 0 && date('w') >= 6) {

		$bytes = random_bytes(15);
		$params['authKey'] = ucwords(bin2hex($bytes)).'%pNR'.date('y').'Fr';

	} else {

		// False = set default authentication key
		$params['authKey'] = 'B5d266e668358267066ced5123ec88%pNR'.date('y').'Fr';

	}

	return $params;

}

function login($params) {

	// Call filterParams and iterate data through the function
	$params  = filterParams($params);

	$params['dba']['s']  = "SELECT * FROM users WHERE user = :user";
	$params['bindParam'] = array(
		':user' => $params['user']
	);

	$stmt           = dbAccess($params);
	$results        = $stmt->fetch(PDO::FETCH_ASSOC);

	// Check if entered user input matches data in table
	// Check if entered password input matches hashed password in table
	if ($results['user'] == $params['user'] && password_verify($params['password'], $results['password'])) {

		// Declare a random generated authentication token
		$params['token'] = hash('sha256', bin2hex(random_bytes(15)));
		
		// Assign entered user/password input to $_SESSION data
		$_SESSION['user']       = $params['user'];
		$_SESSION['password']   = $params['password'];
		$_SESSION['id']         = $results['id'];
		$_SESSION['token']		= $params['token'];

		$params['dba']['u'] 	= "UPDATE users SET authToken = :authToken, timestamp = NOW() WHERE id = 3";
		$params['bindParam'] 	= array(':authToken' => $params['token']);
		dbAccess($params);

		header("Location: index.php");

	} else {

		header("Location: login.php");
		
	}

	return $params;

}

function kickInactiveUser($params) {

	$params['dba']['s'] = "SELECT * FROM users WHERE id = 3";
	$stmt = dbAccess($params);
	$results = $stmt->fetch(PDO::FETCH_ASSOC);

	$first 	= ((date('i', strtotime($results['timestamp']))+15)*60);
	$second = (date('i')+15)*60;
	$diff = ($second - $first) / 60;
	$negativeDiff = 60 / ($second - $first);

	// Check if user has been inactive for 15 mins
	if ($diff >= 15 || $negativeDiff >= 15) {

		$params['dba']['u'] 	= "UPDATE users SET authToken = '', timestamp = '' WHERE user = :user";
		$params['bindParam'] 	= array(
			':user'		 => $_SESSION['user']
		);
		dbAccess($params);

		if ($params['dba']['u']) {

			session_start();
			session_destroy();

		}

	}

}

kickInactiveUser($params);

function logOut() {

	$params['dba']['u'] 	= "UPDATE users SET authToken = '', timestamp = '' WHERE user = :user";
	$params['bindParam'] 	= array(
		':user'		 => $_SESSION['user']
	);
	dbAccess($params);

	if ($params['dba']['u']) {

		session_start();
		session_destroy();
		header("Location: login.php");

	}

	return $params;

}

function pavReservationProcess($params) {

	// Call on dependencies
	$params = filterParams($params);
	$r = getLocations($params);

	// Generate confirmation ID based on location
	foreach ($r as $row) {

		switch ($params['pavilion']) {

			case $row['locID']:
				$params['pavilion']  = $row['locName'];
				$params['text'] = $row['locCode']."-".random_int(9999, 99999);
				$params['pavColor']  = $row['locColor'];
				break;

		}
		
	}

	$params['dba']['s']     = "SELECT * FROM pavreservations WHERE pavName = :pavName AND :resStart BETWEEN resStart AND resEnd AND :resEnd BETWEEN resStart AND resEnd OR pavName = :pavName AND resStart = :resEnd OR pavName = :pavName AND :resEnd BETWEEN resStart AND resEnd OR pavName = :pavName AND :resStart BETWEEN resStart AND resEnd AND resEnd <= :resEnd OR pavName = :pavName AND :resStart <= resEnd AND :resEnd >= resStart";
	$params['bindParam']    = array(
		':pavName' 	=> $params['pavilion'], 
		':resStart' => $params['resStart'],
		':resEnd'	=> $params['resEnd']
	);

	$stmt                   = dbAccess($params);
	$params['rowCount']     = $stmt->rowCount(); // Run a row count to count number of data in table

	// Check if entered reservation input exists in the table
	if ($params['rowCount'] > 0 || date('Y-m-d', strtotime($params['resStart'])) < date('Y-m-d') || date('Y-m-d', strtotime($params['resEnd'])) < date('Y-m-d') || date('Y-m-d', strtotime($params['resEnd'])) < date('Y-m-d', strtotime($params['resStart'])) || date('Y-m-d', strtotime($params['resStart'])) == date('Y-m-d', strtotime($params['resEnd'])) || date('Y', strtotime($params['resStart'])) > date('Y') && date('Y', strtotime($params['resEnd'])) > date('Y') || date('Y', strtotime($params['resEnd'])) > date('Y') || (date('d', strtotime($params['resEnd'])) - date('d', strtotime($params['resStart']))) >= 6) {

		// End process here if reservation exists or the reservation date is less than today
		
	} else {

		// Insert reservation data
		$params['dba']['i']  = "INSERT INTO pavreservations (pavName, resStart, resEnd, pavStatus, confirmID, pavColor, receiptNo) VALUES (:pavName, :resStart, :resEnd, :pavStatus, :confirmID, :pavColor, :receiptNo)";
		$params['bindParam'] = array(
			':pavName'      => $params['pavilion'],
			':resStart'     => $params['resStart'],
			':resEnd'       => $params['resEnd'],
			':pavStatus'    => 'PENDING',
			':confirmID'    => $params['text'],
			':pavColor'     => $params['pavColor'],
			':receiptNo'    => 0
		);

		dbAccess($params);

		if ($params['dba']['i']) {

			$params['dba']['i'] = "INSERT INTO reservationaudit (pavName, resStart, confirmID) VALUES (:pavName, :resStart, :confirmID)";
			$params['bindParam'] = array(
				':pavName'      => $params['pavilion'],
				':resStart'     => $params['resStart'],
				':confirmID'    => $params['text']
			);
			
			dbAccess($params);

			$_SESSION['id'] = $params['text'];

			// debug
			$params['debug'] = array(
				'Location:' 				=> $params['pavilion'],
				'Confirmation ID:' 			=> $params['text'],
				'Reservation Date (Start):' => $params['resStart']
			);

		}

	}
	
	return $params;
	
}

function manualReservation($params) {

	$params = filterParams($params);
	$r = getLocations($params);
	$params['alertMsg'] = '';
	
	foreach ($r as $row) {

		switch ($params['pavilion']) {
	
			case $row['locID']:
				$params['pavilion']  = $row['locName'];
				$params['text'] = $row['locCode']."-".random_int(9999, 99999);
				$params['pavColor']  = $row['locColor'];
			break;
	
		}

	}
	
	$params['dba']['s']     = "SELECT * FROM pavreservations WHERE pavName = :pavName AND :resStart BETWEEN resStart AND resEnd AND :resEnd BETWEEN resStart AND resEnd OR pavName = :pavName AND resStart = :resEnd OR pavName = :pavName AND :resEnd BETWEEN resStart AND resEnd OR pavName = :pavName AND :resStart BETWEEN resStart AND resEnd AND resEnd <= :resEnd OR pavName = :pavName AND :resStart <= resEnd AND :resEnd >= resStart";
	$params['bindParam']    = array(
		':pavName' 	=> $params['pavilion'], 
		':resStart' => $params['resStart'],
		':resEnd'	=> $params['resEnd']
	);

	$stmt 				= dbAccess($params);
	$params['rowCount'] = $stmt->rowCount();

	// Check if entered reservation input exists in the table
	if ($params['rowCount'] > 0) {

		// End process here if reservation exists or the reservation date is less than today
		$params['alertMsg'] = 
		'<div style="color: red; background-color: rgb(254, 226, 226, 0.5);" class="p-4 mb-4 text-sm rounded-lg" role="alert">
			<span class="font-bold"><i class="fas fa-exclamation-triangle"></i> ERROR -</span> The location you have selected to reserve on '.$params['resStart'].' is unavailable! Please select another date.
		</div>';
		
	} elseif (date('Y-m-d', strtotime($params['resStart'])) < date('Y-m-d') || date('Y-m-d', strtotime($params['resEnd'])) < date('Y-m-d') || date('Y', strtotime($params['resStart'])) > date('Y') && date('Y', strtotime($params['resEnd'])) > date('Y') || date('Y', strtotime($params['resEnd'])) > date('Y')) {

		$params['alertMsg'] = 
		'<div style="color: red; background-color: rgb(254, 226, 226, 0.5);" class="p-4 mb-4 text-sm rounded-lg" role="alert">
		  <span class="font-bold"><i class="fas fa-exclamation-triangle"></i> ERROR -</span> The date(s) selected is invalid! Please select a valid date(s) and try again.
		</div>';
		
	} elseif (date('Y-m-d', strtotime($params['resEnd'])) < date('Y-m-d', strtotime($params['resStart']))) {


		$params['alertMsg'] = 
		'<div style="color: red; background-color: rgb(254, 226, 226, 0.5);" class="p-4 mb-4 text-sm rounded-lg" role="alert">
		  <span class="font-bold"><i class="fas fa-exclamation-triangle"></i> ERROR -</span> The date selected is past due! Please select a present or future date(s) and try again.
		</div>';


	} elseif (date('Y-m-d', strtotime($params['resStart'])) == date('Y-m-d', strtotime($params['resEnd']))) {

		$params['alertMsg'] = 
		'<div style="color: red; background-color: rgb(254, 226, 226, 0.5);" class="p-4 mb-4 text-sm rounded-lg" role="alert">
			  <span class="font-bold"><i class="fas fa-exclamation-triangle"></i> ERROR -</span> The date(s) entered match! Please select another pair of date(s) and try again.
		</div>';

	} elseif((date('d', strtotime($params['resEnd'])) - date('d', strtotime($params['resStart']))) >= 6) {

		$params['alertMsg'] = 
		'<div style="color: red; background-color: rgb(254, 226, 226, 0.5);" class="p-4 mb-4 text-sm rounded-lg" role="alert">
			  <span class="font-bold"><i class="fas fa-exclamation-triangle"></i> ERROR -</span> The amount of days allowed for reservation are no greater than 6 days.
		</div>';

	} else {

		$params['dba']['i']  = "INSERT INTO pavreservations (pavName, resStart, resEnd, pavStatus, confirmID, pavColor, receiptNo) VALUES (:pavName, :resStart, :resEnd, :pavStatus, :confirmID, :pavColor, :receiptNo)";
		$params['bindParam'] = array(
			':pavName'      => $params['pavilion'],
			':resStart'     => $params['resStart'],
			':resEnd'       => $params['resEnd'],
			':pavStatus'    => 'PENDING',
			':confirmID'    => $params['text'],
			':pavColor'     => $params['pavColor'],
			':receiptNo'     => 0
		);

		dbAccess($params);

		$_SESSION['id'] = $params['text'];

		// debug
		$params['debug'] = array(
			'Location:' 				=> $params['pavilion'],
			'Confirmation ID:' 			=> $params['text'],
			'Reservation Date (Start):' => $params['resStart'],
			'Reservation Date (End):' 	=> $params['resEnd']
		);
		// debug end

		$params['alertMsg'] = 
		'<div style="color: green; background-color: rgb(220, 252, 231, 0.5);" class="p-4 mb-4 text-sm rounded-lg" role="alert">
			<span class="font-medium"><i class="fas fa-check"></i> Success!</span> The reservation was created.
		</div>';

	}

	return $params;
	
}

function calendarReservation($params) {

	$params = filterParams($params);
	$r = getLocations($params);
	
	foreach ($r as $row) {
	
		switch ($params['calendarFacility']) {
	
			case $row['locID']:
				$params['calendarFacility']  = $row['locName'];
				$params['text'] = $row['locCode']."-".random_int(9999, 99999);
				$params['pavColor']  = $row['locColor'];
				break;

		}
			
	}

	$params['dba']['s']     = "SELECT * FROM pavreservations WHERE pavName = :pavName AND :resStart BETWEEN resStart AND resEnd AND :resEnd BETWEEN resStart AND resEnd OR pavName = :pavName AND resStart = :resEnd OR pavName = :pavName AND :resEnd BETWEEN resStart AND resEnd OR pavName = :pavName AND :resStart BETWEEN resStart AND resEnd AND resEnd <= :resEnd OR pavName = :pavName AND :resStart <= resEnd AND :resEnd >= resStart";
	$params['bindParam']    = array(
		':pavName' 	=> $params['calendarFacility'], 
		':resStart' => date('Y-m-d', strtotime($params['resStart'])),
		':resEnd'	=> date('Y-m-d', strtotime($params['resEnd']))
	);

	$stmt 				= dbAccess($params);
	$params['rowCount'] = $stmt->rowCount();

	// Do not process reservation if = startDate < curDate && endDate < curDate OR startDate >= curDate && endDate < curDate OR startDate < curDate OR endDate < curDate
	if ($params['rowCount'] > 0 || date('Y-m-d', strtotime($params['resStart'])) < date('Y-m-d') || date('Y-m-d', strtotime($params['resEnd'])) < date('Y-m-d') || date('Y-m-d', strtotime($params['resEnd'])) < date('Y-m-d', strtotime($params['resStart'])) || date('Y', strtotime($params['resStart'])) > date('Y') && date('Y', strtotime($params['resEnd'])) > date('Y') || date('Y', strtotime($params['resEnd'])) > date('Y') || date('Y-m-d', strtotime($params['resStart'])) == date('Y-m-d', strtotime($params['resEnd'])) || (date('d', strtotime($params['resEnd'])) - date('d', strtotime($params['resStart']))) >= 6) {

		// End process here if reservation exists or the reservation date is less than today

	} else {

		$params['dba']['i']  = "INSERT INTO pavreservations (pavName, resStart, resEnd, pavStatus, confirmID, pavColor, receiptNo) VALUES (:pavName, :resStart, :resEnd, :pavStatus, :confirmID, :pavColor, :receiptNo)";
		$params['bindParam'] = array(
			':pavName'      => $params['calendarFacility'],
			':resStart'     => date('Y-m-d', strtotime($params['resStart'])),
			':resEnd'       => date('Y-m-d', strtotime($params['resEnd'])),
			':pavStatus'    => 'PENDING',
			':confirmID'    => $params['text'],
			':pavColor'     => $params['pavColor'],
			':receiptNo'	=> 0,
		);

		dbAccess($params);

		if ($params['dba']['i']) {

			$params['dba']['i'] = "INSERT INTO reservationaudit (pavName, resStart, confirmID) VALUES (:pavName, :resStart, :confirmID)";
			$params['bindParam'] = array(
				':pavName'      => $params['calendarFacility'],
				':resStart'     => date('Y-m-d', strtotime($params['resStart'])),
				':confirmID'    => $params['text']
			);

			dbAccess($params);

			session_start();
			$_SESSION['id'] = $params['text'];

			// debug
			$params['debug'] = array(
				'Location:' 				=> $params['calendarFacility'],
				'Confirmation ID:' 			=> $params['text'],
				'Reservation Date (Start):' => $params['resStart'],
				'Reservation Date (End):' 	=> $params['End']
			);

		}

	}

	return $params;
	
}

function cashOut($params) {

	// Get confirmation ID
	$params['confirmation']  = $_GET['id'];

	$params['dba']['s']  = "SELECT * FROM pavreservations WHERE resID = :id";
	$params['bindParam'] = array(
		':id'   => $params['confirmation']
	);

	$stmt   	= dbAccess($params);

	$results	= $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $results;

}

function confirmReservation($params) {

	// Call on dependencies
	$params  = filterParams($params);

	// Get confirmation ID
	$params['confirmation']  = $_GET['id'];

	// Update the reservation status based on confirmation ID
	$params['dba']['u']  = "UPDATE pavreservations SET pavStatus = 'RESERVED', receiptNo = :receiptNo WHERE resID = :id";
	$params['bindParam'] = array(
		':id'   => $params['confirmation'],
		':receiptNo' => $params['receiptNo']
	);
	
	dbAccess($params);

	// Check if SQL statement was ran
	if ($params['dba']['u']) {

		header ("Location: index.php");

	}

}

function cancelReservation($params) {

	// Get confirmation ID
	$params['confirmation']  = $_GET['id'];

	// Delete the reservation status based on confirmation ID
	$params['dba']['u']  = "UPDATE pavreservations SET pavStatus = 'CANCELED' WHERE resID = :id";
	$params['bindParam'] = array(':id' => $params['confirmation']);
	
	dbAccess($params);

	// Check if SQL statement was ran
	if ($params['dba']['u']) {

		header ("Location: index.php");

	}

	return $params;

}

function deleteCanceled($params) {

	// Call on dependencies
	$results = dataView($params);
	
	foreach ($results as $row) {

		// Create a variable to indicate the day when the reservation ends
		$closeOut = date('z', strtotime($row['resEnd']));

		// If the reservation has been canceled, remove it from the table the next day
		if ($closeOut < date('z') && $row['pavStatus'] == 'CANCELED') {

			$params['dba']['d']  = "DELETE FROM pavreservations WHERE pavStatus = 'CANCELED'";

			dbAccess($params);

		}

	}

}

deleteCanceled($params);

function getConfirmationDetails($params) {

	$params = generateAuthKey($params);

	// Check if confirmation ID is present in URL
	if (!$_GET[$params['authKey']]) { 
		
		header("Location: index.php"); 
	
	} else {
	
		$params['confirmation']  = $_GET[$params['authKey']];
	
		// Read/pull data from pavreservations table based on confirmation ID
		$params['dba']['u']  = "SELECT * FROM pavreservations WHERE confirmID = :confirmID";
		$params['bindParam'] = array(
			':confirmID'   => $params['confirmation']
		);
		
		$stmt = dbAccess($params);
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $results;
	
	}

}

function filterReservations($params, $filter) {

	// Call on dependencies
	$params = filterParams($params);

	// Read/pull data from pavreservations table based on filter select of pavilion status
	$params['dba']['s'] = "SELECT * FROM pavreservations WHERE pavStatus = :pavStatus";
	$params['bindParam'] = array(':pavStatus' => $filter);

	$stmt       = dbAccess($params);
	$results    = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $results;

}

function filterLocations($params, $filter) {

	// Call on dependencies
	$params = filterParams($params);
	
	// Read/pull data from pavreservations table based on filter select of location availability
	$params['dba']['s'] = "SELECT * FROM facilitylocations WHERE locType LIKE :locType";
	$params['bindParam'] = array(':locType' => $filter);

	$stmt       = dbAccess($params);
	$results    = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $results;

}

function searchReservations($params) {

	// Call on dependencies 
	$params = filterParams($params);

	// Create a variable to assign search input
	$search = '%'.$params['search'].'%';

	// Read/pull data from pavreservations table based on search term
	$params['dba']['s'] = "SELECT * FROM pavreservations WHERE pavName LIKE :search OR confirmID LIKE :search";
	$params['bindParam'] = array(':search' => $search);

	$stmt = dbAccess($params);
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $results;

}

function searchLocation($params) {

	// Call on dependencies 
	$params = filterParams($params);

	// Create a variable to assign search input
	$search = '%'.$params['facilitySearch'].'%';

	// Read/pull data from locations table based on search term
	$params['dba']['s'] = "SELECT * FROM facilitylocations WHERE locName LIKE :search";
	$params['bindParam'] = array(':search' => $search);

	$stmt = dbAccess($params);
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	return $results;

}

function presentationSignUp($params) {

	$mail = new PHPMailer(true);

	$params = filterParams($params);

	try {
		//Server settings
		$mail->SMTPDebug = SMTP::DEBUG_SERVER;                 //Enable verbose debug output
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'outbound.mailhop.org';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = 'dofcnmi';                     //SMTP username
		$mail->Password   = 'H7FuxnQHK1uV';                               //SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
		$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

		foreach ($_REQUEST as $key => $value) {

			switch ($value) {

				case 1:
					$params['topic'] = 'Fishing across cultures (describes various fishing methods between Chamorros, Carolinians, Filipinos, etc.)';
					break;

				case 2:
					$params['topic'] = 'Responsible fishing techniques';
					break;

				case 3:
					$params['topic'] = 'Various aquatic animals and their habitats';
					break;

				case 4:
					$params['topic'] = 'Boating Access and Fisheries Research Program';
					break;

			}

		}

		// more filtering/sanitization
		$params['cleanedEmail']  = filter_var($params['email'], FILTER_SANITIZE_EMAIL, FILTER_FLAG_EMAIL_UNICODE | FILTER_FLAG_NO_ENCODE_QUOTES | FILTER_FLAG_STRIP_BACKTICK | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);

		$params['message'] =
		'<!DOCTYPE html>
		<html lang="en">
	
		<head>
			<title>Reservation Confirmation - Division of Parks &amp; Recreation | Department of Land and Natural Resources</title>
			<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
		</head>
	
		<body style="font-family: Inter, sans-serif !important;">
			<main>
				<section class="email">
					<div style="padding: 24px 16px;">
						<div style="margin: 0px auto; display: flex; justify-content: center; align-items: center;">
							<img src="https://dev.dlnr.cnmi.gov/assets/img/dlnr.png" alt="" style="max-width: 150px;">
						</div>
					</div>
					<hr style="opacity: 0.5; width: 50%;">
					<div style="background: #f4f3ee !important; padding: 0px 16px 24px 16px;">
						<div style="color: #000 !important; width: 50%; margin: 0 auto;">
							<h1 style="font-size: 1.25rem; margin: 1.5rem auto;">Hafa Adai,</h1>
							<p style="text-align: justify; margin: 1.5rem auto;">
								Thank you for requesting for a presentation! We will get back to you as soon as we can. If you still don&#39t here back from us, please call us at: <b>(670) 664-6000</b>.
							</p>
							<hr style="opacity: 0.5;">
							<h1 style="font-size: 1.1rem; font-weight: bold; margin-bottom: 0px !important;">Presentation Details</h1>
							<p>Teacher&#39s Name: '.$params['teacher'].'</p>
							<p>School: '.$params['school'].'</p>
							<p>Grade: '.$params['grade'].'</p>
							<p>Number of Students: '.$params['noStudents'].'</p>
							<p>Time alloted for presentation: '.$params['allotedTime'].'</p>
							<p>Topic: '.$params['topic'].'</p>
							<p>Date and Time of presentation: '.$params['presentationDate'].'</p>
							<p>Comments:</p>
							<div style="background: #fff !important; padding: 2rem;">
								"'.$params['comments'].'"
							</div>
						</div>
					</div>
				</section>
			</main>
		</body>
	
		</html>';

		//Recipients
		$mail->setFrom($params['cleanedEmail'], 'Aquatic Education');
		$mail->addAddress('j.inoke@dof.gov.mp', 'Jostan T. Inoke');     //Add a recipient

		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = "Presentation Sign-up - Department of Land and Natural Resources (dlnr.cnmi.gov)";
		$mail->Body    = $params['message'];

		$params['result'] = $mail->send();

		$params['alertMsg'] = 
		'<div style="color: green; background-color: rgb(220, 252, 231, 0.5);" class="p-4 mb-4 text-sm rounded-lg" role="alert">
		  <span class="font-medium"><i class="fas fa-check"></i> Success!</span> Your request for presentation has been received. We will get back to you as soon as possible.
		</div>';

	} catch (Exception $e) {

		// echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		$params['alertMsg'] = 
		'<div style="color: red; background-color: rgb(254, 226, 226, 0.5);" class="p-4 mb-4 text-sm rounded-lg" role="alert">
		  <span class="font-bold"><i class="fas fa-exclamation-triangle"></i> ERROR -</span> There was an issue trying to send your message. Please try again! Reference: '.$mail->$e->ErrorInfo.'
		</div>';

	}

	return $params;
	unset($params);

}

function contactUs($params) {

	$mail = new PHPMailer(true);

	$params = filterParams($params);

	try {

		//Server settings
		$mail->SMTPDebug = SMTP::DEBUG_SERVER;                 //Enable verbose debug output
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'outbound.mailhop.org';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = 'dofcnmi';                     //SMTP username
		$mail->Password   = 'H7FuxnQHK1uV';                               //SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
		$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

		switch ($params['division']) {

			case '1':
				$params['division'] = 'Division of Agriculture';
				break;
			
			case '2':
				$params['division'] = 'Division of Land Registration &amp; Survey';
				break;

			case '3':
				$params['division'] = 'Division of Parks &amp; Recreation';
				break;

			case '4':
				$params['division'] = 'Division of Fish &amp; Wildlife';
				break;
			
		}

		$params['message']   =
		'<!DOCTYPE html>
		<html lang="en">
	
		<head>
			<title>Thank you for contacting us! - Division of Parks &amp; Recreation | Department of Land and Natural Resources</title>
			<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
		</head>
	
		<body style="font-family: Inter, sans-serif !important;">
			<main>
				<section class="email">
					<div style="padding: 24px 16px;">
						<div style="margin: 0px auto; display: flex; justify-content: center; align-items: center;">
							<img src="https://dev.dlnr.cnmi.gov/assets/img/dlnr-header-transparent-white.png" alt="" style="max-width: 500px;">
						</div>
					</div>
					<div style="padding: 48px 16px; background: #f4f3ee !important;">
						<div style="color: #000 !important;">
							<h1 style="font-size: 1.25rem; font-weight: normal; margin: 1.5rem auto;">Hafa Adai, <span style="font-weight: bold;">'.$params['division'].'</span>,</h1>
							<div style="background: #fff !important; padding: 2rem;">
						
							<p>Message from <span style="font-weight: bold;">'.$params['name'].'</span>: </p>

							<p style="margin-top: 2rem;">"'.$params['comment'].'"</p>
							</div>
						</div>
					</div>
				</section>
			</main>
		</body>';

		//Recipients
		$mail->setFrom($params['email'], $params['name']);

		switch ($params['division']) {

			case 'Division of Agriculture':
				$mail->addAddress('d.ada@dof.gov.mp', 'Donna M. Ada');
				break;

			case 'Division of Land Registration &amp; Survey':
				$mail->addAddress('j.inoke@dof.gov.mp', 'Jostan T. Inoke');
				break;

			case 'Division of Parks &amp; Recreation':
				$mail->addAddress('k.bautista@dof.gov.mp', 'Ken Ray Bautista');
				break;

			case 'Division of Fish &amp; Wildlife':
				$mail->addAddress('s.alonzo@dof.gov.mp', 'Stephen S. Alonzo');
				break;

		}

		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = "".$params['subject']." - Department of Land and Natural Resources (dlnr.cnmi.gov)";
		$mail->Body    = $params['message'];

		$params['result'] = $mail->send();

		$params['alertMsg'] = 
		'<div style="color: green; background-color: rgb(220, 252, 231, 0.5);" class="p-4 mb-4 text-sm rounded-lg" role="alert">
		  <span class="font-medium"><i class="fas fa-check"></i> Success!</span> Your message was received. The '.$params['division'].' will get back to you as soon as possible.
		</div>';

	} catch (Exception $e) {

		// echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		$params['alertMsg'] = 
		'<div style="color: red; background-color: rgb(254, 226, 226, 0.5);" class="p-4 mb-4 text-sm rounded-lg" role="alert">
		  <span class="font-bold"><i class="fas fa-exclamation-triangle"></i> ERROR -</span> There was an issue trying to send your message. Please try again! Reference: '.$mail->$e->ErrorInfo.'
		</div>';

	}

	return $params;
	unset($params);

}

function reserveFacility($params) {

  $mail = new PHPMailer(true);

  // initiation for confirmation ID
  session_start();

  $params = filterParams($params);
  $params = pavReservationProcess($params);
  $params = generateAuthKey($params);
  
  // Declare QR values
  $params['alertMsg'] = '';
  $params['qrLink'] = 'dev.dof.gov.mp/salonzo/dlnr.cnmi.gov/confirmation.php?'.$params['authKey'].'='.$_SESSION['id'];
  $params['errorCorrection'] = 'L';
  $params['pixelSize'] = 20;
  $params['frameSize'] = 5;

  $qr = file_get_contents('https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=https%3A%2F%2F'.$params['qrLink'].'&choe=UTF-8');
  
  $params['message'] = 
  '<!DOCTYPE html>
  <html lang="en">
  
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Confirmation - Division of Parks &amp; Recreation | Department of Lands and Natural Resources</title>
	  <title>Reservation Confirmation - Division of Parks &amp; Recreation | Department of Land and Natural Resources</title>
	  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
  </head>
  
  <body style="font-family: Inter, sans-serif !important;">
	  <main style="background: #f4f3ee !important;">
		  <section class="email">
			  <div style="padding: 24px 16px;">
				  <div style="margin: 0px auto; display: flex; justify-content: center; align-items: center;">
					  <img src="https://dev.dlnr.cnmi.gov/assets/img/dlnr.png" alt="" style="max-width: 150px;">
				  </div>
			  </div>
			  <hr style="opacity: 0.5;">
			  <div style="padding: 0px 16px 24px 16px;">
				<div style="color: #000 !important;">
					<h1 style="font-size: 1.25rem; margin: 1.5rem auto;">Hafa Adai,</h1>
					<p style="text-align: justify; margin: 1.5rem auto;">
						This reservation will be on hold until you <b>secure your reservation</b>. To <b><u>secure your reservation</u></b>, you must first make a payment and provide the Division of Parks & Recreation a copy of this email receipt within [x] days. Otherwise, you must submit a reservation again.
					</p>
					<p style="text-align: justify; margin: 1.5rem auto;">
						Please keep note that, <b>the validity of the QR code below expires the same day, potentially, that you do not make payment and provide DLNR a copy of this email receipt</b>.
					</p>
					<p style="font-weight: bold">Reservation Details</p>
					<hr style="opacity: 0.5;">
					<ul>
                        <li>Confirmation ID: <span>'.$_SESSION['id'].'</span></li>
                        <li>Location: <span>'.$params['pavilion'].'</span></li>
                        <li>Date: <span>'.date('F d, Y', strtotime($params['resStart'])).'</span> - <span>'.date('F d, Y', strtotime($params['resEnd'])).'</span></li>
                    </ul>
					<img src="cid:qrcode" style="width: 200px; height: 200px; margin: 1.5rem auto;">
				</div>
			  </div>
		  </section>
	  </main>
  </body>
  
  </html>';

  try {

	//Server settings
	$mail->SMTPDebug = SMTP::DEBUG_SERVER;                 //Enable verbose debug output
	$mail->isSMTP();                                            //Send using SMTP
	$mail->Host       = 'outbound.mailhop.org';                     //Set the SMTP server to send through
	$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
	$mail->Username   = 'dofcnmi';                     //SMTP username
	$mail->Password   = 'H7FuxnQHK1uV';                               //SMTP password
	$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
	$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

	if (date('Y-m-d', strtotime($params['resStart'])) < date('Y-m-d')) {

		// Prevent execution of PHPMailer
		$params['alertMsg'] = 
		'<div style="color: red; background-color: rgb(254, 226, 226, 0.5);" class="p-4 mb-4 text-sm rounded-lg" role="alert">
		  <span class="font-bold"><i class="fas fa-exclamation-triangle"></i> ERROR -</span> The date(s) entered is past due! Please enter a valid date(s) and try again.
		</div>';

	} elseif (date('Y-m-d', strtotime($params['resEnd'])) < date('Y-m-d')) {

		// Prevent execution of PHPMailer
		$params['alertMsg'] = 
		'<div style="color: red; background-color: rgb(254, 226, 226, 0.5);" class="p-4 mb-4 text-sm rounded-lg" role="alert">
		  <span class="font-bold"><i class="fas fa-exclamation-triangle"></i> ERROR -</span> The date(s) entered is past due! Please enter a valid date(s) and try again.
		</div>';

	} elseif (date('Y-m-d', strtotime($params['resEnd'])) < date('Y-m-d', strtotime($params['resStart'])) || date('Y', strtotime($params['resStart'])) > date('Y') && date('Y', strtotime($params['resEnd'])) > date('Y') || date('Y', strtotime($params['resEnd'])) > date('Y')) {

		// Prevent execution of PHPMailer
		$params['alertMsg'] = 
		'<div style="color: red; background-color: rgb(254, 226, 226, 0.5);" class="p-4 mb-4 text-sm rounded-lg" role="alert">
		  <span class="font-bold"><i class="fas fa-exclamation-triangle"></i> ERROR -</span> The date(s) entered is invalid! Please enter a valid date(s) and try again.
		</div>';

	} elseif (date('Y-m-d', strtotime($params['resStart'])) == date('Y-m-d', strtotime($params['resEnd']))) {
		
		// Prevent execution of PHPMailer
		$params['alertMsg'] = 
		'<div style="color: red; background-color: rgb(254, 226, 226, 0.5);" class="p-4 mb-4 text-sm rounded-lg" role="alert">
		  <span class="font-bold"><i class="fas fa-exclamation-triangle"></i> ERROR -</span> The date(s) entered match! Please select another pair of date(s) and try again.
		</div>';

	} elseif ($params['rowCount'] > 0 ) {

		// Prevent execution of PHPMailer
		$params['alertMsg'] = 
		'<div style="color: red; background-color: rgb(254, 226, 226, 0.5);" class="p-4 mb-4 text-sm rounded-lg" role="alert">
		  <span class="font-bold"><i class="fas fa-exclamation-triangle"></i> ERROR -</span> The location you have selected to reserve between '.$params['resStart'].' to '.$params['resEnd'].' is unavailable! For more information, visit our <a href="facility-reservations-calendar.php" target="_blank" rel="noopener noreferrer" class="font-bold hover:underline hover:underline-offset-4" style="duration: 200ms;">Facility Reservations Calendar</a> to see location availability.
		</div>';

	} elseif((date('d', strtotime($params['resEnd'])) - date('d', strtotime($params['resStart']))) >= 6) {

		$params['alertMsg'] = 
		'<div style="color: red; background-color: rgb(254, 226, 226, 0.5);" class="p-4 mb-4 text-sm rounded-lg" role="alert">
			  <span class="font-bold"><i class="fas fa-exclamation-triangle"></i> ERROR -</span> The amount of days allowed for reservation are no greater than 6 days.
		</div>';

	} else {

		$params['alertMsg'] = 
		'<div style="color: green; background-color: rgb(220, 252, 231, 0.5);" class="p-4 mb-4 text-sm rounded-lg" role="alert">
		  <span class="font-medium"><i class="fas fa-check"></i> Success!</span> Your reservation was received and an email was sent to you with the details of your reservation.
		</div>';

		$params['cleanedEmail']  = filter_var($params['email'], FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);

		//Recipients
		$mail->setFrom('j.inoke@dof.gov.mp', 'Jostan T. Inoke');
		$mail->addAddress($params['cleanedEmail'], $params['name']);     //Add a recipient
  
		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = "QR Code Test from dlnr.cnmi.gov";
		$mail->Body = $params['message'];
		$mail->addStringEmbeddedImage($qr, 'qrcode', 'qr.png', PHPMailer::ENCODING_BASE64);

		$params['result'] = $mail->send();
		echo 'Message has been sent';
	
	}

  } catch (Exception $e) {
	
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	
  }

  return $params;
  unset($params);

}

function calendarReserveFacility($params) {

	$mail = new PHPMailer(true);
  
	// initiation for confirmation ID
	session_start();
  
	$params = generateAuthKey($params);
	$params = filterParams($params);
	$params = calendarReservation($params);
	
	$params['alertMsg'] = '';
  
	// Declare QR values
	$params['qrLink'] = 'dev.dof.gov.mp/salonzo/dlnr.cnmi.gov/confirmation.php?'.$params['authKey'].'='.$_SESSION['id'];
	$params['errorCorrection'] = 'L';
	$params['pixelSize'] = 20;
	$params['frameSize'] = 5;
  
	$qr = file_get_contents('https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=https%3A%2F%2F'.$params['qrLink'].'&choe=UTF-8');
	
	$params['message'] = 
	'<!DOCTYPE html>
	<html lang="en">
	
	<head>
	  <meta charset="UTF-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	  <title>Reservation Confirmation - Division of Parks &amp; Recreation | Department of Lands and Natural Resources</title>
		<title>Reservation Confirmation - Division of Parks &amp; Recreation | Department of Land and Natural Resources</title>
		<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;800&display=swap" rel="stylesheet">
	</head>
	
	<body style="font-family: Inter, sans-serif !important;">
		<main style="background: #f4f3ee !important;">
			<section class="email">
				<div style="padding: 24px 16px;">
					<div style="margin: 0px auto; display: flex; justify-content: center; align-items: center;">
						<img src="https://dev.dlnr.cnmi.gov/assets/img/dlnr.png" alt="" style="max-width: 150px;">
					</div>
				</div>
				<hr style="opacity: 0.5;">
				<div style="padding: 0px 16px 24px 16px;">
				  <div style="color: #000 !important;">
					  <h1 style="font-size: 1.25rem; margin: 1.5rem auto;">Hafa Adai,</h1>
					  <p style="text-align: justify; margin: 1.5rem auto;">
						  This reservation will be on hold until you <b>secure your reservation</b>. To <b><u>secure your reservation</u></b>, you must first make a payment and provide the Division of Parks & Recreation a copy of this email receipt within [x] days. Otherwise, you must submit a reservation again.
					  </p>
					  <p style="text-align: justify; margin: 1.5rem auto;">
						  Please keep note that, <b>the validity of the QR code below expires the same day, potentially, that you do not make payment and provide DLNR a copy of this email receipt</b>.
					  </p>
					  <p style="font-weight: bold">Reservation Details</p>
					  <hr style="opacity: 0.5;">
					  <ul>
						  <li>Confirmation ID: <span>'.$_SESSION['id'].'</span></li>
						  <li>Location: <span>'.$params['calendarFacility'].'</span></li>
						  <li>Date: <span>'.date('F d, Y', strtotime($params['resStart'])).'</span> - <span>'.date('F d, Y', strtotime($params['resEnd'])).'</span></li>
					  </ul>
					  <img src="cid:qrcode" style="width: 200px; height: 200px; margin: 1.5rem auto;">
				  </div>
				</div>
			</section>
		</main>
	</body>
	
	</html>';
  
	try {
  
		//Server settings
		$mail->SMTPDebug = SMTP::DEBUG_SERVER;                 //Enable verbose debug output
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'outbound.mailhop.org';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = 'dofcnmi';                     //SMTP username
		$mail->Password   = 'H7FuxnQHK1uV';                               //SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
		$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

		if ($params['rowCount'] > 0) {
		  
			// Prevent execution of PHPMailer
			$params['alertMsg'] = 
			  '<div style="color: red; background-color: rgb(254, 226, 226, 0.5);" class="p-4 text-sm rounded-lg" role="alert">
			  <span class="font-bold"><i class="fas fa-info-circle"></i> ERROR -</span> The location you have selected to reserve on '.$params['resStart'].' is unavailable! For more information, visit our <a href="facility-reservations-calendar.php" target="_blank" rel="noopener noreferrer" class="font-bold hover:underline hover:underline-offset-4" style="duration: 200ms;">Facility Reservations Calendar</a> to see availability.
			  </div>';
  
		} elseif (date('Y-m-d', strtotime($params['resStart'])) < date('Y-m-d')) {

			// Prevent execution of PHPMailer
			$params['alertMsg'] = 
			'<div style="color: red; background-color: rgb(254, 226, 226, 0.5);" class="p-4 text-sm rounded-lg" role="alert">
				  <span class="font-bold"><i class="fas fa-exclamation-triangle"></i> ERROR -</span> The date(s) entered is past due! Please enter a valid date(s) and try again.
			</div>';

		} elseif (date('Y-m-d', strtotime($params['resEnd'])) < date('Y-m-d')) {

			// Prevent execution of PHPMailer
			$params['alertMsg'] = 
			'<div style="color: red; background-color: rgb(254, 226, 226, 0.5);" class="p-4 text-sm rounded-lg" role="alert">
				  <span class="font-bold"><i class="fas fa-exclamation-triangle"></i> ERROR -</span> The date(s) entered is past due! Please enter a valid date(s) and try again.
			</div>';

		} elseif (date('Y-m-d', strtotime($params['resEnd'])) < date('Y-m-d', strtotime($params['resStart'])) || date('Y', strtotime($params['resStart'])) > date('Y') && date('Y', strtotime($params['resEnd'])) > date('Y') || date('Y', strtotime($params['resEnd'])) > date('Y')) {

			// Prevent execution of PHPMailer
			$params['alertMsg'] = 
			'<div style="color: red; background-color: rgb(254, 226, 226, 0.5);" class="p-4 text-sm rounded-lg" role="alert">
				  <span class="font-bold"><i class="fas fa-exclamation-triangle"></i> ERROR -</span> The date(s) entered is invalid! Please enter a valid date(s) and try again.
			</div>';

		} elseif (date('Y-m-d', strtotime($params['resStart'])) == date('Y-m-d', strtotime($params['resEnd']))) {
		
			// Prevent execution of PHPMailer
			$params['alertMsg'] = 
			'<div style="color: red; background-color: rgb(254, 226, 226, 0.5);" class="p-4 mb-4 text-sm rounded-lg" role="alert">
		  		<span class="font-bold"><i class="fas fa-exclamation-triangle"></i> ERROR -</span> The date(s) entered match! Please select another pair of date(s) and try again.
			</div>';

		} elseif((date('d', strtotime($params['resEnd'])) - date('d', strtotime($params['resStart']))) >= 6) {

			$params['alertMsg'] = 
			'<div style="color: red; background-color: rgb(254, 226, 226, 0.5);" class="p-4 mb-4 text-sm rounded-lg" role="alert">
				  <span class="font-bold"><i class="fas fa-exclamation-triangle"></i> ERROR -</span> The amount of days allowed for reservation are no greater than 6 days.
			</div>';
	
		} else {

			// Prevent execution of PHPMailer
			$params['alertMsg'] = 
			'<div style="color: green; background-color: rgb(220, 252, 231, 0.5);" class="p-4 mb-4 text-sm rounded-lg" role="alert">
			  <span class="font-medium"><i class="fas fa-check"></i> Success!</span> Your reservation was received and an email was sent to you with the details of your reservation.
			</div>';

			$params['cleanedEmail']  = filter_var($params['email'], FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);

			//Recipients
			$mail->setFrom('j.inoke@dof.gov.mp', 'Jostan T. Inoke');
			$mail->addAddress($params['cleanedEmail'], $params['name']);     //Add a recipient

			//Content
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->Subject = "QR Code Test from dlnr.cnmi.gov";
			$mail->Body = $params['message'];
			$mail->addStringEmbeddedImage($qr, 'qrcode', 'qr.png', PHPMailer::ENCODING_BASE64);
  
			$params['result'] = $mail->send();
			echo 'Message has been sent';

		}
  
	} catch (Exception $e) {
	  
	  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
	  
	}
  
	return $params;
    unset($params);

}

?>
