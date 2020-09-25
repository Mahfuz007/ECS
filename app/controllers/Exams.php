<?php 
    class Exams extends Controller{
        public function __construct()
        {
            if(!isset($_SESSION['id'])){
                redirect('');
            }
            date_default_timezone_set('Asia/Dhaka');
            $this->userModel = $this->model('Exam');
        }

        public function create(){
            //check category. Only teachers can create exam
            $user = $this->userModel->getCategory($_SESSION['id']);
            if($user->category!="Teacher"){
                setFlash('unauthorize',"You are not supposed to view that page");
                redirect('');
            }

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

            //extract duration hour and minutes
            $end = explode(':',$exam->duration);
            //add duration to start time
            $exam->end = date('Y-m-d H:i:s',strtotime("+{$end[0]} hour +{$end[1]} minute",strtotime($exam->begin_time)));
            
            //push exam details at the end of exam problem set
            $len = sizeof($data);
            $data[$len]=$exam;

            //Load view
            $this->view('exams/show',$data);
        }

        public function all($id){
            //get all exam by the teacher
            $data = $this->userModel->getAllExam($id);
        
            //calculate exam ending time
            foreach($data as $exam){
                //extract duration hour and minutes
                $end = explode(':',$exam->duration);
                //add duration to start time
                $exam->end = date('Y-m-d H:i:s',strtotime("+{$end[0]} hour +{$end[1]} minute",strtotime($exam->begin_time)));
            }
            
            //Load view
            $this->view('exams/all',$data);
        }

        public function standing($examid)
        {
            //$totalproblem = $this->userModel->calTotalProblem($examid);
            $standingtable = $this->userModel->getStanding($examid);

            $this->view('exams/standing', $standingtable);
        }

        public function submission($userid, $problemid, $examid)
        {
            $sub = $this->userModel->getSubmission($userid, $problemid, $examid);
            $this->view('exams/submission', $sub);
        }

        public function showcode($submissionid)
        {
            $usercode = $this->userModel->getUserCode($submissionid);
            $this->view('exams/showcode',$usercode);
        }

        public function update($examId){
            $data = $this->userModel->getInfo($examId);
            if($_SERVER['REQUEST_METHOD']=='POST'){
                if($data->author!=$_SESSION['id']){
                    redirect('');
                }

                $exam =[
                    'type' => trim($_POST['type']),
                    'title' => trim($_POST['title']),
                    'time' => trim($_POST['time']),
                    'duration' => trim($_POST['duration']),
                    'id' => $examId
                ];

                $this->userModel->update($exam);
                redirect('exams/show/'. $examId);
            }
            $this->view('exams/update',$data);
        }
    }