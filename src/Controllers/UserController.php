<?php

namespace App\Controllers;

class UserController
{
    public function index()
    {
        return ['users' => ['User1', 'User2', 'User3']];
    }

    public function show($id)
    {
        // Code to show a single user
    }

    public function create()
    {
        // Code to create a new user
    }

    public function update($id)
    {
        // Code to update an existing user
    }

    public function delete($id)
    {
        // Code to delete a user
    }
}
