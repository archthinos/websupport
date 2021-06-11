<?php
namespace Core;

class Validator { 

    public function validate($data){
        $validated_data = [];

       // load rules from file
       $rules = $this->load($data['type']);

       // parse array 
       for($i=0;$i<count($data);$i++){
            // get key from arrayy
            $key = array_keys($data)[$i];
            
            // check if key exists in rules array
            array_key_exists($key,$rules)? true : false;

            // explode validation rules
            $parsed_rules = (explode('|',$rules[$key]));
            
            // parse array for validation conditions
            for($j=0;$j<count($parsed_rules);$j++){
                // check if rule is true, return array with data and errors
                if($this->checkValidationRule($parsed_rules[$j],$data[$key])){
                    $validated_data['data'][$key] = $data[$key];
                } else {
                    $validated_data['errors'][] = $this->message($parsed_rules[$j],$key);
                }
            }
       }
    return $validated_data;       
    }

    // check if value is valid with rule
    public function checkValidationRule($rule,$value){
        switch($rule){
            case 'string':
                return is_string($value)? true : false;           
            case 'required':
                return empty($value)? false : true;
            case 'int':
                return is_numeric($value)? true : false; 
            case 'ipv4':
                return $this->is_ipv4($value)? true : false;
            case 'ipv6':
                return $this->is_ipv6($value)? true : false;
            default:
                return ($rule === $value)? true : false;
        }
    }
    
    public function message($error,$key){
        switch($error){
            case 'string':
                return 'Error: Value '.$key.' must be string.';
            case 'required':
                return 'Error: Value '.$key.' is required.';
            case 'ipv4':
                return 'Error: Value '.$key.' is not in IP4 format.';
            case 'ipv6': 
                return 'Error: Value '.$key.' is not in IP6 format.';
            case 'int':
                return 'Error: Value '.$key.' must be integer.';
        }
    }

    public function is_ipv4($value){
        return preg_match('/^((2[0-4]|1\d|[1-9])?\d|25[0-5])(\.(?1)){3}\z/', $value)? true : false;
    }

    public function is_ipv6($value){
        return preg_match('/^(((?=(?>.*?(::))(?!.+\3)))\3?|([\dA-F]{1,4}(\3|:(?!$)|$)|\2))(?4){5}((?4){2}|((2[0-4]|1\d|[1-9])?\d|25[0-5])(\.(?7)){3})\z/i', $value)? true : false;
    }

    public function load($file){
        return require(__DIR__.'/../app/Rules/'.$file.'.php');
    }
}