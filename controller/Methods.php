<?php
class Methods{
	function __construct(){

	  $this->db = new DB();
	  $this->db_query = new Query();	

	}

    /** application functions */
	
  function fetchProfile(){

    $profile = array();

    $user_details = $this->db_query->runQuery("SELECT admin_id,admin_profile_pic from admin WHERE status='1'");

    $social_profile = $this->db_query->runQuery("SELECT * FROM social_profiles WHERE user_id='".$user_details[0]['admin_id']."'");
    $fetch_skills = $this->db_query->runQuery("SELECT * FROM skills WHERE user_id='".$user_details[0]['admin_id']."'");

    $skills = '<div class="row">';
    foreach($fetch_skills as $s){

      $skills .='<div class="col-md-6" style="page-break-inside: avoid !important;">
      <div class="progress-container progress-primary"><span class="progress-badge">'.$s['skill_name'].'</span>
          <div class="progress">
              <div class="progress-bar progress-bar-primary" data-aos="progress-full" data-aos-offset="10" data-aos-duration="2000" role="progressbar" aria-valuenow="'.$s['skill_level'].'" aria-valuemin="0" aria-valuemax="100" style="width: '.$s['skill_level'].'%;"></div><span class="progress-value">'.$s['skill_level'].'%</span>
          </div>
      </div>
      </div>';
      
    }

    $skills .='</div>';

    $fetch_education = $this->db_query->runQuery("SELECT * FROM education WHERE user_id='".$user_details[0]['admin_id']."'");

    $education = '';

    foreach($fetch_education as $e){
      $education .='<div class="card" style="page-break-inside: avoid !important;">
      <div class="row">
          <div class="col-md-3 bg-primary" data-aos="fade-right" data-aos-offset="50" data-aos-duration="500">
              <div class="card-body cc-education-header">
                  <p>'.$e['from'].' - '.$e['to'].'</p>
                  <div class="h5">'.$e['course'].'</div>
              </div>
          </div>
          <div class="col-md-9" data-aos="fade-left" data-aos-offset="50" data-aos-duration="500">
              <div class="card-body">
                  <div class="h5">'.$e['title'].'</div>
                  <p class="category">'.$e['college'].'</p>
                  <p>'.$e['description'].'</p>
              </div>
          </div>
          </div>
      </div>';
    }

    $fetch_experience = $this->db_query->runQuery("SELECT * FROM experience WHERE user_id='".$user_details[0]['admin_id']."'");
    $experience = '';
    foreach($fetch_experience as $ex){
      $experience .='<div class="card" style="page-break-inside: avoid !important;">
      <div class="row">
          <div class="col-md-3 bg-primary" data-aos="fade-right" data-aos-offset="50" data-aos-duration="500">
              <div class="card-body cc-experience-header">
                  <p>'.$ex['from'].' - '.$ex['to'].'</p>
                  <div class="h5">'.$ex['company_name'].'</div>
              </div>
          </div>
          <div class="col-md-9" data-aos="fade-left" data-aos-offset="50" data-aos-duration="500">
              <div class="card-body">
                  <div class="h5">'.$ex['title'].'</div>
                  <p>'.$ex['description'].'</p>
              </div>
          </div>
        </div>
      </div>';
    }
      
    $profile['social_icons'] = $social_profile;
    $profile['user_basic_details'] = $user_details;
    $profile['skills'] = $skills;
    $profile['education'] = $education;
    $profile['experience'] = $experience;

	 	return $profile;

  }

  function contactMe(){
    $status=0;
    $msg='Please Try Again';
    $table_name='contact_form';
    $payload = $_POST;
    $allowed = $this->db_query->table_filter($table_name);
    $result = $this->db_query->filter_duplicate_value_array($payload,  $allowed);
    $op = $this->db->insert($table_name, $result);
    if($op){
      $status=1;
      $msg = 'Thankyou for your interest. We have received your message. We will respond back shortly.';
    }
    $return_array = array();
      $return_array[] = array(
        "status" => $status, 
        "msg" => $msg
      );
    return json_encode($return_array);
  }

    
    


}

?>