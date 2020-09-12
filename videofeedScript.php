<?php

            define("MAX_RESULTS", 10);

            if (!empty($keyword))
              {
                $apikey = 'AIzaSyCBI44FwNrtU-__zw__WnEP1kXUdKPNEQk'; 
                $googleApiUrl = 'https://www.googleapis.com/youtube/v3/search?part=snippet&q=' . $keyword . '&maxResults=' . MAX_RESULTS . '&key=' . $apikey;

                $ch = curl_init();

                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_VERBOSE, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                $response = curl_exec($ch);

                curl_close($ch);
                $data = json_decode($response);
                $value = json_decode(json_encode($data), true);
            ?>

            
            <div class="videos-data-container" id="SearchResultsDiv">

            <?php
            //print_r($value);
                for ($i = 0; $i < MAX_RESULTS; $i++) {
                    $videoId = $value['items'][$i]['id']['videoId'];
                    $title = $value['items'][$i]['snippet']['title'];
                    $description = $value['items'][$i]['snippet']['description'];
                    ?> 
    
                        <div class="video-tile">
                        <div  class="videoDiv">
                            <iframe id="iframe" style="width:100%;height:100%" src="//www.youtube.com/embed/<?php echo $videoId; ?>" 
                                    data-autoplay-src="//www.youtube.com/embed/<?php echo $videoId; ?>?autoplay=1"></iframe>                     
                        </div>
                        <div class="videoInfo">
                        <div class="videoTitle"><b><?php echo $title; ?></b></div>
                        <div class="videoDesc"><?php echo $description; ?></div>
                        </div>
                        </div>
                <?php 

                    }
                }
                ?>