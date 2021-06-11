
<form method="POST" action="/dns/store?domain=<?php echo $domain?>">
    <input type="hidden" name="type" value="SRV">
    <input type="text" name="name" placeholder="name"
        value="<?php if(isset($old['name'])){ echo $old['name'];} ?>"/>
    <input type="text" name="content" placeholder="content"
        value="<?php if(isset($old['content'])){ echo $old['content'];} ?>"/>
    <input type="text" name="prio" placeholder="prio" 
        value="<?php if(isset($old['prio'])){ echo $old['prio'];} ?>"/>
    <input type="text" name="port" placeholder="port" 
        value="<?php if(isset($old['port'])){ echo $old['port'];} ?>"/>
    <input type="text" name="weight" placeholder="weight" 
        value="<?php if(isset($old['weight'])){ echo $old['weight'];} ?>"/>
    <input type="text" name="ttl" placeholder="ttl" 
        value="<?php if(isset($old['ttl'])){ echo $old['ttl'];} ?>"/>
    <button type="submit">Save</button>
</form>