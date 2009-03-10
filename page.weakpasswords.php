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

$display = isset($_REQUEST['display'])?$_REQUEST['display']:'weakpasswords';

?>

</div>
<p>
<?

	echo "<table><tr><td><div class='content'><h2>"._("Weak Password Detection")."</h2></span></td></tr>\n";
?>
	<tr>
	<td valign="top"> 
	
	<?php 
	if (is_null($selected)) $selected = array();
	$weak = weakpasswords_get_users();
	if(sizeof($weak) > 0)  {
		foreach ($weak as $device => $message) {
			echo "Device $device: $message<br>";
		
		}
	}
	else  {
		echo "No weak secrets detected on this system.";
	}
	?>
	</td></tr>

<?php
			// implementation of module hook
			// object was initialized in config.php
			echo $module_hook->hookHtml;
?>
	
	</table>
