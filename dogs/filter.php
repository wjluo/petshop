<?php

require('../config.php');
require('../functions.php');

if (isset($_POST['filter']) && $_POST['filter'] === "category") {

    if (isset($_POST['category']) && !empty($_POST['category'])) {
        by_category($db, $_POST['category']);
    }
}

if (isset($_POST['filter']) && $_POST['filter'] === "price") {

    if (isset($_POST['order']) && !empty($_POST['order'])) {


        by_price($db, $_POST['order'],$_POST['order']);
    }
}

function by_price($db, $order, $category = null)
{
    $where = "";

    if (!empty($category)) {
        $category = htmlspecialchars($category);
        $where = "WHERE `category` = '$category'";
    }

    $sql = "SELECT * FROM `products` $where ORDER BY `price` $order";
    $result = $db->query($sql);

    $output = "";

    while ($row = $result->fetch_assoc()) {

        $output .= generate_divs($row);
    }

    echo $output;
}

function by_category($db, $category)
{
    $category = htmlspecialchars($category);
    $sql = "SELECT * FROM `products` WHERE `category` = ? ORDER BY `price` ASC";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $category);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    $output = "";

    while ($row = $result->fetch_assoc()) {

        $output .= generate_divs($row);
    }

    echo $output;
}

function generate_divs($row = array())
{
    $divs = "";

    $divs .= '<div class="row" style="border:1px rebeccapurple solid; margin: 0px 0px 10px 0px">
    <h4 style="color:purple ;margin: 10px 0px 10px 10px">' . $row['name']  . '</h4>
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
