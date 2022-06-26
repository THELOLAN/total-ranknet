<?php
/*--------------------------------------------------*/
/* FILE GENERATED BY INVISION POWER BOARD 3         */
/* CACHE FILE: Skin set id: 3               */
/* CACHE FILE: Generated: Sat, 25 Jul 2015 17:29:18 GMT */
/* DO NOT EDIT DIRECTLY - THE CHANGES WILL NOT BE   */
/* WRITTEN TO THE DATABASE AUTOMATICALLY            */
/*--------------------------------------------------*/

class skin_mlist_3 extends skinMaster{

/**
* Construct
*/
function __construct( ipsRegistry $registry )
{
	parent::__construct( $registry );
	

$this->_funcHooks = array();
$this->_funcHooks['member_list_show'] = array('members','showmembers');


}

/* -- member_list_show --*/
function member_list_show($members, $pages="", $dropdowns=array(), $defaults=array(), $custom_fields=null, $url='') {
$IPBHTML = "";
if( IPSLib::locationHasHooks( 'skin_mlist', $this->_funcHooks['member_list_show'] ) )
{
$count_12e35b4590d147cf9d3c4101770da675 = is_array($this->functionData['member_list_show']) ? count($this->functionData['member_list_show']) : 0;
$this->functionData['member_list_show'][$count_12e35b4590d147cf9d3c4101770da675]['members'] = $members;
$this->functionData['member_list_show'][$count_12e35b4590d147cf9d3c4101770da675]['pages'] = $pages;
$this->functionData['member_list_show'][$count_12e35b4590d147cf9d3c4101770da675]['dropdowns'] = $dropdowns;
$this->functionData['member_list_show'][$count_12e35b4590d147cf9d3c4101770da675]['defaults'] = $defaults;
$this->functionData['member_list_show'][$count_12e35b4590d147cf9d3c4101770da675]['custom_fields'] = $custom_fields;
$this->functionData['member_list_show'][$count_12e35b4590d147cf9d3c4101770da675]['url'] = $url;
}
$IPBHTML .= "<template>memberList</template>
{$pages}
" . ((is_array( $members ) and count( $members )) ? ("
	<members>
	".$this->__f__04570f3e9c3218f064b2b79d983fc514($members,$pages,$dropdowns,$defaults,$custom_fields,$url)."	</members>
") : ("")) . "";
return $IPBHTML;
}


function __f__04570f3e9c3218f064b2b79d983fc514($members, $pages="", $dropdowns=array(), $defaults=array(), $custom_fields=null, $url='')
{
	$_ips___x_retval = '';
	$__iteratorCount = 0;
	foreach( $members as $member )
	{
		
		$__iteratorCount++;
		$_ips___x_retval .= "
		<member>
			<id>{$member['member_id']}</id>
			<url>" . $this->registry->getClass('output')->formatUrl( $this->registry->getClass('output')->buildUrl( "showuser={$member['member_id']}", "public",'' ), "{$member['members_seo_name']}", "showuser" ) . "</url>
			<name>{$member['members_display_name']}</name>
			<postCount>{$member['posts']}</postCount>
			<group>{$member['group']}</group>
			<avatar>{$member['pp_thumb_photo']}</avatar>
		</member>
	
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