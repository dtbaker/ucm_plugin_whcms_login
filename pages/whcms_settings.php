<?php


if(!module_config::can_i('view','Settings')){
    redirect_browser(_BASE_HREF);
}

print_heading('WHCMS Settings');
?>
<p>More details here: <a href="http://docs.whmcs.com/AutoAuth" target="_blank">http://docs.whmcs.com/AutoAuth</a> </p>
<?php
module_config::print_settings_form(
    array(
         array(
            'key'=>'whcms_login_url',
            'default'=>"http://demo.whmcs.com/dologin.php",
             'type'=>'text',
             'description'=>'WHCMS Url',
         ),
         array(
            'key'=>'whcms_auth_key',
            'default'=>'(enter your key here)',
             'type'=>'text',
             'description'=>'WHCMS AuthKey',
         ),
         array(
            'key'=>'whcms_goto',
            'default'=>"clientarea.php?action=products",
             'type'=>'text',
             'description'=>'WHCMS Go To URL',
         ),
    )
);

