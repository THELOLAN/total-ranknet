<?php
/*--------------------------------------------------*/
/* FILE GENERATED BY INVISION POWER BOARD 3         */
/* CACHE FILE: Skin set id: 2               */
/* CACHE FILE: Generated: Sat, 25 Jul 2015 17:29:11 GMT */
/* DO NOT EDIT DIRECTLY - THE CHANGES WILL NOT BE   */
/* WRITTEN TO THE DATABASE AUTOMATICALLY            */
/*--------------------------------------------------*/

class skin_editors_2 extends skinMaster{

/**
* Construct
*/
function __construct( ipsRegistry $registry )
{
	parent::__construct( $registry );
	

$this->_funcHooks = array();
$this->_funcHooks['editor'] = array('hasWrningInfo','jsNotLoaded','ismini','showEditor','hasToAcknowledge');
$this->_funcHooks['editorSettings'] = array('isSelected','isSelected');
$this->_funcHooks['mediaGenericWrapper'] = array('haswidth','hasheight','hasimage','hasdescription','genericmedia','hasrows');
$this->_funcHooks['sharedMedia'] = array('mediatabs');


}

/* -- ajaxEditBox --*/
function ajaxEditBox($post="", $pid=0, $error_msg="", $extraData) {
$IPBHTML = "";
$IPBHTML .= "<!--no data in this master skin-->";
return $IPBHTML;
}

/* -- editor --*/
function editor($formField='post', $content='', $options=array(), $autoSaveData=array(), $warningInfo='', $acknowledge=FALSE, $bbcodeVersion=null, $showEditor=TRUE) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_editors', $this->_funcHooks['editor'] ) )
{
$count_9ebede730a521ca37cf61a8cf7b27bc1 = is_array($this->functionData['editor']) ? count($this->functionData['editor']) : 0;
$this->functionData['editor'][$count_9ebede730a521ca37cf61a8cf7b27bc1]['formField'] = $formField;
$this->functionData['editor'][$count_9ebede730a521ca37cf61a8cf7b27bc1]['content'] = $content;
$this->functionData['editor'][$count_9ebede730a521ca37cf61a8cf7b27bc1]['options'] = $options;
$this->functionData['editor'][$count_9ebede730a521ca37cf61a8cf7b27bc1]['autoSaveData'] = $autoSaveData;
$this->functionData['editor'][$count_9ebede730a521ca37cf61a8cf7b27bc1]['warningInfo'] = $warningInfo;
$this->functionData['editor'][$count_9ebede730a521ca37cf61a8cf7b27bc1]['acknowledge'] = $acknowledge;
$this->functionData['editor'][$count_9ebede730a521ca37cf61a8cf7b27bc1]['bbcodeVersion'] = $bbcodeVersion;
$this->functionData['editor'][$count_9ebede730a521ca37cf61a8cf7b27bc1]['showEditor'] = $showEditor;
}

/* Always return as UTF-8 */
			$jsonEncoded = IPSText::jsonEncodeForTemplate( $autoSaveData );
$IPBHTML .= "" . (($acknowledge) ? ("
	<p class='message'>{$this->lang->words['warnings_acknowledge_desc']} <a href='" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "app=members&amp;module=profile&amp;section=warnings&amp;do=acknowledge&amp;id={$acknowledge}", "public",'' ), "", "" ) . "' class='ipsButton_secondary'>{$this->lang->words['warnings_acknowledge_review']}</a></p>
") : ("" . (($warningInfo) ? ("
		<p class='message'>{$warningInfo}</p>
		<br />
	") : ("")) . "
	" . (($showEditor) ? ("		" . ((empty($this->_editorJsLoaded)) ? ("
			" . ( method_exists( $this->registry->getClass('output')->getTemplate('editors'), 'editorLoadJs' ) ? $this->registry->getClass('output')->getTemplate('editors')->editorLoadJs($options) : '' ) . "
		") : ("")) . "
		<input type='hidden' name='isRte' id='isRte_{$options['editorName']}' value='0' />
		<input type='hidden' name='noSmilies' id='noSmilies_{$options['editorName']}' value='" . intval( $options['noSmilies'] ) . "' />
		<textarea id=\"{$options['editorName']}\" name=\"{$formField}\" class='ipsEditor_textarea input_text" . (($options['type'] == 'mini') ? (" mini") : ("")) . "'>{$content}</textarea>
		<p class='desc ipsPad' style='display: none' id='editor_html_message_{$options['editorName']}'>{$this->lang->words['editor_html_message']}</p>") : ("")) . "")) . "";
return $IPBHTML;
}

/* -- editorLoadJs --*/
function editorLoadJs($options='',$inlineLoad=false) {
$IPBHTML = "";
$IPBHTML .= "<!--no data in this master skin-->";
return $IPBHTML;
}

/* -- editorSettings --*/
function editorSettings() {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_editors', $this->_funcHooks['editorSettings'] ) )
{
$count_6ed1a92110fb0a51d63068ce48bc4180 = is_array($this->functionData['editorSettings']) ? count($this->functionData['editorSettings']) : 0;
}
$IPBHTML .= "<h3>{$this->lang->words['editor_options']}</h3>
<div class='fixed_inner ipsBox row1'>
	<div class='ipsSettings'>
		<fieldset class='ipsSettings_section'>
			<ul class='ipsForm ipsForm_horizontal'>
				<li class='ipsField'>
					<label for='bw_cke_contextmenu'>{$this->lang->words['editor_context_menu']}</label>
					<br />
					<select name='bw_cke_contextmenu' id='bw_cke_contextmenu' class='input_select'>
					<option value='0' " . (($this->memberData['bw_cke_contextmenu'] != 1) ? (" selected=\"selected\"") : ("")) . ">{$this->lang->words['editor_context_menu_crc']}</option>
					<option value='1' " . (($this->memberData['bw_cke_contextmenu'] == 1) ? (" selected=\"selected\"") : ("")) . ">{$this->lang->words['editor_context_menu_rc']}</option>
					
					</select>
				</li>
				<li>
					<input type='checkbox' class='input_check' id='clearSavedContent' name=\"clearSavedContent\" value=\"1\" /> &nbsp;<label for='clearSavedContent'>{$this->lang->words['editor_clear_data']}</label>
				</li>
			</ul>
		</fieldset>
	</div>
	<div class='right' style='position: relative'>
		<a href='#' id='ipsEditorOptionsSave' class='ipsButton_secondary'>{$this->lang->words['editor_ok']}</a>
	</div>
