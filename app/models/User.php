<?php
    class User{
        private $db;
        public function __construct()
        {
            $this->db = new Database();
        }

        public function register($data){
            $this->db->query('INSERT into user(id,name,pass,email,category,phone,avatar) values(:id,:name,:pass,:email,:category,:phone,:avatar)');
            $this->db->bind(':id',$data['id']);
            $this->db->bind(':name',$data['name']);
            $this->db->bind(':pass',$data['pass']);
            $this->db->bind(':email',$data['email']);
            $this->db->bind(':category',$data['category']);
            $this->db->bind(':phone',$data['phone']);
            $this->db->bind(':avatar',$data['avatar']);
            $this->db->execute();
        }

        public function login($data){
            $this->db->query('SELECT * from user where id=:id');
            $this->db->bind(':id',$data['id']);

            $row = $this->db->single();
            $hashed_pass = $row->pass;

            if(password_verify($data['pass'],$hashed_pass)){
                return $row;
            }else{
                return false;
            }

        }

        public function findById($id){
            $this->db->query('SELECT * from user where id=:id');
            $this->db->bind(':id',$id);

            return $this->db->single();
        }

        public function findByEmail($email){
            $this->db->query('SELECT * from user where email=:email');
            $this->db->bind(':email',$email);

            return $this->db->single();
        }

        public function findByPhone($phone){
            $this->db->query('SELECT * from user where phone=:phone');
            $this->db->bind(':phone',$phone);

            return $this->db->single();
        }
    }