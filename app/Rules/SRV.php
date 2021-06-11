<?php 
    return [
        'type' => 'SRV',
        'name' => 'string|required',
        'content' => 'string|required',
        'prio' => 'int|required',
        'port' => 'int|required',
        'weight' => 'int|required',
        'ttl' => 'int'        
    ];