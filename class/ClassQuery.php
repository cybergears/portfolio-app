<?php
class Query
{
  function __construct()
  {
    $this->db = new DB();
  }

  function redirect($page)
  {
    header("location:" . $page);
  }


  /** New Functions Start */

  function admin_login($username='',$password='',$remember=''){
    $username = $this->filter($username);
    $password = $this->filter($password);
    $remember = $this->filter($remember);
    
    if(empty($username) || empty($password)){
      return 2;
    }else{
      $get_admin = $this->runQuery("SELECT * FROM admin where admin_username='".$username."' LIMIT 1");
      if($get_admin){
        $pass = password_verify($password,$get_admin[0]['admin_password']);
        if($pass){
          $_SESSION[ADMIN_SESSION_NAME] = $get_admin[0]['admin_id'];
          if($remember == 1){
            $this->setCookie($get_admin[0]['admin_id'],ADMIN_COOKIE_NAME);
          }
          return 1;
        }else{
          return 3;
        }
      }else{
        return 4;
      }
    }
  }


  
  function setCookie($user_id,$type){
    
    unset($_COOKIE[$type]);
    $hash = md5(SECRET_KEY);
		$cookie = $user_id . '|' . $hash;
    $domain = $_SERVER['HTTP_HOST'];
    $path = '';
    if($type==ADMIN_COOKIE_NAME){
      $path = ADMIN_PATH;
    }else{
      $path = '';
    }

    $arr_cookie_options = array (
      'expires' => strtotime('NOW+15DAYS'),
      'path' => '/',
      'domain' => '.'.$domain, // leading dot for compatibility or use subdomain
      'secure' => true,     // or false
      'httponly' => true,    // or false
      'samesite' => 'Strict' // None || Lax  || Strict
    );
    setcookie($type,$cookie,$arr_cookie_options);
    $update['auth_cookie'] = $cookie;

    if($type==ADMIN_COOKIE_NAME){
      $this->db->update( "admin", $update , "admin_id" , $user_id);
    }else{
      $this->db->update( "users", $update , "user_id" , $user_id);
    }
    

	}

	function deleteCookie($user_id,$type){

    
		$my_array = array();
		$my_array['auth_cookie'] = '';

    if($type==ADMIN_COOKIE_NAME){
      $this->db->update( "admin", $my_array , "admin_id" , $user_id);
    }else{
      $this->db->update( "users", $my_array , "user_id" , $user_id);
    }

    if($type==ADMIN_COOKIE_NAME){
      unset($_SESSION[ADMIN_SESSION_NAME]);
		  unset($_COOKIE[ADMIN_COOKIE_NAME]);
    }

		setcookie($type,"",time()- (365*60*60*30) ,"/" );
		$this->redirect(BASEPATH);
    
	}

	function getAuthentication($auth_cookie = '',$type){

		if(empty($auth_cookie)){
			return false;
		}else{

      if($type==ADMIN_COOKIE_NAME){
        $sql_check = $this->fetch_object("select count(*) c, admin_id from admin where auth_cookie = '".$auth_cookie."'");
      }else{
        $sql_check = $this->fetch_object("select count(*) c, user_id from users where auth_cookie = '".$auth_cookie."'");
      }

			
			if($sql_check->c == 1){
        if($type==ADMIN_COOKIE_NAME){
          $_SESSION[ADMIN_SESSION_NAME] = $sql_check->admin_id;
        }
				
				return true;
			}else{
				return false;

			}
		}


	}

  function generate_menu_file_template($url){
    $raw_url =  preg_replace('/[^A-Za-z-]/', '', $url);
    $page_parms = explode("-",$raw_url);
    $page_name = $page_parms[0];
    $page_type = $page_parms[1];
    $new_file_name = $page_name.'_'.$page_type.'.php';
    //create file
    $create_file = fopen(ADMIN_PATH.'/'.$new_file_name,'w');
    fclose($create_file);
    //copy template
    $source_file = '';
    if($page_type=='add'){
      $source_file='templates/add_page.php';
    }else if($page_type=='view'){
      $source_file='templates/view_page.php';
    }else{
      $source_file='';
    }
    $copy_template = copy($source_file,$new_file_name);
    if($copy_template){
      $route = '';
      if($page_type=='add'){
        $route = '
        #Rules with peremeters for '.$raw_url.' \n
        RewriteRule ^'.$raw_url.'/?$ '.$new_file_name.'
        RewriteRule ^'.$raw_url.'/([0-9_-]+)/?$ '.$new_file_name.'?edit=$1 
        
        
        ';
      }else if($page_type=='view'){

        $route = '
          #Rules with peremeters for '.$raw_url.'
          RewriteRule ^'.$raw_url.'/?$ '.$new_file_name.' 
          RewriteRule ^'.$raw_url.'/([0-9_-]+)/?$ '.$new_file_name.'?status=$1 
          RewriteRule ^'.$raw_url.'/([0-9_-]+)/?$ '.$new_file_name.'?delete=$1 
          RewriteRule ^'.$raw_url.'/([0-9_-]+)/?$ '.$new_file_name.'?active=$1 
        ';
        
      }else{
        $route = '';
      }

      $route_file = fopen(".htaccess", "a") or die("Unable to open .htaccess file!");
      fwrite($route_file, "\n". $route);
      fclose($route_file);

      return true;
    }else{
      return false;
    }
    
  }

