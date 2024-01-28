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
                $visit['patient'] == null ? '' : $visit['name'] . " " . $visit['surname'],
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

    public function getVisitsByDateAndDoctorId(string  $date, int $id): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare("
            SELECT v.id as id, doctor, patient, date_time, completed FROM visits as v
            WHERE doctor=:id AND date(date_time) = :date AND patient IS NULL 
            ORDER BY date_time;
        ");


        error_log($date);
        session_start();
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->execute();
        $visits = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($visits as $visit) {
            $result[] = new Visit(
                $visit['id'],
                $visit['doctor'],
                $visit['patient'] == null ? '' : $visit['patient'],
                $visit['date_time'],
                $visit['completed'],
            );
        }

        return $result;
    }

    public function addVisit($visit): void
    {

        $connection = $this->database->connect();
        $connection->beginTransaction();

        try {

            $stmt = $this->database->connect()->prepare('
                SELECT COUNT(*) FROM visits WHERE doctor=:doctor AND date_time=:date
            ');

            $stmt->execute([
                $visit->getDoctor(),
                $visit->getDate()
            ]);

            $exists = $stmt->fetchColumn() > 0;

            if ($exists) {
                throw new Exception('Visits already exists!');
            }

            $stmt = $this->database->connect()->prepare('
             INSERT INTO visits(doctor, date_time, completed)
             VALUES(?, ?, ?)
        ');

            $stmt->execute([
                $visit->getDoctor(),
                $visit->getDate(),
                'false'
            ]);

            $connection->commit();
        } catch (Exception $e) {
            $connection->rollBack();
            throw $e;
        }
    }


    public function reserveVisit($id, $patient)
    {

        $connection = $this->database->connect();
        $connection->beginTransaction();

        try {
            error_log("started");

            $stmt = $connection->prepare('
             SELECT COUNT(*) FROM visits
             WHERE id=:id AND patient=:patient;
        ');

            $stmt->execute([$id, $patient]);

            $exists = $stmt->fetchColumn() > 0;

            if ($exists) {
                throw new Exception('Visit already reserved!');
            }

            $stmt = $connection->prepare('
             UPDATE visits
             SET patient=:patientId
             WHERE id=:id;
        ');

            $stmt->execute([
                $patient,
                $id
            ]);
            $connection->commit();
        } catch (Exception $e) {
            $connection->rollBack();
            throw $e;
        }

    }


    public function getVisitById(int $id)
    {

        $stmt = $this->database->connect()->prepare("
            SELECT v.id as id, doctor, patient, name, surname, date_time, completed FROM visits as v
            LEFT JOIN public.users u on u.id = v.doctor
            LEFT JOIN public.user_details ud on ud.id = u.user_details_id
            WHERE v.id=:id 
        ");

        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $visit = $stmt->fetch(PDO::FETCH_ASSOC);

        $result = new Visit(
            $visit['id'],
            $visit['doctor'] == null ? '' : $visit['name'] . " " . $visit['surname'],
            $visit['patient'],
            $visit['date_time'],
            $visit['completed']);

        return $result;
    }


    public function getPatientVisits(): array
    {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT v.id as id, doctor, patient, name, surname, date_time, completed FROM visits as v
            LEFT JOIN public.users u on u.id = v.doctor
            LEFT JOIN public.user_details ud on ud.id = u.user_details_id
            WHERE patient=:id                                                                      
            ORDER BY date_time;
        ');

    }


}