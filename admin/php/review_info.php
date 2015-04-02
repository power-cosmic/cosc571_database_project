<?php
function generateReview($review) {
  $to_return = '
                    <td class="book-info">' . $review['username'] . '</td>
                    <td class="book-info">' . $review['content'] . '</td>
                    <td class="book-info"><div class="centered">'
                      . generateReviewRating($review) . '</div></td>';
  return $to_return;
}
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