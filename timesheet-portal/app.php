<?php 

function dbAccess($params) {

	try {

		// Establish connection with the localhost
		$pdo = new PDO("mysql:host=localhost;dbname=timesheet-portal", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

		// Prepare various SQL statements through a foreach loop
		foreach ($params['dba'] as $key => $value) { $stmt = $pdo->prepare($params['dba'][$key]); }

		// Execute bindParam after SQL statement
		$stmt->execute($params['bindParam']);

		return $stmt;
		
	} catch (PDOException $e) {

		echo "Connection failed: " . $e->getMessage();
  
	}

	return $params;

}

function filterParams($dirty) {

	$map = array(
		// Windows codepage 1252
		"\xC2\x82" => "'", // U+0082â‡’U+201A single low-9 quotation mark
		"\xC2\x84" => '"', // U+0084â‡’U+201E double low-9 quotation mark
		"\xC2\x8B" => "'", // U+008Bâ‡’U+2039 single left-pointing angle quotation mark
		"\xC2\x91" => "'", // U+0091â‡’U+2018 left single quotation mark
		"\xC2\x92" => "'", // U+0092â‡’U+2019 right single quotation mark
		"\xC2\x93" => '"', // U+0093â‡’U+201C left double quotation mark
		"\xC2\x94" => '"', // U+0094â‡’U+201D right double quotation mark
		"\xC2\x9B" => "'", // U+009Bâ‡’U+203A single right-pointing angle quotation mark

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

	// Check what type of data is passing through
	foreach ($_REQUEST as $key => $value) {

		if ($key == 'emp_num') {

			// Decode any HTML that was entered in the input field
			// Strip any HTML tags in the input field
			$dirty[$key]    = html_entity_decode($value);
			$sanitize[$key] = strip_tags($dirty[$key]);

			// Sanitize and filter input
			$params[$key]   = filter_var(str_replace($a, $b, trim($sanitize[$key])), FILTER_SANITIZE_NUMBER_INT, FILTER_VALIDATE_INT | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK);

		} else {

			$dirty[$key]    = html_entity_decode($value);
			$sanitize[$key] = strip_tags($dirty[$key]);
			
			// Sanitize input
			$params[$key]   = filter_var(str_replace($a, $b, trim($sanitize[$key])), FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK);

		}

	}

	return $params;

}

function getPayPeriod($params) {

	$params = filterParams($params);

	$params['dba']['s'] = "SELECT * FROM pay_period";
	$stmt = dbAccess($params);

	$params['rowCount'] = $stmt->rowCount();

	if ($params['rowCount'] > 0) {

		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $results;

	} else {

		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $results;

	}

	return $params;

}

function employeeLogin($params) {

	$params 				= filterParams($params);
	$params['pay_period'] 	= getPayPeriod($params);

	if (empty($params['emp_num'])) {

		// do nothing

	} else {

		foreach ($params['pay_period'] as $row) {

			if (date('Y-m-d') >= date('Y-m-d', strtotime($row['pp_start'])) && date('Y-m-d') <= date('Y-m-d', strtotime($row['pp_end']))) {

				// if a row exists containing entered emp_num
				// validate that employee exists
				$params['dba']['s'] = "SELECT * FROM employees WHERE emp_num = :emp_num";
				$params['bindParam'] = array(
					':emp_num'	=> $params['emp_num']
				);

				$stmt = dbAccess($params);
				$results = $stmt->fetch(PDO::FETCH_ASSOC);

				if ($results['emp_num'] == $params['emp_num']) {

					// declare session variables
					$_SESSION['emp_num'] 		= $params['emp_num'];
					$_SESSION['emp_name'] 		= $results['emp_name'];
					$_SESSION['emp_position']	= $results['emp_position'];
					$_SESSION['pp_id']			= $row['pp_id'];
					$_SESSION['punch_token'] 	= bin2hex(random_bytes(8));

					header("Location: index.php");

				} else {

					header("Location: login.php");
		
				}					
				
			} else {

				// non executable

			}

		}

		return $params;

	}

}

function employeeLogout() {

	session_start();
    session_destroy();

	header("Location: login.php");

}

function punchProcess($params) {

	$params = filterParams($params);

	foreach ($_REQUEST as $key => $value) {

		switch ($key) {

			case 'timeIn':

				$params['dba']['i'] = "INSERT INTO employee_punches (emp_name, emp_num, emp_punch_date, emp_time_in, punch_token) VALUES (:emp_name, :emp_num, :emp_punch_date, :emp_time_in, :punch_token)";
				$params['bindParam'] = array(
					':emp_name'			=> $params['emp_name'],
					':emp_num'			=> $params['emp_num'],
					':emp_punch_date'	=> date('Y-m-d'),
					':emp_time_in'		=> date('H:i:s'),
					':punch_token'		=> $_SESSION['punch_token']
				);
			
				dbAccess($params);
		
				if ($params['dba']['i']) {
		
					$params['dba']['u'] = "UPDATE employees SET emp_status = 'IN' WHERE emp_num = :emp_num";
					$params['bindParam'] = array(':emp_num'	=> $params['emp_num']);
				
					dbAccess($params);
		
				}

			break;

			case 'lunchOut':

				$params['dba']['i'] 	= "UPDATE employee_punches SET emp_lunch_out = NOW() WHERE punch_token = :punch_token";
				$params['bindParam'] 	= array(':punch_token'	=> $_SESSION['punch_token']);
			
				dbAccess($params);
		
				if ($params['dba']['i']) {
		
					$params['dba']['u'] 	= "UPDATE employees SET emp_status = 'LUNCH' WHERE emp_num = :emp_num";
					$params['bindParam'] 	= array(':emp_num'	=> $params['emp_num']);
				
					dbAccess($params);
		
				}

			break;

			case 'lunchIn':

				$params['dba']['i'] 	= "UPDATE employee_punches SET emp_lunch_in = NOW() WHERE punch_token = :punch_token";
				$params['bindParam'] 	= array(':punch_token'	=> $_SESSION['punch_token']);
			
				dbAccess($params);
		
				if ($params['dba']['i']) {
		
					$params['dba']['u'] 	= "UPDATE employees SET emp_status = 'IN' WHERE emp_num = :emp_num";
					$params['bindParam'] 	= array(':emp_num'	=> $params['emp_num']);
				
					dbAccess($params);
		
				}

			break;

			case 'timeOut':

				$params['dba']['i'] 	= "UPDATE employee_punches SET emp_time_out = NOW() WHERE punch_token = :punch_token";
				$params['bindParam'] 	= array(':punch_token'	=> $_SESSION['punch_token']);
			
				dbAccess($params);
		
				if ($params['dba']['i']) {

					$_SESSION['punch_token'] = bin2hex(random_bytes(8));
		
					$params['dba']['u'] 	= "UPDATE employees SET emp_status = 'OUT' WHERE emp_num = :emp_num";
					$params['bindParam'] 	= array(':emp_num'	=> $params['emp_num']);
				
					dbAccess($params);
		
				}

			break;

			case 'submitLeave':

				if ($params['leave_type'] == 'AL') {

					$params['dba']['i'] = "INSERT INTO employee_punches (emp_name, emp_num, emp_punch_date, emp_time_in, emp_time_out, punch_token, punch_type) VALUES (:emp_name, :emp_num, :emp_punch_date, :emp_time_in, :emp_time_out, :punch_token, :punch_type)";
					$params['bindParam'] = array(
						':emp_name'			=> $_SESSION['emp_name'],
						':emp_num'			=> $_SESSION['emp_num'],
						':emp_punch_date'	=> date('Y-m-d', strtotime($params['leave_time_in'])),
						':emp_time_in'		=> date('H:i:s', strtotime($params['leave_time_in'])),
						':emp_time_out'		=> date('H:i:s', strtotime($params['leave_time_out'])),
						':punch_token'		=> $_SESSION['punch_token'],
						':punch_type'		=> $params['leave_type']
					);
				
					dbAccess($params);
			
					if ($params['dba']['i']) {
			
						$params['dba']['i'] = "INSERT INTO leave_applications (emp_name, emp_num, leave_type, leave_date, leave_time_in, leave_time_out, reason_for_leave) VALUES (:emp_name, :emp_num, :leave_type, :leave_date, :leave_time_in, :leave_time_out, :reason_for_leave)";
						$params['bindParam'] = array(
							':emp_name'				=> $_SESSION['emp_name'],
							':emp_num'				=> $_SESSION['emp_num'],
							':leave_type'			=> $params['leave_type'],
							':leave_date'			=> date('Y-m-d', strtotime($params['leave_time_in'])),
							':leave_time_in'		=> date('H:i:s', strtotime($params['leave_time_in'])),
							':leave_time_out'		=> date('H:i:s', strtotime($params['leave_time_out'])),
							':reason_for_leave'		=> $params['reason_for_leave']
						);
					
						dbAccess($params);
			
					}

				} elseif ($params['leave_type'] == 'SL') {

					$params['dba']['i'] = "INSERT INTO employee_punches (emp_name, emp_num, emp_punch_date, emp_time_in, emp_time_out, punch_token, punch_type) VALUES (:emp_name, :emp_num, :emp_punch_date, :emp_time_in, :emp_time_out, :punch_token, :punch_type)";
					$params['bindParam'] = array(
						':emp_name'			=> $_SESSION['emp_name'],
						':emp_num'			=> $_SESSION['emp_num'],
						':emp_punch_date'	=> date('Y-m-d', strtotime($params['leave_time_in'])),
						':emp_time_in'		=> '07:30:00',
						':emp_time_out'		=> '16:30:00',
						':punch_token'		=> $_SESSION['punch_token'],
						':punch_type'		=> $params['leave_type']
					);
				
					dbAccess($params);
			
					if ($params['dba']['i']) {
			
						$params['dba']['i'] = "INSERT INTO leave_applications (emp_name, emp_num, leave_type, leave_date, leave_time_in, leave_time_out, reason_for_leave) VALUES (:emp_name, :emp_num, :leave_type, :leave_date, :leave_time_in, :leave_time_out, :reason_for_leave)";
						$params['bindParam'] = array(
							':emp_name'				=> $_SESSION['emp_name'],
							':emp_num'				=> $_SESSION['emp_num'],
							':leave_type'			=> $params['leave_type'],
							':leave_date'			=> date('Y-m-d', strtotime($params['leave_time_in'])),
							':leave_time_in'		=> '07:30:00',
							':leave_time_out'		=> '16:30:00',
							':reason_for_leave'		=> $params['reason_for_leave']
						);
					
						dbAccess($params);
			
					}

				} 

			break;

			default:
			break;

		}
	}

    return $params;

}

function listOfAllEmployees($params) {

    $params['dba']['s'] = "SELECT * FROM employees";
    $stmt = dbAccess($params);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;

}

function singleEmployeeData($params) {

	$params['dba']['s'] = "SELECT * FROM employees WHERE emp_num = :emp_num";
	$params['bindParam'] = array(':emp_num'	=> $_SESSION['emp_num']);
    $stmt = dbAccess($params);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;

}

function singleEmployeeTimesheet($params) {

	$params['dba']['s'] = "SELECT * FROM employee_punches WHERE emp_num = :emp_num";
	$params['bindParam'] = array(':emp_num'	=> $_SESSION['emp_num']);
    $stmt = dbAccess($params);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;

}

function getStaffTimesheet($params) {

	$params = filterParams($params);

	$params['dba']['s'] = "SELECT * FROM employee_punches WHERE emp_num = :emp_num";
	$params['bindParam'] = array(':emp_num'	=> $_GET['emp_num']);
    $stmt = dbAccess($params);

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $results;

}

// function getCurrentPayPeriod($params) {

// 	$params = filterParams($params);

// 	$params['dba']['s'] 	= "SELECT * FROM pay_period WHERE pp_id = :pp_id";
// 	$params['bindParam']	= array(':pp_id'	=> $_SESSION['pp_id']);

// 	$stmt 		= dbAccess($params);
// 	$results 	= $stmt->fetchAll(PDO::FETCH_ASSOC);

// 	foreach ($results as $row) {

// 		if (date('Y-m-d') >= date('Y-m-d', strtotime($row['pp_start'])) && date('Y-m-d') <= date('Y-m-d', strtotime($row['pp_end']))) {

// 			$params['separator'] = explode(" ", $_SESSION['emp_name']);
// 			$params['file_name'] = $params['separator'][0]."-".$params['separator'][1]."_".date("Ymd", strtotime($row['pp_start']))."-".date("Ymd", strtotime($row['pp_end'])).".csv";

// 		}
		
		
// 	}


// 	// echo $params['file_name'];

// 	return $params;

// }

// getCurrentPayPeriod($params);

?>