<?php

class Hash {

  /**
   * @param string $data The data to incript 
   * @return string incripted string
   */
  static function create($data) {
    $context = hash_init('sha512', HASH_HMAC, HASH_PASSWORD_KEY);
    hash_update($context, $data);
    return hash_final($context);
  }


}
