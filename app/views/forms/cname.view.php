
<form method="POST" action="/dns/store?domain=<?php echo $domain?>">
    <input type="hidden" name="type" value="CNAME">
    <input type="text" name="name" placeholder="name"
        value="<?php if(isset($old['name'])){ echo $old['name'];} ?>"/>
    <input type="text" name="content" placeholder="content"
        value="<?php if(isset($old['content'])){ echo $old['content'];} ?>"/>
    <input type="text" name="ttl" placeholder="ttl"
        value="<?php if(isset($old['ttl'])){ echo $old['ttl'];} ?>"/>
    <button type="submit">Save</button>
</form>