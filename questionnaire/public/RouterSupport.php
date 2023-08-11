<?php
function generateSeoURL($string, $wordLimit = 0){ 
    $separator = '-'; 
     
    if($wordLimit != 0){ 
        $wordArr = explode(' ', $string); 
        $string = implode(' ', array_slice($wordArr, 0, $wordLimit)); 
    } 
 
    $quoteSeparator = preg_quote($separator, '#'); 
 
    $trans = array( 
        '&.+?;'                 => '', 
        '[^\w\d _-]'            => '', 
        '\s+'                   => $separator, 
        '('.$quoteSeparator.')+'=> $separator 
    ); 
 
    $string = strip_tags($string); 
    foreach ($trans as $key => $val){ 
        $string = preg_replace('#'.$key.'#iu', $val, $string); 
    } 
 
    $string = strtolower($string); 
 
    return trim(trim($string, $separator)); 
}

$postTitle = 'Generate SEO Friendly URL from String in PHP'; 
 
$seoFriendlyURL = generateSeoURL($postTitle); 

echo $seoFriendlyURL;
 
// Output will be: generate-seo-friendly-url-from-string-in-php

$postTitle = 'Generate SEO Friendly URL from String in PHP'; 
 
$seoFriendlyURL = generateSeoURL($postTitle, 4); 
echo "<br>". $seoFriendlyURL;
 
// Output will be: generate-seo-friendly-url
?>

