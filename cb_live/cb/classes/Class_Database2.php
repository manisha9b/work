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

public function getDashboardCount($cluster_id){
	$package_count = $this->getclusterEbhPackageCount($cluster_id);
	$employee_count = $this->getclusterEbhEmployeeCount($cluster_id);
	$result['package_count'] 	= $package_count[0]['package_count'] ;
	$result['employee_count'] 		= $employee_count[0]['employee_count'] ;
	return $result;
}

public function getControllerAction($default) {
        $action = (isset($_GET['action']) && strlen($_GET['action']) > 0) ? $_GET['action'] : '';
        if ($action == '') {
            $action = (isset($_POST['action']) && strlen($_POST['action']) > 0) ? $_POST['action'] : $default;
        }
        return strtolower($action);
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

  }

?>
