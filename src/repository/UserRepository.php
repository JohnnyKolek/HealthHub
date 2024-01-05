<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Doctor.php';

class UserRepository extends Repository
{

    public function getUser(string $email): ?User
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM users u LEFT JOIN user_details ud 
            ON u.user_details_id = ud.id WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return null;
        }

        return new User(
            $user['email'],
            $user['password'],
            $user['name'],
            $user['surname'],
            $user['phone']
        );
    }


    public function addUser(User $user)
    {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO user_details (name, surname, phone)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $user->getName(),
            $user->getSurname(),
            $user->getPhone()
        ]);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (email, password, user_details_id)
            VALUES (?, ?, ?)
        ');

        $stmt->execute([
            $user->getEmail(),
            $user->getPassword(),
            $this->getUserDetailsId($user)
        ]);
    }

    public function getUserDetailsId(User $user): int
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM public.user_details WHERE name = :name AND surname = :surname AND phone = :phone
        ');
        $name = $user->getName();
        $surname = $user->getSurname();
        $phone = $user->getPhone();
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data['id'];
    }

    /**
     * Retrieves all users with the 'doctor' role.
     *
     * @return User[]|null Array of User objects if found, null otherwise.
     */
    public function getDoctors(){
        $role = 'doctor';
        $stmt = $this->database->connect()->prepare('
            SELECT u.id as id, ud.name as name, ud.surname as surname FROM users u
            JOIN user_details ud ON u.user_details_id = ud.id 
            JOIN public.user_roles ur on u.id = ur.user_id
            JOIN public.roles r on r.id = ur.role_id
            WHERE r.name = :role
        ');
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        $stmt->execute();

        $docs = $stmt->fetchAll(PDO::FETCH_ASSOC);


        if (!$docs) {
            return null;
        }

        $doctors = [];
        foreach ($docs as $doc) {
            $doctors[] = new Doctor(
                $doc['id'],
                $doc['name'],
                $doc['surname'],
            );
        }

        return $doctors;
    }
}