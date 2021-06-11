<form method="post" action="/dns/create">
        Create new entry
        <input type="hidden" name="domain" value="<?php echo $domain?>">
        <select name="type">
            <option value="A">A</option>
            <option value="AAAA">AAAA</option>
            <option value="MX">MX</option>
            <option value="ANAME">ANAME</option>
            <option value="CNAME">CNAME</option>
            <option value="NS">NS</option>
            <option value="TXT">TXT</option>
            <option value="SRV">SRV</option>
        </select>
        <button type="submit">Create</button>
    </form>    

<?php 

if($dns['message']){
    echo $dns['message'];
}

if($_REQUEST['status']==='success'){
    echo 'Operation was succesfull.' ;
} 
if($_REQUEST['status']==="error"){
    echo 'Error: '.$_REQUEST['message'];
}



echo "<table cellspacing='4' cellpading='4'>";
echo "<tr>
        <td>ID</td>
        <td>TYPE</td>
        <td>NAME</td>
        <td>CONTENT</td>
        <td></td>
     </tr>";

foreach($dns['items'] as $record){
    echo "<tr>";
    echo "<td>".$record['id']."</td>";
    echo "<td>".$record['type']."</td>";
    echo "<td>".$record['name']."</td>";
    echo "<td>".$record['content']."</td>";
    echo '<td>
        <a href="/dns/destroy/?domain='.$domain.'&id='.$record['id'].'">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
        </svg> 
        </a>
        </td>';
    echo "</tr>";
}

echo "</table>";