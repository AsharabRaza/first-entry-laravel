<?php
function formatted_date($date, $format = 'M d, Y h:i a') {
    $formatted_Date = date($format, strtotime($date));
    return $formatted_Date;
}
