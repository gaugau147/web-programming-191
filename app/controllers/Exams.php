<?php
class Exams extends Controller
{

    public function __construct()
    {
        $this->examModel = $this->model('Exam');
    }

    public function show($user_id)
    {
        $exams = $this->examModel->getExams($user_id);
        $user = $this->examModel->getUserById($user_id);
        $data = [
            'exams' => $exams,
            'user' => $user
        ];
        $this->view('exams/show', $data);
    }

    public function display($exam_id)
    {
        $exam = $this->examModel->getExamById($exam_id);
        $user = $this->examModel->getUserByExam($exam_id);
        $questions = $this->examModel->getExamQuestions($exam_id);
        $data = [
            'exam' => $exam,
            'user' => $user,
            'questions' => $questions
        ];
        $this->view('exams/display', $data);
    }

    public function create($course_id)
    {
        $user_id = $this->examModel->getUserByCourse($course_id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'date' =>  date("Y-m-d", strtotime($_POST['date'])),
                'time' => trim($_POST['time']),
                'duration' => trim($_POST['duration']),
                'no_question' => trim($_POST['no_question']),
                'class' => trim($_POST['class']),
                'notes' => trim($_POST['notes']),
                'course_id' => $course_id,
                'user_id' => $user_id,
                'title_err' => '',
                'date_err' => '',
                'time_err' => '',
                'duration_err' => '',
                'no_question_err' => '',
                'class_err' => '',
                'notes_err' => ''
            ];

            // Validate title
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter Exam title';
            }

            // Validate date taken
            if (empty($data['date'])) {
                $data['date_err'] = 'Please enter Exam date';
            }

            // Validate start time 00:00 - 23:59
            if (empty($data['time'])) {
                $data['time_err'] = 'Please enter Exam start time';
            } elseif (strlen(explode(":", $data['time'])[0]) > 2 || strlen(explode(":", $data['time'])[1]) > 2) {
                $data['time_err'] = 'Wrong time format';
            } elseif (
                (int) explode(":", $data['time'])[0] > 23 ||
                (int) explode(":", $data['time'])[0] < 0 ||
                (int) explode(":", $data['time'])[1] > 59 ||
                (int) explode(":", $data['time'])[1] < 0
            ) {
                $data['time_err'] = 'Wrong time format';
            }

            // Validate exam duration
            if (empty($data['duration'])) {
                $data['duration_err'] = 'Please enter Exam duration';
            } elseif ((int) $data['duration'] < 0 || (int) $data['duration'] > 3600) {
                $data['duration_err'] = 'Exam duration only from 0 - 3600 minutes';
            }

            // Validate number of questions
            if (empty($data['no_question'])) {
                $data['no_question_err'] = 'Please enter Number of questions';
            } elseif ((int) $data['no_question'] < 0) {
                $data['no_question_err'] = 'Only integer allowed';
            }