</div>";
return $IPBHTML;
}

/* -- mediaGenericWrapper --*/
function mediaGenericWrapper($rows, $pages, $app, $plugin) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_editors', $this->_funcHooks['mediaGenericWrapper'] ) )
{
$count_f9cdf35af1d84ee57214866267fccad2 = is_array($this->functionData['mediaGenericWrapper']) ? count($this->functionData['mediaGenericWrapper']) : 0;
$this->functionData['mediaGenericWrapper'][$count_f9cdf35af1d84ee57214866267fccad2]['rows'] = $rows;
$this->functionData['mediaGenericWrapper'][$count_f9cdf35af1d84ee57214866267fccad2]['pages'] = $pages;
$this->functionData['mediaGenericWrapper'][$count_f9cdf35af1d84ee57214866267fccad2]['app'] = $app;
$this->functionData['mediaGenericWrapper'][$count_f9cdf35af1d84ee57214866267fccad2]['plugin'] = $plugin;
}
$IPBHTML .= "<div class='clearfix'>
	{$pages}
</div>
<div>
	<ul class='media_results'>
		" . ((count($rows)) ? ("
			".$this->__f__dae6a4bff4d43e5bba0932fd6241e249($rows,$pages,$app,$plugin)."		") : ("
			<li class='no_messages'>
				{$this->lang->words['no_mymedia_rows']}
			</li>
		")) . "
	</ul>
</div>
<div class='clearfix'>
	{$pages}
</div>";
return $IPBHTML;
}


function __f__dae6a4bff4d43e5bba0932fd6241e249($rows, $pages, $app, $plugin)
{
	$_ips___x_retval = '';
	$__iteratorCount = 0;
	foreach( $rows as $row )
	{
		
		$__iteratorCount++;
		$_ips___x_retval .= "
				<li class='result' onclick=\"return CKEDITOR.plugins.ipsmedia.insert( '{$row['insert']}' );\">
					" . (($row['image']) ? ("<img src='{$row['image']}' alt=''" . (($row['width']) ? (" width='{$row['width']}'") : ("")) . "" . (($row['height']) ? (" height='{$row['height']}'") : ("")) . " style='max-width: 80px;' class='media_image' /><br />") : ("")) . "
					
						<strong>" . IPSText::truncate( $row['title'], 15 ) . "</strong>
						" . (($row['desc']) ? ("
							<br /><span class='desc'>" . IPSText::truncate( $row['desc'], 15 ) . "</span>
						") : ("")) . "
				</li>
			
";
	}
	$_ips___x_retval .= '';
	unset( $__iteratorCount );
	return $_ips___x_retval;
}

