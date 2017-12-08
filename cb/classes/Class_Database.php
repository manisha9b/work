<?php

//session_start();
error_reporting(0);
/*
 * File Name: Database.php
 * Date: September 2010
 * Author: SUJEET G. KARN
 * Description: Contains database connection, result
 *              Management functions, input validation
 *              All functions return true if completed
 *              successfully and false if an error
 *              occurred
 *
 */

class Database {
    /*
     * Edit the following variables
     */

    private $db_host = DB_HOST;     // Database Host
    private $db_user = DB_USER;          // Username
    private $db_pass = DB_PASSWORD;          // Password
    private $db_name = DB_NAME;          // Database
    /*
     * End edit
     */
    private $con = false;               // Checks to see if the connection is active
    public $result = array();          // Results that are returned from the query
    public $innerResult = array();
    public $to_email = '';
    public $subject = '';
    public $auto_response = '';
    public $reply_email = '';
    public $from_email = '';
    public $mailHeader = '';
    public $username = '';
    public $userpwd = '';

    public $userGroupId;
    public $userId;
    public $userDisplayName;
	public $clusterId;
	public $user_id_pk;

	public $hsp_id;
	public $hsp_branch_id;

	public $ebh_customer_id;
	public $customer_name;

    /*
     * Connects to the database, only one connection
     * allowed
     */

    function __construct() {
        $this->userGroupId = $_SESSION['user_group_id'];
        $this->userId = $_SESSION['ref_id'];
        $this->userDisplayName = $_SESSION['user_display_name'];
		$this->clusterId = $_SESSION['cluster_id'];
		$this->user_id_pk= $_SESSION['user_id'];

		$this->hsp_id			= $_SESSION['hsp_id'];
		$this->hsp_branch_id	= $_SESSION['hsp_branch_id'];

		$this->ebh_customer_id	= $_SESSION['ebh_customer_id'];
		$this->customer_name	= $_SESSION['customer_name'];
    }

