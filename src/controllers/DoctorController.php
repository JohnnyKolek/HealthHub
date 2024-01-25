<?php
require_once 'AppController.php';
require_once __DIR__ . '/../models/Visit.php';
require_once __DIR__ . '/../repository/VisitRepository.php';

class DoctorController extends AppController
{
    private UserRepository $userRepository;
    private VisitRepository $visitRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->visitRepository = new VisitRepository();
    }

    public function addVisit(): void
    {
        if (!$this->isPost()) {
            $this->render('addVisit');
            return;
        }

        $date = $_POST['date'];
        $hour = ($_POST['hour']);

        session_start();

        $dateTime = $date . ' ' . $hour;
        $this->visitRepository->addVisit(new Visit(null, $_SESSION['user_id'], null, $dateTime, false));
        $this->render('addVisit', ['messages' => ['Visit was successfully added']]);

    }


    public function doctorVisits()
    {
        $visits = $this->visitRepository->getVisits();

        foreach ($visits as $visit) {
            $visit->getDate();
        }


        $this->render("doctorVisits", ['visits' => $visits]);
    }

//    public function doctorVisits(){
//        header('Content-type: application/json');
//        http_response_code(200);
//        echo json_encode($this->visitRepository->getVisits());
//    }
}