<?php
/**
 *
 */
class homeController extends Controller
{


  public function index($id='',$name='')
  {
    // echo 'i am in '.__CLASS__.'<br>method '.__METHOD__.'';
    // echo 'i am is '.$id.' my name is '.$name;

    $this->view('home'.DIRECTORY_SEPARATOR.'index',array('id' =>$id ,'name'=>$name ));
    $this->view->pageTitle='this page of index';

    $this->view->render();
  }
  public function aboutus()
  {
    // echo 'i am in '.__CLASS__.'<br>method '.__METHOD__.'';
    $this->view('home'.DIRECTORY_SEPARATOR.'aboutUs');
$this->view->pageTitle='this page of about Us';
    $this->view->render();
  }
}




 ?>
