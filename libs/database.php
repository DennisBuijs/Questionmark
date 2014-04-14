<?php

class Database extends PDO {

  public function __construct($config) {
    parent::__construct("mysql:host={$config['host']};dbname={$config['database']}", $config['username'], $config['password']);
  }


  /**
   * Select
   * @param string $sql The Select statement
   * @param array $array The paramenters to bind
   * @param string $fetch_mode The mode to fetch
   * @return mixed
   */
  public function select($sql, $array = array(), $fetch_mode = PDO::FETCH_ASSOC) {
    $sth = $this->prepare($sql);
    foreach ($array as $key => $value) {
      $sth->bindValue("$key", $value);
    }
    $sth->execute();
    $return = $sth->fetchAll($fetch_mode);

    return $return;
  }


  /**
   * Insert data in the database
   * @param string $table The name of the table
   * @param string $data An assosiative array of data 
   */
  public function insert($table, $data) {

    $field_names = implode('`,`', array_keys($data));
    $field_values = ':' . implode(', :', array_keys($data));

    $sth = $this->prepare("INSERT INTO $table (`$field_names`) VALUES ($field_values)");

    foreach ($data as $key => $value) {
      $sth->bindValue(":$key", $value);
    }

    $sth->execute();
  }


  /**
   * Update data in the database
   * @param string $table The name of the database table
   * @param string $data An assosiative array of data 
   * @param string $where The WHERE query part
   */
  public function update($table, $data, $where) {
    $field_details = NULL;
    foreach ($data as $key => $value) {
      $fieldDetails .= "`$key` = :$key,";
    }
    $field_details = rtrim($field_details, ',');
    $sth = $this->prepare("UPDATE $table SET $field_details WHERE $where");

    foreach ($data as $key => $value) {
      $sth->bindValue(":$key", $value);
    }
    $sth->execute();
  }


  /**
   * Delete
   * @param string $table the table name
   * @param string $where the where part of query
   * @param int $limit number of rows to delete
   * @return int Rows effected
   */
  public function delete($table, $where, $limit = 1) {
    return $this->exec("DELETE FROM $table WHERE $where LIMIT $limit");
  }


}
