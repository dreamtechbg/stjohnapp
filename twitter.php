

    <?php

    $woeid = 177739717608083457;  // --- where on earth ID --- (1 = global/earth) --- 

    $json = file_get_contents("https://twitter.com/_VKS/status/".$woeid, true); //getting the file content

   /* $decode = json_decode($json, true); //getting the file content as array

     

    ## echo "<pre>\r\n"; 

    ## print_r($decode);  // debug view

    ## echo "</pre>\r\n"; 

     

    echo "<h2>TRENDS: ".$decode[0]['locations'][0]['name']."</h2> \r\n";

     

    $data = $decode[0]['trends']; 

     

    foreach ($data as $item) { 

       echo "<br /> ".$item['name']."\r\n";

       echo "<br /> <a href=\"".$item['url']."\" target=\"_blank\">".$item['name']."</a>\r\n";

       echo "<br /> \r\n";*/


    //}
echo $json;
     

    ?>

