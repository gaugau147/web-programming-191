<?php
class Courses extends Controller
{
    public function __construct()
    { 
        if(!isLoggedIn()){
            redirect('/users/login');
        }

        $this->courseModel = $this->model('Course');
    }

    public function index()
    {
        $courses = $this->courseModel->getCourses();

        $user_data = $this->courseModel->getUserData();

        $data = [
            'courses' => $courses,
            'user_data' => $user_data
        ];

        $this->view('courses/index', $data);
    }

    public function add()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'course_id' => trim($_POST['course_id']),
                'name' => trim($_POST['name']),
                'user_id' => $_SESSION['user_id'],
                'privacy' => $_POST['privacy'],
                'course_id_err' => '',
                'name_err' => '',
                'privacy_err' => '',
            ];

            // Validate course id
            if(empty($data['course_id'])){
                $data['course_id_err'] = 'Please enter Course ID';
            } elseif (!preg_match("/^[a-zA-Z0-9]*$/",$data['course_id'])){
                $data['course_id_err'] = 'No symbol allowed';
            }

            // Validate course name
            if(empty($data['name'])){
                $data['name_err'] = 'Please enter Course Name';
            } elseif (!preg_match("/^[a-zA-Z0-9 ]*$/",$data['name'])){
                $data['name_err'] = 'No symbol allowed';
            }

            // Validate course privacy
            if ($data['privacy'] != 'private' && $data['privacy'] != 'public' ){
                $data['privacy'] = 'public';
            }

            // Make sure there is no error
            if(empty($data['course_id_err']) && empty($data['name_err']) && empty($data['privacy_err'])){
                // Validated
                if($this->courseModel->addCourse($data)){
                    flash('course_message', 'Course Added');
                    redirect('/courses');
                } else {
                    flash('course_message', 'Something went wrong');
                    redirect('/courses');
                }
            } else {
                // Load view with error
                $this->view('courses/add', $data);
            }

        } else {
            $data = [
                'course_id' => '',
                'name' => '',
                'user_id' => '',
                'privacy' => '',
                'course_id_err' => '',
                'name_err' => '',
                'privacy_err' => '',
            ];

            $this->view('courses/add', $data);

        }

    }

    public function edit($id)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'course_id' => trim($_POST['course_id']),
                'name' => trim($_POST['name']),
                'user_id' => $_SESSION['user_id'],
                'privacy' => $_POST['privacy'],
                'course_id_err' => '',
                'name_err' => '',
                'privacy_err' => '',
            ];

            // Validate course id
            if(empty($data['course_id'])){
                $data['course_id_err'] = 'Please enter Course ID';
            } elseif (!preg_match("/^[a-zA-Z0-9]*$/",$data['course_id'])){
                $data['course_id_err'] = 'No symbol allowed';
            }

            // Validate course name
            if(empty($data['name'])){
                $data['name_err'] = 'Please enter Course Name';
            } elseif (!preg_match("/^[a-zA-Z0-9 ]*$/",$data['name'])){
                $data['name_err'] = 'No symbol allowed';
            }

            // Validate course privacy
            if ($data['privacy'] != 'private' && $data['privacy'] != 'public' ){
                $data['privacy'] = 'public';
            }

            // Make sure there is no error
            if(empty($data['course_id_err']) && empty($data['name_err']) && empty($data['privacy_err'])){
                // Validated
                if($this->courseModel->updateCourse($data)){
                    flash('course_message', 'Course Updated');
                    redirect('/courses');
                } else {
                    flash('course_message', 'Something went wrong');
                    redirect('/courses');
                }
            } else {
                // Load view with error
                $this->view('courses/edit', $data);
            }

        } else {
            // Fetch course
            $course = $this->courseModel->getCourseById($id);

            // Check for owner
            if($course->user_id != $_SESSION['user_id']){
                redirect('/courses');
            }

            $data = [
                'id' => $course->id,
                'course_id' => $course->course_id,
                'name' => $course->name,
                'user_id' => $course->user_id,
                'privacy' => $course->privacy,
                'course_id_err' => '',
                'name_err' => '',
                'privacy_err' => '',
            ];

            $this->view('courses/edit', $data);

        }

    }

    

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Fetch post
            $course = $this->courseModel->getCourseById($id);

            // Check for owner
            if($course->user_id != $_SESSION['user_id']){
                redirect('/courses');
            }
            
            if($this->courseModel->deleteCourse($id)){
                flash('course_message', 'Course Deleted');
                redirect('/courses');
            } else {
                flash('course_message', 'Something went wrong');
                redirect('/courses');
            }
        } else {
            redirect('/courses');
        }
    }

}
