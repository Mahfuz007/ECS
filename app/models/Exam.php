<?php   
    class Exam{
        public function __construct()
        {
            $this->db = new Database();
        }

        public function create($data){
            $this->db->query('INSERT INTO exam(type,title,begin_time,duration,author) values(:type,:title,:begin_time,:duration,:author)');
            $this->db->bind(':type',$data['type']);
            $this->db->bind(':title',$data['title']);
            $this->db->bind(':begin_time',$data['begin_time']);
            $this->db->bind(':duration',$data['duration']);
            $this->db->bind(':author',$data['author']);

            $this->db->execute();
        }

        //get exam id
        public function getId(){
            $this->db->query('SELECT LAST_INSERT_ID()');
            $id = $this->db->single();
            $props = 'LAST_INSERT_ID()';
            return $id->$props;
        }

        //get all problems by specific exam id
        public function getProblems($id){
            $this->db->query('SELECT * FROM problem where examid = :id');
            $this->db->bind(':id',$id);

            $data = $this->db->resultSet();
            return $data;
        }

        //get exam information
        public function getInfo($id){
            $this->db->query('SELECT * FROM exam where id=:id');
            $this->db->bind(":id",$id);
            $data = $this->db->single();

            return $data;
        }

        //get exam author name
        public function getAuthor($id){
            $this->db->query('SELECT name from user where id=:id');
            $this->db->bind(":id",$id);
            $name = $this->db->single();
            return $name;
        }

        //get all exam by author
        public function getAllExam($author){
            $this->db->query('SELECT * from exam where author=:author');
            $this->db->bind(':author',$author);
            $exams = $this->db->resultSet();
            return $exams;
        }

        //fetch user categroy
        public function getCategory($id){
            $this->db->query('SELECT category from user where id=:id');
            $this->db->bind(":id",$id);
            
            $category = $this->db->single();
            return $category;
        }

        public function getSubmission($userid, $problemid, $examid)
        {
            $this->db->query(" SELECT id, date, userid, problemid, language, res FROM submission WHERE userid=:userid and problemid=:problemid and examid=:examid order by id desc; ");
            $this->db->bind(":userid",$userid);
            $this->db->bind(":problemid",$problemid);
            $this->db->bind(":examid",$examid);

            return $this->db->resultSet();
        }

        //Calculate how many users participate in the contest.
        private function calTotalUser($examid)
        {
            $sql = "SELECT DISTINCT userid FROM submission WHERE examid = '$examid' ORDER BY userid ASC ;";
            $this->db->query($sql);
            return $this->db->resultSet();
        }

        //Calculate how many problems are there in the contest
        public function calTotalProblem($examid)
        {
            $sql = "SELECT * FROM problem WHERE examid = '$examid';";
            $this->db->query($sql);
            return $this->db->resultSet();
        }

        //Calculate verdict depending on the userid and problemid
        private function calVerdict($problemid, $userid, $examid)
        {
            $sql = " SELECT res FROM  submission WHERE examid = '$examid' AND problemid = '$problemid' AND userid = '$userid';";
            $this->db->query($sql);
            $allverdict = $this->db->resultSet();
            $verdict = NULL;
            if(count($allverdict) != 0)
            {
                $mark = 0;
                foreach($allverdict as $key => $value)//Search there is any correct solution.
                {
                    if($value->res == "ACCEPTED")
                    {
                        $mark = 1;
                        break;
                    }
                }
                if($mark == 1)
                {
                    $verdict = "Accepted";
                }
                else
                {
                    $verdict = "Wrong Answer";
                }
            }
            return $verdict;  
        }

        //calculate Standing table
        private function calStandingTable($totalproblem, $totaluser, $examid)
        {
            $problemname = [];
            $standingtable = [];
            foreach($totalproblem as $key => $value) // This is for result's first row.
            {
                array_push($problemname,[$value->name, $value->id, $examid]);
            }
            $standingtable["User ID"] = $problemname;
            foreach($totaluser as $key => $value)
            {
                $userid = $value->userid;
                $verdict = [];
                foreach($totalproblem as $key1 => $value1)//Calculate userid's verdict for each problem 
                {
                    $problemid = $value1->id;
                    array_push($verdict, [$this->calVerdict($problemid, $userid, $examid),$problemid, $examid]);
                }
                $standingtable[$userid] = $verdict; //Store userid's verdict to the result table. 
            }
            return $standingtable;
        }

        public function getStanding($examid)
        {
            $totaluser = $this->calTotalUser($examid);
            $totalproblem = $this->calTotalProblem($examid);
            $standingtable = $this->calStandingTable($totalproblem, $totaluser, $examid);
            return $standingtable;
        }

        
    }