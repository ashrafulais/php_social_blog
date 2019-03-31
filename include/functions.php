<?php
define('__DO_DEBUD','0');
require_once('connection_db.php');
include('config_tables.php');

/*---------------------------------------------
Global Functions
---------------------------------------------*/
function sanitize_number($num) {
	//$string = str_replace(' ', '.', $string);
	$val = preg_replace('/[^0-9]/', '', $num);
	return $val;
}

function sanitize_name($string) {
	//$string = str_replace(' ', '.', $string);
	$val = preg_replace('/[^A-Za-z\-]/', '', $string);
	return $val;
}

function sanitize_email($email) {
	return filter_var($email, FILTER_SANITIZE_EMAIL);
}

function password_is_strong($password) {
	return (preg_match("/^\S*(?=\S{5,120})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/", $password) ? true : false);
}
function find_table_data($select_param, $table_name, $srch_param, $srch_val) {
	$check_query = "SELECT ".implode(" ", $select_param)." FROM $table_name WHERE ".$srch_param."='$srch_val' ";

	//echo "$check_query";
	$result = $GLOBALS['conn']->query($check_query);

	// if($result->num_rows > 0) return true;
	// return false;
	return $result;
}

function user_data_insert($tbl_name, $insert_params, $insert_vals) {
	$insert_data_query ="INSERT INTO ".$tbl_name."(".implode(", ", $insert_params).") values('".implode("', '", $insert_vals)."')";

	return $GLOBALS['conn']->query($insert_data_query);
}

//get user informations to profile page
function get_user_details($uid) {
	$sql_query = "SELECT * FROM ".USER_INFO_TABLE." WHERE ".PROFILE_USER_ID."=$uid";

	//echo $sql_query;
	return $GLOBALS['conn']->query($sql_query);
}

//when user page want to show posts
function get_posts($pageid=-1, $post_limit=-1, $uid=-1, $post_id=-1, $post_status="published") {
	$get_post_query = "SELECT * FROM ".ALL_POST_TABLE." WHERE ".POST_STATUS."='$post_status' ";

	if($uid!=-1)
		$get_post_query .= "AND ".POST_USER_ID."= $uid ";
	if($post_id!=-1)
		$get_post_query .= "AND ".POST_ID."= $post_id ";

	if($pageid != -1 && $post_limit != -1){
		$pageid = ($pageid-1) * $post_limit;
		$get_post_query .= "ORDER BY ".POST_TIME." DESC LIMIT $pageid,$post_limit ";
	}

	//echo $get_post_query."<br>";

	//$data = $GLOBALS['conn']->query($get_post_query);

	return $GLOBALS['conn']->query($get_post_query);
}
/*---------------------------------------------
Defining Vars for data input
---------------------------------------------*/

$upload_img_url = "--";

//$GLOBALS['y']
/*---------------------------------------------
Login Function
---------------------------------------------*/
function user_login() {
	$login_page_msg = "";
	$email = sanitize_email($_POST['email']);
	$password = $_POST['password'];

	$login_query = "SELECT * FROM ".LOGIN_DATA." WHERE ".LOGIN_USER_EMAIL."= '$email'";
	$login_data = $GLOBALS['conn']->query($login_query);

	if($login_data->num_rows > 0) {
		$login_result = $login_data->fetch_assoc();
		//print_r($login_result);

		$hashed_password = $login_result[LOGIN_USER_PASSWORD];
		//echo $hashed_password;

		if(password_verify($password, $hashed_password)) {
			$login_page_msg = "Login successful<br>";
			//now start a session and move to index page
			$_SESSION['loggedin'] = true;
			$_SESSION['user_id'] = $login_result[LOGIN_USER_ID];
			header("Location: index.php");

		} else {
			$login_page_msg = "Wrong password<br>";
		}
	} else {
		$login_page_msg = "User not found<br>";
	}
	return $login_page_msg;
}
if( isset($_POST['login_btn']) ) {
	global $login_page_msg;
	$login_page_msg = user_login() ?? "Login now";
	//echo $login_page_msg;
}

