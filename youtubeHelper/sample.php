<?php 
include "./youtube.helper.php";

$youtubeHelper = new youtubeHelper;

$body='
123TEST
<iframe width="560" height="315" src="https://www.youtube.com/embed/t7bprbM4eh8" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
GOGO
';
echo $youtubeHelper->getThumbnailByEmbed($body);