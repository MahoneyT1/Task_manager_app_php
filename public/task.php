<?php
require "../config/database";
// Task class for easier managment

class Task {
    private $name;
    private $id;
    private $completed;

    public function __construct($id, $name, $completed=false )
    {
        $this->name = $name;
        $this->completed = $completed;
    }

    public function createTask($name, $completed) {

}