<?php

echo "<div id='userdata' style='font-size:15px;'>";
//echo "<pre>";print_r($item_datas);
echo $item_datas['Item']['item_description'];
echo '<a href="#" onclick="hidedescription(\''.$item_datas['Item']['id'].'\')">less</a>';
echo "</div>";

?>