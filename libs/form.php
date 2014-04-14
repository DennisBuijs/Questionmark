<?php 
//
// HIER MOETEN WE NOG EEN KEER NAAR KIJKEN
//
//
///**
// * Form
// */
//class Form {
//
//  private $_postData = array();
//  private $_currentItem = NULL;
//  private $_val = array();
//  private $_error = array();
//
//  function __construct() {
//    $this->_val = new Val();
//  }
//
//  public function post($field) {
//    $this->_postData[$field] = $_POST[$field];
//    $this->_currentItem = $field;
//    return $this;
//  }
//
//  /**
//   * Fetch - return the postdata
//   * @param Mixed $fieldName
//   * @return type array 
//   */
//  public function fetch($fieldName = false) {
//    if ($fieldName && isset($this->_postData[$fieldName])) {
//      return $this->_postData[$fieldName];
//    }
//    else {
//      return $this->_postData;
//    }
//  }
//
//  /**
//   * Validate
//   * @param string $typeOfValidator The validate method that will be called
//   * @param midex $arg agrument passed in the validate method thats called
//   * @return \Form
//   */
//  public function val($typeOfValidator, $arg = null) {
//
//    if ($arg == null)
//      $error = $this->_val->{$typeOfValidator}($this->_postData[$this->_currentItem]);
//    else
//      $error = $this->_val->{$typeOfValidator}($this->_postData[$this->_currentItem], $arg);
//
//    if ($error)
//      $this->_error[$this->_currentItem] = $error;
//
//    return $this;
//  }
//
//  /**
//   * Submit handles the form and throws an exeption
//   * @return boolean
//   * @throws Exception
//   */
//  public function submit() {
//    if (empty($this->_error))
//      return true;
//    else {
//      $str = '';
//      foreach ($this->_error as $key => $value)
//        $str .= $key . ' => ' . $value . "\n";
//      throw new Exception($str);
//    }
//  }
//
//}