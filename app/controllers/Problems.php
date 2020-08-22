<?php
class Problems extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('Problem');
    }

    public function create($examId = 0, $author = 0)
    {
        if($examId==0 || $author==0){
            redirect('');
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize problem data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                "name" => trim($_POST['name']),
                "description" => trim($_POST['problem-description']),
                "input" => trim($_POST['input-case']),
                "output" => trim($_POST['output-case']),
                "author" => $author,
                "examId" => $examId,
                "name_error" => '',
                "description_error" => '',
                "input_error" => '',
                "output_error" => ''
            ];

            //check name field is empty or not.
            if (empty($data['name'])) {
                $data['name_error'] = "Please enter problem name";
            }

            //check Description field is empty or not.
            if (empty($data['description'])) {
                $data['description_error'] = "Please Enter Problem Description";
            }

            //check Input Test-Case field is empty or not.
            if (empty($data['input'])) {
                $data['input_error'] = "Please Enter Input test cases";
            }

            //check Input Test-Case field is empty or not.
            if (empty($data['output'])) {
                $data['output_error'] = "Please Enter Output test cases";
            }

            //if no field is empty then pass data to model
            if (empty($data['input_error']) && empty($data['output_error']) && empty($data['name_error']) && empty($data['description_error'])) {

                //store problem data
                $this->userModel->create($data);

                $previous = '';
                if(isset($_POST['url'])) $previous = $_POST['url'];

                //return to origin location
                header('Location:'. $previous);
            } else {
                $this->view('problems/create', $data);
            }
        } else {
            //Initialize
            $data = [
                "name" => '',
                "author" => $author,
                "examId" => $examId,
                "description" => '',
                "input" => '',
                "output" => '',
                "name_error" => '',
                "description_error" => '',
                "input_error" => '',
                "output_error" => ''
            ];
        }

        //validate examid and author
        $exam = $this->userModel->getExam($examId,$author);
        if(empty($exam)){
            redirect('');
        }else if($author!=$_SESSION['id']){
            //if current user isn't exam author then cann't create problem
            setFlash('unauthorize','You are not allowed to view the page');
            redirect('');
        }

        //Load View
        $this->view('problems/create', $data);
    }

    //Display single problem
    public function show($id = 1)
    {
        $data = $this->userModel->show($id);
        $this->view('problems/show', $data);
    }

    //Display all problems
    public function all()
    {
        $data = $this->userModel->all();
        $this->view('problems/all', $data);
    }

    //Submit problem
    public function submit($id = 0)
    {
        $data = $this->userModel->show($id);
        $this->view('problems/submit', $data);
    }

    //Problem Submission
    public function submission()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pid = $_POST['problem-id'];

            //fetch problem
            $data = $this->userModel->show($pid);

            //if problem doesn't exist
            if (empty($data->id)) {
                setFlash('invalid-id', 'Enter Valid Problem Id');
                redirect('problems/submit');
            }

            $lang = $_POST['language'];
            global $code;
            $code = $_POST['submit-code'];
            global $check;
            $check = 0;

            //retrive testcase
            $testCase = $this->userModel->testCase($data->id);
            global $input;
            $input = $testCase->inputcase;

            global $compilationError;
            $compilationError = false;
            global $result;
            
            //include compilers
            if ($lang == 'c') {
                include APPROOT . '/compilers/c.php';
            } else if ($lang == 'cpp') {
                include APPROOT . '/compilers/cpp.php';
            }

            //Store Submitted Code
            $submittedCode = [
                "problemId" => $data->id,
                "examId" => $data->examid,
                "res" => $result,
                "code" => $code,
                "userId" => $_SESSION['id'],
                "language" => $lang
            ];

            //store submitted code
            $this->userModel->pushCode($submittedCode);

            //fetch submission information
            $info = $this->userModel->oneSubmission($data->id, $_SESSION['id']);

            if ($result == "ACCEPTED") {
                $this->view('problems/mysubmission', $info);
            } else {
                $this->view('problems/mysubmission', $info);
            }
        } else {
            redirect('');
        }
    }

    //update problem
    public function update($id){
        //submit updated problem information
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $data = [
                "name" => trim($_POST['name']),
                "description" => trim($_POST['description']),
                "input" => trim($_POST['input']),
                "output" => trim($_POST['output'])
            ];

            //store updated information
            $this->userModel->update($id,$data);

            //return back to the page from where we came here
            if(isset($_POST['url'])){
                header('Location:'.$_POST['url']);
            }
            else redirect('');
        }

        //get problem details
        $data = $this->userModel->details($id);

        //Problem author authentication
        if($data->author!=$_SESSION['id']){
            setFlash('unauthorize','You are not allowed to view the page');
            redirect('');
        }

        $problem = [
            "id" => $data->id,
            "name" => $data->name,
            "description" => $data->description,
            "input" => $data->inputcase,
            "output" => $data->outputcase 
        ];

        //Load view
        $this->view('problems/update',$problem);
    }

    public function delete($id){
        //get problem details
        $data = $this->userModel->details($id);

        if(empty($data)){
            print_r($data);
            die('success');
            //redirect('');
        }

        //Problem author authentication
        if($data->author!=$_SESSION['id']){
            setFlash('unauthorize','You are not allowed to view the page');
            redirect('');
        }

        //remove problem
        $this->userModel->delete($id);

        //redirect to source page
        $previous = URLROOT;
        if(isset($_SERVER['HTTP_REFERER'])) $previous = $_SERVER['HTTP_REFERER'];
        
        header('Location:'.$previous);
    }
}
