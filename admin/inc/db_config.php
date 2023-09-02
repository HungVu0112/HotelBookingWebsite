<?php 
    $hname = 'localhost';
    $uname = 'root';
    $pass = '';
    $db = 'hbwebsite';

    $con = new mysqli($hname, $uname, $pass, $db);

    if (!$con) {
        die("Couldn't connect to database".mysqli_connect_error());
    }

    function filteration($data) {
        foreach($data as $key => $value) {
            $data[$key] = trim($value);
            $data[$key] = stripcslashes($value);
            $data[$key] = htmlspecialchars($value);
            $data[$key] = strip_tags($value);
        } 
        return $data;
    }

    function select($sql, $values, $datatypes) {
        $con = $GLOBALS['con'];

        if($smt = mysqli_prepare($con, $sql)) {
            mysqli_stmt_bind_param($smt, $datatypes, ...$values);
            if(mysqli_stmt_execute($smt)) {
                $result = mysqli_stmt_get_result($smt);
                mysqli_stmt_close($smt);
                return $result;
            } else {
                mysqli_stmt_close($smt);
                die("Query failed");
            }
        } else {
            die("Query failed");
        }
    }
?>