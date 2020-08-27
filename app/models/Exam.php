<?php   
    class Exam{
        public function __construct()
        {
            $this->db = new Database();
        }

        //store exam details
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
    }