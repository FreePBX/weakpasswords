<?php
/* $Id: */
if (!defined('FREEPBX_IS_AUTH')) { die('No direct script access allowed'); }
//	License for all code of this FreePBX module can be found in the license file inside the module directory
//	Copyright 2013 Schmooze Com Inc.
//

//Both of these are used for switch on config.php
$display = isset($_REQUEST['display'])?$_REQUEST['display']:'weakpasswords';

$action = isset($_REQUEST['action'])?$_REQUEST['action']:'';
$email = isset($_REQUEST['email'])?$_REQUEST['email']:'';

?>
<div class="container-fluid">
	<h1><?php echo _('Weak Password Detection')?></h1>
	<div class = "display full-border">
		<div class="row">
			<div class="col-sm-12">
				<div class="fpbx-container">
					<div class="display full-border">
						<table id="weakpasswords" class="table table-striped">
							<thead>
								<tr>
									<th class="col-sm-2"> <?php echo _("Type")?> </th>
									<th class="col-sm-2"> <?php echo _("Name")?> </th>
									<th class="col-sm-2"> <?php echo _("Secret")?> </th>
									<th class="col-sm-6"> <?php echo _("Message")?> </th>
								</tr>
							</thead>
							<tbody>
								<?php
								$weak = weakpasswords_get_users();
								if(sizeof($weak) > 0)  {
									foreach ($weak as $details) {
										echo '<tr><td>'.$details['deviceortrunk'].'</td><td>'.$details['name'].'</td><td>'.$details['secret'].'</td><td>'.$details['message']."</td></tr>";
									}
								} else  {
									echo "<tr><td colspan=3>"._("No weak secrets detected on this system.")."</td></tr>";
								}
								// implementation of module hook
								$module_hook = moduleHook::create();
								echo $module_hook->hookHtml;
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
