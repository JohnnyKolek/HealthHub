<?php

require_once 'AppController.php';

class VisitController extends AppController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function doctors()
    {
        $this->render('doctors');
    }
}