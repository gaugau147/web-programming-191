<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Register user
    public function register($data)
    {
        $this->db->query('INSERT INTO users (fname, lname, lid, email, password) VALUES (:fname, :lname, :lid, :email, :password)');
        // Bind values
        $this->db->bind(':fname', $data['fname']);
        $this->db->bind(':lname', $data['lname']);
        $this->db->bind(':lid', $data['lid']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Login User
    public function login($email, $password)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        $row = $this->db->single();
        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return false;
        }
    }

    // Edit User Profile
    public function edit($data)
    {
        // Get user password
        $user_id = $_SESSION['user_id'];
        $this->db->query('SELECT * FROM users WHERE id = ' . $user_id);
        $row = $this->db->single();
        $user_password = $row->password;

        // Get input password
        $comming_password = $data['password'];

        // Proceed if password match
        if (password_verify($comming_password, $user_password)) {
            //return $row;
            $query = "UPDATE users SET fname = :fname, lname = :lname, lid = :lid, dob = :dob, phone = :phone, faculty = :faculty ";
            $query .= (!empty($data['avatar'])) ? ",avatar = :avatar" : "";
            $query .= " WHERE id = " . $user_id;

            $this->db->query($query);

            // $this->db->query('UPDATE users SET fname = :fname, lname = :lname, lid = :lid, dob = :dob, phone = :phone, faculty = :faculty, avatar = :avatar WHERE id = ' . $user_id);
            // Bind values
            $this->db->bind(':fname', $data['fname']);
            $this->db->bind(':lname', $data['lname']);
            $this->db->bind(':lid', $data['lid']);
            $this->db->bind(':dob', $data['dob']);
            $this->db->bind(':phone', $data['phone']);
            $this->db->bind(':faculty', $data['faculty']);
            if (!empty($data['avatar'])) {
                $this->db->bind(':avatar', $data['avatar']);
            }


            // Execute
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function adminedit($data)
    {
        // Get admin password
        $admin_id = $_SESSION['user_id'];
        $this->db->query('SELECT * FROM users WHERE id = ' . $admin_id);
        $row = $this->db->single();
        $admin_password = $row->password;

        // Get input password
        $comming_password = $data['password'];
        echo (int)password_verify($comming_password, $admin_password);
        // Proceed if password match
        if (password_verify($comming_password, $admin_password)) {
            //return $row;
            $query = "UPDATE users SET fname = :fname, lname = :lname, lid = :lid, role = :role WHERE id = :id";
            $this->db->query($query);

            // Bind values
            $this->db->bind(':fname', $data['fname']);
            $this->db->bind(':lname', $data['lname']);
            $this->db->bind(':lid', $data['lid']);
            $this->db->bind(':role', $data['role']);
            $this->db->bind(':id', $data['id']);

            // Execute
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function deleteUser($id)
    {
        
        $this->db->query('DELETE FROM users WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $id);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserRole(){
        $this->db->query('SELECT * FROM users WHERE id = '. $_SESSION['user_id']);
        $user = $this->db->single();
        return $user->role;
    }

    public function changepass($data)
    {
        // Get user password
        $user_id = $_SESSION['user_id'];
        $this->db->query('SELECT * FROM users WHERE id = ' . $user_id);
        $row = $this->db->single();
        $user_password = $row->password;

        // Get input passwrd
        $comming_password = $data['old_password'];

        // Proceed if password match
        if (password_verify($comming_password, $user_password)) {

            // Hash Password
            $data['new_password'] = password_hash($data['new_password'], PASSWORD_DEFAULT);

            //return $row;
            $this->db->query('UPDATE users SET password = :password WHERE id = ' . $user_id);

            // Bind values
            $this->db->bind(':password', $data['new_password']);

            // Execute
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    // Find User by email
    public function findUserByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        // Bind value
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // Check row
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Get user by id
    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }

    public function getAllUsers(){
        $this->db->query('SELECT * FROM users');
        $results = $this->db->resultSet();
        return $results;
    }

    public function getCourses($user_id){
        $this->db->query('SELECT * FROM courses WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $results = $this->db->resultSet();
        return $results;
    }
}
