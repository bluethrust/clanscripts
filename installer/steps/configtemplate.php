<?php

$configInput = "<?php

   /*
	* Bluethrust Clan Scripts v4
	* Copyright ".date("Y")."
	*
	* Author: Bluethrust Web Development
	* E-mail: support@bluethrust.com
	* Website: http://www.bluethrust.com
	*
	* License: http://www.bluethrust.com/license.php
	*
	*/
	
	\$dbhost = \"".$_POST['dbhost']."\";
	\$dbuser = \"".$_POST['dbuser']."\";
	\$dbpass = \"".$_POST['dbpass']."\";
	\$dbname = \"".$_POST['dbname']."\";
	
	\$dbprefix = \"".$_POST['tableprefix']."\";
	
	\$MAIN_ROOT = \"".$setMainRoot."\";
	
	
	\$ADMIN_KEY = \"".$_POST['adminkey']."\"; // KEY FOR EXTRA SECURITY WHEN ADDING CONSOLE OPTION
	
	define(\"ADMIN_KEY\", \$ADMIN_KEY);

?>
";

?>