<?php 

    class Users extends Controller{
        public function __construct()
        {
            $this->userModel = $this->model('User');
        }

        public function login(){
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $data=[
                    'id' => trim($_POST['id']),
                    'pass' => trim($_POST['pass'])
                ];

                //check login credentials
                if($this->userModel->findById($data['id'])){
                    //find matching user information
                    $login = $this->userModel->login($data);
                    if($login){
                        //found user and store the information on session data
                        $this->userSession($login);
                    }else{
                        //didn't find any user in database;
                        setFlash('login-failed','User Id or Password is incorrect');
                        redirect('');
                    }
                }else {
                    //didn't find any user with submitted user id
                    setFlash('login-failed','User Id or Password is incorrect');
                    redirect('');
                }
            }
        }

        public function register(){
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

            if($_SERVER['REQUEST_METHOD']=='POST'){


                $data=[
                    'id'=> trim($_POST['id']),
                    'name'=>trim($_POST['name']),
                    'email'=> trim($_POST['email']),
                    'pass' =>trim($_POST['pass']),
                    'confirm-pass'=> trim($_POST['confirm-pass']),
                    'category'=> ($_POST['category']),
                    'phone'=>trim($_POST['phone']),
                    'avatar'=>'',
                    'confirm-pass-error'=>'',
                    'avatar-error'=>''
                ];

                //Validate and Save Avatar
                if(file_exists($_FILES['avatar']['tmp_name'])){
                    $fileName = $_FILES['avatar']['name'];
                    $fileTempName = $_FILES['avatar']['tmp_name'];
                    $fileType = $_FILES['avatar']['type'];
                    $fileError = $_FILES['avatar']['error'];
                    $fileSize = $_FILES['avatar']['size'];
                    
                    $fileExt = explode('.',$fileName);
                    $fileExt = strtolower(end($fileExt));
                    $fileType = explode('/',$fileType)[0];
                    $allowed = array('jpeg','jpg','png');

                    if(in_array($fileExt,$allowed)){
                        if($fileType=='image'){
                            if($fileError==0){
                                if($fileSize<=10204000){
                                    $fileName = $data['id'].'.'.$fileExt;
                                    //Destination folder storing image.
                                    //There is an problem . it will be fixed so soon
                                    $fileDestination = APPROOT.'/avatar/'.$fileName;
                                    
                                    move_uploaded_file($fileTempName,$fileDestination);
                                    $data['avatar']='/avatar/'.$fileName;
                                }else{
                                    $data['avatar-error'] = 'Image size must be less than 10MB';
                                }
                            }else{
                                $data['avatar-error'] = 'An Error Occurred';
                            }
                        }else{
                            $data['avatar-error'] = 'Upload an image file';
                        }

                    }else{
                        $data['avatar-error']='Image must be jpeg,jpg or png type';
                    }
                }

                //validate Id
                if(empty($data['id'])){
                    $data['id-error']="Please enter your valid id";
                }

                //Validate Name
                if(empty($data['name'])){
                    $data['name-error']="Please enter your name";
                }

                //Validate Email
                if(empty($data['email'])){
                    $data['email-error']='Please enter your email address';
                }

                //Validate phone
                if(empty($data['phone'])){
                    $data['phone-error']='Please enter your contact number';
                }

                //Validate password
                if(empty($data['pass'])){
                    $data['pass-error']='Please enter password';
                }else if(strlen($data['pass'])<6){
                    $data['pass-error'] = "Password must be at least 6 character";
                }

                //Validate Confirm Password

                if(empty($data['confirm-pass'])){
                    $data['confirm-pass-error']='Please enter confirm password';
                }else if($data['pass']!= $data['confirm-pass']){
                    $data['confirm-pass-error']= 'Password do not match';
                }
                

                //if there is error then re-render register page and display errors
                //otherwise redirect index page and submit data to the database
                if(empty($data['name-error']) && empty($data['id-error']) && empty($data['email-error']) && empty($data['phone-error']) && empty($data['pass-error']) && empty($data['confirm-pass-error'])  && empty($data['avatar-error'])){
                    //hash password
                    $data['pass']= password_hash($data['pass'],PASSWORD_DEFAULT);
                    $this->userModel->register($data);
                    //set confirm registration message
                    setFlash('register','Successfully Registered!');
                    //redirect to home page 
                    redirect('');
                }else{
                    $this->view('users/register',$data);
                }

            }else{
                //Initialize data array
                $data = [
                    'id'=>'',
                    'name'=>'',
                    'email'=>'',
                    'pass'=>'',
                    'confirm-pass'=>'',
                    'category'=>'',
                    'phone'=>'',
                    'avatar'=>'',
                    'id-error'=>'',
                    'name-error'=>'',
                    'email-error'=>'',
                    'pass-error'=>'',
                    'phone-error'=>'',
                    'confirm-pass-error'=>'',
                    'avatar-error'=>''
                ];
            }

            //Load View
            $this->view('users/register',$data);
        }

        public function userSession($user){
            $_SESSION['id']=$user->id;
            $_SESSION['name']=$user->name;
            setFlash('login-success','You successfully logged in');
            redirect('');
        }

        public function profile($id){
            $data=$this->userModel->findById($id);
            $this->view('users/profile',$data);
        }

        public function logout(){
            unset($_SESSION['id']);
            unset($_SESSION['name']);
            redirect('pages/index');
        }
    }