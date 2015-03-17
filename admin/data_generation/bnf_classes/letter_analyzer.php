<?php

function is_vowel($letter) {
  switch(strtolower($letter)) {
    case 'a':
    case 'e':
    case 'i':
    case 'o':
    case 'u':
      return true;
    default:
      return false;
  }
}

?>