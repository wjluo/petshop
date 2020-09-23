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

function nf($price)
{
    return number_format($price, 2, ",", ".");
}

function generate_divs($row = array())
{
    $divs = "";

    $divs .= '<div class="row" style="background-color:white;border:1px rebeccapurple solid; margin: 0px 0px 10px 0px">
    <h4 style="color:rebeccapurple; margin: 10px 0px 10px 10px">' . $row['name']  . '</h4>
        <table class="table" id="products-table">
            <tr>
                <td>
                    <a href="' . ROOT_URI . $row['image'] . '">
                        <img src="' . ROOT_URI . $row['image'] . '" width="100" height="100" style="margin: 10px; border: 1px solid orange">
                    </a>
                </td>
                <td style="vertical-align: top;">
                    <p style="margin-top: 10px">
                        ' . $row['description'] . '
                    </p>
                </td>
            </tr>
            <tr>
            <td style="text-align:center">
                <h4 class="text-danger">' . nf($row["price"]) . ' €</h4>
            </td>
            <td style="text-align:left">
                <input type="number" name="quantity" style="width: 3em" value="1" min="1" max="' . $row['stock'] . '">
                <button type="submit" name="add_to_cart" class="btn btn-outline-warning btn-sm"><i class="fa fa-shopping-cart"></i></button>
                <input type="hidden" name="hidden_name" value="' . $row['name'] . '">
                <input type="hidden" name="hidden_price" value="' . nf($row["price"]) . '">
                </td>
            </tr>
        </table>
    </div>';

    echo $divs;
}
