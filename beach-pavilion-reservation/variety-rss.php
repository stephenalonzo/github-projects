<?php

include('./simple_html_dom.php');

// Initialize cURL
$ch = curl_init();

// CURLOPT_URL = The URL to fetch
// CURLOPT_TRANSFERTEXT = Retrieves data in plain text instead of HTML
$html = file_get_html(filter_var('https://www.mvariety.com/search/?f=atom&q=dlnr&d1=2022-01-01&d2=2022-12-31&sd=desc&l=9&t=article&nsa=eedition', FILTER_SANITIZE_URL, FILTER_VALIDATE_URL));
curl_setopt($ch, CURLOPT_URL, $html);
curl_setopt($ch, CURLOPT_TRANSFERTEXT, true);

$list = $html->find('feed', 0);

// Loop through array to get those div's and output data
foreach ($list->find('updated') as $pub) {
    $updated[] = $pub->plaintext;
}

$parsed = str_replace($updated[0], '<updated>'.date('c').'</updated>', $list);

if ($parsed) {
    // Loop through array to get those div's and output data
    foreach ($list->find('entry') as $element) {

        $link = $element->find('link[href]');

        echo '<div class="flex flex-col items-start space-y-2 bg-white p-2 rounded-md">' . $element . '<div class="px-4"><a href="' . $link[0]->href . '" target="_blank" rel="noopener noreferrer" class="text-sm text-blue-500 font-medium">Read on Marianas Variety <span><i class="fas fa-arrow-circle-right"></i></span></a></div></div>';
    }
}

// Prevent memory leak
$html->clear();
unset($html);

// Execute cURL
$response = curl_exec($ch);

// Close a cURL session and free all resources
curl_close($ch);