/*---------------------------------------------
Signup Function
---------------------------------------------*/

function user_signup() {
	$final_message = "";

	$firstname = sanitize_name($_POST['first_name']);
	$lastname = sanitize_name($_POST['last_name']);
	$email = sanitize_email($_POST['email']);
	$pass1 = $_POST['initial_password'];
	$pass2 = $_POST['confirm_password'];

	if( (strlen($firstname)>40 && strlen($firstname)<1) && (strlen($lastname)>40 && strlen($lastname)<1) )
		$final_message = "Name must be between 1 to 40 chars.<br>";
	if( strlen($email) < 4 && strlen($email) > 125 )
		$final_message .= "Invalid email length.<br>";
	if( $pass1 !== $pass2 )
		$final_message .= "Passwords didn't match. <br>";
	if(password_is_strong($pass1) == false)
		$final_message .= "Password must contain at least one [A-Z,a-z,0-9,!-?] and 5-120 in length.<br>";

	else {
		$select_param = [LOGIN_USER_ID];
		$table_name = LOGIN_DATA;
		$srch_param = LOGIN_USER_EMAIL;
		$srch_val = $email;
		$srch_query_result = find_table_data($select_param, $table_name, $srch_param, $srch_val);

		if($srch_query_result->num_rows > 0) {
			$final_message = "This user already exists.<br>";
		}
		else {
			$encrypted_pass = password_hash($pass1, PASSWORD_DEFAULT);

			//inserting user email and pass
			$user_insert_params = [LOGIN_USER_EMAIL, LOGIN_USER_PASSWORD];
			$user_insert_vals = [$email, $encrypted_pass];
			$do_user_insert = user_data_insert(LOGIN_DATA, $user_insert_params, $user_insert_vals);

			//get the user id from login information's table
			$srch_query_result = find_table_data($select_param, $table_name, $srch_param, $srch_val);
			//-- print_r($srch_query_result->fetch_assoc()['user_id']);
			$last_user_id = $srch_query_result->fetch_assoc()['user_id'];

			//insert user profile info
			$profile_insert_params = [PROFILE_USER_ID, PROFILE_USER_FIRSTNAME, PROFILE_USER_LASTNAME];
			$profile_insert_vals = [$last_user_id, $firstname, $lastname];
			$do_profile_insert = user_data_insert(USER_INFO_TABLE, $profile_insert_params, $profile_insert_vals);

			if( $do_user_insert===TRUE && $do_profile_insert === TRUE ) {
				$final_message = "Signup successful.<br>";
			}
			else {
				$final_message = "Error: <br>" . $GLOBALS['conn']->error;
			}
		}
	}

	return $final_message;

}
if( isset($_POST['register_btn']) ) {
	global $signup_page_msg;
	$signup_page_msg = user_signup();
}


/*---------------------------------------------
Upload functions
---------------------------------------------*/
function upload_file($target_dir, $upload_limit) {
	//$target_dir = "post_images/"; is given
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if(isset($_POST["fileToUpload"])) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) {
	        //echo "File is an image - " . $check["mime"] . ".\n";
	        $uploadOk = 1;
	    } else {
	        echo "File is not an image.\n";
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    echo "Sorry, file already exists.\n";
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > $upload_limit) {
	    echo "Sorry, your file is larger than 5Mb.\n";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.\n";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.\n";
	// if everything is ok, try to upload file
	} else {
		$temp_val = explode(".", $_FILES["fileToUpload"]["name"]);
		$file_id_prefix = date("Ymhdis")."_";
		$newfilename = $target_dir.uniqid($file_id_prefix) . '.' . end($temp_val);

	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newfilename)) {
	    	//chmod($newfilename, 0777);
			//echo "<br> The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded. Target file is: $newfilename <br>";

	        $GLOBALS['upload_img_url'] = $newfilename;
	        $uploadOk = 1;
	    } else {
	        echo "Sorry, there was an error uploading your file.\n";
	        $uploadOk = 0;
	    }
	}
	return $uploadOk;
}

