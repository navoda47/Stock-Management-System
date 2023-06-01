<?php


require_once("../database/dbase.php");


if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username = (isset($_POST["username"])) ? trim(htmlspecialchars($_POST["username"])) : "";
    $password = (isset($_POST["password"])) ? trim(htmlspecialchars($_POST["password"])) : "";

    if (empty($username)) 
    {
        echo json_encode(["status" => "error", "msg" => "username can't be empty"]);
        exit();
    }
    else 
    {
        if ($conn->query("select * from user where uname='$username' and uactive = '2'")->rowCount() == 0)
        {
            echo json_encode(["status" => "error", "msg" => "username doesn't exists"]);
            exit();
        }
    }

    if (empty($password)) 
    {
        echo json_encode(["status" => "error", "msg" => "password can't be empty"]);
        exit();
    }

    /*
        check whether username and password combination is correct
    */
    $sql = "select * from user where uname='$username' and upcode='$password' and uactive='2';";
    if ($conn->query($sql)->rowCount() > 0)
    {
        $uid = $conn->query($sql)->fetch()["uid"];
        session_start();
        $_SESSION["uid"] = $uid; // set the uid to the cookie

        /*
            get the default page of the user
        */
        $sql = "
            select r.pgfile from user as u 
            inner join u_desi_name as ud on ud.u_desi_index=u.udesi
            inner join route as r on r.pgid =ud.u_desi_page
            where u.uid='$uid';
        ";
        $default_page = $conn->query($sql)->fetch()[0];

        echo json_encode(["status" => "success", "msg" => "successfully logged", "link" => "$default_page"]);
        exit();
    }
    else 
    {
        echo json_encode(["status" => "error", "msg" => "username and password combination is invalid"]);
        exit();
    }
}