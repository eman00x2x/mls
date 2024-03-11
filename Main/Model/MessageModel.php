<?php

namespace Main\Model;

use Library\Encrypt;

class MessageModel extends \Main\Model {

	/* content column schema
		$content = [
			"type" => "text|image|file",
			"message" => "some message to be sent to recipient",
			"info" => [
				"links" => [urls]
			]
		];
	*/

	function __construct() {
		$this->table = "messages";
		$this->primary_key = "message_id";
		$this->init();
	}

	function getLastMessage($thread_id) {

		$this->where(" thread_id = ".$thread_id);
		$this->and(" message_id = (SELECT MAX(message_id) FROM #__".$this->table.") ");
        $result = $this->getList();

		if($result) {
			return $result[0];
		}

		return false;

	}

	function getByThreadId(int $thread_id) {
        $this->where(" thread_id = ".$thread_id);
        return $this->getList();
    }

	function saveNew($data) {

		$v = $this->getValidator();

		$v->validateGeneral($data['thread_id'],"Does not have thread_id");
		$v->validateGeneral($data['user_id'],"User is required");
		$v->validateGeneral($data['created_at'],"Time sent is required");

		if($v->foundErrors()) {
			return array(
				"status" => 2,
				"type" => "error",
				"message" => "<h4 class='font-weight-bold'>Error</h4> * ".$v->listErrors('<br/> * ')
			);
		}else {

			/* if(isset($data['content']['info']['links']) && is_array($data['content']['info']['links'])) {
				for($i=0; $i<count($data['content']['info']['links']); $i++) {
					$data['content']['info']['links'][$i] = $this->moveUploadedAttachment(basename($data['content']['info']['links'][$i]));
				}
			} */

			foreach($data as $key => $val) {
				$this->column[$key] = $val;
			}

			$id = $this->insert();

			return array(
				"status" => 1,
				"type" => "success",
				"id" => $id,
				"message" => "Successfully saved"
			);

		}
	}

	function save($id,$data) {

		$this->column[$this->primary_key] = $id;

		if(($this->getById()) !== false) {

			$v = $this->getValidator();

			if($v->foundErrors()) {
				return array(
					"status" => 2,
					"type" => "error",
					"message" => "Please correct the following: ".$v->listErrors(', ')
				);
			}else {

				foreach($data as $key => $val) {
					$this->column[$key] = $val;
				}

				$this->update();

				return array(
					"status" => 1,
					"type" => "success",
					"message" => "Successfully saved"
				);

			}
		}

	}

	function deleteMessage($id,$column = "message_id") {

		$this->delete($id,$column);

		return array(
			"status" => 1,
			"type" => "success",
			"message" => "Successfully Deleted"
		);

	}

	function getContentType($content) {

		if(preg_match('/(jpg|jpeg|png|gif)/', $content, $matches)) {
			return "image";
		}else if(preg_match('/(http|https)/', $content, $matches)) {
			return "link";
		}else if(preg_match('/(pdf)/', $content, $matches)) {
			return "file";
		}else {
			return "text";
		}

	}

	function moveUploadedAttachment($filename) {

        $old_dir = ROOT.DS."Cdn".DS."public".DS."temporary".DS.$filename;

		if(file_exists($old_dir)) {

			$name = explode(".",$filename);
			$ext = array_pop($name);

			if($ext != 'pdf') {
				$length = 50;
				$new_name = '';
				$chars = range(0, 9);

				for ($x = 0; $x < $length; $x++) {
					$new_name .= $chars[array_rand($chars)];
				}

				$filename = $new_name."_".md5(time()).".".$ext;
			}
			
			$new_dir = ROOT.DS."Cdn".DS."public".DS."chat".DS.$filename;
			rename($old_dir,$new_dir);

			return $filename;
		}

	}

	function uploadAttachment($data) {

		require_once(ROOT.DS."vendor".DS."upload".DS."upload.php");
		
		$files = array();
		foreach ($data as $k => $l) {
			foreach ($l as $i => $v) {
				if (!array_key_exists($i, $files))
					$files[$i] = array();
					$files[$i][$k] = $v;
			}
		}
		
		foreach ($files as $file) {

			$handle = new \Vendor\Upload\Upload($file); 

			if ($handle->uploaded) {
			
				$handle->file_safe_name = true;

				$handle->file_max_size = '6000000'; // 6MB
				$handle->allowed = array('image/*','application/pdf');
				
				if($handle->image_src_x > 800) {
					$handle->image_resize = true;
					$handle->image_x = 800;
					$handle->image_ratio_y = true;
				}
				
				$file_size = $handle->file_src_size;

				if($file_size >= $handle->file_max_size) {
					\Library\Factory::setMsg("There was an error uploading your file \"".$file['name']."\". Only image and pdf are allowed and less than 5MB file sizes are allowed, Please check your file size before uploading.","wrong");
					
					$uploadedImages[] = array(
						"status" => 2,
						"message" => getMsg()
					);
				}

				$handle->Process(ROOT."Cdn/public/temporary/"); 
				
				if ($handle->processed) {

					$new_filename = $this->moveUploadedAttachment($handle->file_dst_name);
				
					$uploadedImages[] = array(
						"status" => 1,
						"id" => rand(1000,10000).time(),
						"temp_url" => CDN."public/temporary/".$handle->file_dst_name,
						"url" => CDN."public/chat/".$new_filename,
						"filename" => $new_filename
					);

				}else {

					\Library\Factory::setMsg("There was an error uploading your file \"".$file['name']."\". Only image and pdf are allowed and less than 5MB file sizes are allowed, Please check your file size before uploading.","wrong");
					
					$uploadedImages[] = array(
						"status" => 2,
						"message" => getMsg()
					);
					
				}
			}else {
				\Library\Factory::setMsg("There was an error uploading your file \"".$file['name']."\". Only image and pdf are allowed and less than 5MB file sizes are allowed, Please check your file size before uploading.","wrong");
				$uploadedImages[] = array(
					"status" => 2,
					"message" => getMsg()
				);
			}

			unset($handle);
		}
		
		return json_encode($uploadedImages);

	}

	function removeAttachment($filename) {

		$file_temp = ROOT.DS."Cdn".DS."public".DS."temporary".DS.$filename;
		$file = ROOT.DS."Cdn".DS."public".DS."chat".DS.$filename;
		
		/* check file if exists in main folder */
		if(file_exists($file)) {
			@unlink($file);
			return true;
		}else if(file_exists($file_temp)) {
			@unlink($file_temp);
			return true;
		} else {
			return false;
		}
		
	}

	function encrypt($message) {
		return Encrypt::getInstance()->encrypt($message);
	}

	function decrypt($message) {
		return Encrypt::getInstance()->decrypt($message);
	}

}
