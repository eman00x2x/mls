<?php

namespace Library;

// no direct access
defined( 'ACCESS' ) or die( 'Restricted access' );

class Validator {

    var $errors = []; // A variable to store a list of error messages

    // Validate something's been entered
    // NOTE: Only this method does nothing to prevent SQL injection
    // use with addslashes() command
    function validateGeneral($theinput,$description = ''){
        if (trim($theinput)) {
            return true;
        }else{
            $this->errors[] = $description;
            return false;
        }
    }
    
    // Validate text only
    function validateTextOnly($theinput,$description = ''){
        $result = preg_match("/^[A-Za-z\ .]+$/", $theinput );
        if ($result){
            return true;
        }else{
            $this->errors[] = $description;
            return false;
        }
    }
	
    // Validate text only, no spaces allowed
    function validateTextOnlyNoSpaces($theinput,$description = ''){
        $result = preg_match("^[A-Za-z0-9]+$", $theinput );
        if ($result){
            return true;
        }else{
            $this->errors[] = $description;
            return false;
        }
    }
	
	 // Validate alphanumeric only, spaces allowed
    function validateAlphaNumeric($theinput,$description = ''){
        $result = preg_match("/^[A-Za-z0-9- ]+$/", $theinput );
        if ($result){
            return true;
        }else{
            $this->errors[] = $description;
            return false;
        }
    }
		
	// validate username
	function validateUsername($theusername,$description = '') {
        $result = preg_match('/^[a-z0-9.-_]+$/', $theusername);
        if ($result){
            return true;
        }else{
            $this->errors[] = $description;
            return false;
        }
	}
	
	// Validate Confirm Password
	function confirmPassword($pass1,$pass2,$description = '') {
		if($pass1 == $pass2) {
			return true;
		}else {
			$this->errors[] = $description;
			return false;
		}
	}
        
    // Validate email address
    function validateEmail($themail,$description = ''){
        $result = preg_match("/^[^@ ]+@[^@ ]+\.[^@ \.]+$/", $themail );
        if ($result){
            return true;
        }else{
            $this->errors[] = $description;
            return false;
        }
            
    }
    
    // Validate numbers only
    function validateNumber($theinput,$description = ''){
        if (is_numeric($theinput)) {
            return true; // The value is numeric, return true
        }else{
            $this->errors[] = $description; // Value not numeric! Add error description to list of errors
            return false; // Return false
        }
    }
    
    // Validate date
    function validateDate($thedate,$description = ''){

        if (strtotime($thedate) === -1 || $thedate == '') {
            $this->errors[] = $description;
            return false;
        }else{
            return true;
        }
    }
	
	// Validate BOOLEAN
    function validateBoolean($theinput,$description = ''){
        if (($theinput) === false) {
			$this->errors[] = $description; // Value not numeric! Add error description to list of errors
            return false; 
        }else{
            return true; 
        }
    }
	
	// validate length
	function validateLength($theinput,$min,$max,$description = '') {
		if(strlen($theinput) < $min || strlen($theinput) > $max) {
			$this->errors[] = $description;
			return false;
		}else {
			return true;
		}
	}

    // Validate BOOLEAN
    function validateJSON($json,$description = ''){
        $obj = json_decode($json);
        if ($obj === null) {
            return false; 
			$this->errors[] = $description; // Value not numeric! Add error description to list of errors
        }else{
            return true; 
        }
    }

    function validateMobileNumber($theinput, $description) {
        if(!preg_match('/^[0-9]{11}+$/', $theinput)) {
            $this->errors[] = $description;
            return false;
        }else { return true; }
    }

    // Check whether any errors have been found (i.e. validation has returned false)
    // since the object was created
    function foundErrors() {
        if (count($this->errors) > 0){
            return true;
        }else{
            return false;
        }
    }

    // Return a string containing a list of errors found,
    // Seperated by a given deliminator
    function listErrors($delim = ' '){
        return implode($delim,$this->errors);
    }
    
    // Manually add something to the list of errors
    function addError($description){
        $this->errors[] = $description;
    }

