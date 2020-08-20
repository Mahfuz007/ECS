<?php 
    class Exams extends Controller{
        public function __construct()
        {
            date_default_timezone_set('Asia/Dhaka');
            $this->userModel = $this->model('Exam');
        }

        //create new exam
        public function create(){

            if($_SERVER['REQUEST_METHOD']=='POST'){
                $data =[
                    'type' => trim($_POST['type']),
                    'title' => trim($_POST['title']),
                    'begin_time' => $_POST['time'],
                    'duration' => trim($_POST['duration']),
                    'author' => $_SESSION['id']
                ];

                //store exam details in database
                $this->userModel->create($data);
                //get id of created exam
                $id = $this->userModel->getId();
                $url = "exams/setproblems/".$id;
                //now create problem set for the exam
                redirect($url);
            }

            //load view
            $this->view('exams/create');
        }

        public function setproblems($id){
            //get exam problemset
            $data = $this->userModel->getProblems($id);

            //create new standard object class to stoore exam id and author id
            $exam = new stdClass();
            $exam->id=$id;
            $exam->author = $_SESSION['id'];

            //push obj at the last of problem set array
            $len = sizeof($data);
            $data[$len]=$exam;

            //load view
            $this->view('exams/setproblems',$data);
        }

        public function show($id){
            //get exam problemset
            $data = $this->userModel->getProblems($id);
            //get Exam details
            $exam = $this->userModel->getInfo($id);
            //get Exam author name
            $authorName = $this->userModel->getAuthor($exam->author);
            $exam->authorName = $authorName->name;
            
            //push exam details at the end of exam problem set
            $len = sizeof($data);
            $data[$len]=$exam;

            //Load view
            $this->view('exams/show',$data);
        }
    }