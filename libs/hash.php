<?php

class Hash {

  /**
   * @param type $algo The algorithm that will be used to incript(md5, sha1, wirlpool)
   * @param type $data The data to incript 
   * @param type $salt The salt, should probably be same throughout the system
   * @return type
   */
  static function create($data) {
    $context = hash_init('sha512', HASH_HMAC, HASH_PASSWORD_KEY);
    hash_update($context, $data);
    return hash_final($context);
  }

}