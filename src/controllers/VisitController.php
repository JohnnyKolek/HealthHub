<?php

require_once 'AppController.php';

class VisitController extends AppController
{

    private UserRepository $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function doctors()
    {
        $currentDate = new DateTime();

        $data = [
            'days' => []
        ];

        $data['days'][] = [
            'dayOfWeek' => $currentDate->format('l'),
            'dayOfMonth' => $currentDate->format('j')
        ];

        for ($i = 1; $i <= 6; $i++) {
            $currentDate->add(new DateInterval('P1D'));
            $data['days'][] = [
                'dayOfWeek' => $currentDate->format('l'),
                'dayOfMonth' => $currentDate->format('j')
            ];
        }

        $doctors = $this->userRepository->getDoctors();

        foreach ($doctors as  $doctor) {
            $data['doctors'][] =[
                'name' => $doctor->getName(),
                'surname' => $doctor->getSurname(),
                'id' => $doctor->getId()
            ];
        }



        $this->render('doctors', $data);
    }

    public function reserveVisit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;

            if ($this->isValidReservation($data)) {
                $reservationCreated = $this->storeReservation($data);

                if ($reservationCreated) {
                    $this->render('reservation_success');
                } else {
                    $this->render('reservation_error');
                }
            } else {
                $this->render('reservation_form', [
                    'error' => 'Invalid reservation data.',
                    'formData' => $data
                ]);
            }
        } else {
            $this->render('reservation_form', [
                'error' => 'Please submit the form with valid data.'
            ]);
        }
    }

    private function isValidReservation($data)
    {
        return true;
    }

    private function storeReservation($data)
    {
        return true;
    }



    public function confirm(){
        $this->render('confirm');
    }
}