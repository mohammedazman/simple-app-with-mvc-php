<?php
/**
 *
 */

class Category
{
  protected  $data_file;
  protected $db;


  function __construct()
  {
       $this->db=new Model();
  }
//
public function all()
{
  return $this->db->query("select * from categories");
}
}


 ?>
