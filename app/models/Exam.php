<?php
class Exam
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getUserByCourse($course_id)
    {
        $this->db->query('SELECT * FROM courses WHERE id = :course_id');
        $this->db->bind(':course_id', $course_id);
        $row = $this->db->single();
        return $row->user_id;
    }

    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }

    public function getUserByExam($exam_id)
    {
        $user_id = $this->getExamById($exam_id)->user_id;
        $user = $this->getUserById($user_id);
        return $user;
    }

    public function getTopics($id)
    {
        $this->db->query('SELECT * FROM topics WHERE course_id = :id');
        $this->db->bind(':id', $id);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getCourseById($id)
    {
        $this->db->query('SELECT * FROM courses WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }

    public function getQuestions($course_id)
    {
        $this->db->query('SELECT * FROM questions WHERE course_id = :id');
        $this->db->bind(':id', $course_id);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getExamQuestions($exam_id)
    {
        // Get the current user's courses
        $this->db->query('  SELECT  q.id, q.level, q.title, q.option_1, q.option_2, q.option_3, q.option_4, q.option_5,
                                    q.answer_1, q.answer_2, q.answer_3, q.answer_4, q.answer_5
                            FROM exams e 
                                INNER JOIN exam_questions eq ON e.id = eq.exam_id
                                INNER JOIN questions q ON eq.question_id = q.id
                            WHERE e.id = ' . $exam_id . '
                            ORDER BY q.id ASC
                            ');

        $results = $this->db->resultSet();

        return $results;
    }

    public function getExams($user_id)
    {
        $this->db->query('SELECT * FROM exams WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $results = $this->db->resultSet();
        return $results;
    }

    public function getExamById($exam_id)
    {
        $this->db->query('SELECT * FROM exams WHERE id = :exam_id');
        $this->db->bind(':exam_id', $exam_id);
        $row = $this->db->single();
        return $row;
    }

    // Add question to exam
    public function addQuestion($exam_id, $question_id, $no_question)
    {
        if ($this->checkQuestion($exam_id, $question_id)) {
            return false;
        } else {
            $this->db->query('INSERT INTO exam_questions (exam_id, question_id) VALUES (:exam_id, :question_id)');

            $this->db->bind(':exam_id', $exam_id);
            $this->db->bind(':question_id', $question_id);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }

    // Check if the exam is full
    // public function checkNumberQuestion($exam_id, $question_id, $no_question){
    //     $this->db->query('SELECT COUNT(*) FROM exam_questions WHERE exam_id = :exam_id AND question_id = :question_id');
    //     // Bind value
    //     $this->db->bind(':exam_id', $exam_id);
    //     $this->db->bind(':question_id', $question_id);

    //     $row = $this->db->counting();

    //     if ($row == 0) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // Remove question from exam
    public function removeQuestion($exam_id, $question_id)
    {
        if ($this->checkQuestion($exam_id, $question_id)) {
            $this->db->query('DELETE FROM exam_questions WHERE exam_id = :exam_id AND question_id = :question_id');

            $this->db->bind(':exam_id', $exam_id);
            $this->db->bind(':question_id', $question_id);

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    // Check if a question is in exam yet
    public function checkQuestion($exam_id, $question_id)
    {
        $this->db->query('SELECT * FROM exam_questions WHERE exam_id = :exam_id AND question_id = :question_id');
        // Bind value
        $this->db->bind(':exam_id', $exam_id);
        $this->db->bind(':question_id', $question_id);

        $row = $this->db->single();

        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Search question using topic id, question title and level
    public function searchQuestions($topic_id, $question_title, $question_level)
    {
        $question = strtolower($question_title);

        if (!empty($topic_id)) {
            $query = "SELECT * FROM questions WHERE topic_id =  " . $topic_id;
            $query .= !empty($question_title) ? " AND lower(title) LIKE '%$question%' " : "";
            $query .= !empty($question_level) ? " AND level = '" . $question_level . "'": "";

            $this->db->bind(':topic_id', $topic_id);
            $this->db->bind(':question_level', $question_level);
        } elseif (!empty($question_title)) {
            $query = "SELECT * FROM questions WHERE lower(title) LIKE '%$question%' ";
            $query .= !empty($question_level) ? " AND level = '" . $question_level . "'": "";

            $this->db->bind(':question_level', $question_level);
        } else {
            $query = "SELECT * FROM questions WHERE level = '" . $question_level . "'";

            $this->db->bind(':question_level', $question_level);
        }
        $this->db->query($query);
        $results = $this->db->resultSet();
        return $results;
    }

    public function addExam($data)
    {
        if ($data['user_id'] != $_SESSION['user_id']) {
            redirect('/courses');
        }

        $this->db->query('INSERT INTO exams (title, description, date, time, duration, no_question, class, notes, course_id, user_id) VALUES (:title, :description, :date, :time, :duration, :no_question, :class, :no_question, :course_id, :user_id)');

        // Bind values
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':time', $data['time']);
        $this->db->bind(':duration', $data['duration']);
        $this->db->bind(':no_question', $data['no_question']);
        $this->db->bind(':class', $data['class']);
        $this->db->bind(':notes', $data['notes']);
        $this->db->bind(':course_id', $data['course_id']);
        $this->db->bind(':user_id', $data['user_id']);

        // Execute
        $execute = $this->db->execute_r();
        if ($execute) {
            return $execute;
        } else {
            return false;
        }
    }

    public function updateExam($data)
    {
        $this->db->query('UPDATE exams SET title = :title, description = :description, date = :date, time = :time, duration = :duration, no_question = :no_question, class = :class, notes = :notes WHERE id = :id');
        // Bind values
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':time', $data['time']);
        $this->db->bind(':duration', $data['duration']);
        $this->db->bind(':no_question', $data['no_question']);
        $this->db->bind(':class', $data['class']);
        $this->db->bind(':notes', $data['notes']);
        $this->db->bind(':id', $data['id']);


        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteExam($id)
    {
        $this->db->query('DELETE FROM exams WHERE id = :id');
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
