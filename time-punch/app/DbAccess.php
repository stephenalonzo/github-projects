<?php 

function dbAccess($params) {

	try {

		// Establish connection with the localhost
		
		// localhost
		$pdo = new PDO("mysql:host=localhost;dbname=github_projects", 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

		// // 000webhost
		// $pdo = new PDO("mysql:host=localhost;dbname=id20312172_github_projects", 'id20312172_adminw', '%Qm#})M|In5fbEbv', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

		// Prepare various SQL statements through a foreach loop
		foreach ($params['dba'] as $key => $value) { $stmt = $pdo->prepare($params['dba'][$key]); }

		// Execute bindParam after SQL statement
		$stmt->execute($params['bind_params']);

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

		if ($key == 'emp_number') {

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

?>