/*---------------------------------------------
When the upload post button is pressed
---------------------------------------------*/
function upload_new_post() {
	global $conn, $upload_img_url;

	$message_after_submit = "";
	$img_upload_status = -1;
	$post_status = "";
	$post_user_id = $_SESSION['user_id'] ?? "-1";
	$upload_limit = 5100000;

	$post_title = addslashes($_POST['post_title']) ?? "";
	$post_text = addslashes($_POST['post_text']) ?? "";

	$target_dir = "post_images/";
	$target_img_for_post = $_FILES["fileToUpload"]["name"];
	$post_category = $_POST['post_category'] ?? "";
	$post_status = $_POST['post_status'] ?? "";

	if(__DO_DEBUD) echo "\n $post_title - $post_text - $target_img_for_post - $post_status \n";

	/*
	$all_post_fields = ['POST_TITLE', 'POST_TEXT', 'POST_IMG_URL', 'POST_STATUS', 'POST_USER_ID'];
	$post_insert_query = $conn->prepare("INSERT INTO ".ALL_POST_TABLE." (".implode(', ', $all_post_fields).") VALUES(?, ?,?,?,?)");
	*/

	if(strlen($post_title)<=190 && !empty($post_title) && !empty($post_text) && !empty($target_img_for_post)) {
		if(__DO_DEBUD) echo "\nEverything seems good..!'\n";

		try {
			//when the data meets the requirements
			$img_upload_status = upload_file($target_dir, $upload_limit);

			$post_insert_query = "INSERT INTO all_posts ( post_title, post_text,post_img_url, post_status, user_id, post_category, post_time) VALUES('$post_title', '$post_text', '$upload_img_url', '$post_status', $post_user_id, '$post_category' , CURRENT_TIMESTAMP)" or die(mysqli_error($conn));

			//echo $post_insert_query;

			if(__DO_DEBUD) echo "$post_insert_query\n";

			if ($conn->query($post_insert_query) === TRUE) {
				$message_after_submit = "Post published successfully.<br>";
				//echo "New record created successfully";
			} else {
				$message_after_submit = "Error: <br>" . $conn->error."<br>";
			}

		} catch (Exception $e) {
			$message_after_submit = "Error: ". $e->getMessage() ."<br>";
			//echo "Error: ". $e->getMessage() ."\n";
		}

	}
	else {
		$message_after_submit = "Something went wrong while submitting the form. Check all the input fields<br>";
	}

	//Show the final message
	echo "$message_after_submit";
}

if( isset($_POST['user_new_post_submit']) ) {
	upload_new_post();
}

/*---------------------------------------------
Update post by user from EDIT_BRO
---------------------------------------------*/

function update_information($table_name, $columns=[], $values=[], $chngattr, $pid) {
    $arr_size=count($columns);
    $setvals = " ";
    
    for($i=0; $i<$arr_size; $i++) {
        $setvals .= $columns[$i]."='$values[$i]' , " ;
        
        //echo $columns[$i]."=".$values[$i]." ";
    }
    
	$setvals[strlen($setvals)-2]=" ";
	
	$update_query = " UPDATE $table_name 
	SET ".$setvals."WHERE $chngattr=$pid ";
	
	//echo $update_query;
	if ($GLOBALS['conn']->query($update_query) === TRUE) {
		return 1;
	} else {
		return 0;
	}
}

function update_file($prev_img_url, $target_dir, $upload_limit) {
//delete the prev image if exists and make a new image file and upload that
$uploadOk = 1;
	if(file_exists($prev_img_url)) {
		//echo "file exists";
		$uploadOk = 0;
		if (unlink($prev_img_url)==1) {
			$uploadOk = 1;
		}
		//else deletion successful

	} if($uploadOk == 1) {
		$status = upload_file($target_dir, $upload_limit);
		if($status != 1) $uploadOk = 0; 
	}
	return $uploadOk;
}

