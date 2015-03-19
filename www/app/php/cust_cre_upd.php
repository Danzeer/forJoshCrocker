<?php

//print_r($_POST); you can print_r it for understanding
//use $_POST as usual, example $_POST["cust_ID"] means your $scope.cust.cust_ID value
    $values = $_POST;
    $conn = new PDO('mysql:host=localhost;dbname=displaytrends;charset=utf8', 'displaytrends', 'displaytrends');
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    //Strip array to fields with values
    $values=array_filter($values);
    //Take array keys from array
    $field_keys=array_keys($values);
    //Implode for insert fields
    $ins_fields=implode(",", $field_keys);
    //Implode for insert value fields (values will binded later)
    $value_fields=":" . implode(", :", $field_keys);
    //Create update fields for each array create value = 'value = :value'.
    $update_fields=array_keys($values);
    foreach($update_fields as &$val){
        $val=$val." = :".$val;
    }
    $update_fields=implode(", ", $update_fields);
    //SQL Query
    $insert = "INSERT INTO $table ($ins_fields) VALUES ($value_fields) ON DUPLICATE KEY UPDATE $update_fields";
    $query = $conn->prepare($insert);
    //Bind each value based on value coming in.
    foreach ($values as $key => &$value) {
        switch(gettype($value)) {
            case 'integer':
            case 'double':
                $query->bindParam(':' . $key, $value, PDO::PARAM_INT);
                break;
            default:
                $query->bindParam(':' . $key, $value, PDO::PARAM_STR);
        }
    }
    $query->execute();

