<?php
class Searches extends Controller
{
    public function __construct()
    {
        $this->searchModel = $this->model('Search');
    }

    public function users()
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'fname' => trim($_POST['fname']),
                'lid' => trim($_POST['lid']),
                'email' => trim($_POST['email']),
                'fname_err' => '',
                'lid_err' => '',
                'email_err' => ''
            ];

            // Validate Email
            if (!empty($data['email'])) {
                if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    // Check email format
                    $data['email_err'] = 'Wrong email format';
                } elseif ($this->userModel->findUserByEmail($data['email'])) {
                    // Check email exist
                    $data['email_err'] = 'Email already taken';
                }
            }

            // Validate First Name
            if (empty($data['fname'])) {
                $data['fname_err'] = 'First Name must be filled';
            } elseif (!preg_match("/^[a-zA-Z ]*$/", $data['fname'])) {
                $data['fname_err'] = 'Only letters and white space allowed';
            }


            // Validate Lecturer ID
            if (!empty($data['lid'])) {
                if (!preg_match("/^[a-zA-Z0-9]*$/", $data['lid'])) {
                    $data['lid_err'] = 'No symbol allowed';
                }
            }

            // Make sure there is no error
            if (
                empty($data['fname_err']) &&
                empty($data['lid_err']) &&
                empty($data['email_err'])
            ) {
                // Validated

                // Search User
                // get data and load to other view
                $users = $this->searchModel->getUsers($data);
                $new_data = [
                    'fname' => $data['fname'],
                    'email' => $data['email'],
                    'lid' => $data['lid'],
                    'users' => $users
                ];

                $this->view('searches/resultusers', $new_data);
            } else {
                // Load view with errors
                $this->view('searches/users', $data);
            }
        } else {
            // Init data
            $data = [
                'fname' => '',
                'lid' => '',
                'email' => '',
                'fname_err' => '',
                'lid_err' => '',
                'email_err' => ''
            ];

            // Load view
            $this->view('searches/users', $data);
        }
    }

    public function courses()
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'course_id' => trim($_POST['course_id']),
                'name' => trim($_POST['name']),
                'owner' => trim($_POST['owner']),
                'course_err' => '',
                'name_err' => '',
                'owner_err' => ''
            ];


            // Validate course name
            if (empty($data['name'])) {
                $data['name_err'] = 'Course Name must be filled';
            } elseif (!preg_match("/^[a-zA-Z0-9 ]*$/", $data['name'])) {
                $data['name_err'] = 'Only letters, numbers and white space allowed';
            }


            // Validate Course ID
            if (!empty($data['course_id'])) {
                if (!preg_match("/^[a-zA-Z0-9]*$/", $data['course_id'])) {
                    $data['course_id_err'] = 'No symbol allowed';
                }
            }

            // Validate owner name
            if (!empty($data['owner'])) {
                if (!preg_match("/^[a-zA-Z ]*$/", $data['owner']))
                    $data['owner_err'] = 'Only letters and white space allowed';
            }

            // Make sure there is no error
            if (
                empty($data['course_id_err']) &&
                empty($data['name_err']) &&
                empty($data['owner_err'])
            ) {
                // Validated

                // Search User
                // get data and load to other view
                $courses = $this->searchModel->getCourses($data);
                $new_data = [
                    'course_id' => $data['course_id'],
                    'name' => $data['name'],
                    'owner' => $data['owner'],
                    'courses' => $courses
                ];

                $this->view('searches/resultcourses', $new_data);
            } else {
                // Load view with errors
                $this->view('searches/courses', $data);
            }
        } else {
            // Init data
            $data = [
                'course_id' => '',
                'name' => '',
                'owner' => '',
                'course_id_err' => '',
                'name_err' => '',
                'owner_err' => ''
            ];

            // Load view
            $this->view('searches/courses', $data);
        }
    }
}
