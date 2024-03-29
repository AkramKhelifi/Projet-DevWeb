<?php
namespace App;

class Session 
{
    function __construct()
    {
        session_start();
    }


    public function add(string $key, $data)
    {
        $_SESSION[$key]=$data;
    }

    public function get(string $key)
    {
        return $_SESSION[$key];
    }

    public function isConnected(){
        return isset($_SESSION['user']);
    }

    public function hasRole($role)
    {
        return $_SESSION['user']['role']==$role ? true : false ;
    }

    public function destroy()
    {
        unset($_SESSION);
        session_destroy();
    }
}