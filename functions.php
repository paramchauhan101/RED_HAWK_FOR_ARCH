<?php
// Ensure PHP dependencies are installed: php-dom, php-curl, php-cli

function getTitle($url) {
    $data = readContents($url);
    $title = preg_match('/<title[^>]*>(.*?)<\/title>/ims', $data, $matches) ? $matches[1] : "Title Not Found";
    return $title;
}

function userInput($message) {
    global $bold, $lblue, $fgreen;
    $inputStyle = "\e[1;34m[#] $message: \e[0;32m";
    echo $inputStyle;
}

function webServer($url) {
    stream_context_set_default([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
        ],
    ]);
    $headers = @get_headers($url, 1);
    $server = $headers['Server'] ?? "Could Not Detect";
    echo $server ? "\e[92m$server\e[0m" : "\e[91mUnknown\e[0m";
}

function cloudflareDetect($url) {
    $apiUrl = "http://api.hackertarget.com/httpheaders/?q=" . $url;
    $response = @file_get_contents($apiUrl);
    $status = strpos($response, 'cloudflare') !== false ? "\e[91mDetected\e[0m" : "\e[92mNot Detected\e[0m";
    echo $status . "\n";
}

function cmsDetect($url) {
    $content = readContents($url);
    if (strpos($content, '/wp-content/') !== false) return "WordPress";
    if (strpos($content, 'Joomla') !== false) return "Joomla";
    $drupalUrl = $url . "/misc/drupal.js";
    $drupalContent = readContents($drupalUrl);
    if (strpos($drupalContent, 'Drupal') !== false) return "Drupal";
    if (strpos($content, '/skin/frontend/') !== false) return "Magento";
    return "\e[91mCould Not Detect\e[0m";
}

function robotsTxt($url) {
    $robotsUrl = $url . "/robots.txt";
    $handle = curl_init($robotsUrl);
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($handle);
    $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
    curl_close($handle);

    if ($httpCode == 200) {
        echo $response ? "\e[92mFound\n$response\e[0m" : "Found But Empty!";
    } else {
        echo "\e[91mCould NOT Find robots.txt!\e[0m\n";
    }
}

function getHttpHeaders($url) {
    $headers = @get_headers($url);
    if ($headers) {
        foreach ($headers as $header) {
            echo "\n\e[92m[Header] $header";
        }
    } else {
        echo "\e[91mNo Headers Found!\e[0m\n";
    }
    echo "\n";
}

function extractSocialLinks($sourceCode) {
    $socialPlatforms = ['facebook', 'twitter', 'instagram', 'youtube', 'plus.google', 'pinterest', 'github'];
    $socialLinks = [];
    $dom = new DOMDocument;
    @$dom->loadHTML($sourceCode);
    $links = $dom->getElementsByTagName('a');

    foreach ($links as $link) {
        $href = $link->getAttribute('href');
        foreach ($socialPlatforms as $platform) {
            if (strpos($href, "$platform.com/") !== false) {
                $socialLinks[$platform][] = $href;
            }
        }
    }

    foreach ($socialLinks as $platform => $urls) {
        foreach ($urls as $url) {
            echo "\e[96m[ $platform ]\e[0m $url\n";
        }
    }
    if (empty($socialLinks)) echo "\e[91mNo Social Links Found!\e[0m\n";
}

function readContents($url) {
    $options = [
        "ssl" => [
            "verify_peer" => false,
            "verify_peer_name" => false,
        ],
    ];
    return @file_get_contents($url, false, stream_context_create($options)) ?: "";
}
?>
