<?php

require_once 'Repository.php';
require_once 'VisitRepository.php';
require_once __DIR__ . '/../models/Doctor.php';

class VisitRepository extends Repository
{
    public function getVisits(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM visits WHERE doctor=:id;
        ');

        session_start();
        $stmt->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_STR);
        $stmt->execute();
        $visits = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($visits as $visit) {
            $result[] = new Visit(
                $visit['id'],
                $visit['doctor'],
                $visit['patient'],
                $visit['date_time'],
                $visit['completed'],
            );
        }

        return $result;
    }


    public function addVisit($visit): void
    {
        $stmt = $this->database->connect()->prepare('
             INSERT INTO visits(doctor, date_time, completed)
             VALUES(?, ?, ?)
        ');

        $stmt->execute([
            $visit->getDoctor(),
            $visit->getDate(),
            'false'
        ]);
    }
}