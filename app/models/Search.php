<?php
class Search
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getUsers($data)
    {
        $fname = strtolower($data['fname']);
        $lid = strtolower($data['lid']);
        $email = strtolower($data['email']);
        
        $query = "SELECT * FROM users WHERE lower(fname) LIKE '%$fname%' ";
        $query .= !empty($data['email']) ? " AND lower(email) LIKE '%$email%' " : "";
        $query .= !empty($data['lid']) ? " AND lower(lid) LIKE '%$lid%' " : "";

        $this->db->query($query);

        $results = $this->db->resultSet();
        return $results;
    }

    public function getCourses($data){
        $course_id = strtolower($data['course_id']);
        $name = strtolower($data['name']);
        $owner = strtolower($data['owner']);

        $query = "  SELECT *, 
                    courses.id AS cid, 
                    users.id AS uid 
                    FROM courses 
                    INNER JOIN users 
                    ON courses.user_id = users.id 
                    WHERE courses.privacy = 'public' 
                    AND lower(courses.name) LIKE '%$name%' ";
        $query .= !empty($course_id) ? "AND lower(courses.course_id) LIKE '%$course_id%' " : " " ;
        $query .= !empty($owner) ? "AND lower(users.fname) LIKE '%$owner%' " : " ";

        $this->db->query($query);

        $results = $this->db->resultSet();
        return $results;
    }
}
