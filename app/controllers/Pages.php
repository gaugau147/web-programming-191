<?php
    class Pages extends Controller{
        public function __construct(){
            // $this->postModel = $this->model('Post');
        }
        
        public function index(){
            // $posts = $this->postModel->getPosts();

            // if(isLoggedIn()){
            //     redirect('/profile');
            // }

            $data = [
                'title' => 'QuizVerse',
                'description' => 'The best place to create a quiz'
            ];

            $this->view('pages/index', $data);
        }
        
        public function about(){
            $data = [
                'title' => 'About Us',
                'description' => 'This is the about page'
            ];

            $this->view('pages/about', $data);
        }

        public function features(){
            $data = [
                'title' => 'Features',
                'description' => 'This is the feature pages'
            ];

            $this->view('pages/feature', $data);
        }

        public function useradmin(){
            $data = [
                'title' => 'UserManager',
                'description' => 'This is user manager page'
            ];

            $this->view('pages/usermanagement', $data);
        }
    }