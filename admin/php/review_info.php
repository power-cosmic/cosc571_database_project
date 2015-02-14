<?php
function generateReviewRating($review) {
  $to_return = '';
  for ($i = 0; $i < 5; $i++) {
    if ($i < $review['rating']) {
      $to_return .= '&#x2605;';
    } else {
      $to_return .= '&#x2606;';
    }
  }
  return $to_return;
}
?>