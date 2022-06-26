<?php
/*--------------------------------------------------*/
/* FILE GENERATED BY INVISION POWER BOARD 3         */
/* CACHE FILE: Skin set id: 9               */
/* CACHE FILE: Generated: Sat, 01 Aug 2015 13:33:44 GMT */
/* DO NOT EDIT DIRECTLY - THE CHANGES WILL NOT BE   */
/* WRITTEN TO THE DATABASE AUTOMATICALLY            */
/*--------------------------------------------------*/

class skin_login_9 extends skinMaster{

/**
* Construct
*/
function __construct( ipsRegistry $registry )
{
	parent::__construct( $registry );
	

$this->_funcHooks = array();
$this->_funcHooks['ajax__inlineLogInForm'] = array('anonymous','hasRedirect');
$this->_funcHooks['showLogInForm'] = array('extrafields','referer','facebook','twitterBox','haswindowslive','extraform','liveform','anonymous','privvy','toggleLive');


}

/* -- ajax__inlineLogInForm --*/
function ajax__inlineLogInForm() {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_login', $this->_funcHooks['ajax__inlineLogInForm'] ) )
{
$count_2de39a3c5a152ed7e303190b4cd6fb9d = is_array($this->functionData['ajax__inlineLogInForm']) ? count($this->functionData['ajax__inlineLogInForm']) : 0;
}

$uses_name		= false;
	$uses_email		= false;
	$_redirect		= '';
	
	foreach( $this->cache->getCache('login_methods') as $method )
	{
		if( $method['login_user_id'] == 'username' or $method['login_user_id'] == 'either' )
		{
			$uses_name	= true;
		}
		
		if( $method['login_user_id'] == 'email' or $method['login_user_id'] == 'either' )
		{
			$uses_email	= true;
		}

		if( $method['login_login_url'] )
        	{
			$_redirect    = $method['login_login_url'];
		}
	}
	if( $uses_name AND $uses_email )
	{
		$this->lang->words['enter_name']	= $this->lang->words['enter_name_and_email'];
	}
	else if( $uses_email )
	{
		$this->lang->words['enter_name']	= $this->lang->words['enter_useremail'];
	}
	else
	{
		$this->lang->words['enter_name']	= $this->lang->words['enter_username'];
	}
$IPBHTML .= "" . (($_redirect) ? ("
<script type='text/javascript'>
window.location = '{$_redirect}';
</script>
") : ("<div id='inline_login_form' class='sb_login'>
	<form action=\"" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "app=core&amp;module=global&amp;section=login&amp;do=process", "public",'' ), "", "" ) . "\" method=\"post\" id='login'>
		<input type='hidden' name='auth_key' value='{$this->member->form_hash}' />
		<input type=\"hidden\" name=\"referer\" value=\"" . str_replace( array( '<', '>', '(', ')' ), '-', my_getenv('HTTP_REFERER') ) . "\" />
		<h4>{$this->lang->words['log_in']}</h4>
		

        <div class='sb_login_row'>

        <div class='sb_login_col'>
            
            <strong><label for='ips_username'>{$this->lang->words['enter_name']}</label></strong>
            <div class='ipsField_content'>
                <input id='ips_username' type='text' class='input_text sb_login_input sb_luser' name='ips_username' placeholder=\"{$this->lang->words['enter_name']}\" size='30' tabindex='1' />
            </div>
        </div>
        
        <div class='sb_login_col'>
            <span class='right desc lighter blend_links'><a href='" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "app=core&amp;module=global&amp;section=lostpass", "public",'' ), "", "" ) . "' title='{$this->lang->words['retrieve_pw']}'>{$this->lang->words['login_forgotten_pass']}</a></span>
            <strong><label for='ips_password'>{$this->lang->words['enter_pass']}</label></strong>
            <div class='ipsField_content'>
                <input id='ips_password' type='password' class='input_text sb_login_input sb_lpassword' name='ips_password' placeholder=\"{$this->lang->words['enter_pass']}\" size='30' tabindex='2' /><br />
            </div>
        </div>

        </div>
        <div class='clearfix'>
        
            <div class='sb_login_col'>
            	<input type='checkbox' id='inline_remember' checked='checked' name='rememberMe' value='1' class='input_check left' />
			<div style='padding-left: 20px;'>
				<label for='inline_remember'>
					<strong>{$this->lang->words['rememberme']}</strong>
					<span class='desc lighter' style='display: block; padding-top: 5px;'>{$this->lang->words['notrecommended']}</span>
				</label>
			</div>
            </div>

            " . ((!$this->settings['disable_anonymous']) ? ("
            <div class='sb_login_col'>
			<input type='checkbox' id='inline_invisible' name='anonymous' value='1' class='input_check left' />
			<div style='padding-left: 20px;'>
				<label for='inline_invisible'>
					<strong>{$this->lang->words['form_invisible']}</strong>
					<span class='desc lighter' style='display: block; padding-top: 5px;'>{$this->lang->words['anon_name']}</span>
				</label>
			</div>
		</div>
		") : ("")) . "

        </div>

	<div class='ipsForm_submit ipsForm_center clear'>
		<input type='submit' class='input_submit' value='{$this->lang->words['log_in']}' />
	</div>	
	</form>

</div>")) . "";
return $IPBHTML;
}

/* -- errors --*/
function errors($data="") {
$IPBHTML = "";
$IPBHTML .= "<p class='message error'>
	{$data}
</p>
<br /><br />";
return $IPBHTML;
}

/* -- showLogInForm --*/
function showLogInForm($message="",$referer="",$extra_form="", $login_methods=array(), $facebookOpts=array()) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_login', $this->_funcHooks['showLogInForm'] ) )
{
$count_1b78ecd129499821ee82c7b76f260ed4 = is_array($this->functionData['showLogInForm']) ? count($this->functionData['showLogInForm']) : 0;
$this->functionData['showLogInForm'][$count_1b78ecd129499821ee82c7b76f260ed4]['message'] = $message;
$this->functionData['showLogInForm'][$count_1b78ecd129499821ee82c7b76f260ed4]['referer'] = $referer;
$this->functionData['showLogInForm'][$count_1b78ecd129499821ee82c7b76f260ed4]['extra_form'] = $extra_form;
$this->functionData['showLogInForm'][$count_1b78ecd129499821ee82c7b76f260ed4]['login_methods'] = $login_methods;
$this->functionData['showLogInForm'][$count_1b78ecd129499821ee82c7b76f260ed4]['facebookOpts'] = $facebookOpts;
}
$IPBHTML .= "" . $this->registry->getClass('output')->addJSModule("signin", "0" ) . "
<div id='login_form' class='clearfix'>
	<div id='member_login'>
		" . $this->registry->getClass('output')->getReplacement("header_start") . "<h2 class='maintitle'>{$this->lang->words['log_in']}</h2>" . $this->registry->getClass('output')->getReplacement("header_end") . "<div class='row1'>
		<form action=\"" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "app=core&amp;module=global&amp;section=login&amp;do=process", "public",'' ), "", "" ) . "\" method=\"post\" id='login'>
			<input type='hidden' name='auth_key' value='{$this->member->form_hash}' />
			" . (($referer) ? ("<input type=\"hidden\" name=\"referer\" value=\"{$referer}\" />") : ("")) . "
			<div id='regular_signin'>
				<a id='_regularsignin'></a>
				<h3 class='bar'>{$this->lang->words['enter_name_and_pass']}</h3>
				<ul class='ipsForm ipsForm_vertical ipsPad_double left'>
					<li class='ipsField'>
						<label for='ips_username' class='ipsField_title'>{$this->lang->words['enter_name']}</label>
						<p class='ipsField_content'>
							<input id='ips_username' type='text' class='input_text' name='ips_username' size='50' tabindex='1' /><br />
							
						</p>
					</li>
					<li class='ipsField'>
						<label for='ips_password' class='ipsField_title'>{$this->lang->words['enter_pass']}</label>
						<p class='ipsField_content'>
							<input id='ips_password' type='password' class='input_text' name='ips_password' size='50' tabindex='2' /><br />
							<a href='" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "app=core&amp;module=global&amp;section=lostpass", "public",'' ), "", "" ) . "' class='ipsType_smaller' title='{$this->lang->words['retrieve_pw']}'>{$this->lang->words['login_forgotten_pass']}</a>
						</p>
					</li>
				</ul>
				<div class='right ipsPad_double' id='other_signin'>
					<ul class='ipsList_data clear ipsType_small'>
						" . ((IPSLib::loginMethod_enabled('facebook')) ? ("
							<li><a href=\"" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "app=core&amp;module=global&amp;section=login&amp;serviceClick=facebook", "public",'' ), "", "" ) . "\" class='ipsButton_secondary fixed_width'><img src=\"{$this->settings['img_url']}/loginmethods/facebook.png\" alt=\"Facebook\" /> &nbsp; {$this->lang->words['have_facebook']}</a></li>
						") : ("")) . "
						" . ((IPSLib::loginMethod_enabled('twitter')) ? ("
							<li><a href=\"" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "app=core&amp;module=global&amp;section=login&amp;serviceClick=twitter", "public",'' ), "", "" ) . "\" class='ipsButton_secondary fixed_width'><img src=\"{$this->settings['img_url']}/loginmethods/twitter.png\" alt=\"Twitter\" /> &nbsp; {$this->lang->words['have_twitter']}</a></li>
						") : ("")) . "
						" . ((IPSLib::loginMethod_enabled('live')) ? ("
							<li><a href='" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "app=core&amp;module=global&amp;section=login&amp;do=process&amp;use_live=1&amp;auth_key={$this->member->form_hash}", "public",'' ), "", "" ) . "' title='{$this->lang->words['use_live']}' class='ipsButton_secondary fixed_width'><img src=\"{$this->settings['img_url']}/loginmethods/windows.png\" alt=\"Windows Live\" /> &nbsp; {$this->lang->words['sign_in_winlive']}</a></li>
						") : ("")) . "
						" . ((is_array($extra_form) AND count($extra_form)) ? ("
							".$this->__f__de548585eeeaa242b0189601566e5c8c($message,$referer,$extra_form,$login_methods,$facebookOpts)."						") : ("")) . "
					</ul>
				</div>
			</div>
			" . ((IPSLib::loginMethod_enabled('live')) ? ("
				<div id='live_signin'>
					<a id='_live'></a>
					<h3 class='bar'>{$this->lang->words['sign_in_winlive']}</h3>
					<div class='ipsPad_double'>
						<br />
						<a href='" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "app=core&amp;module=global&amp;section=login&amp;do=process&amp;use_live=1&amp;auth_key={$this->member->form_hash}", "public",'' ), "", "" ) . "' class='ipsButton'>" . $this->registry->getClass('output')->getReplacement("live_large") . " &nbsp;&nbsp;{$this->lang->words['signin_with_live']}</a>
					</div>
					<p class='extra'><a href='#_regularsignin' title='{$this->lang->words['regular_signin']}' id='live_close'>{$this->lang->words['use_regular']}</a></p>
				</div>
			") : ("")) . "
			<hr />
			<fieldset id='signin_options'>
				<legend>{$this->lang->words['sign_in_options']}</legend>
				<ul class='ipsForm ipsForm_vertical ipsPad_double'>
					<li class='ipsField ipsField_checkbox clearfix'>
						<input type='checkbox' id='remember' checked='checked' name='rememberMe' value='1' class='input_check' tabindex='0' />
						<p class='ipsField_content'>
							<label for='remember'>{$this->lang->words['rememberme']}</label><br />
							<span class='desc lighter'>{$this->lang->words['notrecommended']}</span>
						</p>
					</li>
					" . ((!$this->settings['disable_anonymous']) ? ("
						<li class='ipsField ipsField_checkbox clearfix'>
							<input type='checkbox' id='invisible' name='anonymous' value='1' class='input_check' tabindex='0' />
							<p class='ipsField_content'>
								<label for='invisible'>{$this->lang->words['form_invisible']}</label><br />
								<span class='desc lighter'>{$this->lang->words['anon_name']}</span>
							</p>
						</li>
					") : ("")) . "
