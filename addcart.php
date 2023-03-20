<?php
include_once(__DIR__ . "./classes/Db.php");
$userid = $_GET["userid"];
$productnummer = $_GET["productid"];
$amount = $_GET["amount"];
$conn = Db::getConnection();
// insert query
$selectstatement = $conn->prepare("select * from cart where userid = '{$userid}' AND productnummer = '{$productnummer}';");
// check of er al 1 in zit
$selectstatement->execute();
$results = false;
while ($row = $selectstatement->fetch()) {
    $amount = $row['amount'] + $amount;
    $statement = $conn->prepare("UPDATE cart SET amount = {$amount} WHERE cart_id = '{$row["cart_id"]}'");
    $result = $statement->execute();
    $results = true;
    // break is important
    break;
}
if ($results == false) {
    $statement = $conn->prepare("insert into cart (userid, productnummer, amount) values (:userid, :productnummer, :amount)");
    $statement->bindValue(":userid", $userid);
    $statement->bindValue(":productnummer", $productnummer);
    $statement->bindValue(":amount", $amount);
    $result = $statement->execute();
}
if ($result) {
    http_response_code(200);
    exit;
} else {
    http_response_code(400);
    exit;
}
?>