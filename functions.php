<?php
function get_enum($db, $table_name, $field_name)
{
    $sql = "desc {$table_name} {$field_name}";
    $result = mysqli_query($db, $sql);

    while ($row = mysqli_fetch_array($result)) {
        $category_type = $row['Type'];
    }

    $output = str_replace("enum('", "", $category_type);
    $output = str_replace("')", "", $output);
    $results = explode("','", $output);

    return $results;
}

function getUserEmail($db, $table_name, $user_id)
{

    $sql = "SELECT email FROM user WHERE user_id=$user_id";
    $result = mysqli_query($db, $sql);

    while ($row = mysqli_fetch_array($result)) {
        $email = $row['email'];
    }

    return $email;
}
