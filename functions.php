<?php

function get_enums($db, $table_name, $field_name)
{
    $sql = "desc {$table_name} {$field_name}";
    $result = $db->query($sql);

    while ($row = $result->fetch_assoc()) {
        $category_type = $row['Type'];
    }

    $output = str_replace("enum('", "", $category_type);
    $output = str_replace("')", "", $output);
    $results = explode("','", $output);

    return $results;
}

function getUserEmail($db, $table_name, $user_id)
{
    $sql = "SELECT `email` FROM `users` WHERE user_id=$user_id";
    $result = $db->query($sql);

    while ($row = $result->fetch_assoc()) {
        $email = $row['email'];
    }

    return $email;
}
