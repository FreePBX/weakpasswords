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

//Both of these are used for switch on config.php
$display = isset($_REQUEST['display'])?$_REQUEST['display']:'weakpasswords';

$action = isset($_REQUEST['action'])?$_REQUEST['action']:'';
$email = isset($_REQUEST['email'])?$_REQUEST['email']:'';

?>
<p>
<?php
	echo "<table cellpadding=5><tr><td colspan=3><div class='content'><h2>"._("Weak Password Detection")."</h2></td></tr>\n";
	echo "<tr><td><b>"._("Type")."</b></td><td><b>"._("Name")."</b></td><td><b>"._("Secret")."</b></td><td><b>"._("Message")."</b></td></tr>";
	$weak = weakpasswords_get_users();
	if(sizeof($weak) > 0)  {
		foreach ($weak as $details) {
			echo '<tr><td>'.$details['deviceortrunk'].'</td><td>'.$details['name'].'</td><td>'.$details['secret'].'</td><td>'.$details['message']."</td></tr>";
		}
	} else  {
		echo "<tr><td colspan=3>"._("No weak secrets detected on this system.")."</td></tr>";
	}
	// implementation of module hook
	// object was initialized in config.php
	echo $module_hook->hookHtml;
?>
	</table>
