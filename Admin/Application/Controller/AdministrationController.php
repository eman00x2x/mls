<?php

namespace Admin\Application\Controller;

use Ifsnop\Mysqldump as IMysqldump;
use Library\Configuration;
use Verot\Upload\Upload as Upload;

class AdministrationController extends \Main\Controller {

	public $doc;
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."/Admin");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}
	
	function index() {

		$this->doc->setTitle("Database Administration");

		$this->doc->addStyleDeclaration("
			#csvBrowse {
				display:none;
				position: absolute;
				left:-100000px;
			}
		");

		$this->doc->addScriptDeclaration("

			$(document).on('click','.btn-submit-admin-form',function() {
				if($('#query').val() == '') {
					alert('Please enter your Sql Query');
				}else {
					$('.query_result').html(\"<div class='d-flex gap-3 align-items-center justify-content-center'><div class='loader'></div> <p class='p-0 m-0'>Loading results...</p></div>\");
					$.post('".url("AdministrationController@queryResult")."',$('#form').serialize(), function(data,status) {
						$('.query_result').html(data);
					});
				}
			});

			$(document).on('click','.btn-backup',function() {

				$(this).addClass('d-none');

				$('.response').addClass('bg-white p-4');
				$('.response').html(\"<div class='d-flex gap-3 align-items-center'><div class='loader'></div> <p class='p-0 m-0'>Dumping database data to a file...</p></div>\");

				$.get('".url("AdministrationController@backupDatabase")."',function(data,status) {
					$('.response').html(data);
					$('.btn-backup').removeClass('d-none');
					$('.response').removeClass('bg-white p-4');
				});
			});

			$(document).on('click','.btn-delete-backup',function() {
				url = $(this).data('url');

				c = confirm('Are you sure do you want to delete the selected backup?');
				
				if(c === true) {
					$.get(url, function(data) {
						$('.response').html(data);
					});
				}

			});

			$(document).on('click','.show_table',function() {
				query = $(this).data('query');
				$('#query').val(query);
			});

			$(document).on('submit', '#csvUploadForm', (function(e) {
				
				e.preventDefault();
				var formData = new FormData(this);
				
				$('.btn-upload-csv').hide();

				$.ajax({
					type:'POST',
					url: $(this).attr('action'),
					data:formData,
					cache:false,
					contentType: false,
					processData: false,
					beforeSubmit:function(e) {},
					error: function(data){
						console.log('error');
						console.log(data);
					}
				}).done(function(data) {
					response = JSON.parse(data);
					$('.response').html(response.message);
					$('.btn-upload-csv').show();
					$('#csvBrowse').val('');
				});

            }));

			$(document).on('change', '#csvBrowse',function() {
				$('.response').html(\"<div class='bg-white p-3 mt-3 rounded'><div class='d-flex gap-3 align-items-center'><div class='loader'></div><p class='mb-0'>Please wait file is attaching...</p></div></div>\");
				$('#csvUploadForm').submit();
			});
			
			$(document).on('click','.btn-upload-csv',function() {
				$('#csvBrowse').click();
			});

		");
		
		$data['tables'] = [
			"mls_accounts",
			"mls_account_subscriptions",
			"mls_articles",
			"mls_deleted_threads",
			"mls_handshakes",
			"mls_kyc",
			"mls_leads",
			"mls_license_reference",
			"mls_listings",
			"mls_listing_images",
			"mls_messages",
			"mls_notifications",
			"mls_page_ads",
			"mls_premiums",
			"mls_settings",
			"mls_threads",
			"mls_traffics",
			"mls_transactions",
			"mls_users",
			"mls_user_login"
		];

		$path = ROOT."/Admin/DATABASE_BACKUP";
		$data['backup_files'] = array_values(array_diff(scandir($path), array('.', '..')));

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
					
					echo '<th class="text-center">' . strtoupper($meta[$i]->name) . '</th>';
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
						echo '<td class="fs-12 align-middle text-center">' . $c_row . '</td>';
						next($row);
						$y = $y + 1;
					}
					echo '</tr>';
					$i = $i + 1;
				}
				echo '</tbody>';
				echo '</table></div>';
				$db->freeResult($result);
			}else {
				echo "<p>Executed but no results.</p>";
			}
		}
		
	}
	
	function backupDatabase() {

		require_once(ROOT."/Vendor/ifsnop/mysqldump-php/src/Ifsnop/Mysqldump/Mysqldump.php");

		$db = \Library\Factory::getDBO();
		$config = new Configuration();

		$mysql_backup_file = 'backup-'.date("Y-m-d-g-iA",strtotime("NOW")).'.sql';

		try {

			$dump = new IMysqldump\Mysqldump('mysql:host='.$config->db_host.';dbname='.$config->db_name.'', $config->db_user, $config->db_pass);
			$dump->start(ROOT."/Admin/DATABASE_BACKUP/".$mysql_backup_file);
			
			$this->getLibrary("Factory")->setMsg("Successfully save the backup <i>$mysql_backup_file</i>.","success");

			echo getMsg();

		} catch (\Exception $e) {
			echo 'mysqldump-php error: ' . $e->getMessage();
		}

		exit();

	}

	function downloadBackup() {

		$url = url("AdministrationController@downloadBackup", null, ["file" => $_GET['file']]);
		$filename = $_GET['file'];
		$local_path = ROOT."/Admin/DATABASE_BACKUP";

		header("Content-Description: File Transfer");
		header('Content-Type: application/octet-stream');
		header("Content-disposition: attachment; filename=\"" . $filename . "\""); 
		header('Expires: 0');
    	header('Cache-Control: must-revalidate');
    	header('Pragma: public');
		header("Content-length: ".filesize($local_path."/".$filename));

		readfile($local_path."/".$filename); 
		exit();

	}

	function deleteBackup() {

		if(!isset($_GET['file'])) {
			$this->getLibrary("Factory")->setMsg("Can't find file.","error");
			echo getMsg();
		}

		$local_path = ROOT."/Admin/DATABASE_BACKUP";
		unlink($local_path."/".$_GET['file']);

		$this->getLibrary("Factory")->setMsg("Database backup file deleted.","success");
		echo getMsg();
		
		exit();

	}

	function uploadCSV() {

		$handle = new Upload($_FILES['csvBrowse']);

		if ($handle->uploaded) {

			$handle->mime_check = true;
			$handle->file_safe_name = true;

			$file = explode(".", $handle->file_src_name );
			$ext = array_pop($file);

			if($ext === "csv") {

				$handle->Process(ROOT."/Cdn/images/temporary/");

				if ($handle->processed) {

					$the_file = ROOT."/Cdn/emails.csv";

					if(file_exists($the_file)) {
						unlink(ROOT."/Cdn/emails.csv");
					}

					rename(
						ROOT."/Cdn/images/temporary/".$handle->file_dst_name,
						ROOT."/Cdn/emails.csv"
					);

					$this->getLibrary("Factory")->setMsg("CSV uploaded successfully.", "success");

					return json_encode([
						"status" => 1,
						"message" => getMsg()
					]);
					
				}else {

					$this->getLibrary("Factory")->setMsg("CSV uploaded failed! Please try again.", "error");
					return json_encode([
						"status" => 2,
						"message" => getMsg()
					]);
				}

			}else {
				$this->getLibrary("Factory")->setMsg("Invalid file format", "error");
				return json_encode([
					"status" => 2,
					"message" => getMsg()
				]);
			}

		}

		$this->getLibrary("Factory")->setMsg("CSV uploaded failed! Please try again.", "error");
		return json_encode([
			"status" => 2,
			"message" => getMsg()
		]);

	}

}