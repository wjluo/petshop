<?php

require('../config.php');
require('../functions.php');

//-------------------------------------------------------------------------


if (isset($_POST['action']) && $_POST['action'] === "category") {

    if (!empty($_POST['category'])) {

        $category = htmlspecialchars($_POST['category'], ENT_QUOTES, 'UTF-8');
        $price_order = !empty($_POST['price_order']) ?
            htmlspecialchars($_POST['price_order'], ENT_QUOTES, 'UTF-8') : "";


        by_category($db, $category, $price_order);
    }
}


if (isset($_POST['action']) && $_POST['action'] === "price_order") {

    if (!empty($_POST["price_order"])) {

        $price_order = htmlspecialchars($_POST['price_order'], ENT_QUOTES, 'UTF-8');
        $category = !empty($_POST['category']) ?
            htmlspecialchars($_POST['category'], ENT_QUOTES, 'UTF-8') : "";

        by_price($db, $price_order, $category);
    }
}


//-------------------------------------------------------------------------

function by_price($db, $price_order, $category)
{

    if (!empty($category)) {

        $category = htmlspecialchars($category);
        $where = "WHERE `category_slang` = '$category'";
    } else $where = "";

    $sql = "SELECT * FROM `products` $where ORDER BY `price` $price_order LIMIT 0,4";
    $result = $db->query($sql);

    $output = "";

    while ($row = $result->fetch_assoc()) {

        $output .= generate_divs($row);
    }

    echo $output;
}

function by_category($db, $category, $price_order)
{

    if (empty($price_order)) {
        $sql = "SELECT * FROM `products` WHERE `category_slang` = ? LIMIT 0,4";
    } else if ($price_order === "desc") {
        $sql = "SELECT * FROM `products` WHERE `category_slang` = ? ORDER BY `price` DESC LIMIT 0,4";
    } else {
        $sql = "SELECT * FROM `products` WHERE `category_slang` = ? ORDER BY `price` ASC LIMIT 0,4";
    }


    $prepared_statement = $db->prepare($sql);
    $prepared_statement->bind_param("s", $category);
    $prepared_statement->execute();
    $result = $prepared_statement->get_result();
    $prepared_statement->close();

    $output = "";

    while ($row = $result->fetch_assoc()) {

        $output .= generate_divs($row);
    }

    echo $output;
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

    return $divs;
}
