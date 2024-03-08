<?php
include_once 'admin_controllers.php';
class Views {
    public function __construct() {
        $req = new AdminControllers();
        $message = new stdClass();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $req->create_users($message);
        }

        // if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SERVER['REQUEST_URI'] == "/users") {
        //     $req->create_users($message);
        // }

        if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
            $req->delete_role($message);
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET" ) {
            if (count($_GET) === 0) {
                $req->get_users($message);
            } else {
                $req->get_user($message);
            }
        }
    }
}
?>