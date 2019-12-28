<?php
/**
 *
 */

class News
{
  protected  $data_file;
  protected $db;
  protected $inventory=[ ];

  function __construct()
  {
       $this->db=new Model();
  }
// return all row of table of news
public function all()
{
  return $this->db::query("select * from news");
}

//add new row to news table
public function add(array $aData)
{

      $oStmt = $this->db->preparation('INSERT INTO news ( title, text, picture, category, tags, analitics, url) VALUES ( :title, :content, :picture, :category, :tags, :analitics, :url)');

          return $oStmt->execute($aData);

  }


}


 ?>
