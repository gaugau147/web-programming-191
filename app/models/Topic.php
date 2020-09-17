<?php
class Topic
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function addTopic($data)
    {
        $this->db->query('INSERT INTO topics (course_id, user_id, title, name) VALUES (:course_id, :user_id, :title, :name)');
        // Bind values
        $this->db->bind(':course_id', $data['course_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':user_id', $_SESSION['user_id']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function updateTopic($data)
    {
        $this->db->query('UPDATE topics SET title = :title, name = :name WHERE id = :id');
        // Bind values
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':id', $data['id']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteTopic($id)
    {
        $this->db->query('DELETE FROM topics WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $id);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function getUserData()
    {
        // Get the current user ID
        $user_id = $_SESSION['user_id'];

        $this->db->query('SELECT * FROM users WHERE id = ' . $user_id);

        $results = $this->db->resultSet();

        $row = $this->db->single();

        return $row;
    }

    function getCourseById($id)
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

    // Get topics of a course
    public function getTopics($id)
    {
        $this->db->query('SELECT * FROM topics WHERE course_id = :id');
        $this->db->bind(':id', $id);
        $results = $this->db->resultSet();
        return $results;
    }

    // Get one topic
    public function getTopicById($id)
    {
        $this->db->query('SELECT * FROM topics WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }
}
