<?php 

include ('./simple_html_dom.php');

// Initialize cURL
$ch = curl_init();

// CURLOPT_URL = The URL to fetch
// CURLOPT_TRANSFERTEXT = Retrieves data in plain text instead of HTML
$html = array(
    file_get_html(filter_var('https://www.saipantribune.com/?s=dlnr', FILTER_SANITIZE_URL, FILTER_VALIDATE_URL)),
    file_get_html(filter_var('https://www.saipantribune.com/index.php/page/2/?s=dlnr', FILTER_SANITIZE_URL, FILTER_VALIDATE_URL)),
    file_get_html(filter_var('https://www.saipantribune.com/index.php/page/3/?s=dlnr', FILTER_SANITIZE_URL, FILTER_VALIDATE_URL))
);

// Iterate through URLs
foreach ($html as $url) {

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_TRANSFERTEXT, true);

    $list = $url->find('div[class="blog-item-holder"]', 0);
    $list2 = $url->find('feed', 0);

    // Loop through array to get those div's and output data
    foreach ($list->find('div[class="gdl-blog-medium"]') as $element) {

        $link = $element->find('a');

        echo str_replace('&amp;', '&', '<div class="flex flex-col items-start space-y-2 bg-white p-2 rounded-md">'.str_replace('<updated>2022-12-05T08:10:15+10:00</updated>', '<updated>2022-12-05T08:10:15+10:00</updated>', $element,).'<div class="px-4"><a href="'.$link[0]->href.'" target="_blank" rel="noopener noreferrer" class="text-sm text-red-900 font-medium">Read on Saipan Tribune <span><i class="fas fa-arrow-circle-right"></i></span></a></div></div>');
    
    }

// Prevent memory leak
$url->clear();
unset($url);

}

// Execute cURL
$response = curl_exec($ch);

// Close a cURL session and free all resources
curl_close($ch);

?>