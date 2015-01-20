<?php


class module_whcms_login extends module_base{

    public static function can_i($actions,$name=false,$category=false,$module=false){
        if(!$module)$module=__CLASS__;
        return parent::can_i($actions,$name,$category,$module);
    }
	public static function get_class() {
        return __CLASS__;
    }
    public function init(){
		$this->links = array();
		$this->module_name = "whcms_login";
		$this->module_position = 31;
        $this->version = 1;
    }
    public function pre_menu(){
		if(module_security::is_logged_in() && module_config::can_i('view','Settings')){
            $this->links[] = array(
                "name"=>"WHCMS",
                "p"=>"whcms_settings",
                'holder_module' => 'config', // which parent module this link will sit under.
                'holder_module_page' => 'config_admin',  // which page this link will be automatically added to.
                'menu_include_parent' => 0,
            );
        }
	    if(module_security::is_logged_in()){
			$user_account = module_user::get_user(module_security::get_loggedin_id());
	        if($user_account['email']){
		        $whmcsurl = module_config::c('whcms_login_url',"http://demo.whmcs.com/dologin.php");
				$autoauthkey = module_config::c('whcms_auth_key','(enter your key here)');
				$goto = module_config::c('whcms_goto',"clientarea.php?action=products");

		        // generate the WHCMS auto login link
				$timestamp = time();
				$email = $user_account['email'];
				$hash = sha1($email.$timestamp.$autoauthkey);
				$url = $whmcsurl."?email=$email&timestamp=$timestamp&hash=$hash&goto=".urlencode($goto);
		        $this->links[] = array(
			        "url"   => $url,
			        "p"   => '',
			        'name'  => 'WHCMS',
			        'order' => 999999,
		        );
	        }
		}
    }
}