<?php
class Question
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function addQuestion($data)
    {
        $query = 'INSERT INTO questions (topic_id, course_id, user_id, level, title, last_modified, option_1, answer_1, option_2, answer_2, option_3, answer_3, option_4, answer_4, option_5, answer_5) VALUES (:topic_id, :course_id, :user_id, :level, :title, now(), :option_1, :answer_1, :option_2, :answer_2, :option_3, :answer_3, :option_4, :answer_4, :option_5, :answer_5)';

        $this->db->query($query);
        // Bind values
        $this->db->bind(':topic_id', $data['topic_id']);
        $this->db->bind(':course_id', $data['course_id']);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':level', $data['level']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':option_1', $data['option_1']);
        $this->db->bind(':answer_1', $data['answer_1']);
        $this->db->bind(':option_2', $data['option_2']);
        $this->db->bind(':answer_2', $data['answer_2']);
        $this->db->bind(':option_3', $data['option_3']);
        $this->db->bind(':answer_3', $data['answer_3']);
        $this->db->bind(':option_4', $data['option_4']);
        $this->db->bind(':answer_4', $data['answer_4']);
        $this->db->bind(':option_5', $data['option_5']);
        $this->db->bind(':answer_5', $data['answer_5']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
        return true;
    }

    public function updateQuestion($data)
    {
        $this->db->query('UPDATE questions SET level = :level, title = :title, last_modified = now(), option_1 = :option_1, answer_1 = :answer_1, option_2 = :option_2, answer_2 = :answer_2, option_3 = :option_3, answer_3 = :answer_3, option_4 = :option_4, answer_4 = :answer_4, option_5 = :option_5, answer_5 = :answer_5 WHERE id = :id');
        // Bind values
        $this->db->bind(':level', $data['level']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':option_1', $data['option_1']);
        $this->db->bind(':answer_1', $data['answer_1']);
        $this->db->bind(':option_2', $data['option_2']);
        $this->db->bind(':answer_2', $data['answer_2']);
        $this->db->bind(':option_3', $data['option_3']);
        $this->db->bind(':answer_3', $data['answer_3']);
        $this->db->bind(':option_4', $data['option_4']);
        $this->db->bind(':answer_4', $data['answer_4']);
        $this->db->bind(':option_5', $data['option_5']);
        $this->db->bind(':answer_5', $data['answer_5']);
        $this->db->bind(':id', $data['id']);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteQuestion($id)
    {
        $this->db->query('DELETE FROM questions WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $id);

        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Get questions of a topic
    public function getQuestions($topic_id)
    {
        $this->db->query('SELECT * FROM questions WHERE topic_id = :id');
        $this->db->bind(':id', $topic_id);
        $results = $this->db->resultSet();
        return $results;
    }

    // Get question by id
    public function getQuestionById($id)
    {
        $this->db->query('SELECT * FROM questions WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }

    // Get one topic
    public function getTopicById($id)
    {
        $this->db->query('SELECT * FROM topics WHERE id = :id');
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
}
