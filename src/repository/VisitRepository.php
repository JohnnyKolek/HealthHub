<?php /** @noinspection ALL */

require_once 'Repository.php';
require_once 'VisitRepository.php';
require_once __DIR__ . '/../models/Doctor.php';

class VisitRepository extends Repository
{
    public function getVisits(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT v.id as id, doctor, patient, name, surname, date_time, completed FROM visits as v
            LEFT JOIN public.users u on u.id = v.patient
            LEFT JOIN public.user_details ud on ud.id = u.user_details_id
             WHERE doctor=:id and date(date_time) = current_date                                                                       
            ORDER BY date_time;
        ');

        session_start();
        $stmt->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_STR);
        $stmt->execute();
        $visits = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($visits as $visit) {
            $result[] = new Visit(
                $visit['id'],
                $visit['doctor'],
                $visit['patient'] == null ? '' : $visit['name']." ".$visit['surname'],
                $visit['date_time'],
                $visit['completed'],
            );
        }

        return $result;
    }

    public function getVisitsByDate(string  $date): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare("
            SELECT v.id as id, doctor, patient, name, surname, date_time, completed FROM visits as v
            LEFT JOIN public.users u on u.id = v.patient
            LEFT JOIN public.user_details ud on ud.id = u.user_details_id
            WHERE doctor=:id and date(date_time) = :date
            ORDER BY date_time;
        ");


        error_log($date);
        session_start();
        $stmt->bindParam(':id', $_SESSION['user_id'], PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->execute();
        $visits = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($visits as $visit) {
            $result[] = new Visit(
                $visit['id'],
                $visit['doctor'],
                $visit['patient'] == null ? '' : $visit['name']." ".$visit['surname'],
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