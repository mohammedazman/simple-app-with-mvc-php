<?php

/**
 *
 */
class adminController extends Controller
{

  public function index()
  {
$this->model('News');
    $this->view('admin'.DIRECTORY_SEPARATOR.'index',['news'=>$this->model->all()]);

    $this->view->pageTitle='admin index';
    $this->view->render();

  }

  public function addNews()
  {
    // check if there submit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $postErr=0;

//do validation to POST

     $validate=Validation::required(['','category','title','text','title']);


        // check if there is file in posting and process the uploading
      if ($_FILES)
      {
          $upload = 1;
          $file = $_FILES["fileToUpload"]["name"];
          $file_tmp = $_FILES["fileToUpload"]["tmp_name"];
          $file_size = $_FILES["fileToUpload"]["size"];
          $target_dir = ROOT."public".DIRECTORY_SEPARATOR."pictures".DIRECTORY_SEPARATOR;
          //call  static uploadFile from Helper class  to do process of uploading and validation and return file name if sucess
          $filename = Helper::uploadFile($target_dir, $file, $file_tmp, $file_size);
      }

      # add new record to the database

      if ($validate['status'] == 1)
      {
    # prepare the array of post to send it to News model to insert to news table


                    if (!empty($filename)) {
                      $post= array(':title' => htmlentities($_REQUEST['title']),
                                    ':content' => htmlentities($_REQUEST['text']),
                                    ':category' => htmlentities($_REQUEST['category']),
                                    ':picture' => $filename,
                                    ':tags' => htmlentities($_REQUEST['tags']),
                                     ':analitics' => htmlentities($_REQUEST['analytics']),
                                     ':url' => 'url' );

                  } else {
                    $post= array(':title' => htmlentities($_REQUEST['title']),
                                  ':content' => htmlentities($_REQUEST['text']),
                                  ':category' => htmlentities($_REQUEST['category']),
                                  ':picture' => "default.png",
                                  ':tags' => htmlentities($_REQUEST['tags']),
                                   ':analitics' => htmlentities($_REQUEST['analytics']),
                                   ':url' => 'url' );
                  }



      $this->model('News');
      $this->model->add($post);

      }


    }

    # show form view  to add row to news
    $this->model('Category');

        $this->view('admin'.DIRECTORY_SEPARATOR.'addNews',['category'=>$this->model->all()]);

        $this->view->pageTitle='This Page of news admin index';
        $this->view->render();
  }


  //controller for adding user by admin
  public function addUser()
  {
    
    // check if there submit
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $validate= Validation::required(['','password','email','username']); //sure that first element in array most be null


if ($validate['status']==1) {
  $post= array(
                ':email' => htmlentities($_REQUEST['email']),
                ':username' => htmlentities($_REQUEST['username']),
                ':password' => Hashing::init($_REQUEST['password']),
                ':type' =>  htmlentities($_REQUEST['type']),
                 ':status' => isset($_REQUEST['status'])?htmlentities($_REQUEST['status']):0,
                 );

                 $this->model('Users');


                 if ($this->model->add($post)) {
                   Message::setMessage('msgState',1);
                   Message::setMessage('main','تم اضافة المستخدم بنجاح');
                 }
}


    }











    # show form view  to add new user


        $this->view('admin'.DIRECTORY_SEPARATOR.'addUser');

        $this->view->pageTitle='Add New User';
        $this->view->render();
  }


}





















 ?>