/* -- sharedMedia --*/
function sharedMedia($tabs) {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_editors', $this->_funcHooks['sharedMedia'] ) )
{
$count_87ee934b8602f3ee08406cd13ad757d8 = is_array($this->functionData['sharedMedia']) ? count($this->functionData['sharedMedia']) : 0;
$this->functionData['sharedMedia'][$count_87ee934b8602f3ee08406cd13ad757d8]['tabs'] = $tabs;
}
$IPBHTML .= "<h3>{$this->lang->words['mymedia_title']}</h3>
<div class='fixed_inner ipsBox'>
	<div id='mymedia_inserted' style='display: none'>{$this->lang->words['added_to_editor']}</div>
	<div class='ipsVerticalTabbed ipsLayout ipsLayout_withleft ipsLayout_smallleft clearfix'>
		<div class='ipsVerticalTabbed_tabs ipsLayout_left'>
			<ul id='mymedia_tabs'>
				".$this->__f__983cd49672247b4f334b2ce5779c6acd($tabs)."			</ul>
		</div>
		<div class='ipsVerticalTabbed_content ipsLayout_content ipsBox_container' style='position: relative'>
			<div class='ipsType_small' id='mymedia_toolbar'>
				<a href='#' id='mymedia_finish' class='ipsButton no_width' onclick=\"CKEDITOR.plugins.ipsmedia.popup.hide(); return false;\"><img src='{$this->settings['img_url']}/accept.png' /> &nbsp;{$this->lang->words['mymedia_finished']}</a>
				<input type='hidden' name='sharedmedia_search_app' id='sharedmedia_search_app' value='' />
				<input type='hidden' name='sharedmedia_search_plugin' id='sharedmedia_search_plugin' value='' />
				<input type='text' name='search_string' id='sharedmedia_search' value=\"{$this->lang->words['start_typing_sms']}\" size='30' class='input_text inactive' />
				<input class='input_submit' type='button' id='sharedmedia_submit' value='{$this->lang->words['search_string_search']}' />
				&nbsp;&nbsp;<a href='#' id='sharedmedia_reset' class='ipsType_smaller'>{$this->lang->words['search_string_reset']}</a>
			</div>
			<div id='mymedia_content' class='ipsPad'>
				" . ( method_exists( $this->registry->getClass('output')->getTemplate('editors'), 'sharedMediaDefault' ) ? $this->registry->getClass('output')->getTemplate('editors')->sharedMediaDefault() : '' ) . "
			</div>
		</div>
	</div>
</div>
<script type='text/javascript'>
ipb.vars['sm_init_value']	= \"{$this->lang->words['start_typing_sms']}\";
CKEDITOR.plugins.ipsmedia.searchinit();
</script>";
return $IPBHTML;
}


function __f__983cd49672247b4f334b2ce5779c6acd($tabs)
{
	$_ips___x_retval = '';
	$__iteratorCount = 0;
	foreach( $tabs as $tab )
	{
		
		$__iteratorCount++;
		$_ips___x_retval .= "
					<li id='{$tab['app']}_{$tab['plugin']}'><a href='#' onclick=\"return CKEDITOR.plugins.ipsmedia.loadTab( '{$tab['app']}', '{$tab['plugin']}' );\">{$tab['title']}</a></li>
				
";
	}
	$_ips___x_retval .= '';
	unset( $__iteratorCount );
	return $_ips___x_retval;
}

/* -- sharedMediaDefault --*/
function sharedMediaDefault() {
$IPBHTML = "";
$IPBHTML .= "<h1 class='ipsType_pagetitle' style='text-align: center'>{$this->lang->words['mymedia_title']}</h1>
				<h2 class='ipsType_subtitle desc' style='text-align: center'>{$this->lang->words['shareable_media_warn']}</h2>";
return $IPBHTML;
}


}


/*--------------------------------------------------*/
/* END OF FILE                                      */
/*--------------------------------------------------*/

?>