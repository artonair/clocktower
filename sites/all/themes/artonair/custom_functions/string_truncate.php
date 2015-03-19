<?php 
/*
from http://www.the-art-of-web.com/php/truncate

Truncation from sentence breaks:
$shortdesc = stringTruncate($description, 300);

Truncation at word breaks:
$shortdesc = stringTruncate($description, 300, " ");

*/

function closeHtmlTags($html) {
  preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iUs', $html, $result);
  $openedtags = $result[1];
  preg_match_all('#</([a-z]+)>#iUs', $html, $result);
  $closedtags = $result[1];
  $len_opened = count($openedtags);
  if (count($closedtags) == $len_opened) {
    return $html;
  }
  $openedtags = array_reverse($openedtags);
  for ($i=0; $i < $len_opened; $i++) {
    if (!in_array($openedtags[$i], $closedtags)) {
      $html .= '</'.$openedtags[$i].'>';
    } else {
      unset($closedtags[array_search($openedtags[$i], $closedtags)]);
    }
  }
  return $html;
} 


function stringTruncate($string, $limit, $break=" ", $pad="...", $links=FALSE) {

  $string = preg_replace("/(<(\/)?p>)/sU", "$2", $string);

  //strip content within <a href="...> tags so that that isn't counted
  $string_without_urls = preg_replace("/(<a\s*href=.*\s*>(.*)<\/a>)/sU", "$2", $string);
//  $string_without_urls = preg_replace("/(<\/a>)/sU", "", $string);

  // return with no change if string is shorter than $limit
  if(strlen($string_without_urls) <= $limit) { 
    if($links) return $string;
    else return closeHtmlTags($string_without_urls);
  }

  if($links) {

    preg_match_all("/(<a .*>(.*)<\/a>)/Us", $string, $match, PREG_OFFSET_CAPTURE);  // get the matches

    // if string is longer than limit

    // for each offset that the marker is past,
    // if the marker is strlen(text-within-the-a) past the offset,
    // add strlen(A HREF TEXT) to the marker, subtract strlen(text-within-the-a)

    $marker = $limit;
    for($i = 0; $i < count($match[1]); $i++) {
      if($marker > ($match[1][$i][1] + strlen($match[2][$i][0])) ) //if marker is past offset + strlen(text within a-tags)
	$marker = $marker + strlen($match[1][$i][0]) - strlen($match[2][$i][0]); 
    }
 
  } else {

    $string = substr($string_without_urls, 0, $limit);
    if(false !== ($breakpoint = strrpos($string, $break))) {
      $string = substr($string, 0, $breakpoint);
    }

  }
  return closeHtmlTags($string) . $pad; 
}



?>
