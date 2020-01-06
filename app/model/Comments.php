<?php
/**
 *
 */

class Comments
{
  protected  $data_file;
  protected $db;
  protected $inventory=[ ];

  function __construct()
  {
       $this->db=new Model();
  }
// return all row of table of comments
public function all()
{
  return $this->db->query("select * from comments");
}

//add new row to comments table
public function add(array $aData)
{

      $oStmt = $this->db->preparation('INSERT INTO comments ( text_com, user_id, news_id)
                                                  VALUES ( :text_com, :user_id, :news_id)');

          return $oStmt->execute($aData);

  }

  // list comments for news
public function newComments(array $aData)
{
  $oStmt = $this->db->preparation('SELECT * FROM comments WHERE news_id =? ');
$oStmt->execute($aData);
      return $oStmt->fetchAll();

}

}


 ?>
