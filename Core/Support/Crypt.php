<?php

namespace Converdo\ConversionMonitor\Core\Support;

class Crypt
{
    /**
     * Encrypts a given input.
     *
     * @param  string       $input
     * @return string
     */
    public function encrypt($input)
    {
        return @openssl_encrypt(base64_encode($input), 'AES-256-CFB', $this->key());
    }

    /**
     * Decrypts a given input.
     *
     * @param  string       $input
     * @return string
     */
    public function decrypt($input)
    {
        return @base64_decode(openssl_decrypt($input, 'AES-256-CFB', $this->key()));
    }

    /**
     * Returns the encryption key.
     *
     * @return string
     */
    protected function key()
    {
        return cvd_config()->platform()->encryption();
    }
}
