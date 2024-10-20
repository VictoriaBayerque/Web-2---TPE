<?php
require_once "./app/controllers/authors.controller.php";
    class AuthorsModel {
        private $db;

        public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=Lolinwonderland_db;charset=utf8', 'root', '');
        }
        public function getAuthors(){
        
            $query = $this->db->prepare('SELECT * FROM Authors');
            $query->execute();
            $authors = $query->fetchAll(PDO::FETCH_OBJ); 
        
            return $authors;
        }
        public function getAuthor($authorid) {
            $query = $this->db->prepare('SELECT * FROM Authors WHERE author_id = ?');
            $query->execute([$authorid]);   
            $author = $query->fetch(PDO::FETCH_OBJ);
        
            return $author;
        }
        public function insertAuthor ($author_name, $author_age, $author_activity, $author_img = null){
            $newFileName = null;
            if ($author_img) {
                $newFileName = $this->moveImg($author_img);
            }

            $query =$this->db-> prepare ('INSERT INTO Authors (author_name, author_age, author_activity, author_img) VALUES (?, ?, ?, ?)');
            $query->execute([$author_name, $author_age, $author_activity, $newFileName]);
            
            return $this->db->lastInsertId();
        }
        private function moveImg($authorimg) {
            $newFileName = uniqid() . "." . strtolower(pathinfo($authorimg['name'], PATHINFO_EXTENSION));
            $filepath = "./public/statics/images/authors/" . $newFileName ;
            move_uploaded_file($authorimg['tmp_name'], $filepath);
            
            return $newFileName;
        }
        public function eraseAuthor($authorid){
            $query = $this->db->prepare ('DELETE FROM Authors WHERE author_id = ?');
            $query->execute([$authorid]);
        }
        function updateAuthor ($authorid, $author_name, $author_age, $author_activity, $author_img = null){
            $newFileName = null;
            if ($author_img) {
                $newFileName = $this->moveImg($author_img);
                
                $query = $this->db->prepare('UPDATE Authors SET author_name = ?, author_age = ?, author_activity = ?, author_img = ? WHERE author_id = ?');
                $query->execute([$author_name, $author_age, $author_activity, $newFileName, $authorid]);
            } else {
                $query = $this->db->prepare('UPDATE Authors SET author_name = ?, author_age = ?, author_activity = ? WHERE author_id = ?');
                $query->execute([$author_name, $author_age, $author_activity, $authorid]);
            }
        }
}
