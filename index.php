<?php

	// rss page -
  $feed_url = "<<<insert url to your wordpress site here>>> then the string "?feed=rss2";

	// Load XML.
	$xml = simplexml_load_file($feed_url);

	//get title/content/link for first story, then title/links of next stories.

	$content = array();
	$link = array();
	$title = array();
	foreach($xml->channel->item as $item)
	{
		$content[] = (string)$item->children('http://purl.org/rss/1.0/modules/content/');
		$link[] = (string)$item->link;
		$title[] = (string)$item->title;
	}

	$toppost = "";
	if(count($content) > 0)
	{
		$toppost = "<a href='" . $link[0] . "' style='text-decoration: none;'>" . $title[0] . "</a><br>";
		$toppost .= $content[0] . "<br><br>";
	}

	//get the next top 5 links/titles
	$prevlinks = "older news<br>";
	for($i=0; $i<count($title); $i++)
	{
		if($i > 0)
		{
			$prevlinks .= "<a href='" . $link[$i] . "' style='text-decoration: none;'>" . $title[$i] . "</a><br>";
			if($i == 5) break;
		}
	}

	$newshtml = $toppost . $prevlinks;

?>

Then when you want to display it on your page.

<?php echo $newshtml ?>