" . (($this->settings['priv_title']) ? ("
                    <li class='ipsPad_top ipsForm_center desc ipsType_smaller'>
                        <a rel=\"nofollow\" href='" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "app=core&amp;module=global&amp;section=privacy", "public",'' ), "false", "privacy" ) . "'>{$this->settings['priv_title']}</a>
                    </li>
                    ") : ("")) . "
				</ul>
			</fieldset>
			<fieldset class='submit'>
				<input type='submit' class='input_submit' value='{$this->lang->words['sign_in_button']}' tabindex='0' /> {$this->lang->words['or']} <a href='{$this->settings['board_url']}' title='{$this->lang->words['cancel']}' class='cancel'>{$this->lang->words['cancel']}</a>
			</fieldset>
		</form></div>" . $this->registry->getClass('output')->getReplacement("box_end") . "
	</div>
</div>
" . (($this->request['serviceClick'] == 'live') ? ("
<script type='text/javascript'>
document.observe(\"dom:loaded\", function(e){ ipb.signin.toggleLive(e); });
</script>
") : ("")) . "";
return $IPBHTML;
}


function __f__de548585eeeaa242b0189601566e5c8c($message="",$referer="",$extra_form="", $login_methods=array(), $facebookOpts=array())
{
	$_ips___x_retval = '';
	$__iteratorCount = 0;
	foreach( $extra_form as $form_fields )
	{
		
		$__iteratorCount++;
		$_ips___x_retval .= "
								{$form_fields}
							
";
	}
	$_ips___x_retval .= '';
	unset( $__iteratorCount );
	return $_ips___x_retval;
}


}


/*--------------------------------------------------*/
/* END OF FILE                                      */
/*--------------------------------------------------*/

?>