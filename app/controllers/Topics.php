<?php
class Topics extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('/users/login');
        }

        $this->topicModel = $this->model('Topic');
    }

    public function show($id)
    {
        $course = $this->topicModel->getCourseById($id);
        $topics = $this->topicModel->getTopics($id);
        $user = $this->topicModel->getUserById($course->user_id);
        $data = [
            'course' => $course,
            'topics' => $topics,
            'user' => $user
        ];
        $this->view('topics/show', $data);
    }

    public function add($course_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'course_id' => $course_id,
                'title' => trim($_POST['title']),
                'name' => trim($_POST['name']),
                'title_err' => '',
                'name_err' => ''
            ];

            // Validate topic title
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            } elseif (!preg_match("/^[a-zA-Z0-9 ]*$/", $data['title'])) {
                $data['title_err'] = 'No symbol allowed';
            }

            // Validate topic name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter Topic Name';
            } elseif (!preg_match("/^[a-zA-Z0-9 ]*$/", $data['name'])) {
                $data['name_err'] = 'No symbol allowed';
            }

            // Make sure there is no error
            if (empty($data['title_err']) && empty($data['name_err'])) {
                // Validated
                if ($this->topicModel->addTopic($data)) {
                    flash('topic_message', 'Topic Added');
                    redirect('/topics/show/' . $course_id);
                } else {
                    flash('topic_message', 'Something went wrong');
                    redirect('/topics/show/' . $course_id);
                }
            } else {
                // Load view with error
                $this->view('topics/add', $data);
            }
        } else {
            $data = [
                'course_id' => $course_id,
                'title' => '',
                'name' => '',
                'title_err' => '',
                'name_err' => ''
            ];

            $this->view('topics/add', $data);
        }
    }

    public function edit($topic_id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Get course ID
            $course_id = $this->topicModel->getTopicById($topic_id)->course_id;

            $data = [
                'id' => $topic_id,
                'title' => trim($_POST['title']),
                'name' => trim($_POST['name']),
                'title_err' => '',
                'name_err' => '',
            ];

            // Validate topic title
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            } elseif (!preg_match("/^[a-zA-Z0-9 ]*$/", $data['title'])) {
                $data['title_err'] = 'No symbol allowed';
            }

            // Validate topic name
            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            } elseif (!preg_match("/^[a-zA-Z0-9 ]*$/", $data['name'])) {
                $data['name_err'] = 'No symbol allowed';
            }

            // Make sure there is no error
            if (empty($data['title_err']) && empty($data['name_err'])) {
                // Validated
                if ($this->topicModel->updateTopic($data)) {
                    flash('topic_message', 'Topic Updated');
                    redirect('/topics/show/' . $course_id);
                } else {
                    flash('topic_message', 'Something went wrong');
                    redirect('/topics/show/' . $course_id);
                }
            } else {
                // Load view with error
                $this->view('topics/edit', $data);
            }
        } else {
            // Fetch course
            $topic = $this->topicModel->getTopicById($topic_id);

            // Check for owner
            if ($topic->user_id != $_SESSION['user_id']) {
                redirect('/courses');
            }

            $data = [
                'id' => $topic->id,
                'course_id' => $topic->course_id,
                'user_id' => $topic->user_id,
                'title' => $topic->title,
                'name' => $topic->name,
                'title_err' => '',
                'name_err' => ''
            ];

            $this->view('topics/edit', $data);
        }
    }

    public function delete($topic_id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Fetch topic
            $topic = $this->topicModel->getTopicById($topic_id);
            
            // Course ID
            $course_id = $topic->course_id;

            // Check for owner
            if($topic->user_id != $_SESSION['user_id']){
                redirect('/courses');
            }
            
            if($this->topicModel->deleteTopic($topic_id)){
                flash('topic_message', 'Topic Deleted');
                redirect('/topics/show/' . $course_id);
            } else {
                flash('course_message', 'Something went wrong');
                redirect('/topics/show/' . $course_id);
            }
        } else {
            redirect('/topics/show/' . $course_id);
        }
    }
}
