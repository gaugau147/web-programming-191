<?php
class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'fname' => trim($_POST['fname']),
                'lname' => trim($_POST['lname']),
                'lid' => trim($_POST['lid']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'fname_err' => '',
                'lname_err' => '',
                'lid_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Validate Email
            if (empty($data['email'])) {
                // Check email empty
                $data['email_err'] = 'Please enter email';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                // Check email format
                $data['email_err'] = 'Wrong email format';
            } elseif ($this->userModel->findUserByEmail($data['email'])) {
                // Check email exist
                $data['email_err'] = 'Email already taken';
            }

            // Validate First and Last Name
            if (empty($data['fname'])) {
                $data['fname_err'] = 'Please enter First Name';
            } elseif (!preg_match("/^[a-zA-Z ]*$/", $data['fname'])) {
                $data['fname_err'] = 'Only letters and white space allowed';
            }

            if (empty($data['lname'])) {
                $data['lname_err'] = 'Please enter Last Name';
            } elseif (!preg_match("/^[a-zA-Z ]*$/", $data['lname'])) {
                $data['lname_err'] = 'Only letters and white space allowed';
            }

            // Validate Lecturer ID
            if (empty($data['lid'])) {
                $data['lid_err'] = 'Please enter Lecturer ID';
            } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $data['lid'])) {
                $data['lid_err'] = 'No symbol allowed';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            // Validate Confirm Password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password';
            } elseif ($data['password'] != $data['confirm_password']) {
                $data['confirm_password_err'] = 'Password do not match';
            }

            // Make sure there is no error
            if (
                empty($data['fname_err']) &&
                empty($data['lname_err']) &&
                empty($data['lid_err']) &&
                empty($data['email_err']) &&
                empty($data['password_err']) &&
                empty($data['confirm_password_err'])
            ) {
                // Validated

                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // Register User
                if ($this->userModel->register($data)) {
                    flash('register_success', 'You are registered');
                    redirect('/users/login');
                } else {
                    flash('register_success', 'There is an error, please try again');
                    redirect('/users/register');
                }
            } else {
                // Load view with errors
                $this->view('users/register', $data);
            }
        } else {
            // Init data
            $data = [
                'fname' => '',
                'lname' => '',
                'lid' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'fname_err' => '',
                'lname_err' => '',
                'lid_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            // Load view
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];

            // Validate Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            }

            // Check for user email
            if ($this->userModel->findUserByEmail($data['email'])) {
                // User found
            } else {
                // User not found
                $data['email_err'] = 'No user found';
            }

            // Make sure there is no error
            if (empty($data['email_err']) && empty($data['password_err'])) {
                // Validated
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    // Create Session
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['password_err'] = 'Password incorrect';
                    $this->view('users/login', $data);
                }
            } else {
                // Load view with errors
                $this->view('users/login', $data);
            }
        } else {
            // Init data
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => '',
            ];

            // Load view
            $this->view('users/login', $data);
        }
    }

    public function show($user_id){
        $courses = $this->userModel->getCourses($user_id);

        $user_data = $this->userModel->getUserById($user_id);

        $data = [
            'courses' => $courses,
            'user_data' => $user_data
        ];

        $this->view('users/show', $data);
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $currentDir = getcwd();
            $data = [
                'id' => $id,
                'fname' => trim($_POST['fname']),
                'lname' => trim($_POST['lname']),
                'lid' => trim($_POST['lid']),
                'password' => trim($_POST['password']),
                'dob' => date("Y-m-d", strtotime($_POST['dob'])),
                'phone' => trim($_POST['phone']),
                'faculty' => trim($_POST['faculty']),
                'avatar' => $_FILES['avatar']['name'],
                'fname_err' => '',
                'lname_err' => '',
                'lid_err' => '',
                'password_err' => '',
                'dob_err' => '',
                'phone_err' => '',
                'falculty_err' => '',
                'avatar_err' => ''
            ];

            // Working on image file
            if (!empty($data['avatar'])) {
                // Get current directory
                $currentDir = getcwd();

                // Upload path 
                $uploadPath = $currentDir . '/img/uploads/' . basename($data['avatar']);

                // Upload folder
                $uploadFolder = $currentDir . '/img/uploads/';

                // Allowed file extensions
                $fileExtensions = ['jpeg', 'jpg', 'png'];

                // Get file size
                $fileSize = $_FILES['avatar']['size'];

                // Get file temp name
                $fileTmpName  = $_FILES['avatar']['tmp_name'];

                // Get file type
                $fileType = $_FILES['avatar']['type'];

                // Get file extension
                $tmp = explode('.', $data['avatar']);
                $fileExtension = strtolower(end($tmp));

                // Validate avatar
                if (!in_array($fileExtension, $fileExtensions)) {
                    $data['avatar_err'] = "File extension not allowed. JPEG, JPG or PNG only";
                } elseif ($fileSize > 2000000) {
                    $data['avatar_err'] = "File size cannot exceed 2MB";
                } elseif (file_exists($uploadFolder . $data['avatar'])) {
                    $data['avatar_err'] = "File name already exist";
                }
            }


            // Validate First and Last Name
            if (empty($data['fname'])) {
                $data['fname_err'] = 'Please enter First Name';
            } elseif (!preg_match("/^[a-zA-Z ]*$/", $data['fname'])) {
                $data['fname_err'] = 'Only letters and white space allowed';
            }

            if (empty($data['lname'])) {
                $data['lname_err'] = 'Please enter Last Name';
            } elseif (!preg_match("/^[a-zA-Z ]*$/", $data['lname'])) {
                $data['lname_err'] = 'Only letters and white space allowed';
            }

            // Validate Lecturer ID
            if (empty($data['lid'])) {
                $data['lid_err'] = 'Please enter Lecturer ID';
            } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $data['lid'])) {
                $data['lid_err'] = 'No symbol allowed';
            }

            // Validate phone
            if (!preg_match("/^[0-9]*$/", $data['phone'])) {
                $data['phone_err'] = 'Only numbers allowed';
            }

            // Validate Faculty
            if (!preg_match("/^[a-zA-Z0-9 ]*$/", $data['faculty'])) {
                $data['faculty_err'] = 'No symbol allowed';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password to confirm changes';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be minimum 6 characters';
            }

            // Make sure there is no error
            if (
                empty($data['fname_err']) &&
                empty($data['lname_err']) &&
                empty($data['lid_err']) &&
                empty($data['dob_err']) &&
                empty($data['phone_err']) &&
                empty($data['faculty_err']) &&
                empty($data['avatar_err']) &&
                empty($data['password_err'])
            ) {
                // Validated
                if (!empty($data['avatar'])) {
                    // Upload picture
                    $didUpload = move_uploaded_file($fileTmpName, $uploadPath);
                } else {
                    $didUpload = true;
                }

                // If upload successfully
                if ($didUpload) {
                    // Request Changes
                    if ($this->userModel->edit($data)) {
                        flash('profile_edit', 'Edited Your Profile Successfully');
                        redirect('/courses');
                    } else {
                        flash('profile_edit', 'There is an error, please try again');
                        redirect('/courses');
                    }
                } else {
                    flash('profile_edit', 'There is an error uploading your profile picture');
                    redirect('/courses');
                }
            } else {
                // Load view with errors
                $this->view('users/edit', $data);
            }
        } else {
            // Fetch user
            $user = $this->userModel->getUserById($id);

            // Check for owner
            if ($user->id != $_SESSION['user_id']) {
                redirect('/courses');
            }

            $data = [
                'id' => $id,
                'fname' => $user->fname,
                'lname' => $user->lname,
                'lid' => $user->lid,
                'password' => '',
                'dob' => date('Y-m-d', strtotime($user->dob)),
                'phone' => $user->phone,
                'faculty' => $user->faculty,
                'avatar' => $user->avatar,
                'fname_err' => '',
                'lname_err' => '',
                'lid_err' => '',
                'password_err' => '',
                'dob_err' => '',
                'phone_err' => '',
                'falculty_err' => '',
                'avatar_err' => ''
            ];

            $this->view('users/edit', $data);
        }
    }

    public function adminedit($id)
    {
        $user_role = $this->userModel->getUserRole();

        if ($user_role != 'admin'){
            redirect('/users/logout');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'fname' => trim($_POST['fname']),
                'lname' => trim($_POST['lname']),
                'lid' => trim($_POST['lid']),
                'role' => $_POST['role'],
                'password' => trim($_POST['password']),
                'fname_err' => '',
                'lname_err' => '',
                'lid_err' => '',
                'role_err' => '',
                'password_err' => ''
            ];

            // Validate First and Last Name
            if (empty($data['fname'])) {
                $data['fname_err'] = 'Please enter First Name';
            } elseif (!preg_match("/^[a-zA-Z ]*$/", $data['fname'])) {
                $data['fname_err'] = 'Only letters and white space allowed';
            }

            if (empty($data['lname'])) {
                $data['lname_err'] = 'Please enter Last Name';
            } elseif (!preg_match("/^[a-zA-Z ]*$/", $data['lname'])) {
                $data['lname_err'] = 'Only letters and white space allowed';
            }

            // Validate Lecturer ID
            if (empty($data['lid'])) {
                $data['lid_err'] = 'Please enter Lecturer ID';
            } elseif (!preg_match("/^[a-zA-Z0-9]*$/", $data['lid'])) {
                $data['lid_err'] = 'No symbol allowed';
            }

            // Validate role
            if (empty($data['role'])){
                $data['role_err'] = 'Please select role';
            } elseif ($data['role'] != 'admin' && $data['role'] != 'lecturer'){
                $data['role_err'] = 'Wrong type of user';
            }

            // Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password to confirm changes';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must be minimum 6 characters';
            }

            // Make sure there is no error
            if (
                empty($data['fname_err']) &&
                empty($data['lname_err']) &&
                empty($data['lid_err']) &&
                empty($data['role_err']) &&
                empty($data['password_err'])
            ) {
                // Validated

                // Request Changes
                if ($this->userModel->adminedit($data)) {
                    flash('profile_edit', 'Edited Profile Successfully');
                    redirect('/users/manage');
                } else {
                    flash('profile_edit', 'There is an error, please try again');
                    redirect('/users/manage');
                }

            } else {
                // Load view with errors
                $this->view('users/adminedit', $data);
            }
        } else {
            // Check role
            if ($_SESSION['user_role'] != 'admin') {
                redirect('/courses');
            }

            // Fetch user
            $user = $this->userModel->getUserById($id);

            $data = [
                'id' => $id,
                'fname' => $user->fname,
                'lname' => $user->lname,
                'lid' => $user->lid,
                'role' => $user->role,
                'password' => '',
                'fname_err' => '',
                'lname_err' => '',
                'lid_err' => '',
                'role_err' => '',
                'password_err' => ''
            ];

            $this->view('users/adminedit', $data);
        }
    }

    public function changepass($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'old_password' => trim($_POST['old_password']),
                'new_password' => trim($_POST['new_password']),
                'confirm_new_password' => trim($_POST['confirm_new_password']),
                'old_password_err' => '',
                'new_password_err' => '',
                'confirm_new_password_err' => ''
            ];

            // Validate Old Password
            if (empty($data['old_password'])) {
                $data['old_password_err'] = 'Please enter your old password';
            } elseif (strlen($data['old_password']) < 6) {
                $data['old_password_err'] = 'Password must be minimum 6 characters';
            }

            // Validate New Password
            if (empty($data['new_password'])) {
                $data['new_password_err'] = 'Please enter your new password';
            } elseif (strlen($data['new_password']) < 6) {
                $data['new_password_err'] = 'Password must be minimum 6 characters';
            }

            // Validate Confirm New Password
            if (empty($data['confirm_new_password'])) {
                $data['confirm_new_password_err'] = 'Please confirm your new password';
            } elseif ($data['new_password'] != $data['confirm_new_password']) {
                $data['confirm_new_password_err'] = 'Password do not match';
            }

            // Make sure there is no error
            if (
                empty($data['old_password_err']) &&
                empty($data['new_password_err']) &&
                empty($data['confirm_new_password_err'])
            ) {
                // Validated

                // Request Changes
                if ($this->userModel->changepass($data)) {
                    flash('change_pass', 'Changed Your Password Successfully');
                    redirect('/courses');
                } else {
                    flash('change_pass', 'There is an error, please try again');
                    redirect('/courses');
                }
            } else {
                // Load view with errors
                $this->view('users/changepass', $data);
            }
        } else {
            // Fetch user
            $user = $this->userModel->getUserById($id);

            // Check for owner
            if ($user->id != $_SESSION['user_id']) {
                redirect('/courses');
            }

            $data = [
                'id' => $id,
                'old_password' => '',
                'new_password' => '',
                'confirm_new_password' => '',
                'old_password_err' => '',
                'new_password_err' => '',
                'confirm_new_password_err' => ''
            ];

            $this->view('users/changepass', $data);
        }
    }

    public function manage()
    {
        $user_role = $this->userModel->getUserRole();

        if ($user_role != 'admin'){
            redirect('/users/logout');
        }

        $users = $this->userModel->getAllUsers();
        $data = [
            'users' => $users
        ];

        $this->view('users/manage', $data);
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $user_role = $this->userModel->getUserRole();
            
            if ($user_role != 'admin'){
                redirect('/courses');
            }

            if($this->userModel->deleteUser($id)){
                flash('user_message', 'User Deleted');
                redirect('/users/manage');
            } else {
                flash('user_message', 'Something went wrong');
                redirect('/users/manage');
            }
        } else {
            redirect('/users/manage');
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->fname;
        $_SESSION['user_role'] = $user->role;
        if ($user->role == 'admin') {
            redirect('/users/manage');
        } else {
            redirect('/courses');
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_role']);
        session_destroy();
        redirect('/users/login');
    }
}
