<?php

	include_once("basic.php");

	class btPluginLoader {
		
		protected $MySQL;
		protected $objPlugin;
		
		public function __construct($sqlConnection) {
			$this->MySQL = $sqlConnection;
			$this->objPlugin = new Basic($sqlConnection, "plugins", "plugin_id");
		}
		
		
		public function loadPlugins($page) {
			
			$returnArr = array();
			
			$query = "SELECT * FROM ".$this->MySQL->get_tablePrefix()."plugin_pages WHERE pagepath = ? ORDER BY ordernum";
			$result = $this->MySQL->prepare($query);
			if($result->execute(array($page))) {
				while($row = $result->fetch_assoc()) {
					
					$this->objPlugin->select($row['plugin_id']);
					
					$returnArr[] = $this->objPlugin->get_info("filepath");
					
					
				}
			}
			
			
			return $returnArr;
			
		}
		
		
	}


?>