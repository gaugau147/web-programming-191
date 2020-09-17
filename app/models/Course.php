<?php
class Course
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getCourses()
    {
        // Get the current user ID
        $user_id = $_SESSION['user_id'];

        // Get the current user's courses
        $this->db->query('SELECT *, 
                            courses.id as cid,
                            courses.course_id as courseId,
                            users.id as userId
                            FROM courses
                            INNER JOIN users
                            ON courses.user_id = users.id
                            WHERE courses.user_id = '.$user_id.'
                            ORDER BY courses.course_id ASC
                            ');

        $results = $this->db->resultSet();

        return $results;
    }

    public function getUserData()
    {
        // Get the current user ID
        $user_id = $_SESSION['user_id'];

        $this->db->query('SELECT * FROM users WHERE id = '.$user_id);
        
        $results = $this->db->resultSet();

        $row = $this->db->single();

        return $row;
    }

    public function addCourse($data)
    {
        $this->db->query('INSERT INTO courses (course_id, name, user_id, privacy) VALUES (:course_id, :name, :user_id, :privacy)');
        // Bind values
        $this->db->bind(':course_id', $data['course_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':privacy', $data['privacy']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateCourse($data)
    {
        $this->db->query('UPDATE courses SET course_id = :course_id, name = :name, privacy = :privacy WHERE id = :id');
        // Bind values
        $this->db->bind(':course_id', $data['course_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':privacy', $data['privacy']);
        $this->db->bind(':id', $data['id']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getCourseById($id)
    {
        $this->db->query('SELECT * FROM courses WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }

    // Find User by id
    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }


    public function deleteCourse($id)
    {
        $this->db->query('DELETE FROM courses WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $id);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

}
