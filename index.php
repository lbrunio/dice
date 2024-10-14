<?php
define("ONE", "&#9856");
define("TWO", "&#9857");
define("THREE", "&#9858");
define("FOUR", "&#9859");
define("FIVE", "&#9860");
define("SIX", "&#9861");

$dice_icons = [ONE, TWO, THREE, FOUR, FIVE, SIX];

$player1_numbers = [];
$player2_numbers = [];

// Fill player 1 & 2 array
for ($i = 0; $i < 6; $i++) {
    $player1_numbers[$i] = rand(1, 6);
    $player2_numbers[$i] = rand(1, 6);
}

// Player 1 & 2 array with no 1 highest number and 1 lowest number
$player1_numbers = remove_largest_and_lowest_number($player1_numbers);
$player2_numbers = remove_largest_and_lowest_number($player2_numbers);

// Assign the icons for the generated numbers
$player1_dices = icons($player1_numbers, $dice_icons);
$player2_dices = icons($player2_numbers, $dice_icons);

$winner = check_winner($player1_numbers, $player2_numbers);
    

function print_winner($win) {
    if($win === 1)
        echo "Player 1 Wins!";
    else if ($win === 2)
        echo "Player 2 Wins!";
    else
        echo "Draw!";
}


function total($array) {
    $total = 0;
    for ($i = 0; $i < count($array); $i++) 
        $total += $array[$i];
    
    return $total;
}

function remove_largest_and_lowest_number($array) {
    $largest_number = max($array);
    $lowest_number = min($array);

    $largest_index = array_search($largest_number, $array);
    if ($largest_index !== false)
        unset($array[$largest_index]);
    

    $lowest_index = array_search($lowest_number, $array);
    if ($lowest_index !== false)
        unset($array[$lowest_index]);
    

    return array_values($array);
}


function check_winner($array1, $array2) {
    $player1 = total($array1);
    $player2 = total($array2);

    if ($player1 > $player2) {
        return 1; // for player 1 win
    } elseif ($player1 < $player2) {
        return 2; // for player 2 win
    } else {
        return 3; // for draw
    }
}


// Replace the numbers for the icons
function icons($array, $dice_icons) {
    for ($i = 0; $i < 6; $i++) 
        $array[$i] = $dice_icons[$array[$i] - 1];
    
    return $array;
}

function print_array($array) {
    foreach($array as $values)
        echo $values;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Dices </title>

    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <p> Refresh to play again!</p>

    <h2> Player 1: total - <?= total($player1_numbers); ?> </h2>
    
    <div class="player_1">
        <h1>
        <?= print_array($player1_dices); ?>
        </h1>
    </div>

    <h2> Player 2: total - <?= total($player2_numbers); ?> </h2>

    <div class="player_2">
        <h1>
        <?= print_array($player2_dices); ?>
        </h1>
    </div>

    <h1>
    <?= print_winner($winner); ?>
    </h1>
</body>
</html>

