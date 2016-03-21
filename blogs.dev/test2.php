<?php
date_default_timezone_set('GMT');
$targetDate = mktime(16, 30, 0, 9, 11, 2012);
$today = time();
$hr = date("H")-4; // optional. Used to change the time to my timezone which is GMT-4.
if ($today < $targetDate) {
print date($hr.":i:s",$today) . '<br />';
}
?>