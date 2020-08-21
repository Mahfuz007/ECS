<?php
    class Problem{
        public function __construct(){
            $this->db = new Database();
        }

        public function create($data){
            $this->db->query("INSERT into problem(name,author,examid,description,inputcase,outputcase) values(:name,:author,:examid,:description,:inputcase,:outputcase)");
            $this->db->bind(':name',$data['name']);
            $this->db->bind(':author',$data['author']);
            $this->db->bind(':examid',$data['examId']);
            $this->db->bind(':description',$data['description']);
            $this->db->bind(':inputcase',$data['input']);
            $this->db->bind(':outputcase',$data['output']);
            $this->db->execute();
        }

        //Fetch single proble with problem id
        public function show($id){
            $this->db->query("SELECT problem.id,problem.name,problem.examid,user.name as author,problem.description,user.id as userid from problem join user on problem.author = user.id where  problem.id=:id");
            $this->db->bind(':id',$id);

            $data = $this->db->single();
            return $data;
        }

        //Fetch all problems
        public function all(){
            $this->db->query('Select * from problem');
            $data = $this->db->resultSet();
            return $data;
        }

        //Fetch Test Case
        public function testCase($id){
            $this->db->query('SELECT inputcase,outputcase from problem where id=:id');
            $this->db->bind(':id',$id);
            $data = $this->db->single();
            return $data;
        }

        //Store code
        public function pushCode($data){
            $this->db->query('INSERT into submission(problemId,examId,res,code,userId,language) values(:problemId,:examId,:res,:code,:userId,:language)');

            $this->db->bind(':problemId',$data['problemId']);
            $this->db->bind(':examId',$data['examId']);
            $this->db->bind(':res',$data['res']);
            $this->db->bind(':code',$data['code']);
            $this->db->bind(':userId',$data['userId']);
            $this->db->bind(':language',$data['language']);
            
            $this->db->execute();
        }

        //fetch all submission for one particular problem
        public function oneSubmission($problemId,$userId){
            $this->db->query('SELECT submission.problemId,submission.res,submission.language,submission.date,problem.name FROM submission join problem where submission.problemId=:problemId and submission.userId = :userId and problem.id=:pid ORDER BY submission.date DESC');
            $this->db->bind('problemId',$problemId);
            $this->db->bind('userId',$userId);
            $this->db->bind('pid',$problemId);

            $data = $this->db->resultSet();
            return $data;
        }

        //get exam details by id
        public function getExam($id,$author){
            $this->db->query('SELECT * from exam where id=:id and author=:author');
            $this->db->bind(":id",$id);
            $this->db->bind(":author",$author);

            $data = $this->db->resultSet();
            return $data;
        }

        //problem details
        public function details($id){
            $this->db->query('SELECT * from problem where id=:id');
            $this->db->bind(':id',$id);
            $data = $this->db->single();
            return $data;
        }

        //update problem
        public function update($id,$data){
            $this->db->query('UPDATE problem SET name=:name,description=:description,inputcase=:input,outputcase=:output WHERE id=:id');
            $this->db->bind(':name',$data['name']);
            $this->db->bind(':description',$data['description']);
            $this->db->bind(':input',$data['input']);
            $this->db->bind(':output',$data['output']);
            $this->db->bind(':id',$id);

            $this->db->execute();
        }
    }