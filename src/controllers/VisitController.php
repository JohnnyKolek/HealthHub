<?php

require_once 'AppController.php';

class VisitController extends AppController
{

    private VisitRepository $visitRepository;
    private UserRepository $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->visitRepository = new VisitRepository();
    }

    public function doctors(): void
    {
        session_start();
        if (!isset($_SESSION['user_role'])){
            $this->render("error", ['message' => '401 Unauthorized']);
            return;
        }

        $role = $_SESSION['user_role'];
        if ($role !== 'patient') {
            $this->render('error', ['message' => '403 Forbidden']);
            return;
        }

        $currentDate = new DateTime();

        $data = [
            'days' => []
        ];

        $data['days'][] = [
            'dayOfWeek' => $currentDate->format('l'),
            'dayOfMonth' => $currentDate->format('j'),
            'monthNumeric' => $currentDate->format('m'),
            'year' => $currentDate->format('Y')
        ];

        for ($i = 1; $i <= 6; $i++) {
            $currentDate->add(new DateInterval('P1D'));
            $data['days'][] = [
                'dayOfWeek' => $currentDate->format('l'),
                'dayOfMonth' => $currentDate->format('j'),
                'monthNumeric' => $currentDate->format('m'),
                'year' => $currentDate->format('Y')
            ];
        }

        $doctors = $this->userRepository->getDoctors();

        if ($doctors != null) {
            foreach ($doctors as $doctor) {
                $data['doctors'][] = [
                    'name' => $doctor->getName(),
                    'surname' => $doctor->getSurname(),
                    'id' => $doctor->getId()
                ];
            }
        }


        $this->render('doctors', $data);
    }

    public function getVisitsByDateAndDoctor(): void
    {

        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            $visits = $this->visitRepository->getVisitsByDateAndDoctorId($decoded['date'], $decoded['doctor']);

            $json = json_encode($visits);
            echo $json;
            error_log($json);
        }
    }

    public function reserveVisit(): void
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            session_start();

            try {
                $this->visitRepository->reserveVisit($decoded['id'], $_SESSION['user_id']);
                echo json_encode([
                    'response' => "Visit successfully reserved",
                    'id' => $decoded['id']
                ]);
            } catch (Exception $e) {
                error_log($e->getMessage());
                echo json_encode(['response' => "Visit already reserved!"]);
            }

        }
    }

    public function confirm(): void
    {
        session_start();
        if (!isset($_SESSION['user_role'])){
            $this->render("error", ['message' => '401 Unauthorized']);
            return;
        }

        $role = $_SESSION['user_role'];
        if ($role !== 'patient') {
            $this->render('error', ['message' => '403 Forbidden']);
            return;
        }

        $message = $_GET['message'];

        if ($message != 'Visit successfully reserved') {
            $this->render('confirm', [
                'message' => $message
            ]);
            return;
        }

        $id = $_GET['id'];

        $visit = $this->visitRepository->getVisitById($id);

        $this->render('confirm', [
            'message' => $message,
            'doctor' => $visit->getDoctor(),
            'date' => $visit->getDate()
        ]);
    }

    public function personalData(): void
    {
        session_start();
        if (!isset($_SESSION['user_role'])){
            $this->render("error", ['message' => '401 Unauthorized']);
            return;
        }

        $role = $_SESSION['user_role'];
        if ($role !== 'patient') {
            $this->render('error', ['message' => '403 Forbidden']);
            return;
        }

        $visits = $this->visitRepository->getPatientVisits();
        $user = $this->userRepository->getUserData($_SESSION['user_id']);
        $this->render('personalData', ['visits' => $visits, 'user' => $user]);
    }

}