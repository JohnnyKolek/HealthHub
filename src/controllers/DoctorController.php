<?php
require_once 'AppController.php';
require_once __DIR__ . '/../models/Visit.php';
require_once __DIR__ . '/../repository/VisitRepository.php';

class DoctorController extends AppController
{
    private VisitRepository $visitRepository;

    public function __construct()
    {
        parent::__construct();
        $this->visitRepository = new VisitRepository();
    }

    public function addVisit(): void
    {
        session_start();
        if (!isset($_SESSION['user_role'])){
            $this->render("error", ['message' => '401 Unauthorized']);
            return;
        }

        $role = $_SESSION['user_role'];
        if ($role !== 'doctor') {
            $this->render('error', ['message' => '403 Forbidden']);
            return;
        }


            if (!$this->isPost()) {
                $this->render('addVisit');
                return;
            }

            $date = $_POST['date'];
            $hour = ($_POST['hour']);


            $dateTime = $date . ' ' . $hour;

            $format = 'Y-m-d H:i';

            $dt = DateTime::createFromFormat($format, $dateTime);
            if ($dt === false) {
                $this->render('addVisit', ['messages' => ['Incorrect Date or Time']]);
            } else {
                try {
                    $this->visitRepository->addVisit(new Visit(null, $_SESSION['user_id'], null, $dateTime, false));
                } catch (Exception $e){
                    $this->render('addVisit', ['messages' => [$e->getMessage()]]);
                }
                $this->render('addVisit', ['messages' => ['Visit was successfully added']]);
            }


    }


    public function doctorMenu(): void
    {
        session_start();
        if (!isset($_SESSION['user_role'])){
            $this->render("error", ['message' => '401 Unauthorized']);
            return;
        }

        $role = $_SESSION['user_role'];
        if ($role !== 'doctor') {
            $this->render('error', ['message' => '403 Forbidden']);
            return;
        }
        $this->render('doctorMenu');
    }


    public function getVisitsByDate(): void
    {
        session_start();
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === "application/json"){
            $content  = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-type: application/json');
            http_response_code(200);

            $visits = $this->visitRepository->getVisitsByDate($decoded['date']);
            $json = json_encode($visits);
            echo $json;
        }

    }

    public function doctorVisits(): void
    {
        session_start();
        if (!isset($_SESSION['user_role'])){
            $this->render("error", ['message' => '401 Unauthorized']);
            return;
        }

        $role = $_SESSION['user_role'];
        if ($role !== 'doctor') {
            $this->render('error', ['message' => '403 Forbidden']);
            return;
        }

        $visits = $this->visitRepository->getVisits();

        foreach ($visits as $visit) {
            $visit->getDate();
        }

        $this->render("doctorVisits", ['visits' => $visits]);
    }
}