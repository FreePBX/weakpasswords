<?php
//Copyright (C) 2009 Ethan Schreoder (ethan.schroeder@schmoozecom.com)
//
//This program is free software; you can redistribute it and/or
//modify it under the terms of version 2 of the GNU General Public
//License as published by the Free Software Foundation.
//
//This program is distributed in the hope that it will be useful,
//but WITHOUT ANY WARRANTY; without even the implied warranty of
//MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//GNU General Public License for more details.

// Remove all weak password notifications
$nt = notifications::create($db);
$security_notifications = $nt->list_security();
foreach($security_notifications as $notification)  {
	if($notification['module'] == "weakpasswords")  {
		$nt->delete($notification['module'],$notification['id']);
	}
}

?>
