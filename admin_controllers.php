<?php
include 'database.php';
class AdminControllers extends Connection {
    
    public function __construct() {
        parent::__construct();
    }

    // public function register($message) {
    //     $json = 
    // }

    public function create_role($message) {
        $json = file_get_contents("php://input");

        $idata = json_decode($json, true);

        $existsql = "SELECT * FROM roles_table";
        $existresult = $this->connection->query($existsql);
        $existdata = $existresult->fetch_all();

        for ($i = 0; $i < count($existdata); $i++) {
            if($idata["role"] == $existdata[$i][1]) {
                $message->success = "false";
                $message->message = "role already exist!";
                echo json_encode($message, JSON_PRETTY_PRINT);
                exit;
            }
        }

        $sql = "INSERT INTO roles_table(role, description) VALUES('{$idata['role']}', '{$idata['description']}');";
        
        if ($sql) {
            $result = $this->connection->query($sql);
            if ($result) {
                $message->success = "true";
                $message->message = "role has been added!";
                echo json_encode($message, JSON_PRETTY_PRINT);
            } else {
                $message->success = "false";
                $message->message = "Error BRUV!";
                echo json_encode($message, JSON_PRETTY_PRINT);
            }
        } else {
            $message->success = "false";
            $message->message = "Error BRUV!";
            echo json_encode($message, JSON_PRETTY_PRINT);
        }
    }

    public function delete_role($message) {
        $params = $_GET['roleid'];

        $sql = "DELETE * FROM roles_table WHERE roleid = ".$params.";";
        $result = $this->connection->query($sql);

        if ($result) {
            $message->success = "true";
            $message->message = "role deleted successfully!";
            echo json_encode($message, JSON_PRETTY_PRINT);
        } else {
            $message->success = "false";
            $message->message = "Error BRUV!";
            echo json_encode($message, JSON_PRETTY_PRINT);
        }
    }

    public function create_users($message) {
        $json = file_get_contents("php://input");

        $idata = json_decode($json, true);

        $existsql = "SELECT * FROM users_table";
        $existresult = $this->connection->query($existsql);
        $existdata = $existresult->fetch_all();

        for ($i = 0; $i < count($existdata); $i++) {
            if($idata["username"] == $existdata[$i][1]) {
                $message->success = "false";
                $message->message = "user already exist!";
                echo json_encode($message, JSON_PRETTY_PRINT);
                exit;
            }
        }

        $sql = "INSERT INTO users_table(username, password, roleid) VALUES('{$idata['username']}', '{$idata['password']}', '{$idata['roleid']}');";
        
        if ($sql) {
            $result = $this->connection->query($sql);
            if ($result) {
                $message->success = "true";
                $message->message = "user has been added!";
                echo json_encode($message, JSON_PRETTY_PRINT);
            } else {
                $message->success = "false";
                $message->message = "Error BRUV!";
                echo json_encode($message, JSON_PRETTY_PRINT);
            }
        } else {
            $message->success = "false";
            $message->message = "Error BRUV!";
            echo json_encode($message, JSON_PRETTY_PRINT);
        }
    }

    public function get_users($message) {
        $sql = "SELECT * FROM users_table";
        $result = $this->connection->query($sql);
        $data = $result->fetch_all();
        $a = array();
        $n = 0;

        foreach ($data as $row => $value) {
            $num = count($value);
            $user = new stdClass();
            for($i=0;$i<=$num;$i++) {
                if ($i == 0) {
                    $user->userid = $value[$i];
                } else if ($i == 1) {
                    $user->username = $value[$i];
                } else if ($i == 2) {
                    $user->password = $value[$i];
                } else if ($i == 3) {
                    $user->roleid = $value[$i];
                } else if ($i == 4) {
                    $user->status = $value[$i];
                } else if ($i == 5) {
                    $user->is_logged_in = $value[$i];
                }
            }
            $a[$n] = $user;
            $n++;
        }
        $message->success = "true";
        $message->message = "transaction get successfully!";
        $message->users = $a;
        echo json_encode($message, JSON_PRETTY_PRINT);
    }

    public function get_user($message) {
        $params = $_GET;
        foreach ($params as $key => $value) {
            $sql = "SELECT * FROM users_table WHERE ".$key." = ".$value.";";
            $result = $this->connection->query($sql);
            $data = $result->fetch_all();
            $a = array();
            $n = 0;

            foreach ($data as $row => $value) {
                $num = count($value);
                $user = new stdClass();
                for($i=0;$i<=$num;$i++) {
                    if ($i == 0) {
                        $user->userid = $value[$i];
                    } else if ($i == 1) {
                        $user->username = $value[$i];
                    } else if ($i == 2) {
                        $user->password = $value[$i];
                    } else if ($i == 3) {
                        $user->roleid = $value[$i];
                    } else if ($i == 4) {
                        $user->status = $value[$i];
                    } else if ($i == 5) {
                        $user->is_logged_in = $value[$i];
                    }
                }
                $a[$n] = $user;
                $n++;
            }
            $message->success = "true";
            $message->message = "transaction get successfully!";
            $message->users = $a;
            echo json_encode($message, JSON_PRETTY_PRINT);
        }
    }
}
?>