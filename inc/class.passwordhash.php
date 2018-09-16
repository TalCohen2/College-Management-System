<?php

class PasswordHash {

    private $cost = 7;
    private $crypt = TRUE;

    function __construct() {
        $v = explode('.',phpversion());
        $this->crypt = ($v[0]==5 && $v[1]<5);
    }

    function getHash($password) {
        if($this->crypt) {
            return $this->crypt_create($password); 
        }
        else {
            return $this->pwhash_create($password);
        }
    }

    function checkHash($password,$hash) {
        if($this->crypt) {
            return $this->crypt_test($password,$hash);
        }
        else {
            return $this->pwhash_test($password,$hash); 
        }
    }

    /* PHP >= 5.5 */

    private function pwhash_create($password) {
        $crypt_options = array(
            'cost' => $this->cost
        );
        return password_hash($password, PASSWORD_BCRYPT, $crypt_options);
    }
    
    function pwhash_test($password,$hash) {
        return password_verify($password, $hash);
    }

    /* PHP < 5.5 */
    
    private function crypt_create($password) {
        $coststr = ($this->cost<10) ? "0{$this->cost}" : $this->cost;
        $rndstr = bin2hex(openssl_random_pseudo_bytes(22));
        $salt = "$2y\${$coststr}\${$rndstr}";
        return crypt($password,$salt);
    }
    
    private function crypt_test($password,$hash) {
        $result = crypt($password,$hash);
        return $hash==$result;
    }    

}
