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

    public function doctors()
    {
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

    public function getVisitsByDateAndDoctor()
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

    public function reserveVisit()
    {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            session_start();

            $this->visitRepository->reserveVisit($decoded['id'], $_SESSION['user_id']);

        }
    }

}