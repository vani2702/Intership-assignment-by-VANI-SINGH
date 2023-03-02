<?php
function findLongestPalindrome($str) {
  $str = strtolower($str); // convert string to lowercase
  $max_palindrome = '';
  
  for ($i = 0; $i < strlen($str); $i++) {
    for ($j = $i + 1; $j < strlen($str); $j++) {
      $sub_str = substr($str, $i, $j - $i + 1);
      if ($sub_str == strrev($sub_str) && strlen($sub_str) > strlen($max_palindrome)) {
        $max_palindrome = $sub_str;
      }
    }
  }
  
  return $max_palindrome;
}

$str = "racecar is a palindrome, but not kayak or level";
$longest_palindrome = findLongestPalindrome($str);
echo "The longest palindrome in '$str' is '$longest_palindrome'";
?>