<?php 

if($dns['message']){
    echo $dns['message'];
}

if(count($zones['items'])===0){
    echo 'No items found.';
}

for($i=0;$i<count($zones['items']);$i++){
    echo '<a href="/dns/?domain='.$zones['items'][$i]['name'].'">'.$zones['items'][$i]['name'].'</a>';
}
