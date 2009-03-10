<?php
// Remove all weak password notifications
$nt = notifications::create($db);
$security_notifications = $nt->list_security();
foreach($security_notifications as $notification)  {
	if($notification['module'] == "weakpasswords")  {
		$nt->delete($notification['module'],$notification['id']);
	}
}

?>
