<?php 
/* $Id: */
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

function weakpasswords_get_config($engine) {
        switch($engine) {
                case "asterisk":
			// Clear all weak password notifications
			$nt = notifications::create($db);
			$security_notifications = $nt->list_security();
			foreach($security_notifications as $notification)  {
				if($notification['module'] == "weakpasswords")  {
					$nt->delete($notification['module'],$notification['id']);
				}
			}
			// Generate new notifications
			$weak = weakpasswords_get_users();
			if(sizeof($weak) > 0)  {
				foreach($weak as $device => $message)  {
					$nt->add_security("weakpasswords", $device, "Weak secret for device $device: $message");
				}

			}
		break;
	}
}

function weakpasswords_get_users()  {
	global $db;

	$sql = "SELECT id as device,data as secret FROM sip WHERE keyword='secret'";
	$sipsecrets = sql($sql,"getAll",DB_FETCHMODE_ASSOC);
	$weak = array();
	foreach($sipsecrets as $sip)  {
		$device = $sip['device'];
		$secret = $sip['secret'];

		$reversed = strrev($secret);
		$match = "0123456789";
		if(strpos($match,$secret) || strpos($match,$reversed))  {
			$weak[$device] = "Secret $secret has sequential digits";
		}
		else if($device == $secret)  {
			$weak[$device] = "Secret $secret is same as device";
		}
		else if(preg_match("/(.)\\1{3,}/",$secret,$regs))  {
			$weak[$device] = "Secret $secret contains consecutive digit ".$regs[1];
		}
		else if(strlen($secret) < 6)  {
			$weak[$device] = "Secret $secret is less than 6 digits long";
		}
	}
	return $weak;
}
?>