            // Make sure there is no error
            if (
                empty($data['title_err']) &&
                empty($data['time_err']) &&
                empty($data['date_err']) &&
                empty($data['duration_err']) &&
                empty($data['no_question_err'])
            ) {
                $execute = $this->examModel->addExam($data);
                // Validated
                if ($execute) {
                    flash('exam_message', 'Exam Created');
                    redirect('/exams/questions/' . $execute);
                } else {
                    flash('exam_message', 'Something went wrong');
                    redirect('/topics/show/' . $course_id);
                }
            } else {
                // Load view with error
                $this->view('exams/create', $data);
            }
        } else {
            $data = [
                'title' => '',
                'description' => '',
                'date' => '',
                'time' => '',
                'duration' => '',
                'no_question' => '',
                'class' => '',
                'notes' => '',
                'course_id' => $course_id,
                'user_id' => $user_id,
                'title_err' => '',
                'description_err' => '',
                'date_err' => '',
                'time_err' => '',
                'duration_err' => '',
                'no_question_err' => '',
                'class_err' => '',
                'notes_err' => ''
            ];

            $this->view('exams/create', $data);
        }
    }

    public function edit($exam_id)
    {
        $exam = $this->examModel->getExamById($exam_id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'date' =>  date("Y-m-d", strtotime($_POST['date'])),
                'time' => trim($_POST['time']),
                'duration' => trim($_POST['duration']),
                'no_question' => trim($_POST['no_question']),
                'class' => trim($_POST['class']),
                'notes' => trim($_POST['notes']),
                'course_id' => $exam->course_id,
                'user_id' => $exam->user_id,
                'title_err' => '',
                'date_err' => '',
                'time_err' => '',
                'duration_err' => '',
                'no_question_err' => '',
                'class_err' => '',
                'notes_err' => ''
            ];

            // Validate title
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter Exam title';
            }

            // Validate date taken
            if (empty($data['date'])) {
                $data['date_err'] = 'Please enter Exam date';
            }

            // Validate start time 00:00 - 23:59
            if (empty($data['time'])) {
                $data['time_err'] = 'Please enter Exam start time';
            } elseif (strlen(explode(":", $data['time'])[0]) > 2 || strlen(explode(":", $data['time'])[1]) > 2) {
                $data['time_err'] = 'Wrong time format';
            } elseif (
                (int) explode(":", $data['time'])[0] > 23 ||
                (int) explode(":", $data['time'])[0] < 0 ||
                (int) explode(":", $data['time'])[1] > 59 ||
                (int) explode(":", $data['time'])[1] < 0
            ) {
                $data['time_err'] = 'Wrong time format';
            }

            // Validate exam duration
            if (empty($data['duration'])) {
                $data['duration_err'] = 'Please enter Exam duration';
            } elseif ((int) $data['duration'] < 0 || (int) $data['duration'] > 3600) {
                $data['duration_err'] = 'Exam duration only from 0 - 3600 minutes';
            }

            // Validate number of questions
            if (empty($data['no_question'])) {
                $data['no_question_err'] = 'Please enter Number of questions';
            } elseif ((int) $data['no_question'] < 0) {
                $data['no_question_err'] = 'Only integer allowed';
            }

            // Make sure there is no error
            if (
                empty($data['title_err']) &&
                empty($data['time_err']) &&
                empty($data['date_err']) &&
                empty($data['duration_err']) &&
                empty($data['no_question_err'])
            ) {
                // Validated
                if ($this->examModel->updateExam($data)) {
                    flash('exam_message', 'Exam Edited');
                    redirect('/exams/display/' . $exam_id);
                } else {
                    flash('exam_message', 'Something went wrong');
                    redirect('/exams/display/' . $exam_id);
                }
            } else {
                // Load view with error
                $this->view('exams/edit', $data);
            }
        } else {
            $data = [
                'id' => $exam_id,
                'title' => $exam->title,
                'description' => $exam->description,
                'date' => $exam->date,
                'time' => $exam->time,
                'duration' => $exam->duration,
                'no_question' => $exam->no_question,
                'class' => $exam->class,
                'notes' => $exam->notes,
                'course_id' => $exam->course_id,
                'user_id' => $exam->user_id,
                'title_err' => '',
                'description_err' => '',
                'date_err' => '',
                'time_err' => '',
                'duration_err' => '',
                'no_question_err' => '',
                'class_err' => '',
                'notes_err' => ''
            ];

            $this->view('exams/edit', $data);
        }
    }

    public function questions($exam_id)
    {
        $exam = $this->examModel->getExamById($exam_id);
        $course = $this->examModel->getCourseById($exam->course_id);
        $topics = $this->examModel->getTopics($course->id);
        $questions = $this->examModel->getQuestions($course->id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Something
        } else {
            $data = [
                'id' => $exam_id,
                'course' => $course,
                'topics' => $topics,
                'questions' => $questions,
                'exam' => $exam,
                'topic' => '',
                'question' => '',
                'level' => ''
            ];
            $this->view('exams/questions', $data);
        }
    }

    public function delete($exam_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Fetch topic
            $user_id = $this->examModel->getUserByExam($exam_id)->id;

            // Check for owner
            if ($user_id != $_SESSION['user_id']) {
                redirect('/searches/courses/' . $user_id);
            }

            if ($this->examModel->deleteExam($exam_id)) {
                flash('exam_message', 'Exam Deleted');
                redirect('/exams/show/' . $user_id);
            } else {
                flash('exam_message', 'Something went wrong');
                redirect('/exams/show/' . $user_id);
            }
        } else {
            redirect('/exams/show/' . $user_id);
        }
    }

    // Add a question to exam
    public function addquestion($qid_eid_nq)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get question id and exam id
            $question_id = explode(".", $qid_eid_nq)[0];
            $exam_id = explode(".", $qid_eid_nq)[1];
            $no_question = explode(".", $qid_eid_nq)[2];

            if ($this->examModel->addQuestion($exam_id, $question_id, $no_question)) {
                flash('exam_message', 'Question Added');
                redirect('/exams/questions/' . $exam_id);
            } else {
                flash('exam_message', 'Something went wrong');
                redirect('/exams/questions/' . $exam_id);
            }
        } else {
            redirect('/exams/questions/' . $exam_id);
        }
    }

    public function removequestion($qid_eid)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get question id and exam id
            $question_id = explode(".", $qid_eid)[0];
            $exam_id = explode(".", $qid_eid)[1];

            if ($this->examModel->removeQuestion($exam_id, $question_id)) {
                flash('exam_message', 'Question Removed');
                redirect('/exams/questions/' . $exam_id);
            } else {
                flash('exam_message', 'Something went wrong');
                redirect('/exams/questions/' . $exam_id);
            }
        } else {
            redirect('/exams/questions/' . $exam_id);
        }
    }

    public function search($exam_id)
    {
        // Init data
        $exam = $this->examModel->getExamById($exam_id);
        $course = $this->examModel->getCourseById($exam->course_id);
        $topics = $this->examModel->getTopics($course->id);
        $questions = $this->examModel->getQuestions($course->id);

        // Check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process form

            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Init data
            $data = [
                'id' => $exam_id,
                'course' => $course,
                'topics' => $topics,
                'questions' => $questions,
                'exam' => $exam,
                'topic' => trim($_POST['topic']),
                'question' => trim($_POST['question']),
                'level' => trim($_POST['level']),
                'topic_err' => '',
                'question_err' => '',
                'level_err' => ''
            ];

            if (
                empty($data['topic']) &&
                empty($data['question']) &&
                empty($data['level'])
            ) {
                $data['topic_err'] = 'At least one field must be filled';
                $data['question_err'] = 'At least one field must be filled';
                $data['level_err'] = 'At least one field must be filled';
            }

            // Make sure there is no error
            if (
                empty($data['topic_err']) &&
                empty($data['question_err']) &&
                empty($data['level_err'])
            ) {
                // Validated

                $questions = $this->examModel->searchQuestions($data['topic'], $data['question'], $data['level']);
                $data['questions'] = $questions;

                $this->view('exams/questions', $data);
            } else {
                // Load view with errors
                $this->view('exams/questions', $data);
            }
        } else {
            // // Init data
            // $exam = $this->examModel->getExamById($exam_id);
            // $course = $this->examModel->getCourseById($exam->course_id);
            // $topics = $this->examModel->getTopics($course->id);
            // $questions = $this->examModel->getQuestions($course->id);

            $data = [
                'id' => $exam_id,
                'course' => $course,
                'topics' => $topics,
                'questions' => $questions,
                'exam' => $exam,
                'topic' => '',
                'question' => '',
                'level' => '',
                'topic_err' => '',
                'question_err' => '',
                'level_err' => ''
            ];
            $this->view('exams/questions', $data);
        }
    }

    public function createpdf($exam_id)
    {
        // Init data
        $exam = $this->examModel->getExamById($exam_id);
        $course = $this->examModel->getCourseById($exam->course_id);
        $topics = $this->examModel->getTopics($course->id);
        $questions = $this->examModel->getQuestions($course->id);
        $user = $this->examModel->getUserByExam($exam_id);


        $pdf = new FPDF('P', 'mm', 'A4');

        $pdf->SetAuthor($user->fname . ' ' . $user->lname);
        $pdf->SetTitle($exam->title);

        $pdf->AddPage();
        $pdf->SetFont('Courier', '', 11);

        // Exam description
        $pdf->Image(URLROOT . '/img/hcmut-logo-2.png', 10, 10, -150);
        $pdf->Cell(80);
        $pdf->Cell(120, 10, $exam->title, 0, 2, 'C');
        $pdf->Cell(120, 10, 'Date: ' . $exam->date . ', ' . $exam->time, 0, 2, 'C');
        $pdf->Cell(120, 10, 'Duration: ' . $exam->duration . ' - Class: ' . $exam->class, 0, 2, 'C');
        $pdf->Cell(120, 10, 'Notes: ' . $exam->notes, 0, 1, 'C');

        // Exam questions
        $i = 1;
        foreach ($questions as $question) {
            $pdf->Cell(180, 10, '', 0, 1, '');
            $pdf->MultiCell(180, 5, 'Question ' . $i . ': ' . $question->title);
            $pdf->MultiCell(180, 5, 'A. ' . $question->option_1);
            $pdf->MultiCell(180, 5, 'B. ' . $question->option_2);
            if (!empty($question->option_3)) {
                $pdf->MultiCell(180, 5, 'C. ' . $question->option_3);
            }
            if (!empty($question->option_4)) {
                $pdf->MultiCell(180, 5, 'D. ' . $question->option_4);
            }
            if (!empty($question->option_3)) {
                $pdf->MultiCell(180, 5, 'E. ' . $question->option_5);
            }
            $i++;
        }

        $pdf->AddPage();
        $pdf->SetFont('Courier', '', 11);

        $pdf->Image(URLROOT . '/img/hcmut-logo-2.png', 10, 10, -150);
        
        $pdf->Cell(80);
        $pdf->Cell(120, 40, 'Answers', 0, 2, 'C');

        $i = 1;
        foreach ($questions as $question) {
            $pdf->Cell(180, 5, '', 0, 1, '');
            $pdf->MultiCell(180, 5, 'Question ' . $i . ': ');
            if($question->answer_1 == '1'){
                $pdf->MultiCell(180, 5, 'A. ');
            }
            if($question->answer_2 == '1'){
                $pdf->MultiCell(180, 5, 'B. ');
            }
            if($question->answer_3 == '1'){
                $pdf->MultiCell(180, 5, 'C. ');
            }
            if($question->answer_4 == '1'){
                $pdf->MultiCell(180, 5, 'D. ');
            }
            if($question->answer_5 == '1'){
                $pdf->MultiCell(180, 5, 'E. ');
            }
            $i++;
        }
        // $pdf->SetFont('Arial', 16);
        // $pdf->Cell()
        $pdf->Output();
        // if ($this->examModel->removeQuestion($exam_id, $question_id)) {
        //     flash('exam_message', 'Question Removed');
        //     redirect('/exams/questions/' . $exam_id);
        // } else {
        //     flash('exam_message', 'Something went wrong');
        //     redirect('/exams/questions/' . $exam_id);
        // }
    }
}