if(isset($_POST["user_post_update_btn"])) {
	//Header("Location: success.php?v=$edit_previous_img_url");

	$message_after_update_post = "";
	$img_upload_status = -1;
	$post_status = "";
	$post_user_id = $_SESSION['user_id'] ?? "-1";
	$upload_limit = 5100000;

	$post_title = addslashes($_POST['post_title']) ?? "";
	$post_text = addslashes($_POST['post_text']) ?? "";
	$post_category = addslashes($_POST['post_category']) ?? "";
	$post_status = addslashes($_POST['post_status']) ?? "";

	//Find the post id to update
	$pid = addslashes($_POST['the_post_id']) ?? -1;

	$target_dir = "post_images/";
	$target_img_for_post = $_FILES["fileToUpload"]["name"];
	$prev_img_url = addslashes($_POST['prev_img_url']) ?? "";

	$post_img_url = $prev_img_url;
	$current_time = date("Y-m-d H:i:s",time());
	//2019-03-25 02:50:06

	if(strlen($post_title)<=190 && !empty($post_title) && !empty($post_text)) {
		
		//when the data meets the requirements
		if($target_img_for_post != "") {
			$img_upload_status = update_file($prev_img_url, $target_dir, $upload_limit);
			$post_img_url = $upload_img_url;


		}
		//Header("Location: success.php?m=$post_img_url");
		if($img_upload_status==1 || file_exists($post_img_url)) {
			//echo $post_insert_query;
			
			//update_informtion("all_posts", [], []);
			$attributes = ["post_title", "post_text", "post_img_url", "post_status", "post_category", "post_time"];
			$attr_values = [$post_title, $post_text, $post_img_url, $post_status, $post_category, $current_time ];

			$up_status = update_information("all_posts", $attributes, $attr_values, "post_id", $pid);

			if ($up_status == 1) {
				$message_after_update_post = "Post Updated successfully.<br>";
				//echo "New record created successfully";
			} else {
				$message_after_update_post = "__Error: <br>" . $conn->error."<br>";
			}
		}

	}
	else {
		$message_after_update_post = "Something went wrong while updating. Check all the input fields<br>";
	}

	echo $message_after_update_post."  ".$post_img_url;
	//Header("Location: success.php?m=lol");
}

/*---------------------------------------------
Update Comment button from EDIT_BRO
---------------------------------------------*/

if( isset($_POST['update_comment_button']) ) {
	$cmnt_text = addslashes($_POST['comment_text']) ?? "";
	$tbl_name = ALL_COMMENTS_TABLE;
	$insert_params = [COMMENT_TEXT, COMMENT_TIME];

	$current_time = date("Y-m-d H:i:s",time());
	$insert_vals = [$cmnt_text, $current_time];
	$cmnt_id = sanitize_number($_POST['hidden_cmnt_id']);

	$status = update_information($tbl_name, $insert_params, $insert_vals, COMMENT_ID, $cmnt_id );

	if($status) echo "Comment updated";
	else echo "Error occurred";
}

/*---------------------------------------------
Update profile button from EDIT_BRO
---------------------------------------------*/


if( isset($_POST['update_profile_info']) ) {
	update_information($table_name, $attributes, $attribute_values);
}

/*---------------------------------------------
Comment insert operation
---------------------------------------------*/


if( isset($_POST['push_comment_button']) ) {
	$cmnt_text = addslashes($_POST['comment_text']) ?? "";
	$tbl_name = ALL_COMMENTS_TABLE;
	$insert_params = [COMMENT_POST_ID, COMMENT_TEXT,POST_USER_ID];
	$insert_vals = [addslashes($_REQUEST['show_post']) ,$cmnt_text, $_SESSION['user_id'] ];
	user_data_insert($tbl_name, $insert_params, $insert_vals);

}


//$conn->close();
?>
