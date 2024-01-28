<?php

require_once "AppController.php";

class ErrorController extends AppController {
    public function fileNotFound(): void
    {
        $this->render("error");
    }
}