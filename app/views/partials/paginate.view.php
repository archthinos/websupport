<?php 

if($response['pager']['pagesize']!==null){
    $pages = ceil($response['pager']['items']/$response['pager']['pagesize']);

    echo '<p>';

    for($i=1;$i<=$pages;$i++){
        echo '<a href="';
        if($domain) {
            echo '?domain='.$domain.'&page='.$i.'">';
        } else {
            echo '&page='.$i.'">';
        }
        echo $i.'</a> | ';
    }

    echo '</p>';

}