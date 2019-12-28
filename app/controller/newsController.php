<?php

/**
 *
 */
class newsController extends Controller
{

  public function index()
  {
    $this->model('News');
    $this->view('news'.DIRECTORY_SEPARATOR.'index',['news'=>$this->model->all()]);
    
    $this->view->pageTitle='This Page of news Index';
    $this->view->render();

  }
}





















 ?>
