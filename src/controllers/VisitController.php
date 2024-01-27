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

}