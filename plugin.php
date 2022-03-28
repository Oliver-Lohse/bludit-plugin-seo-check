<?php

// Das Plugin liest Beiträge ein und unterzieht diese einer SEO-Prüfung.
// Das Ergebnis wird im Dashboard angezeigt

class pluginSeoCheck extends Plugin {

	public function dashboard() {

		global $pages;
		global $syslog;
		global $L;

		$pageNumber    = 1;
    	$numberOfItems = -1;
    	$onlyPublished = true;
    	$items         = $pages->getList($pageNumber, $numberOfItems, $onlyPublished);

    	foreach ($items as $key) {
        	$page = buildPage($key);
			
			//$syslog->add(array('dictionaryKey'=>strlen($page->title().' - '.$page->category()) ));

        	if (strlen($page->title()) > 70) {
				$syslog->add(array('dictionaryKey'=>
					 $L->get('icon_arrow_right')
					.$L->get('icon_heading')
					.$L->get('icon_arrow_left')
					,'notes'=>
					strlen($page->title())
					.' - '
					.$page->title() ));
			}
			if (strlen($page->title()) < 50) {
				$syslog->add(array('dictionaryKey'=>
					 $L->get('icon_arrow_left')
					.$L->get('icon_heading')
					.$L->get('icon_arrow_right')
					,'notes'=>
					strlen($page->title())
					.' - '
					.$page->title() ));
			}

			if (strlen($page->description()) > 160) {
				$syslog->add(array('dictionaryKey'=>
					 $L->get('icon_arrow_right')
					.$L->get('icon_text')
					.$L->get('icon_arrow_left')
					,'notes'=>
					strlen($page->description())
					.' - '
					.$page->title() ));
			}
			if (strlen($page->description()) < 150) {
				$syslog->add(array('dictionaryKey'=>
					 $L->get('icon_arrow_left')
					.$L->get('icon_text')
					.$L->get('icon_arrow_right')
					,'notes'=>
					strlen($page->description())
					.' - '
					.$page->title() ));
			}
    	}
	}
}
?>
