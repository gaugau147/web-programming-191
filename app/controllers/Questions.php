<?php
class Questions extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('/users/login');
        }

        $this->questionModel = $this->model('Question');
    }

    public function show($topic_id)
    {
        $questions = $this->questionModel->getQuestions($topic_id);
        $topic = $this->questionModel->getTopicById($topic_id);
        $user = $this->questionModel->getUserById($topic->user_id);
        $data = [
            'questions' => $questions,
            'course_id' => $topic->course_id,
            'topic' => $topic,
            'user' => $user
        ];
        $this->view('questions/show', $data);
    }

    public function add($topic_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Get course and user id
            $topic = $this->questionModel->getTopicById($topic_id);
            $course_id = $topic->course_id;
            $user_id = $topic->user_id;

            $data = [
                'topic_id' => $topic_id,
                'course_id' => $course_id,
                'user_id' => $user_id,
                'last_modified' => '',
                'level' => trim($_POST['level']),
                'title' => trim($_POST['title']),
                'option_1' => trim($_POST['option_1']),
                'option_2' => trim($_POST['option_2']),
                'option_3' => trim($_POST['option_3']),
                'option_4' => trim($_POST['option_4']),
                'option_5' => trim($_POST['option_5']),
                'answer_1' => $_POST['answer_1'],
                'answer_2' => $_POST['answer_2'],
                'answer_3' => $_POST['answer_3'],
                'answer_4' => $_POST['answer_4'],
                'answer_5' => $_POST['answer_5'],
                'level_err' => '',
                'title_err' => '',
                'option_1_err' => '',
                'option_2_err' => '',
                'option_3_err' => '',
                'option_4_err' => '',
                'option_5_err' => ''
            ];


            // Validate level

            // Allowed levels
            $levels = ['easy', 'medium', 'hard', 'mindblow'];

            if (empty($data['level'])) {
                $data['level_err'] = 'Please select level';
            } elseif (!in_array($data['level'], $levels)) {
                $data['level_err'] = 'Wrong level';
            }

            // Validate title
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter question title';
            }

            // Validate option 1
            if (empty($data['option_1'])) {
                $data['option_1_err'] = 'Please enter option';
            }

            // Validate option 2
            if (empty($data['option_2'])) {
                $data['option_2_err'] = 'Please enter option';
            }

            // At least 2 options is filled
            // However if user skip one field, there will be errors

            // Validate options 3-5
            if (!empty($data['option_4']) && empty($data['option_3'])) {
                $data['option_3_err'] = "Please don't skip this option";
            } elseif (!empty($data['option_5'])) {
                if (empty($data['option_3'])) {
                    $data['option_3_err'] = "Please don't skip this option";
                }
                if (empty($data['option_4'])) {
                    $data['option_4_err'] = "Please don't skip this option";
                }
            }

            // Validate answers

            // change answers to boolean
            if (empty($data['answer_1'])) {
                $data['answer_1'] = 0;
            } else {
                $data['answer_1'] = 1;
            }

            if (empty($data['answer_2'])) {
                $data['answer_2'] = 0;
            } else {
                $data['answer_2'] = 1;
            }

            // Check if a box is checked but option is not filled
            if (empty($data['answer_3'])) {
                if (!empty($data['option_3'])) {
                    $data['answer_3'] = 0;
                }
            } else {
                if (!empty($data['option_3'])) {
                    $data['answer_3'] = 1;
                } else {
                    $data['option_3_err'] = 'Please check on check box only if this option is filled';
                }
            }

            if (empty($data['answer_4'])) {
                if (!empty($data['option_4'])) {
                    $data['answer_4'] = 0;
                }
            } else {
                if (!empty($data['option_4'])) {
                    $data['answer_4'] = 1;
                } else {
                    $data['option_4_err'] = 'Please check on check box only if this option is filled';
                }
            }

            if (empty($data['answer_5'])) {
                if (!empty($data['option_5'])) {
                    $data['answer_5'] = 0;
                }
            } else {
                if (!empty($data['option_5'])) {
                    $data['answer_5'] = 1;
                } else {
                    $data['option_5_err'] = 'Please check on check box only if this option is filled';
                }
            }

            // Make sure there is no error
            if (empty($data['title_err']) && empty($data['level_err']) && empty($data['option_1_err']) && empty($data['option_2_err']) && empty($data['option_3_err']) && empty($data['option_4_err']) && empty($data['option_5_err'])) {
                // Validated
                if ($this->questionModel->addQuestion($data)) {
                    flash('question_message', 'Question Added');
                    redirect('/questions/show/' . $topic_id);
                } else {
                    flash('question_message', 'Something went wrong');
                    redirect('/questions/show/' . $topic_id);
                }
            } else {
                // Load view with error
                $this->view('questions/add', $data);
            }
        } else {
            $data = [
                'topic_id' => $topic_id,
                'level' => '',
                'title' => '',
                'option_1' => '',
                'option_2' => '',
                'option_3' => '',
                'option_4' => '',
                'option_5' => '',
                'answer_1' => '',
                'answer_2' => '',
                'answer_3' => '',
                'answer_4' => '',
                'answer_5' => '',
                'level_err' => '',
                'title_err' => '',
                'option_1_err' => '',
                'option_2_err' => '',
                'option_3_err' => '',
                'option_4_err' => '',
                'option_5_err' => ''
            ];

            $this->view('questions/add', $data);
        }
    }

    public function edit($question_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Get topic, course and user id
            $question = $this->questionModel->getQuestionById($question_id);
            $data = [
                'id' => $question_id,
                'topic_id' => $question->topic_id,
                'course_id' => $question->course_id,
                'user_id' => $question->user_id,
                'last_modified' => '',
                'level' => trim($_POST['level']),
                'title' => trim($_POST['title']),
                'option_1' => trim($_POST['option_1']),
                'option_2' => trim($_POST['option_2']),
                'option_3' => trim($_POST['option_3']),
                'option_4' => trim($_POST['option_4']),
                'option_5' => trim($_POST['option_5']),
                'answer_1' => $_POST['answer_1'],
                'answer_2' => $_POST['answer_2'],
                'answer_3' => $_POST['answer_3'],
                'answer_4' => $_POST['answer_4'],
                'answer_5' => $_POST['answer_5'],
                'level_err' => '',
                'title_err' => '',
                'option_1_err' => '',
                'option_2_err' => '',
                'option_3_err' => '',
                'option_4_err' => '',
                'option_5_err' => ''
            ];


            // Validate level

            // Allowed levels
            $levels = ['easy', 'medium', 'hard', 'mindblow'];

            if (empty($data['level'])) {
                $data['level_err'] = 'Please select level';
            } elseif (!in_array($data['level'], $levels)) {
                $data['level_err'] = 'Wrong level';
            }

            // Validate title
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter question title';
            }

            // Validate option 1
            if (empty($data['option_1'])) {
                $data['option_1_err'] = 'Please enter option';
            }

            // Validate option 2
            if (empty($data['option_2'])) {
                $data['option_2_err'] = 'Please enter option';
            }

            // At least 2 options is filled
            // However if user skip one field, there will be errors

            // Validate options 3-5
            if (!empty($data['option_4']) && empty($data['option_3'])) {
                $data['option_3_err'] = "Please don't skip this option";
            } elseif (!empty($data['option_5'])) {
                if (empty($data['option_3'])) {
                    $data['option_3_err'] = "Please don't skip this option";
                }
                if (empty($data['option_4'])) {
                    $data['option_4_err'] = "Please don't skip this option";
                }
            }

            // Validate answers

            // change answers to boolean
            if (empty($data['answer_1'])) {
                $data['answer_1'] = 0;
            } else {
                $data['answer_1'] = 1;
            }

            if (empty($data['answer_2'])) {
                $data['answer_2'] = 0;
            } else {
                $data['answer_2'] = 1;
            }

            // Check if a box is checked but option is not filled
            if (empty($data['answer_3'])) {
                if (!empty($data['option_3'])) {
                    $data['answer_3'] = 0;
                }
            } else {
                if (!empty($data['option_3'])) {
                    $data['answer_3'] = 1;
                } else {
                    $data['option_3_err'] = 'Please check on check box only if this option is filled';
                }
            }

            if (empty($data['answer_4'])) {
                if (!empty($data['option_4'])) {
                    $data['answer_4'] = 0;
                }
            } else {
                if (!empty($data['option_4'])) {
                    $data['answer_4'] = 1;
                } else {
                    $data['option_4_err'] = 'Please check on check box only if this option is filled';
                }
            }

            if (empty($data['answer_5'])) {
                if (!empty($data['option_5'])) {
                    $data['answer_5'] = 0;
                }
            } else {
                if (!empty($data['option_5'])) {
                    $data['answer_5'] = 1;
                } else {
                    $data['option_5_err'] = 'Please check on check box only if this option is filled';
                }
            }

            // Make sure there is no error
            if (empty($data['title_err']) && empty($data['level_err']) && empty($data['option_1_err']) && empty($data['option_2_err']) && empty($data['option_3_err']) && empty($data['option_4_err']) && empty($data['option_5_err'])) {
                // Validated
                if ($this->questionModel->updateQuestion($data)) {
                    flash('question_message', 'Question Edited');
                    redirect('/questions/show/' . $question->topic_id);
                } else {
                    flash('question_message', 'Something went wrong');
                    redirect('/questions/show/' . $question->topic_id);
                }
            } else {
                // Load view with error
                $this->view('questions/edit', $data);
            }
        } else {
            // Fetch data
            $question = $this->questionModel->getQuestionById($question_id);

            // Check for owner
            if ($question->user_id != $_SESSION['user_id']) {
                redirect('/questions/show/' . $question->topic_id);
            }
            $data = [
                'id' => $question_id,
                'topic_id' => $question->topic_id,
                'level' => $question->level,
                'title' => $question->title,
                'option_1' => $question->option_1,
                'option_2' => $question->option_2,
                'option_3' => $question->option_3,
                'option_4' => $question->option_4,
                'option_5' => $question->option_5,
                'answer_1' => $question->answer_1,
                'answer_2' => $question->answer_2,
                'answer_3' => $question->answer_3,
                'answer_4' => $question->answer_4,
                'answer_5' => $question->answer_5,
                'level_err' => '',
                'title_err' => '',
                'option_1_err' => '',
                'option_2_err' => '',
                'option_3_err' => '',
                'option_4_err' => '',
                'option_5_err' => ''
            ];

            $this->view('questions/edit', $data);
        }
    }

    public function delete($question_id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Fetch data
            $question = $this->questionModel->getQuestionById($question_id);
            
            // Check for owner
            if($question->user_id != $_SESSION['user_id']){
                redirect('/questions/show/' . $question->topic_id);
            }
            
            if($this->questionModel->deleteQuestion($question_id)){
                flash('question_message', 'Question Deleted');
                redirect('/questions/show/' . $question->topic_id);
            } else {
                flash('question_message', 'Something went wrong');
                redirect('/questions/show/' . $question->topic_id);
            }
        } else {
            redirect('/questions/show/' . $question->topic_id);
        }
    }
}
