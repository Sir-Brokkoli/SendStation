<?php
namespace Sendstation;

use Sendstation\Database\Database;
use Sendstation\Authentication\SignupRequest;

ini_set ("display_errors", "1");
error_reporting(E_ALL);

require_once('Classes/Database.class.php');
include_once('Classes/SignupRequest.class.php');
include_once('DEBUG/DEBUG.php');

session_start();

/*
class SignUpData{
    public $nickname;
    public $email;
    public $password;

    public function set_nickname($nickname){ $this->nickname = $nickname; }
    public function get_nickname(){ return $this->nickname; }

    public function set_email($email){ $this->email = $email; }
    public function get_email(){ return $this->email; }

    public function set_password($password){ $this->password = $password; }
    public function get_password(){ return $this->password; }

    public function sendToDatabase(){
        $conn = ConnectionMysql::getInstance();

        $nickname_err = $email_err = "";

        //
        //Check whether nickname is already taken
        //
        $sql = "SELECT id FROM " . DT_CLIMBERS . " WHERE nickname=?";
        if($stmt = $conn->prepare($sql)){
            $stmt->bind_param("s", $param_nickname);

            $param_nickname = $this->nickname;

            if($stmt->execute()){
                $stmt->store_result();
                if($stmt->num_rows > 0){
                    $nickname_err = "Nickname already taken.";
                }
            }
            else{
                echo ERR_SQL_EXECUTE;
            }

            $stmt->close();
        }

        //
        //Check whether email is already registered
        //
        $sql = "SELECT id FROM " . DT_CLIMBERS . " WHERE email=?";
        if($stmt = $conn->prepare($sql)){
            $stmt->bind_param("s", $param_email);

            $param_nickname = $this->email;

            if($stmt->execute()){
                $stmt->store_result();
                if($stmt->num_rows > 0){
                    $nickname_err = "Email already taken.";
                }
            }
            else{
                echo ERR_SQL_EXECUTE;
            }

            $stmt->close();
        }

        if(empty($nickname_err && $email_err)){
            $sql = "INSERT INTO " . DT_CLIMBERS . " (nickname, email, password) VALUES (?, ?, ?)";
            if($stmt = $conn->prepare($sql)){
                $stmt->bind_param("sss", $param_nickname, $param_email, $param_password);

                $param_nickname = $this->nickname;
                $param_email = $this->email;
                $param_password = password_hash($this->password, PASSWORD_DEFAULT);

                if($stmt->execute()){
                    session_reset();
                            
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $stmt->insert_id;
                    $_SESSION["nickname"] = $this->nickname;

                    echo("Sign up finished!");
                    //header("location: home.php");
                }
                else{
                    echo ERR_SQL_EXECUTE;
                    echo $conn->error;
                }

                $stmt->close();
            }
        }
        else{
            //Already taken!
        }
    }
}*/

if($_SERVER["REQUEST_METHOD"] == "POST"){
    // TODO: Implement Tocken mechanism
    $sanitizedUsername = "";
    $sanitizedEmail = "";
    $sanitizedPassword = "";

    if(key_exists('username', $_POST)){

        $sanitizedUsername = filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS);
    }
    else{
        DEBUG::Log("...No Username entered</br>");
    }

    if(key_exists('email', $_POST)){

        $sanitizedEmail = filter_var($_POST['email'], FILTER_SANITIZE_STRING);

        if(filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL) == false) {
            $sanitizedEmail = "";
            DEBUG::Log("...No valid email adress</br>");
        }
        
    }
    else{
        DEBUG::Log("...No email entered</br>");
    }

    if(key_exists('password', $_POST)){
        $sanitizedPassword = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    }
    else{

    }

    if(empty($sanitizedUsername) || empty($sanitizedEmail) || empty($sanitizedPassword)){
        echo "Fail";
        // TODO: Implement response mechanism
        die();
    }
    $signupRequest = new SignupRequest($sanitizedUsername, $sanitizedEmail, $sanitizedPassword);
    $signupRequest->execute();

    header("location: home.php");
}
?>
