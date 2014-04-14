<?php

class Val {

  public function max_length($data, $arg) {
    if (strlen($data) > $arg)
      return 'Your string cannot be ' . $arg . ' long';
  }

  public function digit($data) {
    if (ctype_digit($data) == false)
      return 'The input has to be an integer';
  }

  public function min_length($data, $arg) {
    if (strlen($data) < $arg)
      return 'Your string van only be ' . $arg . ' long';
  }

}