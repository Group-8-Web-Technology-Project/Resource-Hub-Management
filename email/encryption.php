<?php

function encrypt($text){
    return openssl_encrypt($text, "aes-128-cbc", "password",0,"1234567890123456");

}

function decrypt($code){

    return openssl_decrypt($code, "aes-128-cbc", "password",0,"1234567890123456");
}

?>