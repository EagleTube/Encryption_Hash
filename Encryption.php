<?php
namespace Connections;
class OpenSSL_Encryption
{
    public $string;
    public $keys;
    private $options=0;
    private $iv="4797450924659018";
    private $ciphering="AES-256-CBC";
    private $iv_length;
    private $output;
    
    
    public function OpenSSL_Set()
    {
        $this->iv_length = openssl_cipher_iv_length($this->ciphering);
        $this->output = openssl_encrypt($this->string,
                                        $this->ciphering,
                                        sha1($this->keys),
                                        $this->options,
                                        $this->iv);
        return $this->output;
    }
    public function OpenSSL_Dec($enc,$key)
    {
        $this->output = openssl_decrypt($enc,
                                        $this->ciphering,
                                        sha1($key),
                                        $this->options,
                                        $this->iv);
        return $this->output;
    }
}
class Hashing
{
    public $string;
    static protected $algo="haval224,3";
    private $output;
    
    public function HashPass()
    {
        $this->output = hash(self::$algo,$this->string);
        return $this->output;
    }
    public static function Salted($str)
    {
        $cutoff = substr($str,0,20);
        $blow = '$2a$07$'.$cutoff.'salt$';
        $salted = crypt($str,$blow);
        return $salted;
    }
}