    public function connect() {
        //echo "db_user".$this->db_user;
        //exit;
        if (!$this->con) {
            $myconn = @mysql_connect($this->db_host, $this->db_user, $this->db_pass);
            if ($myconn) {
                $seldb = @mysql_select_db($this->db_name, $myconn);
                if ($seldb) {
                    $this->con = true;
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return true;
        }
    }

    /*
     * Changes the new database, sets all current results
     * to null
     */

    public function setDatabase($name) {
        if ($this->con) {
            if (@mysql_close()) {
                $this->con = false;
                $this->results = null;
                $this->db_name = $name;
                $this->connect();
            }
        }
    }

    /*
     * Checks to see if the table exists when performing
     * queries
     */

    private function tableExists($table) {
        $tablesInDb = mysql_query('SHOW TABLES FROM ' . $this->db_name . ' LIKE "' . $table . '"') or die(mysql_error());
        if ($tablesInDb) {
            if (mysql_num_rows($tablesInDb) == 1) {
                return true;
            } else {
                return false;
            }
        }
    }

    /*
     * Selects information from the database.
     * Required: table (the name of the table)
     * Optional: rows (the columns requested, separated by commas)
     *           where (column = value as a string)
     *           order (column DIRECTION as a string)
     */

    public function select($sql_query, $res_type = null) {
        $q = $sql_query;

        
        $query = @mysql_query($sql_query) or die(mysql_error());

        if ($query) {
            $this->numResults = mysql_num_rows($query);
            for ($i = 0; $i < $this->numResults; $i++) {
                $r = mysql_fetch_array($query);
                $key = array_keys($r);
                for ($x = 0; $x < count($key); $x++) {
                    // Sanitizes keys so only alphavalues are allowed
                    if (!is_int($key[$x])) {
                        if (mysql_num_rows($query) > 0) {
                            if (!$res_type) {
                                $this->result[$i][$key[$x]] = $r[$key[$x]];
                            } else {
                                $this->innerResult[$i][$key[$x]] = $r[$key[$x]];
                            }
                        } else if (mysql_num_rows($query) < 1) {
                            if (!$res_type) {
                                $this->result = null;
                            } else {
                                $this->innerResult = null;
                            }
                        } else {
                            if (!$res_type) {
                                $this->result[$key[$x]] = $r[$key[$x]];
                            } else {
                                $this->innerResult[$key[$x]] = $r[$key[$x]];
                            }
                        }
                    }
                }
            }
            return true;
        } else {
            return false;
        }
    }

    /*
     * Insert values into the table
     * Required: table (the name of the table)
     *           values (the values to be inserted)
     * Optional: rows (if values don't match the number of rows)
     */

    public function insert($table, $values, $rows = null) {
        if ($this->tableExists($table)) {
            $insert = 'INSERT INTO ' . $table;
            if ($rows != null) {
                $insert .= ' (' . $rows . ')';
            }
            for ($i = 0; $i < count($values); $i++) {
                if (is_string($values[$i])) {
                    if ($values[$i] != 'NULL') {
                        //str_replace('"','',$values[$i]);
                        $values[$i] = '"' . $values[$i] . '"';
                    } else {
                        $values[$i] = $values[$i];
                    }
                }
            }

            //echo $insert;
            $values = implode(',', $values);
            $insert .= ' VALUES (' . $values . ')';
            //echo $insert;

            $ins = mysql_query($insert) or die(mysql_error());
            if ($ins) {
                return true;
            } else {
                return false;
            }
        }
    }

    /*
     * Deletes table or records where condition is true
     * Required: table (the name of the table)
     * Optional: where (condition [column =  value])
     */

    public function delete($table, $where = null) {
        if ($this->tableExists($table)) {
            if ($where == null) {
                $delete = 'DELETE ' . $table;
            } else {
                $delete = 'DELETE FROM ' . $table . ' WHERE ' . $where;
            }
            //echo $delete;
            $del = @mysql_query($delete);

            if ($del) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /*
     * Updates the database with the values sent
     * Required: table (the name of the table to be updated
     *           rows (the rows/values in a key/value array
     *           where (the row/condition in an array (row,condition) )
     */

    public function update($table, $rows, $where) {
        if ($this->tableExists($table)) {
            // Parse the where values
            // even values (including 0) contain the where rows
            // odd values contain the clauses for the row

            $update = 'UPDATE ' . $table . ' SET ';
            $keys = array_keys($rows);
            for ($i = 0; $i < count($rows); $i++) {
                if (is_string($rows[$keys[$i]])) {
                    if ($rows[$keys[$i]] != 'NULL') {
                        $update .= $keys[$i] . '="' . $rows[$keys[$i]] . '"';
                    } else {
                        $update .= $keys[$i] . '=' . $rows[$keys[$i]];
                    }
                } else {
                    $update .= $keys[$i] . '=' . $rows[$keys[$i]];
                }
                // Parse to add commas
                if ($i != count($rows) - 1) {
                    $update .= ',';
                }
            }
            $update .= ' WHERE ' . $where;
           // echo $update;die;

            $query = @mysql_query($update);
            if ($query) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /*
     * Returns the result set
     */

    public function getResult() {
        return $this->result;
    }

    function is_duplicate($feild_name, $table_name, $where) {
        $sql = "select $feild_name from $table_name where " . $where;
        return $this->GET_NUM_ROWS($sql);
    }
    function is_duplicate_data($feild_name,$table_name,$where)
	{
		 $sql="select $feild_name from $table_name where ".$where;
		$query = @mysql_query($sql) or die(mysql_error());
		$r = mysql_fetch_assoc($query);
		return $r;
	}
    function GET_NUM_ROWS($SQL) {
        $QUERY = $SQL;
        $this->select($QUERY);
		return $this->numResults;
    }

    function delete_directory($dirname) {
        if (is_dir($dirname))
            $dir_handle = opendir($dirname);
        if (!$dir_handle)
            return false;
        while ($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname . "/" . $file))
                    unlink($dirname . "/" . $file);
                else
                    delete_directory($dirname . '/' . $file);
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
    }

    function generate_password() {
        //settings
        $chars = "123456789";
        $minchars = 8;
        $maxchars = 8;
        //rest of script
        $escapecharplus = 0;
        $repeat = mt_rand($minchars, $maxchars);
        while ($escapecharplus < $repeat) {
            $randomword.=$chars[mt_rand(1, strlen($chars) - 1)];
            $escapecharplus+=1;
        }
        //display random word
        return $randomword;
    }

    public function findexts($filename) {
        $filename = strtolower($filename);
        $exts = split("[/\\.]", $filename);
        $n = count($exts) - 1;
        $exts = $exts[$n];
        return $exts;
    }

    public function uploadFile($elementName, $uploadPath) {
        $ext = $this->findexts($_FILES[$elementName]['name']);
        $files_name = $_SESSION['ref_id'] . "-" . date('Ymdhis') .rand(10,100). "." . $ext;
        $files_path = $uploadPath;
		$target_path = $files_path . $files_name;

        if (move_uploaded_file($_FILES[$elementName]['tmp_name'], $target_path)) {
            return $files_name;
        } else {
            return 0;
        }
    }

    function sendEmail() {
        $this->mailHeader = "MIME-Version: 1.0\r\nContent-Type: text/html; charset=utf-8\r\nContent-Transfer-Encoding: 8bit\r\nFrom:" . $this->reply_email . "\r\nX-Mailer: PHP/" . phpversion();
        $send = mail($this->to_email, $this->subject, $this->auto_response, $this->mailHeader);
    }

    public function viewLink($module, $dataId) {
        return HTTP_SERVER . 'portal/index.php?module=' . $module . '&page=view&dataId=' . $dataId;
    }

    public function editLink($module, $dataId) {
        return HTTP_SERVER . 'portal/index.php?module=' . $module . '&page=edit&dataId=' . $dataId;
    }

    public function editwcLink($module, $dataId) {
        return HTTP_SERVER . 'portal/index.php?module=' . $module . '&page=editwc&dataId=' . $dataId;
    }

    public function delConfirmLink($module, $dataId) {
        return HTTP_SERVER . 'portal/index.php?module=' . $module . '&page=view&operation=del&dataId=' . $dataId;
    }

    public function deleteLink($module, $dataId) {
        return HTTP_SERVER . 'portal/index.php?module=' . $module . '&page=view&operation=delc&dataId=' . $dataId;
    }

    public function deleteCancelLink($module, $dataId) {
        return HTTP_SERVER . 'portal/index.php?module=' . $module . '&page=view&dataId=' . $dataId;
    }

    public function cancelLink($module) {
        return HTTP_SERVER . 'portal/index.php?module=' . $module;
    }

    public function show_alert($type, $error = NULL) {
        $msg_array =
                array(
                    's' => array('header' => 'Congratulations!!', 'para' => 'Record has been saved successfully.'),
                    'u' => array('header' => 'Congratulations!!', 'para' => 'Record has been updated successfully.'),
                    'd' => array('header' => '', 'para' => 'Record has been deleted successfully.'),
                    'm' => array('header' => 'Congratulations!!', 'para' => 'Message has been sent successfully.'),
                    'kup' => array('header' => 'Congratulations!!', 'para' => 'Keywords has been updated successfully.'),
                    'kn' => array('header' => 'Sorry!!', 'para' => 'No Keywords Assigned. It seems you have not selected any keyword.'),
                    'en' => array('header' => 'Sorry!!', 'para' => 'This username already exists!'),
					'pupd' => array('header' => 'Congratulations', 'para' => 'Purchase price has been updated successfully.'),
					'sales_price' => array('header' => 'Congratulations', 'para' => 'Sales price has been updated successfully.'),

					'shared' => array('header' => 'Congratulations', 'para' => 'Employee data has been shared successfully.'),
					'shared' => array('header' => 'Congratulations', 'para' => 'Invitation process has been executed successfully.<br/><br/><a href="'.HTTP_SERVER.'portal/error-log/import-error-'.$this->clusterId.'.txt" target="blank" class="text-bold">Click here</a> for error-logs'),

                    'password-changed' => array('header' => '', 'para' => 'Password has been changed successfully.'),
                    'incorrect-password' => array('header' => '', 'para' => 'Old password does not match.'),
                    'dup' => array('header' => 'Congratulations', 'para' => 'Documents uploaded successfully'),
                    'blank' => array('header' => '', 'para' => 'All Fields can not be left blank to find contact.'),

                    'hsp-s' => array('header' => 'Congratulations!!', 'para' => 'Form Submitted Successfully!!!<p>&nbsp;</p><p><a href="'.HTTP_SERVER.'portal/index.php?module=hsp-empanelment&form=business-details" class="btn btn-sm btn-success">Add New HSP</a>&nbsp;&nbsp;<a href="'.HTTP_SERVER.'portal/index.php?module=hsp-empanelment-list" class="btn btn-sm btn-warning">My Applications</a></p>'),
                    'emp-vs' => array('header' => 'Congratulations!!', 'para' => 'Verification Completed Successfully!'),
                    'emp-vr' => array('header' => 'Warning:', 'para' => 'Status of HSP Profile has been set to Reopened'),
                    'emp-sk' => array('header' => 'Congratulations!!', 'para' => 'SEO information has been updated successfully.'),
                    'emp-sp' => array('header' => 'Congratulations!!', 'para' => 'Profile has been published successfully.'),

                    'hsp-pc-ps' => array('header' => 'Congratulations!!', 'para' => 'Package has been published successfully.'),
                    'hsp-pc-ups' => array('header' => 'Congratulations!!', 'para' => 'Package has been unpublished successfully.'),

                    'isend' => array('header' => 'Congratulations!!', 'para' => 'Invitation Process Executed Successfully!<div id=\'error_log\'></div>'),
					'isend_err' => array('header' => 'Warning:', 'para' => 'Invitation not sent.'),
                    'aemp' => array('header' => 'Congratulations!!', 'para' => 'New employee added successfully.'),
                    'uemp' => array('header' => 'Congratulations!!', 'para' => 'Employee details updated successfully.'),

                    'sch' => array('header' => 'Congratulations!!', 'para' => 'The Record is updated successfully.'),

                    'new-di' => array('header' => 'Congratulations!!', 'para' => 'New Disease saved successfully.'),
                    'edit-di' => array('header' => 'Congratulations!!', 'para' => 'Disease information has been updated successfully.'),
                    'new-ad' => array('header' => 'Warning:', 'para' => 'The Disease is not available...<p>&nbsp;</p><p><a href="'.HTTP_SERVER.'portal/index.php?module=disease&page=add" class="btn btn-sm btn-success">Create New</a>&nbsp;&nbsp;<a href="'.HTTP_SERVER.'portal/index.php?module=disease" class="btn btn-sm btn-warning">Cancel</a></p>'),
        );

        $content = ($msg_array[$type]['header'] != '') ? '<h3>' . $msg_array[$type]['header'] . '</h3>' : "";

        if ($type == 'incorrect-password' || $type == 'blank' || $error == 1) {
            $html = '
			<div class="alert alert-danger alert-dismissable">
			   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			   ' . $content . '
			   <p>' . $msg_array[$type]['para'] . '</p>
			 </div>';
            return $html;
        } else {
            $html = '
			<div class="alert alert-success alert-dismissable">
			    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			   ' . $content . '
			   <p>' . $msg_array[$type]['para'] . '</p>
			 </div>';
            return $html;
        }
    }

    public function drawList($imagePath, $name, $module, $dataId, $next_line = NULL) {
        if ($imagePath == '') {
            $imagePath = 'images/no_image_thumb.jpg';
        }
        if ($imagePath == 'NA') {
            $img_html = "";
        } else {
            $img_html = '<img src="' . HTTP_SERVER . 'portal/' . $imagePath . '" class="project-img pull-left img-circle"" alt="" /> ';
        }
        $html = '<tr>
				<td>
				 <div class="list-group list-projects">
				 <a href="#" class="">
					' . $img_html . '
					 <div class="row">
						<div class="col-md-9">
						<a href="' . $this->viewLink($module, $dataId) . '">' . $name . '</a>
						</div>
						<div class="col-md-9">
						<small>' . $next_line . '</small>
						</div>
					 </div>
				 </a>
				 </div>
				</td>
			</tr>';
        return $html;
    }

    function drawViewButtons($module, $dataId) {
        $html = '';

        $html .='
			<button type="button" class="btn btn-success  btn-sm" onclick=document.location.href="' . $this->editLink($module, $dataId) . '"><i class="fa fa-pencil"></i> Edit</button>
			<button type="button" class="btn btn-danger btn-sm" onclick=document.location.href="' . $this->delConfirmLink($module, $dataId) . '"><i class="fa fa-trash-o"></i> Delete</button>';

        $html .='
		<button type="button" class="btn btn-warning btn-sm" onclick=document.location.href="' . $this->CancelLink($module, $dataId) . '">Cancel</button>
		';

        return $html;
    }

    function drawDeleteButtons($module, $dataId) {
        $html = '
		<a href="' . $this->deleteLink($module, $dataId) . '" class="btn btn-danger btn-wide">I am sure</a>
      	<a href="' . $this->deleteCancelLink($module, $dataId) . '" class="btn btn-warning btn-wide">Cancel</a>';

        return $html;
    }

    public function getAboutMessage($module) {
        $msg_array =
                array(
                    'lab-test' => array('header' => '', 'para' => "<p>This section help you to maintain all the preventive care lab tests data. </p>"),
                    'ebh-package' => array('header' => '', 'para' => "<p>Here you can define the EBH Standard Packages Only </p>"),
                    'custom-package' => array('header' => '', 'para' => "<p>Here you can define HSP custom Packages </p>"),

        );
        return $msg_array[$module]['para'];
    }

    public function printAbout($module) {
        if($module=='manage-employee')
        {
        $html = '<div class="panel">
            <div class="panel-heading"> <span class="panel-title text-primary">About <i class="fa fa-info-circle"></i></span> </div>
            <div class="panel-body">
             ' . $this->getAboutMessage($module) . '
              <div class="row">
                <div class="col-md-12">
                <a href="javascript:void(0);" class="btn btn-success btn-md btn-animate-demo" role="button" onclick=show_form("'.$module.'");> <i class="fa fa-plus-circle"></i>  Add New</a>
                <a href="index.php?module='.$module.'&page=file" class="btn btn-success btn-md btn-animate-demo" role="button"> <i class="fa fa-plus-circle"></i>  Add New From File</a>
                <a href="' . HTTP_SERVER . 'portal/" class="btn btn-warning  btn-md btn-animate-demo" role="button">Return To Home</a>
                </div>
              </div>
            </div>
        </div>';
        }else{
        $html = '<div class="panel">
            <div class="panel-heading"> <span class="panel-title text-primary">About <i class="fa fa-info-circle"></i></span> </div>
            <div class="panel-body">
             ' . $this->getAboutMessage($module) . '
              <div class="row">
                <div class="col-md-12">
                <a href="javascript:void(0);" class="btn btn-success btn-md btn-animate-demo" role="button" onclick=show_form("' . $module . '");> <i class="fa fa-plus-circle"></i>  Create New ' . ucfirst(str_replace('-', ' ', $module)) . '</a>
                <a href="' . HTTP_SERVER . 'portal/" class="btn btn-warning  btn-md btn-animate-demo" role="button">Return To Home</a>
                </div>
              </div>
            </div>
        </div>';
        }
        return $html;
    }

    public function ConverToUSD() {
        $from = 'INR'; /* change it to your required currencies */
        $to = 'USD';
        $url = 'http://finance.yahoo.com/d/quotes.csv?e=.csv&f=sl1d1t1&s=' . $from . $to . '=X';
        $handle = @fopen($url, 'r');
        if ($handle) {
            $result = fgets($handle, 4096);
            fclose($handle);
        }
        $allData = explode(',', $result); /* Get all the contents to an array */
        $dollarValue = $allData[1];
        return $dollarValue;
    }

    function sendSmtpEmail($mode, $message, $subject, $to_email, $to_name, $acc_id = NULL, $attach = NULL,$from_name=NUll,$from_email=NULL) {
        //$acc_settings = $this->getSettingInfo($acc_id);

        /**
         * This example shows making an SMTP connection with authentication.
         */
        //SMTP needs accurate times, and the PHP time zone MUST be set
        //This should be done in your php.ini, but this is how to do it if you don't have access to that
        //date_default_timezone_set('Etc/UTC');

        date_default_timezone_set('Asia/Calcutta');
        require_once  '../../phpmailer/PHPMailerAutoload.php';
        //Create a new PHPMailer instance
        $mail = new PHPMailer;
        //$mail =	clone $mail;
        //Tell PHPMailer to use SMTP
        //$mail->isSMTP();
        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;
        // secure transfer enabled REQUIRED for GMail
        $mail->SMTPSecure = 'ssl';

		$mail->Host = "smtp.gmail.com";
		$mail->Port = 465;
		$mail->Username = "admin@easybuyhealth.com";
		$mail->Password = "ebh!@#098";

        //Set who the message is to be sent from
		if($from_name!='')
		{
			$mail->setFrom('admin@easybuyhealth.com', $from_name);
		}
		else
		{
			$mail->setFrom('admin@easybuyhealth.com', 'Easybuyhealth Admin');
		}


        //Set an alternative reply-to address
        $mail->addReplyTo('admin@easybuyhealth.com', 'Easybuyhealth Admin');

        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 0;

        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';


        //echo $mail->Username." - ".$to_email." - ".$to_name;
        $mail->addAddress($to_email, $to_name);
        $mail->addBCC('sujeet.karn@easybuyhealth.com');
        //Set the subject lines
        $mail->Subject = $subject;

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

        $mail->msgHTML($message);
        //Replace the plain text body with one created manually
        $mail->AltBody = 'This is a plain-text message body';
        //Attach an image file
        if (!empty($attach))
            $mail->addAttachment($attach);
        //send the message, check for errors

		if (!$mail->send())
		{
            echo "Mailer Error: " . $mail->ErrorInfo;
        }
		else {
            //echo "IN send function.";
            //sleep(10);
            //echo "Message sent!";
        }

        $mail->ClearAddresses();

        //$mail->SmtpClose();
        //exit;
    }

    public function getLabTestDetails($dataId = NULL,$order_by=NULL) {
        unset($this->result);
        if ($dataId != '') {
            $id_query = " and a.lab_test_id='" . $dataId . "'";
        }
		$order_by_query	=	" ORDER BY a.lab_test_id DESC";
		if(order_by!=''){$order_by_query	=	$order_by;}

        $sql = "SELECT
				a.lab_test_id,
				a.test_name,
				a.brief_summary,
				a.technical_purpose,
				a.test_process,
				a.test_outcome,
				a.applicable_gender,
				a.age_limit,a.is_active
				from tbl_preventive_care_tests as a
				WHERE a.is_active<>2" . $id_query .$order_by_query ;
        $this->select($sql);
        return $this->result;
    }

    public function getKeywordList($dataId = NULL,$notInclude=NULL) {
        unset($this->result);
        if ($dataId != '') {
            $id_query = " and a.keyword_id='" . $dataId . "'";
        }

		if ($notInclude != '') {
            $not_include_query = " and a.keyword_type NOT IN('".$notInclude."')";
        }

        $sql = "SELECT
				a.keyword_id,
				a.keyword
				FROM
				tbl_keywords as a
				WHERE 1 " . $id_query ." ".$not_include_query;
        $this->select($sql);
        return $this->result;
    }

	public function getLabTestKeywords($dataId=NULL)
	{
		 unset($this->result);
		$sql="SELECT
				a.lab_test_id,GROUP_CONCAT(b.keyword_id) as keyword_id_arr, GROUP_CONCAT(c.keyword) as keyword_nm_arr
				from tbl_preventive_care_tests as a
				left join tbl_preventive_care_test_keyword as b on a.lab_test_id = b.lab_test_id
				LEFT JOIN tbl_keywords as c on b.keyword_id=c.keyword_id
				WHERE a.lab_test_id='".$dataId."'";
		$this->select($sql);
        return $this->result;
	}

	public function getEBHPackageLabTest($dataId=NULL)
	{
		unset($this->result);
		$sql="
			SELECT
				a.ebh_package_id,GROUP_CONCAT(b.lab_test_id) as lab_test_id_arr, GROUP_CONCAT(c.test_name) as lab_test_name_arr
			from tbl_ebh_pc_packages as a
			left join tbl_ebh_pc_packages_tests as b on a.ebh_package_id = b.ebh_package_id
			left join tbl_preventive_care_tests as c on b.lab_test_id = c.lab_test_id
			WHERE a.ebh_package_id='".$dataId."'";

		$this->select($sql);
        return $this->result;
	}

	public function getEBHPackageAsscoiatedInfo($dataId=NULL)
	{
		unset($this->result);
		$sql="
			SELECT
				a.ebh_package_id,
				lab_test.lab_test_id_arr,
				lab_test.lab_test_name_arr,
				package_hsp.hsp_id_arr,
				package_hsp.hsp_name_arr,
				age_group.age_group_arr,
				nature_of_work.nature_of_work_arr,
				conditions.condition_id_arr,
				conditions.condition_name_arr,
				speciality.speciality_id_arr,
				speciality.speciality_name_arr,
				symptom.symptom_id_arr,
				symptom.symptom_name_arr
			FROM
				tbl_ebh_pc_packages AS a
			left JOIN
			(
				SELECT
				x.ebh_package_id,
				GROUP_CONCAT(x.lab_test_id) AS lab_test_id_arr,
				GROUP_CONCAT(y.test_name) AS lab_test_name_arr

				from tbl_ebh_pc_packages_tests AS x
				LEFT JOIN tbl_preventive_care_tests AS y ON x.lab_test_id = y.lab_test_id
				group by x.ebh_package_id
			) as lab_test on a.ebh_package_id = lab_test.ebh_package_id

			left JOIN
			(
				SELECT
				x.ebh_package_id,
				GROUP_CONCAT(x.hsp_id) AS hsp_id_arr,
				GROUP_CONCAT(y.`name`) AS hsp_name_arr

				from tbl_ebh_hsp_package_mapping AS x
				LEFT JOIN tbl_hsps AS y ON x.hsp_id = y.id
				group by x.ebh_package_id
			) as package_hsp on a.ebh_package_id = package_hsp.ebh_package_id

			LEFT JOIN
			(
				SELECT
				x.ebh_package_id,
				GROUP_CONCAT(y.age_group) as age_group_arr
				from tbl_ebh_pc_packages as x
				LEFT JOIN tbl_ebh_pc_packages_agegroup as y on x.ebh_package_id = y.ebh_package_id
				GROUP BY x.ebh_package_id
			) as age_group on a.ebh_package_id = age_group.ebh_package_id
			LEFT JOIN
			(
				SELECT
				x.ebh_package_id,
				GROUP_CONCAT(y.nature_of_work) as nature_of_work_arr
				from tbl_ebh_pc_packages as x
				LEFT JOIN tbl_ebh_pc_packages_natureofwork as y on x.ebh_package_id = y.ebh_package_id
				GROUP BY x.ebh_package_id
			) as nature_of_work on a.ebh_package_id = nature_of_work.ebh_package_id
			LEFT JOIN
			(
				SELECT
				x.ebh_package_id,
				GROUP_CONCAT(y.con_id) as condition_id_arr,
				GROUP_CONCAT(z.`condition`) as condition_name_arr
				from tbl_ebh_pc_packages as x
				left join tbl_ebh_pc_packages_condition as y on x.ebh_package_id = y.ebh_package_id
				left join tbl_mst_conditions as z on y.con_id = z.con_id
				GROUP BY x.ebh_package_id
			) as conditions on a.ebh_package_id = conditions.ebh_package_id
			LEFT JOIN
			(
				SELECT
				x.ebh_package_id,
				GROUP_CONCAT(y.speciality_id) as speciality_id_arr,
				GROUP_CONCAT(z.speciality) as speciality_name_arr
				from tbl_ebh_pc_packages as x
				left join tbl_ebh_pc_packages_speciality as y on x.ebh_package_id = y.ebh_package_id
				left join tbl_mst_speciality as z on y.speciality_id = z.specilaity_id
				GROUP BY x.ebh_package_id
			) as speciality on a.ebh_package_id = speciality.ebh_package_id
			LEFT JOIN
			(
				SELECT
				x.ebh_package_id,
				GROUP_CONCAT(y.symptom_id) as symptom_id_arr,
				GROUP_CONCAT(z.symptom) as symptom_name_arr

				from tbl_ebh_pc_packages as x
				LEFT JOIN tbl_ebh_pc_packages_symptom as y on x.ebh_package_id = y.ebh_package_id
				LEFT JOIN tbl_mst_symptoms as z on y.symptom_id = z.symptom_id
				GROUP BY x.ebh_package_id
			) as symptom on a.ebh_package_id = symptom.ebh_package_id
			WHERE a.ebh_package_id='".$dataId."'";

		$this->select($sql);
        return $this->result;
	}

	public function getEbhPackageList($dataId=NULL,$search_string=NULL)
	{
		 unset($this->result);
		if ($dataId != '') {
            $id_query = " and a.ebh_package_id='" . $dataId . "'";
        }

		$filter_query	=	"";

		switch($search_string)
		{
			case "keyword_pending":
				$filter_query	=	" and a.is_keyword_assigned<>1 ";
			break;

			case "keyword_updated":
				$filter_query	=	" and a.is_keyword_assigned=1 ";
			break;

			case "review_pending":
				$filter_query	=	" and a.is_medical_review_done<>1 ";
			break;
			case "review_completed":
				$filter_query	=	" and a.is_medical_review_done=1 ";
			break;


			case "purchase_pending":
				$filter_query	=	" and a.is_purchase_price<>1 ";
			break;
			case "purchase_completed":
				$filter_query	=	" and a.is_purchase_price=1 ";
			break;

			case "sales_price_pending":
				$filter_query	=	" and a.is_sales_price<>1 ";
			break;
			case "sales_price_available":
				$filter_query	=	" and a.is_sales_price=1 ";
			break;

			case "publish_pending":
				$filter_query	=	" and a.is_published<>1 ";
			break;
			case "published":
				$filter_query	=	" and a.is_published=1 ";
			break;

			default:
				$filter_query	=	" ";
			break;

		}


		$sql="SELECT
				a.ebh_package_id,
				a.package_category_id,
				a.instructions,
				a.package_nm,
				a.package_code,
				a.about_package,
				a.purpose,
				a.ebh_price,
				a.gender,
				a.is_available_online,
				a.is_active,
				b.group_id,a.package_icon,a.package_icon_thumb,
				b.category_name,b.`code` as category_code,
				c.group_name,c.group_code,
				DATE_FORMAT(a.valid_from,'%d %b %Y') as valid_from,
				DATE_FORMAT(a.valid_till,'%d %b %Y') as valid_till,

				if(a.is_keyword_assigned=1,1,0) as is_keyword_assigned,
				a.keyword_assigned_by,
				DATE_FORMAT(a.keyword_assigned_on,'%d %b %Y') as keyword_assigned_on,

				if(a.is_medical_review_done=1,1,0) as is_medical_review_done,
				a.medical_reveiw_by,
				DATE_FORMAT(a.medical_review_on,'%d %b %Y') as medical_review_on,

				if(a.is_purchase_price=1,1,0) as is_purchase_price,
				a.purchase_by,
				DATE_FORMAT(a.purchase_price_on,'%d %b %Y') as purchase_price_on,

				if(a.is_sales_price=1,1,0) as is_sales_price,
				a.sales_price_by,
				DATE_FORMAT(a.sales_price_on,'%d %b %Y') as sales_price_on,

				if(a.is_published=1,1,0) as is_published,
				a.published_by,
				DATE_FORMAT(a.published_on,'%d %b %Y') as published_on,
				a.sales_price_type,
				a.sales_price,a.expected_medical_reports_title


				FROM tbl_ebh_pc_packages as a
				left join tbl_service_package_category as b on a.package_category_id = b.package_category_id
				left join tbl_service_package_group as c on b.group_id = c.service_pack_group_id
				WHERE a.is_active<>2 ". $id_query.$filter_query." ORDER BY ebh_package_id DESC";
		$this->select($sql);
        return $this->result;
	}
	public function getEbhPackageTestHspPrice($ebh_package_id,$hsp_id)
	{
		unset($this->result);
		$sql="SELECT
				a.ebh_package_id,
				b.lab_test_id,
				c.test_name,
				e.test_name as hsp_test_name,
				e.regular_price,
				e.ebh_price,
				d.hsp_discount_per,
				d.hsp_discount_price
			FROM
				tbl_ebh_pc_packages AS a
			LEFT JOIN tbl_ebh_pc_packages_tests AS b ON a.ebh_package_id = b.ebh_package_id
			LEFT JOIN tbl_preventive_care_tests AS c ON b.lab_test_id = c.lab_test_id
			LEFT JOIN tbl_ebh_hsp_package_mapping as d on a.ebh_package_id = d.ebh_package_id and d.hsp_id='".$hsp_id."'
			LEFT JOin tbl_hsp_lab_test_ratecard as e on b.lab_test_id = e.lab_test_id and e.hsp_id='".$hsp_id."'
			WHERE	a.ebh_package_id = '".$ebh_package_id."'";
		$this->select($sql);
		return $this->result;
	}

	public function checkPackPurchasePriceUpdate($ebh_package_id)
	{
		unset($this->result);
		$sql="SELECT
				COUNT(a.ebh_hsp_pack_mapping_id) as total_pending_updates,
				GROUP_CONCAT(b.`name`) as hsp_name
			FROM tbl_ebh_hsp_package_mapping as a
			LEFT join tbl_hsps as b on a.hsp_id = b.id
			where (a.purchase_price IS NULL or a.purchase_price=0 or a.purchase_price='')
			and a.ebh_package_id='".$ebh_package_id."'  and a.is_active=1";

		$this->select($sql);
		return $this->result;
	}

	public function checkPackSalesPriceUpdate($ebh_package_id)
	{
		unset($this->result);
		$sql="SELECT
				a.ebh_package_id,a.sales_price_type,
				case
					WHEN a.sales_price_type='hspprice' and sales_update.total_pending_update=0 THEN 1
					WHEN a.sales_price_type='Fixed' and a.sales_price>0 THEN 1
					ELSE 0
				end as eligible

				FROM tbl_ebh_pc_packages as a
				left JOIN
				(
					SELECT
					x.ebh_package_id,	sum(if(x.sales_price = 0 or x.sales_price IS NULL ,1,0))AS total_pending_update
					FROM tbl_ebh_hsp_package_mapping AS x
					GROUP BY x.ebh_package_id
				) as sales_update on a.ebh_package_id = sales_update.ebh_package_id and a.sales_price_type='hspprice'
			WHERE a.ebh_package_id='".$ebh_package_id."' and (a.sales_price_type<>'' or a.sales_price_type IS NOT NULL)";

		$this->select($sql);
		return $this->result;
	}

	public function getServiceGroup()
	{
		unset($this->result);
		$sql="SELECT a.service_pack_group_id,a.group_name,a.group_code,a.is_active
		FROM tbl_service_package_group as a WHERE a.is_active=1";
		$this->select($sql);
		return $this->result;
	}

	public function getServiceCategory()
	{
		unset($this->result);
		$sql="SELECT
				a.package_category_id,a.category_name,a.`code`,a.is_active,a.group_id
				from tbl_service_package_category as a
				WHERE is_active=1";

		$this->select($sql);
		return $this->result;
	}

	public function getConditions($dataId = NULL)
	{
		unset($this->result);
		$where_qry = '';


		if($dataId != ''){

			$where_qry .= " and a.con_id = '".$dataId."'";
		}

		$sql="SELECT
				a.con_id,
				a.`condition`,
                a.is_active
				from tbl_mst_conditions as a
				WHERE a.is_active=1".$where_qry." ";

		$this->select($sql);
		return $this->result;
	}

	public function getSpeciality()
	{
		unset($this->result);
		$sql="SELECT
				a.specilaity_id,
				a.speciality
				from tbl_mst_speciality as a
				where a.is_active=1";

		$this->select($sql);
		return $this->result;
	}

	public function getSymptoms($dataId = NULL)
	{
		unset($this->result);
		$where_qry = '';


		if($dataId != ''){

			$where_qry .= " and a.symptom_id = '".$dataId."'";

		}

		$sql="SELECT
				a.symptom_id,
				a.symptom,
                a.is_active
				FROM
				tbl_mst_symptoms as a
				where a.is_active=1".$where_qry." ";

		$this->select($sql);
		return $this->result;
	}

/* Employee start */

	public function getEmployeeRankList($clusterId)
	{
    	unset($this->result);
     	$sql = "SELECT cl_rank_id, rank_title, is_active FROM tbl_cluster_employee_rank_mst WHERE cluster_id='".$clusterId."' ORDER BY rank_title ASC";
        $this->select($sql);
        return $this->result;
    }

    public function getEmployeeRankDetails($dataId)
	{
    	unset($this->result);
     	$sql = "SELECT cl_rank_id, rank_title, is_active FROM tbl_cluster_employee_rank_mst WHERE cl_rank_id='".$dataId."'";
        $this->select($sql);
        return $this->result;
    }

    public function getEmployeeList($clusterId)
	{
    	unset($this->result);
     	$sql = "SELECT * FROM tbl_cluster_employee WHERE cluster_id='".$clusterId."' ORDER BY emp_id ASC";
        $this->select($sql);
        return $this->result;
    }

    public function getEmployeeDetails($emp_id)
	{
    	unset($this->result);
     	$sql = "SELECT * FROM tbl_cluster_employee WHERE emp_id='".$emp_id."'";
        $this->select($sql);
        return $this->result;
    }

/* Employee end */

/* Cluster start */
	public function getClusterUser($clsun)
	{
    	unset($this->result);
    	$sql = "SELECT * FROM tbl_user_mst WHERE login_username='".$clsun."'";
        $this->select($sql);
        return $this->result;
    }

	public function getClusterGroups($clsgrp)
	{
    	unset($this->result);
    	if(!empty($clsgrp))
    	{
    	$sql = "SELECT cluster_group FROM tbl_cluster_group WHERE cluster_group_id='".$clsgrp."'";
        $this->select($sql);
        return $this->result;
    	}
    	else
    	{
     	$sql = "SELECT * FROM tbl_cluster_group";
        $this->select($sql);
        return $this->result;
        }
    }

   public function getClusterUsersList()
	{
    	unset($this->result);
     	$sql = "SELECT * FROM tbl_clusters ORDER BY cluster_id ASC";
        $this->select($sql);
        return $this->result;
    }

    public function getClusterUsersDetails($emp_id)
	{
    	unset($this->result);
     	$sql = "SELECT * FROM tbl_clusters WHERE cluster_id='".$emp_id."'";
        $this->select($sql);
        return $this->result;
    }

    public function getClusterKeyContacts($cluster_id)
	{
    	unset($this->result);
     	$sql = "SELECT * FROM tbl_cluster_contacts WHERE cluster_id='".$cluster_id."'";
        $this->select($sql);
        return $this->result;
    }

    public function getClusterPackageType($package_type, $cluster_id)
	{
    	unset($this->result);
     if(!empty($package_type))
     {
     	$sql = "SELECT associated_package_type FROM tbl_cluster_package_type WHERE associated_package_type='".$package_type."' AND cluster_id='".$cluster_id."'";
        $this->select($sql);
        return $this->result;
     }
    else
     {
        $sql = "SELECT * FROM tbl_cluster_package_type WHERE cluster_id='".$cluster_id."'";
        $this->select($sql);
        return $this->result;
     }
    }

    public function getClusterUsersLogin($cluster_id)
	{
    	unset($this->result);
     	$sql = "SELECT * FROM tbl_user_mst WHERE ref_id='".$cluster_id."'";
        $this->select($sql);
        return $this->result;
    }

    public function getClusterSchedule($cluster_id, $where)
	{
    	unset($this->result);
    	if(empty($where))
    	{
     		$sql = "SELECT * FROM tbl_cluster_reminder_schedule WHERE cluster_id = '".$cluster_id."' ORDER BY schedule_id DESC LIMIT 1";
     	}
     	else
     	{
			$sql = "SELECT * FROM tbl_cluster_reminder_schedule WHERE cluster_id = '".$cluster_id."' AND ".$where." ORDER BY schedule_id DESC LIMIT 1";
     	}
        $this->select($sql);
        return $this->result;
    }

/* Cluster end */

/* hsp-empanelment start */
	public function getProgressBar($id)
	{
    	unset($this->result);
     	$sql = "SELECT SUM(hsp_table_weight) FROM tbl_hsp_progress WHERE hspid='".$id."'";
        $this->select($sql);
        return $this->result;
    }

	public function getSpecFacList()
	{
    	unset($this->result);
     	$sql = "SELECT * FROM tbl_hsp_sf_list ORDER BY sf_name ASC";
        $this->select($sql);
        return $this->result;
    }

    public function getSectorComp($sector, $hspid)
	{
    	unset($this->result);
     	$sql = "SELECT * FROM ".$sector." WHERE hspid='".$hspid."'";
        $this->select($sql);
        return $this->result;
    }

    public function getHspsList($uid)
	{
    	unset($this->result);
     	$sql = "SELECT * FROM tbl_hspid WHERE created_by='".$uid."'";
        $this->select($sql);
        return $this->result;
    }

    public function getHspsStat($hspid)
	{
    	unset($this->result);
     	$sql = "SELECT * FROM tbl_hspid WHERE hspid='".$hspid."'";
        $this->select($sql);
        return $this->result;
    }

    public function getTableForHsp($table, $where)
	{
    	unset($this->result);
    	if(!empty($where)){
     	$sql = "SELECT * FROM ".$table." WHERE ".$where."";
     	}else{
     	$sql = "SELECT * FROM ".$table."";
     	}
        $this->select($sql);
        return $this->result;
    }

/* hsp-empanelment end */

		/*HSP RATE CARD*/
	public function getHSPList($is_preventive_care=NULL,$hsp_id=NULL)
	{
		unset($this->result);
		if($is_preventive_care==1){$where_query	=" and b.empanelled_for=1";	}
		if($hsp_id>0){$where_query.=" and a.`id`='".$hsp_id."'";	}

		$sql="SELECT
				a.`id` as hsp_id, a.`name` as hsp_name,a.logo,c.emp_name as sales_executive,
				d.is_ratecard_updated,d.is_ebh_package_mapped,
				d.is_ebh_package_mapped,hsp_ebh_pack.total_ebh_packages,
				d.is_custom_package_available,custom_pack.total_custom_package,

        concat(e.hsp_address,' ', e.hsp_locality,' ',e.hsp_landmark,', ',g.city_name,', ',h.state_name) as hsp_address,
        e.hsp_pin_code as hsp_pin_code,

				e.hsp_general_email_id as hsp_email,

				e.hsp_helpline_number1 as helpline_no
				from tbl_hsps as a
				left join tbl_hsp_empanellments as b on a.id = b.hsp_id
				left join tbl_hsp_address_contacts as e on a.id = e.hspid
        LEFT JOIN cities as g on e.hsp_city = g.id
        LEFT JOIN states as h on e.hsp_state = h.id
				left join tbl_ebh_employee_mst as c on a.sales_executive_id = c.employee_id
				LEFT JOIN tbl_hsp_activities as d on a.id=d.hsp_id
				LEFT JOIN
				(
					SELECT
					x.hsp_id,
					count(x.ebh_hsp_pack_mapping_id) as total_ebh_packages
					from tbl_ebh_hsp_package_mapping as x
					group by x.hsp_id
				) as hsp_ebh_pack	on a.id = hsp_ebh_pack.hsp_id
				LEFT JOIN
				(
					SELECT
					a.hsp_id,count(a.hsp_package_id) as total_custom_package
					from tbl_hsp_pc_packages as a
					GROUP BY a.hsp_id
				) as custom_pack on a.id = custom_pack.hsp_id
				WHERE a.is_active=1 and a.is_delete=0 ".$where_query." GROUP BY a.`id`";

		$this->select($sql);
		return $this->result;

	}

	public function getHspTestList($hsp_id)
	{
		unset($this->result);
		$sql="SELECT
				a.lab_test_id,b.test_name as ebh_test_name,
				a.test_name as hsp_test_name,
				a.hsp_code,
				a.regular_price,a.ebh_price
				from tbl_hsp_lab_test_ratecard as a
				left join tbl_preventive_care_tests as b on a.lab_test_id=b.lab_test_id
			  WHERE a.hsp_id='".$hsp_id."'";

		$this->select($sql);
		return $this->result;

	}
	/*END HSP RATE CARD*/

	/*HSP EBH Package mapping*/
	public function getEbh_Hsp_package_list($group_code=NULL,$hsp_id=NULL,$dataId=NULL)
	{
		unset($this->result);
		if($group_code!='')
		{
			$group_query=" and c.group_code='".$group_code."'";
		}

		$sql="SELECT
				a.ebh_package_id,
				a.package_category_id,
				a.package_nm,
				a.package_code,
				a.about_package,
				a.purpose,
				a.ebh_price,
				d.ebh_hsp_pack_mapping_id,
				d.hsp_price,
				d.remarks,
				a.is_available_online,
				a.is_active,
				b.group_id,
				b.category_name,b.`code` as category_code,
				c.group_name,c.group_code
				FROM tbl_ebh_pc_packages as a
				left join tbl_service_package_category as b on a.package_category_id = b.package_category_id
				left join tbl_service_package_group as c on b.group_id = c.service_pack_group_id
				LEFT JOIN tbl_ebh_hsp_package_mapping as d on a.ebh_package_id = d.ebh_package_id and hsp_id=".$hsp_id."
				WHERE a.is_active=1 ".$group_query." GROUP BY a.ebh_package_id";

		$this->select($sql);
		return $this->result;
	}
	/*END*/

	/*HSP PACKAGE*/
	public function getHSPPackageLabTest($dataId=NULL)
	{
		unset($this->result);
		$sql="
			SELECT
				a.hsp_package_id,GROUP_CONCAT(b.lab_test_id) as lab_test_id_arr, GROUP_CONCAT(c.test_name) as lab_test_name_arr
			from tbl_hsp_pc_packages as a
			left join tbl_hsp_pc_packages_tests as b on a.hsp_package_id = b.hsp_package_id
			left join tbl_preventive_care_tests as c on b.lab_test_id = c.lab_test_id
			WHERE a.hsp_package_id='".$dataId."'";

		$this->select($sql);
        return $this->result;
	}

	public function getHSPPackageAsscoiatedInfo($dataId=NULL)
	{
		unset($this->result);
		$sql="
			SELECT
				a.hsp_package_id,
				lab_test.lab_test_id_arr,
				lab_test.lab_test_name_arr,
				age_group.age_group_arr,
				nature_of_work.nature_of_work_arr,
				conditions.condition_id_arr,
				conditions.condition_name_arr,
				speciality.speciality_id_arr,
				speciality.speciality_name_arr,
				symptom.symptom_id_arr,
				symptom.symptom_name_arr
			FROM
				tbl_hsp_pc_packages AS a
			left JOIN
			(
				SELECT
				x.hsp_package_id,
				GROUP_CONCAT(x.lab_test_id) AS lab_test_id_arr,
				GROUP_CONCAT(y.test_name) AS lab_test_name_arr

				from tbl_hsp_pc_packages_tests AS x
				LEFT JOIN tbl_preventive_care_tests AS y ON x.lab_test_id = y.lab_test_id
				group by x.hsp_package_id
			) as lab_test on a.hsp_package_id = lab_test.hsp_package_id
			LEFT JOIN
			(
				SELECT
				x.hsp_package_id,
				GROUP_CONCAT(y.age_group) as age_group_arr
				from tbl_hsp_pc_packages as x
				LEFT JOIN tbl_hsp_pc_packages_agegroup as y on x.hsp_package_id = y.hsp_package_id
				GROUP BY x.hsp_package_id
			) as age_group on a.hsp_package_id = age_group.hsp_package_id
			LEFT JOIN
			(
				SELECT
				x.hsp_package_id,
				GROUP_CONCAT(y.nature_of_work) as nature_of_work_arr
				from tbl_hsp_pc_packages as x
				LEFT JOIN tbl_hsp_pc_packages_natureofwork as y on x.hsp_package_id = y.hsp_package_id
				GROUP BY x.hsp_package_id
			) as nature_of_work on a.hsp_package_id = nature_of_work.hsp_package_id
			LEFT JOIN
			(
				SELECT
				x.hsp_package_id,
				GROUP_CONCAT(y.con_id) as condition_id_arr,
				GROUP_CONCAT(z.`condition`) as condition_name_arr
				from tbl_hsp_pc_packages as x
				left join tbl_hsp_pc_packages_condition as y on x.hsp_package_id = y.hsp_package_id
				left join tbl_mst_conditions as z on y.con_id = z.con_id
				GROUP BY x.hsp_package_id
			) as conditions on a.hsp_package_id = conditions.hsp_package_id
			LEFT JOIN
			(
				SELECT
				x.hsp_package_id,
				GROUP_CONCAT(y.speciality_id) as speciality_id_arr,
				GROUP_CONCAT(z.speciality) as speciality_name_arr
				from tbl_hsp_pc_packages as x
				left join tbl_hsp_pc_packages_speciality as y on x.hsp_package_id = y.hsp_package_id
				left join tbl_mst_speciality as z on y.speciality_id = z.specilaity_id
				GROUP BY x.hsp_package_id
			) as speciality on a.hsp_package_id = speciality.hsp_package_id
			LEFT JOIN
			(
				SELECT
				x.hsp_package_id,
				GROUP_CONCAT(y.symptom_id) as symptom_id_arr,
				GROUP_CONCAT(z.symptom) as symptom_name_arr

				from tbl_hsp_pc_packages as x
				LEFT JOIN tbl_hsp_pc_packages_symptom as y on x.hsp_package_id = y.hsp_package_id
				LEFT JOIN tbl_mst_symptoms as z on y.symptom_id = z.symptom_id
				GROUP BY x.hsp_package_id
			) as symptom on a.hsp_package_id = symptom.hsp_package_id
			WHERE a.hsp_package_id='".$dataId."'";

		$this->select($sql);
        return $this->result;
	}

	public function getHSPPackageList($dataId=NULL,$hsp_id=NULL)
	{
		unset($this->result);
		if ($dataId != '') {
            $id_query = " and a.hsp_package_id='" . $dataId . "'";
        }

		if ($hsp_id != '') {
            $id_query.= " and a.hsp_id='" . $hsp_id . "'";
        }

		$sql="SELECT
				a.hsp_package_id,
				a.hsp_id,
				a.package_nm,
				a.package_code,
				a.about_package,
				a.purpose,
				a.ebh_price,
				a.gender,
				a.is_available_online,
				a.is_active,
				a.package_icon,a.package_icon_thumb
				FROM tbl_hsp_pc_packages as a
				WHERE a.is_active<>2 ". $id_query;
		$this->select($sql);
        return $this->result;
	}
	/*END*/
		/*Cluster Packages*/

    public function getClusterAdmin($cluster_id)
	{
    	unset($this->result);
     	$sql = "SELECT * FROM tbl_user_mst WHERE user_group_id=7 AND ref_id='".$cluster_id."'";
        $this->select($sql);
        return $this->result;
    }

	public function getClusters($dataId=NULL)
	{
		unset($this->result);
		if ($dataId != '') {
            $id_query = " and a.cluster_id='" . $dataId . "'";
        }

		$sql="SELECT
				a.cluster_id,
				a.cluster_business_name,
				a.business_email_id,
				a.contact_mobile,
				a.contact_landline,
				a.logo,
        a.city,
        a.state,
        a.address,
        a.pincode,
        a.missed_calls_no,
				a.is_sms,
				a.sms_mobile_no,
				a.is_email,
				a.communication_email,
				b.cluster_group,
				c.`code`,b.cluster_type,
				if(cluster_package.total_packages>0,cluster_package.total_packages,0) as total_packages,
				cluster_emp.total_emp,
				a.hr_full_name,
				a.hr_email_id,
				a.hr_mobile_no,
        g.city_name,
        h.state_name,
        a.is_active
				from tbl_clusters as a
        LEFT JOIN cities as g on g.id = a.city
      	LEFT JOIN states as h on h.id = a.state
				left join tbl_cluster_group as b on a.cluster_group_id = b.cluster_group_id
				left join tbl_service_package_category as c on b.cluster_type = c.package_category_id
				left join
				(
					SELECT
					x.cluster_id,count(x.cluster_package_id) as total_packages
					from tbl_cluster_packages as x
					GROUP BY x.cluster_id
				) as cluster_package on a.cluster_id = cluster_package.cluster_id
				left JOIN
				(
					SELECT
					x.cluster_id,count(x.emp_id) as total_emp
					from tbl_cluster_employee as x
					GROUP BY x.cluster_id
				) as cluster_emp on a.cluster_id = cluster_emp.cluster_id
				where a.is_active<>2 ".$id_query;
		$this->select($sql);
        return $this->result;
	}

	public function getClustersUser($dataId=NULL,$cluster_user_id)
	{
		unset($this->result);
		if ($dataId != '') {
            $id_query = " and a.cluster_id='" . $dataId . "'";
        }

		$sql="SELECT
				a.cluster_id,
				a.cluster_business_name,
				a.business_email_id,
				a.contact_mobile,
				a.contact_landline,
				a.logo,
				a.is_sms,
				a.sms_mobile_no,
				a.is_email,
				a.communication_email,
				b.cluster_group,
				c.`code`,b.cluster_type,
				if(cluster_package.total_packages>0,cluster_package.total_packages,0) as total_packages,
				cluster_emp.total_emp,
				a.hr_full_name,
				a.hr_email_id,
				a.hr_mobile_no
				from tbl_clusters as a
				left join tbl_cluster_group as b on a.cluster_group_id = b.cluster_group_id
				left join tbl_service_package_category as c on b.cluster_type = c.package_category_id
				left join
				(
					SELECT
					x.cluster_id,count(x.cluster_package_id) as total_packages
					from tbl_cluster_packages as x
					GROUP BY x.cluster_id
				) as cluster_package on a.cluster_id = cluster_package.cluster_id
				left JOIN
				(
					SELECT
					x.cluster_id,count(x.emp_id) as total_emp
					from tbl_cluster_employee as x
					WHERE x.cluster_user_id='".$cluster_user_id."' GROUP BY x.cluster_id
				) as cluster_emp on a.cluster_id = cluster_emp.cluster_id
				where a.is_active<>2 ".$id_query;
		$this->select($sql);
        return $this->result;
	}

	public function getClusterSuggesteedPackage($service_category,$cluster_id=NULL)
	{
		unset($this->result);
		$sql="SELECT
				a.ebh_package_id,b.`code` as category_code,b.category_name,a.package_nm,a.package_code,a.ebh_price
				from tbl_ebh_pc_packages as a
				left join tbl_service_package_category as b on a.package_category_id = b.package_category_id
				where a.package_category_id=".$service_category." OR a.cluster_id='".$cluster_id."'";

		$this->select($sql);
        return $this->result;
	}

	public function getEbhPackageHSP($ebh_package_id,$hsp_id=NULL,$is_hsp=NULL)
	{
		unset($this->result);
		if($is_hsp=='')
		{
			if($hsp_id!='')
			{
				$hsp_query=" and b.hsp_id='".$hsp_id."'";
			}
		}
		else
		{
			$hsp_query=" and b.hsp_id='".$hsp_id."'";
		}

		$sql="SELECT
				b.hsp_id,tcase(c.`name`) as hsp_name,b.purchase_price,a.sales_price_type,a.sales_price as fixed_price,b.sales_price as hsp_price,
				case
					when a.sales_price_type='Fixed' then a.sales_price
					when a.sales_price_type='hspprice' then b.sales_price
				end as price
				from tbl_ebh_pc_packages as a
				left join tbl_ebh_hsp_package_mapping as b  on a.ebh_package_id = b.ebh_package_id
				left join tbl_hsps as c on b.hsp_id = c.id
				WHERE a.ebh_package_id=".$ebh_package_id." ".$hsp_query." and b.is_active=1 ";

		$this->select($sql);
        return $this->result;
	}
    public function getEbhClusterPackageHSP($cluster_package_id)
	{
		unset($this->result);


		 $sql="SELECT b.name,b.logo,a.price_per_unit,tcase(d.package_nm) AS package_nm,d.sales_price_type,
			c.package_unit,c.price_per_unit, c.total_price,c.cluster_contribution				FROM tbl_cluster_packages_hsp a
				LEFT JOIN tbl_hsps b ON a.hsp_id=b.id
				LEFT JOIN tbl_cluster_packages c ON c.cluster_package_id=a.cluster_package_id
				LEFT JOIN tbl_ebh_pc_packages d ON d.ebh_package_id=c.package_id
				WHERE c.cluster_package_id=".$cluster_package_id;

		$this->select($sql);
        return $this->result;
	}
	public function getEbhClusterPackageHSPDetails($cluster_package_id, $limit ='')
	{
		unset($this->result);


		 $sql="SELECT a.hsp_id,
				a.cluster_package_id,
				 b.ebh_package_id,
				tcase(b.package_nm) AS package_nm,
				tcase(c.`name`) AS hsp_name,
				d.hsp_logo,
					CONCAT(
					e.hsp_address,
					' ',
					e.hsp_locality,
					' ',
					e.hsp_landmark,
					', ',
					e.hsp_pin_code,
					', ',
					g.city_name,
					', ',
					h.state_name
				) AS hsp_address,
				e.hsp_general_email_id,
				e.hsp_helpline_number1,
				e.hsp_helpline_number2,
				e.hsp_helpline_number3,
				e.hsp_helpline_number4,
				tcase(hsp_branch.hsp_branchs) AS hsp_branchs
				FROM
					tbl_cluster_packages AS a 
				LEFT JOIN tbl_ebh_pc_packages AS b 
				ON
					a.package_id = b.ebh_package_id AND a.package_type = 'EBH'
				LEFT JOIN tbl_cluster_packages_hsp AS cph
			   on a.cluster_package_id=cph.cluster_package_id
			   left join tbl_hsps c
			   ON
				cph.hsp_id = c.id
				LEFT JOIN tbl_hsp_business_details AS d
				ON
					c.id = d.hspid
					LEFT JOIN tbl_hsp_address_contacts AS e
				ON
					d.hspid = e.hspid
				LEFT JOIN cities AS g
				ON
					e.hsp_city = g.id
				LEFT JOIN states AS h
				ON
					e.hsp_state = h.id
					LEFT JOIN(
							SELECT X.hspid,
								GROUP_CONCAT(X.branch_name) AS hsp_branchs
							FROM
								tbl_hsp_branchs AS X
							GROUP BY
								X.hspid
						) AS hsp_branch
						ON
							d.hspid = hsp_branch.hspid
			   where a.cluster_package_id=".$cluster_package_id;
		$sql = $sql .' '.$limit;
		$this->select($sql);
        return $this->result;
	}


	public function getclusterEbhPackageList($cluster_id,$cluster_apckagae_id=NULL, $dsort='DESC'){
		$whr_q = '';
		if($cluster_apckagae_id!='')
		{
			$whr_q	=	" and a.cluster_package_id='".$cluster_apckagae_id."'";
		}
		unset($this->result);
		$sql = "SELECT a.package_id,count(c.hsp_id) as hsp_count,
				a.cluster_id,a.cluster_package_id,tcase(b.package_nm) AS package_nm,
				a.package_unit,a.price_per_unit, a.total_price,a.cluster_contribution, 
				DATE_FORMAT(a.created_on,'%d %b %Y') AS created_on,a.created_on as created_on_date
				FROM tbl_cluster_packages AS a
				LEFT JOIN tbl_ebh_pc_packages AS b ON a.package_id=b.ebh_package_id AND a.package_type='EBH'
				Left Join tbl_cluster_packages_hsp c on c.cluster_package_id=a.cluster_package_id
				where a.cluster_id='".$cluster_id."'  ".$whr_q." group by c.cluster_package_id ORDER BY a.created_on ".$dsort."";
		$this->select($sql);
        return $this->result;
	}
	public function getclusterEbhPackageDetail($cluster_id,$cluster_apckagae_id=NULL, $dsort='DESC')
	{
		if($cluster_apckagae_id!='')
		{
			$whr_q	=	" and a.cluster_package_id='".$cluster_apckagae_id."'";
		}
		
		unset($this->result);
		$sql="SELECT
				hsp.hsp_count,
				a.cluster_id,
				a.hsp_id,
				a.cluster_package_id,
				tcase(b.package_nm) AS package_nm,
				a.package_unit,
				a.price_per_unit,
				a.total_price,
				a.cluster_contribution,
				DATE_FORMAT(a.created_on, '%d %b %Y') AS created_on,
				a.created_on as created_on_date,
				pack_emp.total_invited,
				pack_emp.appt_confirmed,
				pack_emp.visited,
				b.about_package,
				ebh_pack_test.lab_test_id_arr,
				ebh_pack_test.lab_test_name_arr,
				b.ebh_package_id
				 FROM
				tbl_cluster_packages AS a
			LEFT JOIN tbl_ebh_pc_packages AS b
			ON
				a.package_id = b.ebh_package_id AND a.package_type = 'EBH'
			LEFT JOIN(
					  SELECT count(1) as hsp_count,cp.cluster_package_id
				FROM
					tbl_ebh_pc_packages AS pp
				LEFT JOIN tbl_cluster_packages AS cp
				ON
					pp.ebh_package_id = cp.package_id
				LEFT JOIN tbl_cluster_packages_hsp AS cph
			   on cp.cluster_package_id=cph.cluster_package_id
			   where cp.cluster_id =8
				GROUP BY
				  cp.cluster_package_id
			) AS hsp
			ON
				a.cluster_package_id = hsp.cluster_package_id
			LEFT JOIN(
				SELECT X.cluster_package_id,
					COUNT(Y.emp_id) AS total_invited,
					SUM(IF(Y.is_confirmed = 1, 1, 0)) AS appt_confirmed,
					SUM(IF(z.appt_status <> 'New', 1, 0)) AS visited
				FROM
					tbl_cluster_packages AS X
				LEFT JOIN tbl_cluster_employee_pack AS Y
				ON
					X.cluster_package_id = Y.cluster_package_id
				LEFT JOIN tbl_appointments AS z
				ON
					Y.appointment_id = z.appointment_id
				GROUP BY
					X.cluster_package_id
			) AS pack_emp
			ON
				a.cluster_package_id = pack_emp.cluster_package_id
			LEFT JOIN(
				SELECT X.ebh_package_id,
					GROUP_CONCAT(Y.lab_test_id) AS lab_test_id_arr,
					GROUP_CONCAT(z.test_name) AS lab_test_name_arr
				FROM
					tbl_ebh_pc_packages AS X
				LEFT JOIN tbl_ebh_pc_packages_tests AS Y
				ON
					X.ebh_package_id = Y.ebh_package_id
				LEFT JOIN tbl_preventive_care_tests AS z
				ON
					Y.lab_test_id = z.lab_test_id
				GROUP BY
					X.ebh_package_id
			) AS ebh_pack_test
			ON
				b.ebh_package_id = ebh_pack_test.ebh_package_id
				where a.cluster_id='".$cluster_id."'  ".$whr_q." ORDER BY a.created_on ".$dsort."";
		$this->select($sql);
        return $this->result;
	}

	public function getclusterEbhPackage($cluster_id,$cluster_apckagae_id=NULL, $dsort='DESC')
	{
		if($cluster_apckagae_id!='')
		{
			$whr_q	=	" and a.cluster_package_id='".$cluster_apckagae_id."'";
		}

		unset($this->result);
		$sql="SELECT
				a.cluster_id,a.hsp_id,a.cluster_package_id,tcase(b.package_nm) as package_nm,tcase(c.`name`) as hsp_name,a.package_unit,a.price_per_unit,
				a.total_price,a.cluster_contribution,DATE_FORMAT(a.created_on,'%d %b %Y') as created_on,
				pack_emp.total_invited,
				pack_emp.appt_confirmed,
				pack_emp.visited,
				b.about_package,
				ebh_pack_test.lab_test_id_arr,
				ebh_pack_test.lab_test_name_arr,
				age_group.age_group_arr,
				nature_of_work.nature_of_work_arr,
				d.hsp_logo,b.ebh_package_id,
				concat(e.hsp_address,' ', e.hsp_locality,' ',e.hsp_landmark,', ', e.hsp_pin_code,', ',g.city_name,', ',h.state_name) as hsp_address,
				e.hsp_general_email_id,	e.hsp_helpline_number1,e.hsp_helpline_number2,e.hsp_helpline_number3,e.hsp_helpline_number4,
				tcase(hsp_branch.hsp_branchs) as hsp_branchs
				from tbl_cluster_packages as a
				left join tbl_ebh_pc_packages as b on a.package_id=b.ebh_package_id and a.package_type='EBH'
				left join tbl_hsps as c on a.hsp_id = c.id
				LEFT join tbl_hsp_business_details as d on c.id = d.hspid
				LEFT join tbl_hsp_address_contacts as e on d.hspid = e.hspid
				LEFT JOIN cities as g on e.hsp_city = g.id
				LEFT JOIN states as h on e.hsp_state = h.id
				LEFT JOIN
				(
					SELECT
					x.hspid, GROUP_CONCAT(x.branch_name) as hsp_branchs
					FROM tbl_hsp_branchs as x
					GROUP BY x.hspid
				) as hsp_branch on d.hspid = hsp_branch.hspid
				LEFT JOIN
				(
					SELECT
					x.cluster_package_id,count(y.emp_id) as total_invited,
					sum(if(y.is_confirmed=1,1,0)) as appt_confirmed,
					sum(if(z.appt_status<>'New',1,0)) as visited
					from tbl_cluster_packages as x
					LEFT JOIN tbl_cluster_employee_pack as y on x.cluster_package_id = y.cluster_package_id
					LEFT JOIN tbl_appointments as z on y.appointment_id = z.appointment_id
					GROUP BY x.cluster_package_id
				) as pack_emp on a.cluster_package_id = pack_emp.cluster_package_id
				left join
				(
					SELECT
					x.ebh_package_id ,
					GROUP_CONCAT(y.lab_test_id) as lab_test_id_arr,
					GROUP_CONCAT(z.test_name) as lab_test_name_arr
					from tbl_ebh_pc_packages as x
					left join tbl_ebh_pc_packages_tests as y on x.ebh_package_id = y.ebh_package_id
					left join tbl_preventive_care_tests as z on y.lab_test_id = z.lab_test_id
					GROUP BY x.ebh_package_id
				) as ebh_pack_test on b.ebh_package_id = ebh_pack_test.ebh_package_id
				LEFT JOIN
				(
					SELECT
					x.ebh_package_id,
					GROUP_CONCAT(y.age_group) as age_group_arr
					from tbl_ebh_pc_packages as x
					LEFT JOIN tbl_ebh_pc_packages_agegroup as y on x.ebh_package_id = y.ebh_package_id
					GROUP BY x.ebh_package_id
				) as age_group on b.ebh_package_id = age_group.ebh_package_id
				LEFT JOIN
				(
					SELECT
					x.ebh_package_id,
					GROUP_CONCAT(y.nature_of_work) as nature_of_work_arr
					from tbl_ebh_pc_packages as x
					LEFT JOIN tbl_ebh_pc_packages_natureofwork as y on x.ebh_package_id = y.ebh_package_id
					GROUP BY x.ebh_package_id
				) as nature_of_work on b.ebh_package_id = nature_of_work.ebh_package_id

			where a.cluster_id='".$cluster_id."'  ".$whr_q." ORDER BY a.created_on ".$dsort."";
		$this->select($sql);
        return $this->result;
	}

	public function getclusterUserEbhPackage($cluster_id,$cluster_user_id,$cluster_apckagae_id=NULL, $dsort='DESC')
	{
		if($cluster_apckagae_id!='')
		{
			$whr_q	=	" and a.cluster_package_id='".$cluster_apckagae_id."'";
		}

		unset($this->result);
		$sql="SELECT
				a.cluster_id,a.hsp_id,a.cluster_package_id,tcase(b.package_nm) as package_nm,tcase(c.`name`) as hsp_name,a.package_unit,a.price_per_unit,
				a.total_price,a.cluster_contribution,DATE_FORMAT(a.created_on,'%d %b %Y') as created_on,
				pack_emp.total_invited,
				pack_emp.appt_confirmed,
				pack_emp.visited,
				b.about_package,
				ebh_pack_test.lab_test_id_arr,
				ebh_pack_test.lab_test_name_arr,
				age_group.age_group_arr,
				nature_of_work.nature_of_work_arr,
				d.hsp_logo,b.ebh_package_id,
				concat(e.hsp_address,' ', e.hsp_locality,' ',e.hsp_landmark,', ', e.hsp_pin_code,', ',g.city_name,', ',h.state_name) as hsp_address,
				e.hsp_general_email_id,	e.hsp_helpline_number1,e.hsp_helpline_number2,e.hsp_helpline_number3,e.hsp_helpline_number4,
				tcase(hsp_branch.hsp_branchs) as hsp_branchs
				from tbl_cluster_packages as a
				left join tbl_ebh_pc_packages as b on a.package_id=b.ebh_package_id and a.package_type='EBH'
				left join tbl_hsps as c on a.hsp_id = c.id
				LEFT join tbl_hsp_business_details as d on c.id = d.hspid
				LEFT join tbl_hsp_address_contacts as e on d.hspid = e.hspid
				LEFT JOIN cities as g on e.hsp_city = g.id
				LEFT JOIN states as h on e.hsp_state = h.id
				LEFT JOIN
				(
					SELECT
					x.hspid, GROUP_CONCAT(x.branch_name) as hsp_branchs
					FROM tbl_hsp_branchs as x
					GROUP BY x.hspid
				) as hsp_branch on d.hspid = hsp_branch.hspid
				LEFT JOIN
				(
				 SELECT
				 x.cluster_package_id,count(y.emp_id) as total_invited,
				 sum(if(y.is_confirmed=1,1,0)) as appt_confirmed,
				 sum(if(z.appt_status<>'New',1,0)) as visited
				 from tbl_cluster_packages as x
				 LEFT JOIN tbl_cluster_employee_pack as y on x.cluster_package_id = y.cluster_package_id
				 LEFT JOIN tbl_appointments as z on y.appointment_id = z.appointment_id
				 LEFT JOIN tbl_cluster_employee as p on y.emp_id = p.emp_id
			     WHERE p.cluster_user_id=".$cluster_user_id."
				 GROUP BY x.cluster_package_id
				) as pack_emp on a.cluster_package_id = pack_emp.cluster_package_id
				left join
				(
					SELECT
					x.ebh_package_id ,
					GROUP_CONCAT(y.lab_test_id) as lab_test_id_arr,
					GROUP_CONCAT(z.test_name) as lab_test_name_arr
					from tbl_ebh_pc_packages as x
					left join tbl_ebh_pc_packages_tests as y on x.ebh_package_id = y.ebh_package_id
					left join tbl_preventive_care_tests as z on y.lab_test_id = z.lab_test_id
					GROUP BY x.ebh_package_id
				) as ebh_pack_test on b.ebh_package_id = ebh_pack_test.ebh_package_id
				LEFT JOIN
				(
					SELECT
					x.ebh_package_id,
					GROUP_CONCAT(y.age_group) as age_group_arr
					from tbl_ebh_pc_packages as x
					LEFT JOIN tbl_ebh_pc_packages_agegroup as y on x.ebh_package_id = y.ebh_package_id
					GROUP BY x.ebh_package_id
				) as age_group on b.ebh_package_id = age_group.ebh_package_id
				LEFT JOIN
				(
					SELECT
					x.ebh_package_id,
					GROUP_CONCAT(y.nature_of_work) as nature_of_work_arr
					from tbl_ebh_pc_packages as x
					LEFT JOIN tbl_ebh_pc_packages_natureofwork as y on x.ebh_package_id = y.ebh_package_id
					GROUP BY x.ebh_package_id
				) as nature_of_work on b.ebh_package_id = nature_of_work.ebh_package_id

			where a.cluster_id='".$cluster_id."'  ".$whr_q." ORDER BY a.created_on ".$dsort."";
		$this->select($sql);
        return $this->result;
	}

	public function getclusterUserEbhPackageInvited($cluster_id,$cluster_user_id,$cluster_package_id)
	{
		unset($this->result);
		$sql="SELECT
		concat(a.salutation,' ',a.first_name,' ',a.last_name) AS emp_name,
		a.professional_email_id,a.mobile_no,
		c.appt_status,
		d.report_title,d.report_path,
		DATE_FORMAT(b.created_on,'%d %b %Y') as invited_on,
		DATE_FORMAT(c.modified_on,'%d %b %Y') as visited_on,
		z.package_nm
		FROM tbl_cluster_employee AS a
		LEFT JOIN tbl_cluster_employee_pack AS b ON b.emp_id = a.emp_id
		LEFT JOIN tbl_appointments AS c ON c.ebh_customer_id = a.ebh_customer_id
		LEFT JOIN tbl_appointments_report AS d ON d.appointment_id = c.appointment_id
		LEFT JOIN tbl_cluster_packages AS e ON e.cluster_package_id = b.cluster_package_id
		LEFT JOIN tbl_ebh_pc_packages AS z ON z.ebh_package_id = e.package_id
		WHERE a.cluster_id = '".$cluster_id."' AND a.cluster_user_id = '".$cluster_user_id."' AND b.cluster_package_id = '".$cluster_package_id."'
		GROUP BY a.emp_id 
		";
		$this->select($sql);
        return $this->result;
	}

	public function getclusterEbhPackageEmployee($cluster_id)
	{
		unset($this->result);

		$sql="SELECT
		a.cluster_package_id,
		concat(tcase(c.salutation),' ',tcase(c.first_name),' ',tcase(c.last_name)) AS employee_name,
		c.salutation,
		c.first_name,
		c.last_name,
		DATE_FORMAT(a.confirmed_on, '%d %b %Y') AS confirmed_on,
		DATE_FORMAT(b.verified_on, '%d %b %Y') AS visited_on,
		b.is_report_uploaded,
		report.report_name,
		report.report_path,
		report.bp,report.temp,report.pulse_rate,report.resp_rate,report.height,report.weight,report.bmi,report.bmi_category,report.temperature,
		report.created_on
		FROM
		tbl_cluster_employee_pack AS a
		LEFT JOIN tbl_appointments AS b ON a.appointment_id = b.appointment_id
		LEFT JOIN tbl_ebh_customer AS c ON b.ebh_customer_id = c.ebh_customer_id
		LEFT JOIN (
		SELECT
		x.appointment_id,
		GROUP_CONCAT(x.report_title) AS report_name,
		GROUP_CONCAT(x.report_path) AS report_path,
		x.bp,x.temp,x.pulse_rate,x.resp_rate,x.height,x.weight,x.bmi,x.bmi_category,x.temperature,
		x.created_on
		FROM
		tbl_appointments_report AS x
		GROUP BY
		x.appointment_id
		) AS report ON b.appointment_id = report.appointment_id
		WHERE a.cluster_id='".$cluster_id."' AND b.appt_status <> 'New'";

		$this->select($sql);
        return $this->result;
	}
	/*END*/
	/*EBH PACKAGE SALES PRICE*/
	public function getEBHPackage_HSP_price($dataId=NULL)
	{
		unset($this->result);
		$sql="SELECT
				a.ebh_package_id,
				a.package_nm,
				b.hsp_id, c.`name` as hsp_name,
				b.purchase_price as ebh_purchase_price,
				a.sales_price_type,a.sales_price as ebh_fixed_sale_price,
				b.sales_price as ebh_sales_price

				from tbl_ebh_pc_packages as a
				LEFT JOIN tbl_ebh_hsp_package_mapping as b on a.ebh_package_id = b.ebh_package_id
				LEFT JOIN tbl_hsps as c on b.hsp_id = c.id
				where a.ebh_package_id='".$dataId."'";
		$this->select($sql);
        return $this->result;
	}
	/*END*/
	/*PACKAGE COUNT*/
	public function getEbhPackageStatusCount()
	{
		unset($this->result);
		$sql="SELECT
				sum(if(a.is_keyword_assigned<>1 AND a.is_published<>1,1,0)) as pending_keyword,
				sum(if(a.is_medical_review_done<>1,1,0)) as pending_medical_review,
				sum(if(a.is_purchase_price<>1,1,0)) as pending_purchase_price,
				sum(if(a.is_sales_price<>1,1,0)) as pending_sales_price,
				sum(if(a.is_published<>1,1,0)) as pending_publish,

				sum(if(a.is_keyword_assigned=1,1,0)) as keyword_update_done,
				sum(if(a.is_medical_review_done=1,1,0)) as medical_review_done,
				sum(if(a.is_purchase_price=1,1,0)) as purchase_price_available,
				sum(if(a.is_sales_price=1,1,0)) as sales_price_avaiable,
				sum(if(a.is_published=1,1,0)) as published_packages
				from tbl_ebh_pc_packages as a
				WHERE a.is_active=1
				";
		$this->select($sql);
        return $this->result;
	}
	/*END*/

	/**/
	public function getClusterEmp($clusterId,$emp_id)
	{
		unset($this->result);
		if($emp_id != ''){
			$where_qry = " and a.emp_id ='".$emp_id."'";
		}
		//concat(a.salutation,'',a.first_name,' ',a.middle_name,' ',a.last_name) as emp_name,
		$sql="SELECT a.emp_id,
			a.salutation,
			a.first_name,
			a.middle_name,
			a.last_name,
			if(a.middle_name<>'' or a.middle_name is not null, concat(a.salutation,' ',tcase(a.first_name),' ',tcase(a.middle_name),' ',tcase(a.last_name)), concat(a.salutation,' ',tcase(a.first_name),' ',tcase(a.last_name))) as emp_name,
			a.professional_email_id,
			a.personal_email_id,
			a.emp_designation,
			b.city_name,
			if(a.emp_dob<>'0000-00-00' or a.emp_dob is not null,a.emp_dob,'') as dob,
			if(a.emp_dob<>'0000-00-00' or a.emp_dob is not null,DATE_FORMAT(a.emp_dob,'%d %b %Y'),'') as emp_dob,
			if(a.anniversary_date<>'0000-00-00' or a.anniversary_date is not null,DATE_FORMAT(a.anniversary_date,'%d %b %Y'),'') as anniversary_date,
			a.mobile_no,
			c.date_of_birth,
			c.photo,
			c.photo_thumb,
			c.blood_group
		from tbl_cluster_employee as a
		left join tbl_ebh_customer as c on a.ebh_customer_id=c.ebh_customer_id
		left join cities b on b.id = a.city
		WHERE cluster_id='".$clusterId."' ".$where_qry;

		$this->select($sql);
        return $this->result;
	}
	public function getClusterEmpDetails($clusterId,$health_type = '',$limit = '')
	{
		unset($this->result);
		if($health_type == 'H'){
			$where_qry = " and rp.bs_status!='UH' and rp.bp_status !='UH' and rp.bmi_status !='UH' and rp.bmi_status !=''";
		}elseif($health_type == 'UH'){
			$where_qry = " and (rp.bs_status='UH' or rp.bp_status ='UH' or rp.bmi_status ='UH')";
		}
		//concat(a.salutation,'',a.first_name,' ',a.middle_name,' ',a.last_name) as emp_name,
		$sql="SELECT a.emp_id,rp.bs_status,rp.bp_status,rp.bmi_status, rp.bmi_category,rp.bp_category,rp.bs_result,
if(rp.bp_status = '' and rp.bs_status='' and rp.bmi_status ='' ,'',
if(rp.bp_status is null and rp.bs_status is null and rp.bmi_status is null ,'',
		if(rp.bp_status = 'UH' or rp.bs_status='UH' or rp.bmi_status ='UH','UH','H'))) as health,
			a.salutation,
			a.first_name,
			a.middle_name,
			a.last_name,
			if(a.middle_name<>'' or a.middle_name is not null, concat(a.salutation,' ',tcase(a.first_name),' ',tcase(a.middle_name),' ',tcase(a.last_name)), concat(a.salutation,' ',tcase(a.first_name),' ',tcase(a.last_name))) as emp_name,
			a.professional_email_id,
			a.personal_email_id,
			a.emp_designation,
			b.city_name,
			if(a.emp_dob<>'0000-00-00' or a.emp_dob is not null,a.emp_dob,'') as dob,
			if(a.emp_dob<>'0000-00-00' or a.emp_dob is not null,DATE_FORMAT(a.emp_dob,'%d %b %Y'),'') as emp_dob,
			if(a.anniversary_date<>'0000-00-00' or a.anniversary_date is not null,DATE_FORMAT(a.anniversary_date,'%d %b %Y'),'') as anniversary_date,
			a.mobile_no,
			c.date_of_birth,
			c.photo,
			c.photo_thumb,
			c.blood_group
		from tbl_cluster_employee as a
		left join tbl_ebh_customer as c on a.ebh_customer_id=c.ebh_customer_id
		
		left join tbl_appointments ap on ap.ebh_customer_id = c.ebh_customer_id 
		left join (select r.appointment_id,r.bmi_category,r.bp_category,r.bs_result,
				if(r.bmi_category='Normal' , 'H', if (r.bmi_category='Underweight' or r.bmi_category='Overweight' ,'UH','')) as bmi_status,
					if(r.bp_category='Normal Blood pressure range' , 'H', 
				if (r.bp_category='Lower than Normal'
					or r.bp_category='Prehypertension'
					or r.bp_category='Stage 1 Hypertension'
					or r.bp_category='Stage 2 Hypertension'
					 ,'UH','')) as bp_status,
				if(r.bs_result='Normal' , 'H', 
					if (r.bs_result='Prediabetes'
					or r.bs_result='Diabetes'
					,'UH','')) as bs_status 
				from tbl_appointments_report r) rp on rp.appointment_id = ap.appointment_id
				
				left join cities b on b.id = a.city where a.cluster_id='".$clusterId."' ".$where_qry.' '.$limit;

		$this->select($sql);
        return $this->result;
	}
	
public function getClusterEmpCount($clusterId)
	{
		
		unset($this->result);
		
		//concat(a.salutation,'',a.first_name,' ',a.middle_name,' ',a.last_name) as emp_name,
		 $sql="SELECT count(1) as count,
if(rp.bp_status = '' and rp.bs_status='' and rp.bmi_status ='' ,'',
if(rp.bp_status is null and rp.bs_status is null and rp.bmi_status is null ,'',
		if(rp.bp_status = 'UH' or rp.bs_status='UH' or rp.bmi_status ='UH','UH','H'))) as health
		from tbl_cluster_employee as a
		left join tbl_ebh_customer as c on a.ebh_customer_id=c.ebh_customer_id		
		left join tbl_appointments ap on ap.ebh_customer_id = c.ebh_customer_id 
		left join (select r.appointment_id,r.bmi_category,r.bp_category,r.bs_result,
				if(r.bmi_category='Normal' , 'H', if (r.bmi_category='Underweight' or r.bmi_category='Overweight' ,'UH','')) as bmi_status,
					if(r.bp_category='Normal Blood pressure range' , 'H', 
				if (r.bp_category='Lower than Normal'
					or r.bp_category='Prehypertension'
					or r.bp_category='Stage 1 Hypertension'
					or r.bp_category='Stage 2 Hypertension'
					 ,'UH','')) as bp_status,
				if(r.bs_result='Normal' , 'H', 
					if (r.bs_result='Prediabetes'
					or r.bs_result='Diabetes'
					,'UH','')) as bs_status 
				from tbl_appointments_report r) rp on rp.appointment_id = ap.appointment_id
				 where a.cluster_id='".$clusterId."' group by health ";

		$this->select($sql);
		$result = $this->result;
		//print_R($result);	
		$returnArr['healthy'] = 0;
		$returnArr['unhealthy'] = 0;
		$returnArr['total'] = 0;
		foreach($result as $key=>$val){
			switch($val['health']){
				case 'H':$returnArr['healthy'] = $val['count'];
						$returnArr['total'] += $val['count'];
				break;
				case 'UH':$returnArr['unhealthy'] = $val['count'];
						$returnArr['total'] += $val['count'];
				break;
				default:$returnArr['total'] += $val['count'];
					
			}
		}
        return $returnArr;
	}
	
	public function getClusterUserEmp($clusterId,$cluster_user_id,$emp_id)
	{
		unset($this->result);
		if($emp_id != ''){
			$where_qry = " and a.emp_id ='".$emp_id."'";
		}
		//concat(a.salutation,'',a.first_name,' ',a.middle_name,' ',a.last_name) as emp_name,
		$sql="SELECT a.emp_id,
			a.salutation,
			a.first_name,
			a.middle_name,
			a.last_name,
			if(a.middle_name<>'' or a.middle_name is not null, concat(a.salutation,' ',tcase(a.first_name),' ',tcase(a.middle_name),' ',tcase(a.last_name)), concat(a.salutation,' ',tcase(a.first_name),' ',tcase(a.last_name))) as emp_name,
			a.professional_email_id,
			a.personal_email_id,
			a.emp_designation,
			b.city_name,
			if(a.emp_dob<>'0000-00-00' or a.emp_dob is not null,DATE_FORMAT(a.emp_dob,'%d %b %Y'),'') as emp_dob,
			if(a.anniversary_date<>'0000-00-00' or a.anniversary_date is not null,DATE_FORMAT(a.anniversary_date,'%d %b %Y'),'') as anniversary_date,
			a.mobile_no
		from tbl_cluster_employee as a
		left join cities b on b.id = a.city
		WHERE cluster_id='".$clusterId."' AND cluster_user_id = '".$cluster_user_id."' ".$where_qry;

		$this->select($sql);
        return $this->result;
	}

	public function getGender($salutation)
	{
		$gender = null;
		if($salutation == 'Mr.' or $salutation == 'Mr')
		{
			$gender = 'Male';
		}
		elseif($salutation == 'Ms.' or $salutation == 'Ms' or $salutation == 'Mrs.' or $salutation == 'Mrs')
		{
			$gender = 'Female';
		}
        return $gender;
	}

	public function getClusterEmpByGenderBmi($clusterId,$gender,$bmi_stat)
	{
		unset($this->result);
		if(!empty($gender))
		{
			if($gender == 'female')
			{
				$gender_where = " AND salutation='Ms.'
				OR cluster_id='".$clusterId."' AND salutation='Mrs.'
				OR cluster_id='".$clusterId."' AND salutation='Kumari.'
				OR cluster_id='".$clusterId."' AND salutation='Ms'
				OR cluster_id='".$clusterId."' AND salutation='Mrs'
				OR cluster_id='".$clusterId."' AND salutation='Kumari'";
			}
			else
			{
				$gender_where = " AND salutation='Mr.'
				OR cluster_id='".$clusterId."' AND salutation='Kumar.'
				OR cluster_id='".$clusterId."' AND salutation='Shri.'
				OR cluster_id='".$clusterId."' AND salutation='Mr'
				OR cluster_id='".$clusterId."' AND salutation='Kumar'
				OR cluster_id='".$clusterId."' AND salutation='Shri'";
			}
		}

		$sql="SELECT *	FROM tbl_cluster_employee WHERE cluster_id='".$clusterId."'".$gender_where."";
		$this->select($sql);
        return $this->result;
	}

	public function getClusterEmpGender($clusterId,$emp_id)
	{
		$gender = NULL;
		unset($this->result);
		$sql="SELECT salutation	FROM tbl_cluster_employee WHERE cluster_id='".$clusterId."' AND emp_id='".$emp_id."'";
		$this->select($sql);
        $salutation=$this->result;

		if($salutation[0]['salutation'] == 'Ms.' or $salutation[0]['salutation'] == 'Mrs.' or $salutation[0]['salutation'] == 'Kumari.' or $salutation[0]['salutation'] == 'Ms' or $salutation[0]['salutation'] == 'Mrs' or $salutation[0]['salutation'] == 'Kumari')
		{
			$gender = 'Female';
		}
		elseif($salutation[0]['salutation'] == 'Mr.' or $salutation[0]['salutation'] == 'Kumar.' or $salutation[0]['salutation'] == 'Shri.' or $salutation[0]['salutation'] == 'Mr' or $salutation[0]['salutation'] == 'Kumar' or $salutation[0]['salutation'] == 'Shri')
		{
			$gender = 'Male';
		}
		else
		{
			$gender = $salutation[0]['salutation'];
		}

		return $gender;
	}

	/**/

	/*Change Password*/
	public function getUserPassword($user_id,$old_password)
	{
		unset($this->result);
		$sql="SELECT login_password from tbl_user_mst where user_id='".$user_id."' and login_password='".$old_password."'";
		$this->select($sql);
        return $this->result;
	}
	/**/
	/*CLUSTER Package */
	public function getClusterPackageDetails($cluster_package_id)
	{

		$sql="SELECT
				b.package_nm
				from tbl_cluster_packages as a
				left join tbl_ebh_pc_packages as b on a.package_id=b.ebh_package_id and a.package_type='EBH'
				WHERE a.cluster_package_id='".$cluster_package_id."'";
		$this->select($sql);
        return $this->result;
	}
	/**/
	function accept_invitation($where)
	{
		$sql="SELECT a.user_id, a.acc_id,CONCAT(a.first_name,' ',a.last_name) as username, a.company_name,b.acc_admin_phone,
b.organization_name,a.user_email FROM tbl_user_mst as a LEFT JOIN tbl_accounts_mst as b on a.acc_id=b.acc_id  where MD5(CONCAT(a.user_email,'~',a.first_name,'~',a.acc_id))='".$where."'";
		$this->select($sql);
		return $this->result;
	}

	/*HSP Branch*/
	public function getHspBranch($hsp_id = NULL ,$dataId = NULL)
	{
		unset($this->result);
		if($dataId != ''){
			$whr_query = " and a.branch_id = '".$dataId."' ";
		}
		if($hsp_id != ''){
			$whr_query.= " and a.hspid='".$hsp_id."' ";
		}

		$sql="SELECT DISTINCT
				a.branch_id,
				a.hspid,
				a.branch_name,
				a.br_general_email_id,
				a.br_helpline_number1,
				a.br_helpline_number2,
				a.br_helpline_number3,
				a.br_helpline_number4,
				a.br_address,
				a.br_landmark,
				a.br_locality,
				a.br_city,
				a.br_pin_code,
				a.br_state,
				a.br_country,
				a.br_fd_name_a,
				a.br_fd_phone_a,
				a.br_fd_email_a,
				a.br_fd_name_b,
				a.br_fd_phone_b,
				a.br_fd_email_b,
				a.br_fm_name,
				a.br_fm_phone,
				a.br_fm_email,
				b.state_name,
				c.city_name,
				d.country_name
				FROM tbl_hsp_branchs a
				LEFT JOIN states b on a.br_state = b.id
				LEFT JOIN cities c on a.br_city=c.id
				LEFT JOIN countries d on a.br_country = d.id
				WHERE a.is_active<>2 ".$whr_query." ORDER BY a.branch_id ASC";
		$this->select($sql);
        return $this->result;
	}
	/*End */

	public function getHspBranchPackage($hsp_id = NULL, $package_id=NULL)
	{
		unset($this->result);
		$sql="SELECT
				a.branch_id,a.branch_name,
				b.sr_no
				from tbl_hsp_branchs as a
			left join tbl_ebh_pc_hsp_branch as b on a.branch_id = b.branch_id and b.ebh_package_id='".$package_id."'
			where a.hspid='".$hsp_id."' and a.is_active=1 ORDER BY a.branch_id";
		$this->select($sql);
        return $this->result;
	}

	public function getHspPackageBranch($hsp_id = NULL, $package_id=NULL)
	{
		unset($this->result);
		$sql="SELECT
				a.branch_id,a.branch_name,
				b.sr_no
				from tbl_hsp_branchs as a
			INNER join tbl_ebh_pc_hsp_branch as b on a.branch_id = b.branch_id and b.ebh_package_id='".$package_id."'
			where a.hspid='".$hsp_id."' and a.is_active=1 ORDER BY a.branch_id";
		$this->select($sql);
        return $this->result;
	}

	public function getBranchAppointments($branch_id,$list_type=NULL,$voucher_code=NULL)
	{
		unset($this->result);
		if($voucher_code!='')
		{
			$v_query	=	" and a.appt_voucher_code='".$voucher_code."'";
		}

		switch($list_type)
		{
			case "TODAY":
				$date_query = " and a.appt_request_date=DATE(NOW()) ";
			break;
			case "f08faee6cee8c297d12855d1b904cde2bca22f44"://TOMORROW
				$date_query = " and a.appt_request_date IN(CURDATE() + INTERVAL 1 DAY)";
				$order_by=" ORDER BY  a.appt_request_date DESC";
			break;
			case "ba6e98ecd5596d34d79a7bc6b88d7a840ba96239": // NEXT 7 DAYS
				$date_query = " and a.appt_request_date >=(CURDATE()) and a.appt_request_date <=(CURDATE() + INTERVAL 7 DAY)";
				$order_by=" ORDER BY  a.appt_request_date ASC";
			break;
			case "48641a4af7f26c26d88bb8b0a24faf7e303bfdf0": // NEXT 1 MONTH
				$date_query = " and a.appt_request_date >=(CURDATE()) and a.appt_request_date <=(CURDATE() + INTERVAL 1 MONTH)";
				$order_by=" ORDER BY  a.appt_request_date ASC";
			break;
			case "83d48dfa496dc79dd5ec8be2e40859c8a0a3b69d": // NEXT 3 MONTHS
				$date_query = " and a.appt_request_date >=(CURDATE()) and a.appt_request_date <=(CURDATE() + INTERVAL 3 MONTH)";
				$order_by=" ORDER BY  a.appt_request_date ASC";
			break;
			case "a05fa5b3b2c741699ceeb95854f1ce70f88d6d86"://YESTERDAY
				$date_query = " and a.appt_request_date IN(CURDATE() - INTERVAL 1 DAY)";
				$order_by=" ORDER BY  a.appt_request_date ASC";
			break;
			case "9362970e388a0026ab4c1e121719d8580f01df2f": // LAST 7 DAYS
				$date_query = " and (a.appt_request_date <=(CURDATE()) and a.appt_request_date >=(CURDATE() - INTERVAL 7 DAY))";
				$order_by=" ORDER BY  a.appt_request_date DESC";
			break;
			case "7d350927f1bb7dfbf0fe9fb09537bc1c6e03e35b": // LAST 1 MONTH
				$date_query = " and (a.appt_request_date <=(CURDATE()) and a.appt_request_date >=(CURDATE() - INTERVAL 1 MONTH))";
				$order_by=" ORDER BY  a.appt_request_date DESC";
			break;
			case "bd4e1ea607454642d141cb79ebdb2d7c32cef9d6": // LAST 3 MONTHS
				$date_query = " and (a.appt_request_date <=(CURDATE()) and a.appt_request_date >=(CURDATE() - INTERVAL 3 MONTH))";
				$order_by=" ORDER BY  a.appt_request_date DESC";
			break;

			case "231e564db4cdb44a6545583a8d460edc7f9f97ca": // COMPLETED APPOINTMENTS
				$date_query = " and a.appt_status ='Visited'";
				$order_by=" ORDER BY  a.appt_request_date DESC";
			break;

			default:
				$date_query = " ";
			break;
		}

		$sql="SELECT
				a.appointment_id,a.appt_voucher_code,a.appt_status,
				concat(DATE_FORMAT(a.appt_request_date,'%d %b %Y'),' ', TIME_FORMAT(a.appt_request_time,'%h %i %p')) as appointment_datetime,
				Concat(b.salutation,' ',tcase(b.first_name),' ',tcase(b.last_name)) as visitor_name,
				b.personal_email_id,
				b.professional_email_id,
				b.mobile_no,b.city_name,
				c.package_nm,lab_test.lab_test_name_arr ,
				DATE_FORMAT(c.valid_till,'%d %b %Y') as valid_till,
				DATE_FORMAT(a.verified_on,'%d %b %Y') as verified_on,
				DATE_FORMAT(a.report_uploaded_on,'%d %b %Y') as report_uploaded_on,
				a.is_report_uploaded
				FROM tbl_appointments as a
				LEFT JOIN tbl_ebh_customer as b on a.ebh_customer_id = b.ebh_customer_id
				LEFT JOIN tbl_ebh_pc_packages as c on a.ebh_package_id = c.ebh_package_id
				left JOIN
				(
					SELECT
					x.ebh_package_id,
					GROUP_CONCAT(x.lab_test_id) AS lab_test_id_arr,
					GROUP_CONCAT(y.test_name) AS lab_test_name_arr

					from tbl_ebh_pc_packages_tests AS x
					LEFT JOIN tbl_preventive_care_tests AS y ON x.lab_test_id = y.lab_test_id
					group by x.ebh_package_id
				) as lab_test on a.ebh_package_id = lab_test.ebh_package_id
				WHERE a.hsp_branch_id = ".$branch_id." ".$date_query." ".$v_query.$order_query;

		$this->select($sql);
        return $this->result;
	}

	function generate_OTP() {
        //settings
        $chars = "123456789";
        $minchars = 4;
        $maxchars = 4;
        //rest of script
        $escapecharplus = 0;
        $repeat = mt_rand($minchars, $maxchars);
        while ($escapecharplus < $repeat) {
            $randomword.=$chars[mt_rand(1, strlen($chars) - 1)];
            $escapecharplus+=1;
        }
        //display random word
        return $randomword;
    }
	public function getCustomerInfo($customer_id=NULL)
	{
		unset($this->result);
		if($customer_id!='')
		{
			$wh_query	=" and a.ebh_customer_id='".$customer_id."'";
		}

		$sql="SELECT
				a.ebh_customer_id,
				a.salutation,
				a.first_name,
				a.middle_name,
				a.last_name,
				a.current_designation,
				a.professional_email_id,
				a.personal_email_id,
				a.mobile_no,
				a.date_of_birth,
				a.address,
				a.pincode,
				a.city_name as c_city_name,
				a.country_id,b.country_name,
				a.state_id,c.state_name,
				a.city_id,d.city_name,
				a.photo,
				a.photo_thumb
				from tbl_ebh_customer as a
				left join countries as b on a.country_id = b.id
				left join states as c on a.state_id = c.id
				left join cities as d on a.city_id = d.id
				WHERE 1 ".$wh_query;
		$this->select($sql);
        return $this->result;
	}

	public function getCustomerFamilyInfo($customer_id=NULL,$relation=NULL)
	{
		unset($this->result);
		if($customer_id!='')
		{
			$wh_query	=" and a.ebh_customer_id='".$customer_id."'";
		}
		if($relation!='')
		{
			$wh_query	.=" and upper(relation)=upper('".$relation."')";
		}

		$sql="SELECT
				a.sr_no,
				a.ebh_customer_id,
				a.relation,
				a.child_gender,
				a.salutation,
				a.first_name,
				a.middle_name,
				a.last_name,
				a.current_designation,
				a.personal_email_id,
				a.mobile_no,
				a.date_of_birth,
				a.address,
				a.pincode,
				a.city_name as c_city_name,
				a.country_id,b.country_name,
				a.state_id,c.state_name,
				a.city_id,d.city_name,
				a.photo,
				a.photo_thumb
			from tbl_ebh_customer_family as a
			left join countries as b on a.country_id = b.id
			left join states as c on a.state_id = c.id
			left join cities as d on a.city_id = d.id
			WHERE 1 ".$wh_query;

		$this->select($sql);
        return $this->result;
	}

	public function getCustomerPackage($customer_id)
	{
		unset($this->result);
		$sql="SELECT
				a.appointment_id,
				if(a.ebh_package_id IS NULL,'HSP PACKAGE','EBH PACKAGE') as package_type,
				a.ebh_package_id,b.package_nm,
				a.hsp_id,c.hsp_brand_name as hsp_name,
				c.hsp_logo,
				a.hsp_branch_id, d.branch_name,
				d.br_general_email_id,	d.br_helpline_number1,
				a.hsp_pack_id, e.package_nm as hsp_package_name,
				a.appt_status,
				DATE_FORMAT(a.appt_request_date,'%d %b %Y') as appt_request_date,
				TIME_FORMAT(a.appt_request_time,'%h %i %p') as appt_request_time,
				a.appt_voucher_code,a.verified_on, lab_test.lab_test_name_arr,
				concat(d.br_address,' ', d.br_locality,' ',d.br_landmark,', ', d.br_pin_code,', ',g.city_name,', ',h.state_name) as branch_address
				from tbl_appointments as a
				LEFT JOIN tbl_ebh_pc_packages as b on a.ebh_package_id=b.ebh_package_id
				left join tbl_hsp_business_details as c on a.hsp_id = c.hspid
				left join tbl_hsp_branchs as d on a.hsp_branch_id = d.branch_id
				left join tbl_hsp_pc_packages as e on a.hsp_pack_id = e.hsp_package_id
				LEFT JOIN cities as g on d.br_city = g.id
				LEFT JOIN states as h on d.br_state = h.id
				left JOIN
				(
					SELECT
					x.ebh_package_id,
					GROUP_CONCAT(x.lab_test_id) AS lab_test_id_arr,
					GROUP_CONCAT(y.test_name) AS lab_test_name_arr

					from tbl_ebh_pc_packages_tests AS x
					LEFT JOIN tbl_preventive_care_tests AS y ON x.lab_test_id = y.lab_test_id
					group by x.ebh_package_id
				) as lab_test on a.ebh_package_id = lab_test.ebh_package_id
				where a.ebh_customer_id = '".$customer_id."'";
		$this->select($sql);
        return $this->result;
	}

	public function getClusterPackageUtilizationSummary($cluster_package_id)
	{
		unset($this->result);

		$sql="SELECT a.period ,
				case
						when a.a_month=1 then concat('Jan','-',a.a_year)
						when a.a_month=2 then concat('Feb','-',a.a_year)
						when a.a_month=3 then concat('Mar','-',a.a_year)
						when a.a_month=4 then concat('Apr','-',a.a_year)
						when a.a_month=5 then concat('May','-',a.a_year)
						when a.a_month=6 then concat('Jun','-',a.a_year)
						when a.a_month=7 then concat('Jul','-',a.a_year)
						when a.a_month=8 then concat('Aug','-',a.a_year)
						when a.a_month=9 then concat('Sep','-',a.a_year)
						when a.a_month=10 then concat('Oct','-',a.a_year)
						when a.a_month=11 then concat('Nov','-',a.a_year)
						when a.a_month=12 then concat('Dec','-',a.a_year)
				end as month_year,
				COALESCE(invited.total_invited,0) as total_invited,
				COALESCE(confirmed.appt_confirmed,0) as appt_confirmed,
				COALESCE(visited.total_visited,0) as total_visited
				from view_last_six_months  as a
				left join
				(
						SELECT
							month(y.created_on) as c_month,
							year(y.created_on) as c_year,
							count(y.emp_id) as total_invited
						from tbl_cluster_employee_pack as y
						WHERE y.cluster_package_id='".$cluster_package_id."'
						GROUP BY month(y.created_on), year(y.created_on)
				) as invited on a.a_month = invited.c_month and a.a_year = invited.c_year
				left join
				(
					SELECT
						month(y.confirmed_on) as c_month,
						year(y.confirmed_on) as c_year,
						sum(if(y.is_confirmed=1,1,0)) as appt_confirmed
					FROM tbl_cluster_employee_pack as y
					WHERE  y.cluster_package_id='".$cluster_package_id."'
					GROUP BY month(y.confirmed_on), year(y.confirmed_on)
				) as  confirmed on a.a_month = confirmed.c_month and a.a_year = confirmed.c_year
				left join
				(
					SELECT
						month(z.verified_on) as c_month,
						year(z.verified_on) as c_year,
						sum(if(z.appt_status<>'New',1,0)) as total_visited
					FROM tbl_cluster_employee_pack as y
					LEFT JOIN tbl_appointments as z on y.appointment_id = z.appointment_id
					WHERE  y.cluster_package_id='".$cluster_package_id."'
					GROUP BY month(z.verified_on), year(z.verified_on)
				) as  visited on a.a_month = visited.c_month and a.a_year = visited.c_year
				GROUP BY a.a_month,a.a_year
				ORDER BY a.a_year DESC, a.a_month DESC";
		$this->select($sql);
        return $this->result;
	}

	public function getClusterPackageUtilizationSummaryAgent($cluster_package_id, $cluster_agent_id)
	{
		unset($this->result);

		$sql="SELECT a.period ,
				case
						when a.a_month=1 then concat('Jan','-',a.a_year)
						when a.a_month=2 then concat('Feb','-',a.a_year)
						when a.a_month=3 then concat('Mar','-',a.a_year)
						when a.a_month=4 then concat('Apr','-',a.a_year)
						when a.a_month=5 then concat('May','-',a.a_year)
						when a.a_month=6 then concat('Jun','-',a.a_year)
						when a.a_month=7 then concat('Jul','-',a.a_year)
						when a.a_month=8 then concat('Aug','-',a.a_year)
						when a.a_month=9 then concat('Sep','-',a.a_year)
						when a.a_month=10 then concat('Oct','-',a.a_year)
						when a.a_month=11 then concat('Nov','-',a.a_year)
						when a.a_month=12 then concat('Dec','-',a.a_year)
				end as month_year,
				COALESCE(invited.total_invited,0) as total_invited,
				COALESCE(confirmed.appt_confirmed,0) as appt_confirmed,
				COALESCE(visited.total_visited,0) as total_visited
				from view_last_six_months  as a
				left join
				(
						SELECT
							month(y.created_on) as c_month,
							year(y.created_on) as c_year,
							count(y.emp_id) as total_invited
						from tbl_cluster_employee_pack as y
						LEFT JOIN tbl_cluster_employee as z on z.emp_id = y.emp_id
						WHERE y.cluster_package_id='".$cluster_package_id."' AND z.cluster_user_id = '".$cluster_agent_id."'
						GROUP BY month(y.created_on), year(y.created_on)
				) as invited on a.a_month = invited.c_month and a.a_year = invited.c_year
				left join
				(
					SELECT
						month(y.confirmed_on) as c_month,
						year(y.confirmed_on) as c_year,
						sum(if(y.is_confirmed=1,1,0)) as appt_confirmed
					FROM tbl_cluster_employee_pack as y
					LEFT JOIN tbl_cluster_employee as z on z.emp_id = y.emp_id
					WHERE y.cluster_package_id='".$cluster_package_id."' AND z.cluster_user_id = '".$cluster_agent_id."'
					GROUP BY month(y.confirmed_on), year(y.confirmed_on)
				) as  confirmed on a.a_month = confirmed.c_month and a.a_year = confirmed.c_year
				left join
				(
					SELECT
						month(z.verified_on) as c_month,
						year(z.verified_on) as c_year,
						sum(if(z.appt_status<>'New',1,0)) as total_visited
					FROM tbl_cluster_employee_pack as y
					LEFT JOIN tbl_appointments as z on y.appointment_id = z.appointment_id
					LEFT JOIN tbl_cluster_employee as x on x.emp_id = y.emp_id
					WHERE  y.cluster_package_id='".$cluster_package_id."' AND x.cluster_user_id = '".$cluster_agent_id."'
					GROUP BY month(z.verified_on), year(z.verified_on)
				) as  visited on a.a_month = visited.c_month and a.a_year = visited.c_year
				GROUP BY a.a_month,a.a_year
				ORDER BY a.a_year DESC, a.a_month DESC";
		$this->select($sql);
        return $this->result;
	}

	public function getPackageUtilizationList($cluster_packagae_id,$is_visited,$is_confirmed)
	{
		unset($this->result);

		if($is_visited==1)
		{
			$where_qry	=	" and b.appt_status<>'New'";
		}
		if($is_confirmed==1)
		{
			$where_qry	=	" and a.is_confirmed=1 and b.appt_status='New'";
		}

		$sql="SELECT
			a.cluster_package_id,
			concat(tcase(c.salutation),' ',tcase(c.first_name),' ', tcase(c.last_name)) as employee_name,
			DATE_FORMAT(a.confirmed_on,'%d %b %Y') as confirmed_on 	,
			DATE_FORMAT(b.verified_on,'%d %b %Y') as visited_on ,
			b.is_report_uploaded,
			report.report_name,
			report.report_path
		FROM  tbl_cluster_employee_pack as a
		LEFT JOIN tbl_appointments as b on a.appointment_id = b.appointment_id
		LEFT JOIN tbl_ebh_customer as c on b.ebh_customer_id = c.ebh_customer_id
		LEFT JOIN
		(
			SELECT
				x.appointment_id,
				GROUP_CONCAT(x.report_title) as report_name,
				GROUP_CONCAT(x.report_path) as report_path
			from tbl_appointments_report as x
			group by x.appointment_id
		) as report on b.appointment_id = report.appointment_id
		WHERE a.cluster_package_id=".$cluster_packagae_id.$where_qry;

		$this->select($sql);
        return $this->result;
	}

		public function getAppointmentDetails($appointment_id,$encrypted=NULL)
	{
		unset($this->result);
		$where_qry	=	" WHERE b.appointment_id='".$appointment_id."'";
		if($encrypted==1)
		{
			$where_qry	=	" WHERE SHA1(b.appointment_id)='".$appointment_id."'";

		}

		$sql="SELECT
				a.sr_no,a.cluster_package_id,a.emp_id,a.cluster_id,a.appointment_id,
				j.hr_full_name,j.hr_email_id,
				b.ebh_customer_id,b.appt_request_date,
				concat(DATE_FORMAT(b.appt_request_date,'%d %b %Y'),' ', TIME_FORMAT(b.appt_request_time,'%h %i %p')) as appointment_datetime,
				b.appt_request_time,b.appt_voucher_code,
				tcase(CONCAT(c.first_name,' ',c.last_name)) as customer_name,c.mobile_no as customer_mobile,
				tcase(d.package_nm) as package_nm,
				e.`name` as hsp_name,
				f.branch_name,k.ebh_client_code,
				concat(f.br_address,' ', f.br_locality,' ',f.br_landmark,' ', f.br_pin_code,' ',g.city_name,h.state_name) as branch_address,
				f.br_general_email_id,	f.br_helpline_number1 ,lab_test.lab_test_name_arr,
				d.expected_medical_reports_title,
				b.recommendations
			FROM
				tbl_cluster_employee_pack AS a
			LEFT JOIN tbl_appointments as b on a.appointment_id=b.appointment_id
			LEFT JOIN tbl_ebh_customer as c on b.ebh_customer_id = c.ebh_customer_id
			LEFT JOIN tbl_ebh_pc_packages as d on b.ebh_package_id = d.ebh_package_id
			LEFT JOIN tbl_hsps as e on b.hsp_id = e.id
			LEFT JOIN tbl_hsp_branchs as f on b.hsp_branch_id = f.branch_id
			LEFT JOIN cities as g on f.br_city = g.id
			LEFT JOIN states as h on f.br_state = h.id
			LEFT JOIN tbl_hsp_business_details as i on e.id = i.hspid
			LEFT JOIN tbl_clusters as j on a.cluster_id = j.cluster_id
			left join tbl_hsp_apis as k on b.hsp_id = k.hsp_id 
			left JOIN
			(
				SELECT
				x.ebh_package_id,
				GROUP_CONCAT(x.lab_test_id) AS lab_test_id_arr,
				GROUP_CONCAT(y.test_name) AS lab_test_name_arr

				from tbl_ebh_pc_packages_tests AS x
				LEFT JOIN tbl_preventive_care_tests AS y ON x.lab_test_id = y.lab_test_id
				group by x.ebh_package_id
			) as lab_test on d.ebh_package_id = lab_test.ebh_package_id

			".$where_qry;

		$this->select($sql);
        return $this->result;
	}

	public function cluster_invitation_overview()
	{
		unset($this->result);
		$sql="SELECT
				tcase(c.package_nm) as package_nm,
				count(a.emp_id) as total_invites,
				((count(a.emp_id)*100)/(SELECT count(x.emp_id) from tbl_cluster_employee_pack as x where x.cluster_id='".$this->clusterId."') ) as invited_per,
				sum(if(a.is_confirmed=1,1,0)) as total_confirmed,
				((sum(if(a.is_confirmed=1,1,0))*100)/(SELECT count(x.emp_id) from tbl_cluster_employee_pack as x where x.cluster_id='".$this->clusterId."' and x.is_confirmed=1)) as confirmed_per,
				sum(if(d.appt_status<>'New',1,0)) as total_visited,
				((sum(if(d.appt_status<>'New',1,0))*100)/(SELECT count(y.appointment_id) from tbl_cluster_employee_pack as x LEFT JOIN tbl_appointments as y on x.appointment_id = y. appointment_id where x.cluster_id='".$this->clusterId."' and y.appt_status<>'New')) as visit_per

			from tbl_cluster_employee_pack as a
			left join tbl_cluster_packages as b on a.cluster_package_id = b.cluster_package_id
			left join tbl_ebh_pc_packages as c on b.package_id = c.ebh_package_id
			left join tbl_appointments as d on a.appointment_id = d.appointment_id
			where a.cluster_id='".$this->clusterId."'
			GROUP BY a.cluster_package_id";

		$this->select($sql);
        return $this->result;

	}

	public function cluster_package_summary_monthwise($cluster_id, $cluster_package_id,$year)
	{
		unset($this->result);
		$sql='SELECT
		"Invited" as action,
			sum(if(month(y.created_on)=1,1,0)) as jan_month,
			sum(if(month(y.created_on)=2,1,0)) as feb_month,
			sum(if(month(y.created_on)=3,1,0)) as mar_month,
			sum(if(month(y.created_on)=4,1,0)) as apr_month,
			sum(if(month(y.created_on)=5,1,0)) as may_month,
			sum(if(month(y.created_on)=6,1,0)) as jun_month,
			sum(if(month(y.created_on)=7,1,0)) as jul_month,
			sum(if(month(y.created_on)=8,1,0)) as aug_month,
			sum(if(month(y.created_on)=9,1,0)) as sep_month,
			sum(if(month(y.created_on)=10,1,0)) as oct_month,
			sum(if(month(y.created_on)=11,1,0)) as nov_month,
			sum(if(month(y.created_on)=12,1,0)) as dec_month
		from tbl_cluster_employee_pack as y
		WHERE y.cluster_package_id="'.$cluster_package_id.'" and  year(y.created_on)='.$year.' and y.cluster_id='.$cluster_id.'
		GROUP BY y.cluster_package_id=4

		UNION ALL

		SELECT
		"Confirmed" as action,
			sum(if(month(y.confirmed_on)=1,1,0)) as jan_month,
			sum(if(month(y.confirmed_on)=2,1,0)) as feb_month,
			sum(if(month(y.confirmed_on)=3,1,0)) as mar_month,
			sum(if(month(y.confirmed_on)=4,1,0)) as apr_month,
			sum(if(month(y.confirmed_on)=5,1,0)) as may_month,
			sum(if(month(y.confirmed_on)=6,1,0)) as jun_month,
			sum(if(month(y.confirmed_on)=7,1,0)) as jul_month,
			sum(if(month(y.confirmed_on)=8,1,0)) as aug_month,
			sum(if(month(y.confirmed_on)=9,1,0)) as sep_month,
			sum(if(month(y.confirmed_on)=10,1,0)) as oct_month,
			sum(if(month(y.confirmed_on)=11,1,0)) as nov_month,
			sum(if(month(y.confirmed_on)=12,1,0)) as dec_month
		from tbl_cluster_employee_pack as y
		WHERE y.cluster_package_id="'.$cluster_package_id.'"  and  year(y.confirmed_on)='.$year.' and y.cluster_id='.$cluster_id.'
		GROUP BY y.cluster_package_id=4

		UNION ALL

		SELECT
		"Visited" as action,
			sum(if(month(z.verified_on)=1,1,0)) as jan_month,
			sum(if(month(z.verified_on)=2,1,0)) as feb_month,
			sum(if(month(z.verified_on)=3,1,0)) as mar_month,
			sum(if(month(z.verified_on)=4,1,0)) as apr_month,
			sum(if(month(z.verified_on)=5,1,0)) as may_month,
			sum(if(month(z.verified_on)=6,1,0)) as jun_month,
			sum(if(month(z.verified_on)=7,1,0)) as jul_month,
			sum(if(month(z.verified_on)=8,1,0)) as aug_month,
			sum(if(month(z.verified_on)=9,1,0)) as sep_month,
			sum(if(month(z.verified_on)=10,1,0)) as oct_month,
			sum(if(month(z.verified_on)=11,1,0)) as nov_month,
			sum(if(month(z.verified_on)=12,1,0)) as dec_month
		from tbl_cluster_employee_pack as y
		LEFT JOIN tbl_appointments as z on y.appointment_id = z.appointment_id
		WHERE y.cluster_package_id="'.$cluster_package_id.'"  and year(z.verified_on)='.$year.' and y.cluster_id='.$cluster_id.'
		GROUP BY y.cluster_package_id=4 ';

		$this->select($sql);
        return $this->result;
	}

	public function cluster_package_summary_monthwise_agent($cluster_id, $cluster_package_id,$year,$cluster_user_id)
	{
		unset($this->result);
		$sql='SELECT
		"Invited" as action,
			sum(if(month(y.created_on)=1,1,0)) as jan_month,
			sum(if(month(y.created_on)=2,1,0)) as feb_month,
			sum(if(month(y.created_on)=3,1,0)) as mar_month,
			sum(if(month(y.created_on)=4,1,0)) as apr_month,
			sum(if(month(y.created_on)=5,1,0)) as may_month,
			sum(if(month(y.created_on)=6,1,0)) as jun_month,
			sum(if(month(y.created_on)=7,1,0)) as jul_month,
			sum(if(month(y.created_on)=8,1,0)) as aug_month,
			sum(if(month(y.created_on)=9,1,0)) as sep_month,
			sum(if(month(y.created_on)=10,1,0)) as oct_month,
			sum(if(month(y.created_on)=11,1,0)) as nov_month,
			sum(if(month(y.created_on)=12,1,0)) as dec_month
		from tbl_cluster_employee_pack as y
		LEFT JOIN tbl_cluster_employee AS e ON y.emp_id = e.emp_id
		WHERE y.cluster_package_id="'.$cluster_package_id.'" and year(y.created_on)='.$year.' and y.cluster_id='.$cluster_id.' and e.cluster_user_id='.$cluster_user_id.'
		GROUP BY y.cluster_package_id=4

		UNION ALL

		SELECT
		"Confirmed" as action,
			sum(if(month(y.confirmed_on)=1,1,0)) as jan_month,
			sum(if(month(y.confirmed_on)=2,1,0)) as feb_month,
			sum(if(month(y.confirmed_on)=3,1,0)) as mar_month,
			sum(if(month(y.confirmed_on)=4,1,0)) as apr_month,
			sum(if(month(y.confirmed_on)=5,1,0)) as may_month,
			sum(if(month(y.confirmed_on)=6,1,0)) as jun_month,
			sum(if(month(y.confirmed_on)=7,1,0)) as jul_month,
			sum(if(month(y.confirmed_on)=8,1,0)) as aug_month,
			sum(if(month(y.confirmed_on)=9,1,0)) as sep_month,
			sum(if(month(y.confirmed_on)=10,1,0)) as oct_month,
			sum(if(month(y.confirmed_on)=11,1,0)) as nov_month,
			sum(if(month(y.confirmed_on)=12,1,0)) as dec_month
		from tbl_cluster_employee_pack as y
		LEFT JOIN tbl_cluster_employee AS e ON y.emp_id = e.emp_id
		WHERE y.cluster_package_id="'.$cluster_package_id.'"  and  year(y.confirmed_on)='.$year.' and y.cluster_id='.$cluster_id.' and e.cluster_user_id='.$cluster_user_id.'
		GROUP BY y.cluster_package_id=4

		UNION ALL

		SELECT
		"Visited" as action,
			sum(if(month(z.verified_on)=1,1,0)) as jan_month,
			sum(if(month(z.verified_on)=2,1,0)) as feb_month,
			sum(if(month(z.verified_on)=3,1,0)) as mar_month,
			sum(if(month(z.verified_on)=4,1,0)) as apr_month,
			sum(if(month(z.verified_on)=5,1,0)) as may_month,
			sum(if(month(z.verified_on)=6,1,0)) as jun_month,
			sum(if(month(z.verified_on)=7,1,0)) as jul_month,
			sum(if(month(z.verified_on)=8,1,0)) as aug_month,
			sum(if(month(z.verified_on)=9,1,0)) as sep_month,
			sum(if(month(z.verified_on)=10,1,0)) as oct_month,
			sum(if(month(z.verified_on)=11,1,0)) as nov_month,
			sum(if(month(z.verified_on)=12,1,0)) as dec_month
		from tbl_cluster_employee_pack as y
		LEFT JOIN tbl_appointments as z on y.appointment_id = z.appointment_id
		LEFT JOIN tbl_cluster_employee AS e ON y.emp_id = e.emp_id
		WHERE y.cluster_package_id="'.$cluster_package_id.'" and year(z.verified_on)='.$year.' and y.cluster_id='.$cluster_id.' and e.cluster_user_id='.$cluster_user_id.'
		GROUP BY y.cluster_package_id=4 ';

		$this->select($sql);
        return $this->result;
	}


	public function createZip($files = array(), $destination = '', $overwrite = false)
	{
	if(extension_loaded('zip'))
	 {
	 	//if the zip file already exists and overwrite is false, return false
		if(file_exists($destination) && !$overwrite)
		{
			return false;
		}
		//vars
		$valid_files = array();
		//if files were passed in...
		if(is_array($files))
		{
			//cycle through each file
			foreach($files as $file)
			{
				//make sure the file exists
				if(file_exists($file))
				{
					$valid_files[] = $file;
				}
			}
		}

		//if we have good files...
		if(count($valid_files))
		{
			//create the archive
			$zip = new ZipArchive();
			if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true)
			{
				return false;
			}
			//add the files
			foreach($valid_files as $file)
			{
				$zip->addFile($file,$file);
			}
			//debug
			//echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;

			//close the zip -- done!
			$zip->close();

			//check to make sure the file exists
			return file_exists($destination);
		}
		else
		{
			return false;
		}
     }
	}
	public function get_report_availablity($cluster_id)
	{
		unset($this->result);
		$sql="SELECT
				a.cluster_package_id,tcase(b.package_nm) as package_nm,
				report_avail.visit_count,
				report_avail.report_available_count,
				COALESCE(((report_avail.report_available_count*100)/report_avail.visit_count),0) as avail_per
				from tbl_cluster_packages as a
				LEFT join tbl_ebh_pc_packages as b on a.package_id = b.ebh_package_id and a.package_type='EBH'
				left join
				(
					SELECT
					a.cluster_package_id,
					sum(if(b.is_report_uploaded=1,1,0)) as report_available_count,
					sum(if(b.appt_status<>'New',1,0)) as visit_count
					FROM tbl_cluster_employee_pack as a
					left join tbl_appointments as b on a.appointment_id = b.appointment_id
					GROUP BY a.cluster_package_id
				) as  report_avail on a.cluster_package_id = report_avail.cluster_package_id

				WHERE a.cluster_id='".$cluster_id."'";

		$this->select($sql);
        return $this->result;
	}

  public function getMissedCalls($where) {
		unset($this->result);
    $sql = "
      SELECT
        a.miss_call_sr_no,
        a.missed_call_no,
        a.called_mobile_no,
        a.call_datetime,
        a.call_location,
        a.call_type,
        a.call_status,
        a.ebh_customer_id,
        a.appointment_id,
        a.follow_up_by,
        a.follow_up_datetime,
        b.cluster_id,
        b.cluster_business_name
      FROM
        tbl_missed_calls AS a
        LEFT JOIN tbl_clusters AS b ON a.called_mobile_no = b.missed_calls_no
      WHERE 1=1 ".$where."
    ";
		$this->select($sql);
    return $this->result;
	}

  public function getTableForPendingAppointments($where) {
    unset($this->result);
    $sql = "SELECT
		a.sr_no,
    a.cluster_package_id,
    a.emp_id,
    a.cluster_id,
		DATE_FORMAT(a.created_on,'%d %b %Y') as invited_on,
		a.is_link_clicked,
		a.clicked_on,
		a.is_confirmed,
		a.confirmed_on,
		a.appointment_id,
		b.salutation,
		b.first_name,
		b.middle_name,
		b.last_name,
		b.emp_designation,
		b.professional_email_id,
		b.personal_email_id,
		b.mobile_no,
		b.emp_dob,
		b.city,
    b.address,
    b.pincode,
    b.preferred_location,
		b.ebh_customer_id,
		c.cluster_business_name,
		c.cluster_page_name,
		c.logo,d.hsp_id,
    d.package_id,
    g.package_nm as package_name,
    h.city_name,
    h.state_id_new,
    h.state_id,
    j.sum_insured
		from tbl_cluster_employee_pack as a
		LEFT JOIN tbl_cluster_employee as b on a.emp_id = b.emp_id
		LEFT JOin tbl_clusters as c on a.cluster_id = c.cluster_id
		LEFT JOin tbl_cluster_packages as d on a.cluster_package_id = d.cluster_package_id
		LEFT JOIN tbl_appointments as e on a.appointment_id = e.appointment_id
		LEFT JOIN tbl_hsps as f on d.hsp_id = f.id
		LEFT JOIN tbl_ebh_pc_packages as g on d.package_id = g.ebh_package_id and d.package_type='EBH'
    LEFT join cities as h on b.city = h.id
    LEFT JOIN tbl_cluster_employee_pack as j on a.sr_no = j.sr_no
		where (a.appointment_id is NULL or a.appointment_id=0)".((!empty($where))?$where:"");
    $this->select($sql);
    return $this->result;
  }

  public function getTableForScheduledAppointments($where) {
    unset($this->result);
    $sql = "SELECT
		b.ebh_customer_id,
    b.appointment_id,
    DATE_FORMAT(b.appt_request_date,'%d %b %Y') as appt_request_date,
		DATE_FORMAT(b.appt_request_time,'%h %I %p') as appt_request_time,
    DATE_FORMAT(b.appt_schedule_date,'%d %b %Y') as appt_schedule_date,
		DATE_FORMAT(b.appt_schedule_time,'%h %I %p') as appt_schedule_time,
    DATE_FORMAT(b.verified_on,'%d %b %Y') as verified_on_date,
		DATE_FORMAT(b.verified_on,'%h %I %p') as verified_on_time,
    DATE_FORMAT(b.created_on,'%d %b %Y') as created_on_date,
    DATE_FORMAT(b.created_on,'%h %I %p') as created_on_time,
    b.appt_status,
		b.appt_voucher_code,
    b.callback_mood,
    b.callback_remark,
    c.salutation,
    c.date_of_birth,
		CONCAT(c.first_name,' ',c.last_name) as customer_name,
		c.professional_email_id,
    c.mobile_no,
		d.package_nm,
		e.`name` as hsp_name,
    g.city_name,
    h.state_name,
    f.br_pin_code,
    f.br_address,
    f.br_locality,
		concat(f.br_address,' ', f.br_locality,' ',f.br_landmark,'<br/>', f.br_pin_code,'<br/>',g.city_name,'<br/>',h.state_name) as branch_address,
		f.br_general_email_id,
    f.br_helpline_number1,
    i.hsp_logo,
    i.hsp_brand_name,
    x.hsp_general_email_id,
    x.hsp_helpline_number1,
    x.hsp_helpline_number2,
    x.hsp_helpline_number3,
    x.hsp_helpline_number4,
    x.hsp_address,
    j.sum_insured,
    j.sr_no
  	FROM tbl_appointments as b
  	LEFT JOIN tbl_ebh_customer as c on b.ebh_customer_id = c.ebh_customer_id
  	LEFT JOIN tbl_ebh_pc_packages as d on b.ebh_package_id = d.ebh_package_id
  	LEFT JOIN tbl_hsps as e on b.hsp_id = e.id
  	LEFT JOIN tbl_hsp_branchs as f on b.hsp_branch_id = f.branch_id
  	LEFT JOIN cities as g on f.br_city = g.id
  	LEFT JOIN states as h on f.br_state = h.id
  	LEFT JOIN tbl_hsp_business_details as i on e.id = i.hspid
    LEFT JOIN tbl_hsp_address_contacts as x on e.id = x.hspid
    LEFT JOIN tbl_cluster_employee_pack as j on b.appointment_id = j.appointment_id".((!empty($where))?" WHERE ".$where:"");
    $this->select($sql);
    return $this->result;
  }

  public function getPreviousCallLogs($sr_no) {
    unset($this->result);
    $sql = "SELECT
    sr_no,
    call_remark,
    callback_required,
    DATE_FORMAT(callback_datetime, '%d %b %Y') as callback_datetime
    FROM tbl_cluster_employee_logcalls WHERE sr_no = ".mysql_real_escape_string(trim($sr_no));
    $this->select($sql);
    return $this->result;
  }
  
  
  public function getclusterEbhPackageCount($cluster_id)
	{
		
		unset($this->result);
		$sql = "select count(1) as package_count from tbl_cluster_packages e where e.cluster_id=".$cluster_id;
		$this->select($sql);
        return $this->result;
	}
public function getclusterEbhEmployeeCount($cluster_id)
	{
		
		unset($this->result);
		$sql = "select count(1) as employee_count  from tbl_cluster_employee e where e.cluster_id=".$cluster_id;
		$this->select($sql);
        return $this->result;
	}
/*public function getclusterEbhEmployeeCount($cluster_id)
	{
		
		unset($this->result);
		$sql = "select count(1) as employee_count  from tbl_cluster_employee e where e.cluster_id=".$cluster_id;
		$this->select($sql);
        return $this->result;
	}*/

public function getDashboardCount($cluster_id){
	/*$package_count = $this->getclusterEbhPackageCount($cluster_id);
	$employee_count = $this->getclusterEbhEmployeeCount($cluster_id);
	$result['package_count'] 	= $package_count[0]['package_count'] ;
	$result['employee_count'] 		= $employee_count[0]['employee_count'] ;*/
	unset($this->result);
	$sql = " SELECT 
a.cluster_id,
cluster_pack.total_packages,
cluster_emp.total_employees,
cluster_emp.male_employee,
cluster_emp.female_employee,
cluster_report.total_report_available
from tbl_clusters as a
left join 
(
	select 
	x.cluster_id, count(x.cluster_package_id) as total_packages
	from tbl_cluster_packages as x where x.cluster_id=".$cluster_id."
	group by x.cluster_id 
) as cluster_pack on a.cluster_id = cluster_pack.cluster_id
left join 
(
	select 
	x.cluster_id, 
	count(x.emp_id) as total_employees, 
	sum(if(x.salutation in ('Mr.'),1,0)) as male_employee,
	sum(if(x.salutation in ('Ms.','Mrs.'),1,0)) as female_employee
	from tbl_cluster_employee as x  where x.cluster_id=".$cluster_id."
	group by x.cluster_id
) as cluster_emp on a.cluster_id = cluster_emp.cluster_id
left join 
(
	SELECT
	e.cluster_id,count(b.appointment_id) as total_report_available
	FROM tbl_appointments as b 
	LEFT JOIN tbl_ebh_customer as c on b.ebh_customer_id = c.ebh_customer_id 
	LEFT JOIN tbl_ebh_pc_packages as d on b.ebh_package_id = d.ebh_package_id
	LEFT JOIN tbl_cluster_employee as e on c.ebh_customer_id = e.ebh_customer_id
	LEFT JOIN tbl_clusters as f on e.cluster_id = f.cluster_id
	where b.is_report_uploaded=1 and e.cluster_id=".$cluster_id."
	GROUP BY e.cluster_id
) as cluster_report on a.cluster_id = cluster_report.cluster_id
where a.cluster_id=".$cluster_id."
group by a.cluster_id
";
$this->select($sql);
       
	return $this->result[0];
}

public function getControllerAction($default) {
        $action = (isset($_GET['action']) && strlen($_GET['action']) > 0) ? $_GET['action'] : '';
        if ($action == '') {
            $action = (isset($_POST['action']) && strlen($_POST['action']) > 0) ? $_POST['action'] : $default;
        }
        return strtolower($action);
    }
  public  function mysqlToDateCustom($date, $format = 'd-m-Y', $seperator = '') { // mysql date to date
 
        if ($timeStamp = strtotime($date)) {
			
            if ($seperator != '') {
                return date('d' . $seperator . 'm' . $seperator . 'Y', $timeStamp);
            } else {
                return date($format, $timeStamp);
            }
        } else {
            return '';
        }
    }
	function ageCalculator($dob){
    if(!empty($dob)){
        $birthdate = new DateTime($dob);
        $today   = new DateTime('today');
        $age = $birthdate->diff($today)->y;
        return $age;
    }else{
        return 0;
    }
}

function getDashboardDataOld($clusterId){
unset($this->result);
	$weight_sql = "SELECT  monthname(a.recorded_on) as recording_month,a.recorded_on,round(avg(bmi)) as avg_bmi,round((weight)) as avg_weight,

				if( b.salutation = 'Mr.','Male',if( b.salutation = 'Mrs.','Female',if( b.salutation = 'Ms.','Female','')) )  as  gender1
				from tbl_ebh_customer_health_readings as a
				left join tbl_ebh_customer as b on a.ebh_customer_id = b.ebh_customer_id 
				left join tbl_cluster_employee as c on b.ebh_customer_id = c.ebh_customer_id 
				where  c.cluster_id=".$clusterId." and a.recorded_on  > DATE_SUB(now(), INTERVAL 12 MONTH) and bmi>0 group by gender1, month(a.recorded_on)";
	//AND y.cluster_id=".$clusterId."
	// c.cluster_id=".$clusterId." and
		$this->select($weight_sql);
		$result['weight'] = $this->result;
		$sugar_sql = "SELECT monthname(x.recorded_on) AS recording_month, round(AVG(x.ppbs))  as avg_ppbs, round(AVG(x.fbs)) as avg_fbs
		FROM 	tbl_ebh_customer_health_readings x
		JOIN tbl_cluster_employee y ON x.ebh_customer_id=y.ebh_customer_id
		WHERE x.fbs>0 AND x.ppbs>0 and x.recorded_on  > DATE_SUB(now(), INTERVAL 12 MONTH) AND y.cluster_id=".$clusterId."
		GROUP BY MONTH(x.recorded_on);";
			unset($this->result);
		$this->select($sugar_sql);
		$result['sugar'] = $this->result;
		$bp_sql = "SELECT monthname(x.recorded_on) AS recording_month, round(AVG(x.systolic)) as avg_systolic, round(AVG(x.diastolic)) as avg_diastolic
		FROM 	tbl_ebh_customer_health_readings x
		JOIN tbl_cluster_employee y ON x.ebh_customer_id=y.ebh_customer_id
		WHERE x.systolic>0 AND x.diastolic>0  and x.recorded_on  > DATE_SUB(now(), INTERVAL 12 MONTH) AND y.cluster_id=".$clusterId."
		GROUP BY MONTH(x.recorded_on)";
			unset($this->result);
		$this->select($bp_sql);
		$result['bp'] = $this->result;
	return $result;
       
}
function getDashboardChartOld($clusterId){
	$data = $this->getDashboardData($clusterId);
	$result = array();
	$avg_bmi = 0;
	$avg_weight = 0;
	$avg_fbs = 0;
	$avg_ppbs = 0;
	$avg_systolic = 0;
	$avg_diastolic = 0;
	$n_bmi = 0;
	$n_bp = 0;
	$n_sugar = 0;
	foreach($data['weight'] as $key=>$value){
		if($value['gender1']!=''){
			$result['bmi'][$value['gender1']][$value['recording_month']] = $value['avg_bmi'];
			//[["Jan", 65], ["Feb", 66.5], ["Mar", 69.5], ["Apr", 69.8], ["May", 71], ["June", 71.8]],
			$bmi_chart[$value['gender1']][] = '["'.$value['recording_month'].'", '.$value['avg_bmi'].']' ;
			$avg_bmi += $value['avg_bmi'];
			$avg_weight += $value['avg_weight'];
			$n_bmi++;
		}
	}
	$result['chart']['male_bmi_chart'] = '['.implode(', ',$bmi_chart['Male']).']';
	$result['chart']['female_bmi_chart'] = '['.implode(', ',$bmi_chart['Female']).']';
if($n_bmi>0){
		$result['chart']['avg_bmi'] = round($avg_bmi/$n_bmi) ;
		$result['chart']['avg_weight'] = round($avg_weight/$n_bmi) ;
	}
	foreach($data['sugar'] as $key=>$value){
			$result['sugar'][$value['recording_month']]['ppbs'] = $value['avg_ppbs'];
			$result['sugar'][$value['recording_month']]['fbs'] = $value['avg_fbs'];
			$ppbs_chart[] = '["'.$value['recording_month'].'", '.$value['avg_ppbs'].']' ;
			$fbs_chart[] = '["'.$value['recording_month'].'", '.$value['avg_fbs'].']' ;
			$avg_fbs += $value['avg_fbs'];
			$avg_ppbs += $value['avg_ppbs'];
			$n_sugar++;
	}
	$result['chart']['ppbs_chart'] = '['.implode(', ',$ppbs_chart).']';
	$result['chart']['fbs_chart'] = '['.implode(', ',$fbs_chart).']';
	if($n_sugar>0){
		$result['chart']['avg_fbs'] = round($avg_fbs/$n_sugar) ;
		$result['chart']['avg_ppbs'] = round($avg_ppbs/$n_sugar) ;
	}
	foreach($data['bp'] as $key=>$value){
			$result['bp'][$value['recording_month']]['ppbs'] = $value['avg_systolic'];
			$result['bp'][$value['recording_month']]['fbs'] = $value['avg_diastolic'];
			$systolic_chart[] = '["'.$value['recording_month'].'", '.$value['avg_systolic'].']' ;
			$diastolic_chart[] = '["'.$value['recording_month'].'", '.$value['avg_diastolic'].']';
			$avg_systolic += $value['avg_systolic'];
			$avg_diastolic += $value['avg_diastolic'];
			$n_bp++;
	}
	$result['chart']['systolic_chart'] = '['.implode(', ',$systolic_chart).']';
	$result['chart']['diastolic_chart'] = '['.implode(', ',$diastolic_chart).']';
	if($n_bp>0){
		$result['chart']['avg_systolic'] = round($avg_systolic/$n_bp) ;
		$result['chart']['avg_diastolic'] = round($avg_diastolic/$n_bp) ;
	}
	echo "<pre>";
	print_R($result);
	echo "</pre>";
	return $result;
}
public function getClusterGoal($clusterId){
	  $sql = "select * from tbl_cluster_goal where cluster_id =".$clusterId;
		unset($this->result);
		$this->select($sql);
		return $this->result;
}


function getAvgBPCountGroupByGenderforChart($clusterId){
	 $sql = "SELECT 
\"Male\" as gender,
sum(if(a.bp_level='High',1,0)) as high_bp,
sum(if(a.bp_level='Normal',1,0)) as normal_bp,
sum(if(a.bp_level='Low',1,0)) as low_bp
from tbl_ebh_customer_health_readings as a
left join tbl_cluster_employee as b on a.ebh_customer_id = b.ebh_customer_id
where b.cluster_id=$clusterId and b.salutation in('Mr.') 
UNION ALL 
SELECT 
\"Female\" as gender,
sum(if(a.bp_level='High',1,0)) as high_bp,
sum(if(a.bp_level='Normal',1,0)) as normal_bp,
sum(if(a.bp_level='Low',1,0)) as low_bp
from tbl_ebh_customer_health_readings as a
left join tbl_cluster_employee as b on a.ebh_customer_id = b.ebh_customer_id
where b.cluster_id=$clusterId and b.salutation in('Mrs.','Ms.')";;
		unset($this->result);
		$this->select($sql);
		
		return $this->result;
}
function getAvgBPCountGroupByGender($clusterId){
	 $sql = "SELECT 
a.reading,a.cat_id, 
count(b.ebh_customer_id) as total_cnt,
sum(if(c.salutation in('Mr.'),1,0)) as male_count,
sum(if(c.salutation in('Mrs.','Ms.'),1,0)) as female_count
from view_blood_pressure as a 
left join tbl_ebh_customer_health_readings as b on BINARY  a.`bp_result`= BINARY b.`bp_category`
left join tbl_cluster_employee as c on b.ebh_customer_id = c.ebh_customer_id 
where c.cluster_id = $clusterId
GROUP BY a.reading;	";;
		unset($this->result);
		$this->select($sql);
		
		return $this->result;
}

function getAvgBMICountGroupByGenderforChart($clusterId){
	 $sql = "SELECT 
\"Male\" as gender,
sum(if(a.bmi_category='Normal',1,0)) as normal_bmi,
sum(if(a.bmi_category='Underweight',1,0)) as underwght_bmi,
sum(if(a.bmi_category='Overweight',1,0)) as overwght_bmi
from tbl_ebh_customer_health_readings as a
left join tbl_cluster_employee as b on a.ebh_customer_id = b.ebh_customer_id
where b.cluster_id=$clusterId and b.salutation in('Mr.') 

UNION ALL 

SELECT 
\"Female\" as gender,
sum(if(a.bmi_category='Normal',1,0)) as normal_bmi,
sum(if(a.bmi_category='Underweight',1,0)) as underwght_bmi,
sum(if(a.bmi_category='Overweight',1,0)) as overwght_bmi
from tbl_ebh_customer_health_readings as a
left join tbl_cluster_employee as b on a.ebh_customer_id = b.ebh_customer_id
where b.cluster_id=$clusterId and b.salutation in('Mrs.','Ms.');";;
		unset($this->result);
		$this->select($sql);
		 
		return $this->result;
}
function getAvgBMICountGroupByGender($clusterId){
	 $sql = "SELECT 
a.reading, a.cat_id, 
count(b.ebh_customer_id) as total_cnt,
sum(if(c.salutation in('Mr.'),1,0)) as male_count,
sum(if(c.salutation in('Mrs.','Ms.'),1,0)) as female_count

from view_bmi as a 
left join tbl_ebh_customer_health_readings as b on BINARY  a.`bmi_result`= BINARY b.`bmi_category`
left join tbl_cluster_employee as c on b.ebh_customer_id = c.ebh_customer_id 
where c.cluster_id = $clusterId
GROUP BY a.reading;	";;
		unset($this->result);
		$this->select($sql);
		
		return $this->result;
}
function getDashboardChart($clusterId){
	$gender_wise_bp_chart = $this->getAvgBPCountGroupByGenderforChart($clusterId);
	$returnArr['bp']['table'] = $this->getAvgBPCountGroupByGender($clusterId);
	$returnArr['bp']['label'] = "'Normal','High BP', 'Low BP'";
	foreach($gender_wise_bp_chart as $key=>$value){
			$returnArr['bp'][$value['gender']] = $value['normal_bp'].','.$value['high_bp'].','.$value['low_bp'];
		}
		
		//BMI
			$gender_wise_bp_chart = $this->getAvgBMICountGroupByGenderforChart($clusterId);
	$returnArr['bmi']['table'] = $this->getAvgBMICountGroupByGender($clusterId);
	$returnArr['bmi']['label'] = "'Normal','Underweight', 'Overweight'";
	foreach($gender_wise_bp_chart as $key=>$value){
			$returnArr['bmi'][$value['gender']] = $value['normal_bmi'].','.$value['underwght_bmi'].','.$value['overwght_bmi'];
		}
	/*echo "<pre>";
	print_R($returnArr);
	echo "</pre>";*/
	return $returnArr;
}
}

?>
