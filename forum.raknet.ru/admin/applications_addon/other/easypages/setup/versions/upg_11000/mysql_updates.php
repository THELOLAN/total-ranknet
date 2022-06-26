<?php

$SQL[] = <<<SQL
ALTER TABLE ep_blocks ADD COLUMN block_use_php TINYINT(1) DEFAULT 0,
	ADD COLUMN block_use_bbcode TINYINT(1) DEFAULT 1;
SQL;

$SQL[] = <<<SQL
ALTER TABLE ep_pages ADD COLUMN page_use_php TINYINT(1) DEFAULT 0 AFTER page_use_wrapper,
	ADD COLUMN page_use_bbcode TINYINT(1) DEFAULT 1 AFTER page_use_php,
	ADD COLUMN page_use_cache TINYINT(1) DEFAULT 1 AFTER page_use_bbcode,
	ADD COLUMN page_meta_key TEXT AFTER page_content_cache,
	ADD COLUMN page_meta_desc TEXT AFTER page_meta_key,
	ADD COLUMN page_cached INT(11) DEFAULT 0;
SQL;

$SQL[] = 'INSERT INTO ep_pages (`page_title`, `page_key`, `page_content`, `page_content_cache`, `page_meta_key`, `page_meta_desc`, `page_group_access`, `page_use_wrapper`, `page_use_php`, `page_use_bbcode`, `page_use_cache`, `page_created`, `page_updated`, `page_cached`) VALUES (\'Page Index\', \'list\', \'<h1 class="ipsType_pagetitle"><?php echo $page[\'\'page_title\'\']; ?></h1>\r\n\r\n<ul class="bbc">\r\n<?php\r\n	$this->memb = $this->registry->member()->fetchMemberData();\r\n	$this->DB->build( array(	\'\'select\'\'	=> \'\'*\'\',\r\n								\'\'from\'\'		=> \'\'ep_pages\'\',\r\n								\'\'where\'\'		=> \'\'page_key != "\'\' . IPSText::safeslashes($page[\'\'page_key\'\']) . \'\'"\'\',\r\n								\'\'order\'\'		=> \'\'page_title ASC\'\' ) );\r\n	$this->DB->execute();\r\n\r\n	while( $page = $this->DB->fetch() ) {\r\n		if( empty($page[\'\'page_group_access\'\']) || IPSMember::isInGroup( $this->memb, array_filter( explode( \'\',\'\', $page[\'\'page_group_access\'\'] ) ), true ) ) {\r\n			echo \'\'<li><a href="\'\' . $this->registry->output->buildSEOUrl( \'\'app=easypages&page=\'\'.$page[\'\'page_key\'\'], \'\'public\'\', $page[\'\'page_title\'\'], \'\'easypages\'\' ) . \'\'">\'\' . $page[\'\'page_title\'\'] . \'\'</a></li>\'\';\r\n		}\r\n	}\r\n?>\r\n</ul>\', \'\', \'\', \'\', \'\', 1, 1, 0, 0, UNIX_TIMESTAMP(), UNIX_TIMESTAMP(), 0);';