  function icon($name){
    $icon = $this->filter($name);
    $i = $this->runQuery("SELECT * FROM app_icons WHERE icon_name='".$icon."' LIMIT 1");
    return html_entity_decode($i[0]['icon']);
  }

  function icon_front($id){
    $icon = $this->filter($id);
    $i = $this->runQuery("SELECT * FROM app_icons WHERE icon_id='".$icon."' LIMIT 1");
    return html_entity_decode($i[0]['icon']);
  }

  function calculateYearDifference($date_1 , $date_2 , $differenceFormat = '%y' )
  {
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);

    $interval = date_diff($datetime1, $datetime2);

    return $interval->format($differenceFormat);

  }


  function filter_duplicate_value_array($my_array, $allowed){
    $r=array();

    for($i=0;$i<=count($allowed);$i++){
      $r[$allowed[$i]] = $my_array[$allowed[$i]];
    }
    

    $result = array_filter($r, function($value) {
      return ($value !== null && $value !== false && $value !== '' ); 
    });

    

    return $result;
  }


  function get_next_bigger_element_array($array, $number) {

    sort($array);
    foreach ($array as $a) {
        if ($a >= $number) return $a;
    }
    return end($array); 
  }

  
  

  /** New Functions End */

 

  function filter($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  function clean($data)
  {
    $data = trim($data);
    $data = html_entity_decode($data);
    // $data = strip_tags($data);
    // $data = $this->db->link->real_escape_string($data);
    return $data;
  }
  function html_decode($data)
  {
    $data = trim($data);
    $data = html_entity_decode($data);
    // $data = strip_tags($data);
    // $data = $this->db->link->real_escape_string($data);
    return $data;
  }
  function clean_tags($data)
  {
    $data = trim($data);
    $data = html_entity_decode($data);
    $data = strip_tags($data);
    $data = $this->db->link->real_escape_string($data);
    return $data;
  }
  function isemail($email)
  {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return 1;
    } else {
      return 0;
    }
  }

  function valid_email($email)
  {
    return !!filter_var($email, FILTER_VALIDATE_EMAIL);
  }
  function runQuery($query)
  {
    $object = $this->db->runQuery($query);
    return $object;
  }

  function fetch_object($sql)
  {
    $object = $this->db->fetch_object($sql);
    return $object;
  }
  function fetch_assoc($sql)
  {
    $object = $this->db->get_row($sql);
    return $object;
  }

  function query($sql)
  {
    $row = $this->db->query($sql);
    return $row;
  }

 

  function pageURL()
  {
    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {
      $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
      $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
      $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    return $pageURL;
  }

  



  function capital_word($word)
  {

    return ucwords(strtolower($this->clean($word)));
  }



  function current_url()
  {
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

    $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

    return $url;
  }

  function unlink_image($table_name = '', $table_id = '', $del_id = '', $baseimg = '')
  {
    $sql = $this->fetch_object("select image_path from " . $table_name . " where " . $table_id . " = '" . $del_id . "' ");
    $image_link = $baseimg . $sql->image_path;
    unlink($image_link);
  }

  function str_rand($length = 6, $seeds = 'numeric')
  {
    // Possible seeds
    $seedings['alpha'] = 'abcdefghijklmnopqrstuvwqyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $seedings['numeric'] = '0123456789';
    $seedings['alphanum'] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $seedings['hexidec'] = '0123456789abcdef';
    $seedings['alphacaps'] = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    // Choose seed
    if (isset($seedings[$seeds])) {
      $seeds = $seedings[$seeds];
    }

    // Seed generator
    list($usec, $sec) = explode(' ', microtime());
    $seed = (float) $sec + ((float) $usec * 100000);
    mt_srand($seed);

    // Generate
    $str = '';
    $seeds_count = strlen($seeds);

    for ($i = 0; $length > $i; $i++) {
      $str .= $seeds[mt_rand(0, $seeds_count - 1)];
    }

    return $str;
  }

  function filter_array($my_array, $allowed)
  {
    $result = array_flip(array_filter(array_flip($my_array), function ($key) use ($allowed) {
      return in_array($key, $allowed);
    }));

    return $result;
  }

  

  function table_filter($table_name)
  {
    $allowed = $this->db->list_fields("select * from " . $table_name . " limit 1");
    foreach ($allowed as $key => $value) {
      $value_name[] = $value->name;
    }

    return $value_name;
  }




  function slug($title = '', $table_name = '', $slug_name='')
  {
    $slug = preg_replace("/-$/", "", preg_replace('/[^a-z0-9]+/i', "-", strtolower($title)));

    $query = "SELECT COUNT(*) AS NumHits FROM $table_name WHERE  $slug_name  LIKE '$slug%'";
    $result = $this->fetch_object($query);
    $numHits = $result->NumHits;

    return ($numHits > 0) ? ($slug . '-' . $numHits) : $slug;
  }

  function comma_separated_to_array($string, $separator = ',')
  {
    $vals = explode($separator, $string);
    foreach ($vals as $key => $val) {
      $vals[$key] = trim($val);
    }
    return array_diff($vals, array(""));
  }

  function getExtension($str)
  {
    $i = strrpos($str, ".");
    if (!$i) {
      return "";
    }
    $l = strlen($str) - $i;
    $ext = substr($str, $i + 1, $l);
    return $ext;
  }

  function image_type($field_name)
  {
    $filename = stripslashes($_FILES[$field_name]['name']);
    $extension = $this->getExtension($filename);
    $extension = strtolower($extension);
    if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
      $errors = 0;
    } else $errors = 1;
    return $errors;
  }
  function cwUpload($field_name = '', $target_folder = '', $file_name = '', $thumb = FALSE, $thumb_folder = '', $thumb_width = '', $thumb_height = '', $file_save_name)
  {
    //folder path setup
    $target_path = $target_folder;
    $thumb_path = $thumb_folder;

    //file name setup
    $filename_err = explode(".", $_FILES[$field_name]['name']);
    $filename_err_count = count($filename_err);
    $file_ext = $filename_err[$filename_err_count - 1];
    if ($file_name != '') {
      $fileName = $file_name . '.' . $file_ext;
    } else {
      $fileName = $_FILES[$field_name]['name'];
    }
    //$fileName = rand().time().basename($fileName);
    if ($file_save_name == '') {
      $fileName = time() . '.' . $file_ext;
    } else {
      $fileName = $file_save_name . '.' . $file_ext;
    }


    //upload image path
    $upload_image_name = $fileName;
    $upload_image = $target_path . $upload_image_name;

    //upload image
    if (move_uploaded_file($_FILES[$field_name]['tmp_name'], $upload_image)) {
      //thumbnail creation
      if ($thumb == TRUE) {
        $thumbnail = $thumb_path . $fileName;
        list($width, $height) = getimagesize($upload_image);
        $thumb_create = imagecreatetruecolor($thumb_width, $thumb_height);
        switch ($file_ext) {
          case 'jpg':
            $source = imagecreatefromjpeg($upload_image);
            break;
          case 'jpeg':
            $source = imagecreatefromjpeg($upload_image);
            break;
          case 'png':
            $source = imagecreatefrompng($upload_image);
            break;
          case 'gif':
            $source = imagecreatefromgif($upload_image);
            break;
          default:
            $source = imagecreatefromjpeg($upload_image);
        }
        imagecopyresized($thumb_create, $source, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
        switch ($file_ext) {
          case 'jpg' || 'jpeg':
            imagejpeg($thumb_create, $thumbnail, 100);
            break;
          case 'png':
            imagepng($thumb_create, $thumbnail, 100);
            break;
          case 'gif':
            imagegif($thumb_create, $thumbnail, 100);
            break;
          default:
            imagejpeg($thumb_create, $thumbnail, 100);
        }
      }

      return $upload_image_name;
    } else {
      return false;
    }
  }





  function getItem($table_name, $table_id, $table_id_value)
  {
    $sql = "select * from " . $table_name . " where " . $table_id . "='" . $table_id_value . "'";
    $sql_query = $this->fetch_object($sql);
    return $sql_query;
  }


  function getItemById($table_name, $table_id, $table_id_value, $return_value, $group_by = '')
  {
    $sql = "select " . $return_value . " c from " . $table_name . " where " . $table_id . "='" . $table_id_value . "'";
    if ($group_by != '') {
      $sql .= " group by " . $group_by;
    }
    $sql .= " order by " . $table_id . " limit 1";
    $sql_query = $this->fetch_object($sql);
    return $sql_query->c;
  }




 

  function getDateFormat($date = '')
  {
    return date('d M, Y', strtotime($date));
  }

  






  
}


?>