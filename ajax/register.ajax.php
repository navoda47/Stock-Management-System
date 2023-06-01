<?php 


/*
    database connection
*/
require_once("../database/dbase.php");



/*
    create the passcode 
*/
function generate_passcode() : string
{
    global $conn;
    global $usecid;

    switch($usecid)
    {
        case "1":
            $lPart = "A";
            break;
        case "2":
            $lPart = "B";
            break;
        case "3":
            $lPart = "C";
            break;
        case "4":
            $lPart = "D";
            break;
    }

    /*
        only if upcode is not used before once
        then return the new upcode
    */
    while (true)
    {
        $rPart = rand(1000, 9999);
        $upcode = $lPart . $rPart;
        if ($conn->query("select * from user where upcode='$upcode'")->rowCount() == 0) return $upcode;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username = isset($_POST["username"]) ? trim(htmlspecialchars($_POST["username"])) : "";
    $designation = isset($_POST["designation"]) ? trim(htmlspecialchars($_POST["designation"])) : "";
    $usecid = isset($_POST["usecid"]) ? trim(htmlspecialchars($_POST["usecid"])) : "";
    $teleno = isset($_POST["teleno"]) ? trim(htmlspecialchars($_POST["teleno"])) : "";


    /*
        if username or password is empty
        then echo a error message
    */
    if (empty($username)) 
    {
        echo json_encode(["status" => "error", "msg" => "username is empty"]);
        exit();
    }
    else 
    {
        if (strlen($username) < 5)
        {
            echo json_encode(["status" => "error", "msg" => "username is too short"]);
            exit();
        }
    }

    if (empty($designation)) 
    {
        echo json_encode(["status" => "error", "msg" => "user designation is not set"]);
        exit();
    }

    if (empty($usecid)) 
    {
        echo json_encode(["status" => "error", "msg" => "user section is not set"]);
        exit();
    }
    if (empty($teleno)) 
    {
        echo json_encode(["status" => "error", "msg" => "Telephone number is not set"]);
        exit();
    }


    /*
        check whether the username is already exists
    */
    if ($conn->query("select * from user where uname='$username'")->rowCount() == 0)
    {

        try 
        {
            $passcode = generate_passcode(); // generate the passcode
            $sql = "insert into user(usec_id, udesi, uname, upcode, uactive,telno) values ('$usecid', '$designation', '$username', '$passcode', '1','$teleno')";
            $conn->query($sql);

            echo json_encode(["status" => "success", "msg" => "username : $username, passcode : $passcode "]);
            exit();
        }
        catch(PDOException $err)
        {
            echo json_encode(["status" => "error", "msg" => $err->getMessage()]);
            exit();
        }

    }
    else 
    {
        echo json_encode(["status" => "error", "msg" => "username is already exists, try with another one"]);
        exit();
    }
}