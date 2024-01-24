<?php

namespace Admin\Application\Controller;

class AdministrationController extends \Application\Controller {
	
	function __construct() {}
	
	function defaultView() {
		
		$classes = $this->getModel("Classes");
		$data['classes'] = $classes->getList();
		
		$this->setTemplate("administration".DS."default.php");
		return $this->getTemplate($data);
		
	}
	
	function queryResult() {
		
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			
			if(!isset($_POST['query'])) {
				die("Invalid Request!");
			}
			
			$db = \Library\Factory::getDBO();
			
			$query = $_POST['query'];
			$result = $db->query($query);
			
			if($result) {
				$i = 0;
				echo "<div class='table-responsive'>";
				echo '<table class="table table-bordered table-striped table-sm table-hover"><thead><tr>';
				while ($i < $db->numFields($result)) {
					$meta = $db->fetchFields($result, $i);
					
					echo '<th style="font-size:10px;">' . strtoupper($meta[$i]->name) . '</th>';
					$i = $i + 1;
				}
				echo '</tr></thead>';
				
				echo '<tbody>';
				$i = 0;
				while ($row = $db->fetchRow($result)) {
					echo '<tr>';
					$count = count($row);
					$y = 0;
					while ($y < $count)
					{
						$c_row = current($row);
						echo '<td style="font-size:12px;">' . $c_row . '</td>';
						next($row);
						$y = $y + 1;
					}
					echo '</tr>';
					$i = $i + 1;
				}
				echo '</tbody>';
				echo '</table></div>';
				$db->freeResult($result);
			}
		}
		
	}
	
	
}