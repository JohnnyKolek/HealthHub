<?php

class Visit
{
    private $id;
    private $doctor;
    private $patient;
    private $date;
    private bool $completed;

    /**
     * @param $id
     * @param $doctor
     * @param $patient
     * @param $date
     * @param bool $completed
     */
    public function __construct($id, $doctor, $patient, $date, bool $completed)
    {
        $this->id = $id;
        $this->doctor = $doctor;
        $this->patient = $patient;
        $this->date = $date;
        $this->completed = $completed;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDoctor()
    {
        return $this->doctor;
    }

    /**
     * @return mixed
     */
    public function getPatient()
    {
        return $this->patient;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }




}