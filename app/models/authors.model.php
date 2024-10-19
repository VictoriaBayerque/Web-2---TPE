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
        public function getAuthor($authorname) {
            $query = $this->db->prepare('SELECT * FROM Authors WHERE author_name = ?');
            $query->execute([$authorname]);   
            $author = $query->fetch(PDO::FETCH_OBJ);
        
            return $author;
        }
        public function insertAuthor ($author_name, $author_age, $author_activity){
            $query =$this->db-> prepare ('INSERT INTO Authors (author_name, author_age, author_activity) VALUES (?, ?, ?)');
            $query ->execute ([$author_name, $author_age, $author_activity]);
            $author = $this->db->lastInsertId();
    
            return $author;
        }
        public function eraseAuthor($authorname){
            $query = $this->db->prepare ('DELETE FROM Authors WHERE author_name = ?');
            $query->execute([$authorname]);
        }
        function updateAuthor ($authorname){
            //VERIFICAR EL CODIGO SQL DESPUES DEL SET!!!!!
            $query = $db->prepare('UPDATE Authors SET author_age = ? WHERE id = ?');
            $query->execute([$authorname]);
        }
}