    // validate Words
	function validateWords($input,$description = '') {
        if (!in_array($input,$this->restrictedWords())){
            return true;
        }else{
            $this->errors[] = $description;
            return false;
        }
	}

    function restrictedWords() {
		$restricted_words = "about access account accounts add address adm admin administration administrator adult ";
		$restricted_words .= "advertising affiliate affiliates ajax analytics android anon anonymous api ";
		$restricted_words .= "apple app apps archive atom auth authentication avatar ";
		$restricted_words .= "backup banner banners bin billing blog blogs board bot bots business ";
		$restricted_words .= "chat cache cadastro calendar campaign careers cgi client cliente code comercial ";
		$restricted_words .= "compare config connect contact contest create code compras css ";
		$restricted_words .= "dashboard data db design delete demo design designer dev devel dir directory";
		$restricted_words .= "doc docs domain download downloads edit editor email ecommerce ";
		$restricted_words .= "forum forums faq favorite feed feedback flog follow file files free ftp";
		$restricted_words .= "gadget gadgets games guest group groups ";
		$restricted_words .= "help home homepage host hosting hostname html http httpd https hpg ";
		$restricted_words .= "info information image img images imap index invite intranet indice ipad iphone irc ";
		$restricted_words .= "java javascript job jobs js ";
		$restricted_words .= "knowledgebase ";
		$restricted_words .= "log login logs logout list lists ";
		$restricted_words .= "mail mail1 mail2 mail3 mail4 mail5 mailer mailing mx manager marketing master me media message ";
		$restricted_words .= "microblog microblogs mine mp3 msg msn mysql messenger mob mobile movie movies music musicas my ";
		$restricted_words .= "name named net network new news newsletter nick nickname notes noticias ns ns1 ns2 ns3 ns4 ";
		$restricted_words .= "old online operator order orders ";
		$restricted_words .= "page pager pages panel password perl pic pics photo photos photoalbum php plugin plugins pop pop3 post ";
		$restricted_words .= "postmaster postfix posts profile project projects promo pub public python ";
		$restricted_words .= "random register registration root ruby rss ";
		$restricted_words .= "sale sales sample samples script scripts secure send service shop sql signup signin search security ";
		$restricted_words .= "settings setting setup site sites sitemap smtp soporte ssh stage staging start subscribe subdomain ";
		$restricted_words .= "suporte support stat static stats status store stores system ";
		$restricted_words .= "tablet tablets tech telnet test test1 test2 test3 teste tests theme themes tmp todo task tasks tools tv talk ";
		$restricted_words .= "update upload url user username usuario usage ";
		$restricted_words .= "vendas video videos visitor ";
		$restricted_words .= "win ww www www1 www2 www3 www4 www5 www6 www7 wwww wws wwws web webmail website websites webmaster workshop ";
		$restricted_words .= "xxx xpg you yourname yourusername yoursite yourdomain ";
		$restricted_words .= "anal anus arse ass ballsack balls bastard bitch biatch bloody blowjob bollock bollok boner ";
		$restricted_words .= "boob bugger bum butt buttplug clitoris cock coon crap cunt damn dick dildo dyke fag feck ";
		$restricted_words .= "fellate fellatio felching fuck fudgepacker fudge packer flange Goddamn God damn hell homo ";
		$restricted_words .= "jerk jizz knobend knob end labia lmao lmfao muff nigger nigga omg penis piss poop prick pube ";
		$restricted_words .= "pussy queer scrotum sex shit sh1t slut smegma spunk tit tosser turd twat vagina wank whore wtf ";
	
		return explode(" ",$restricted_words);
	
	}
        
}

/*

// sample usage

require_once('Validator.php');

// Create an instance of Validator

$validator = new Validator();

// Will check that the input is TEXT ONLY, replace with validateNumber for a number etc
$validator->validateTextOnly($_POST['name'],'Your Name');
        if ( $validator->foundErrors() ){  // check if there are any errors
            // Show any errors, with a line between each
            echo 'There was a problem with: <br>'.$validator->listErrors('<br />');
            
        }else{
            // Do whatever you want to do if its a good input.
        }
*/
?>