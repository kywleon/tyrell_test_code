<?php

// Check if the number of people is provided
if (!isset($_GET['numberOfPeople'])) {
    die("Input value does not exist or value is invalid");
}

$numberOfPeople = intval($_GET['numberOfPeople']);

// Validate the input value
if ($numberOfPeople <= 0) {
    die("Input value does not exist or value is invalid");
}

$cards = [];

// Create an array of all the cards
$suits = ['S', 'H', 'D', 'C'];
$faces = ['A', 2, 3, 4, 5, 6, 7, 8, 9, 'X', 'J', 'Q', 'K'];

foreach ($suits as $suit) {
    foreach ($faces as $face) {
        $cards[] = $suit . '-' . $face;
    }
}

// Shuffle the cards randomly
shuffle($cards);

// Distribute the cards to the people
$cardIndex = 0;
$distribution = [];

for ($i = 0; $i < $numberOfPeople; $i++) {
    $row = [];
    
    for ($j = $i; $j < count($cards); $j += $numberOfPeople) {
        $row[] = $cards[$j];
    }
    
    $distribution[] = implode(',', $row);
}

// Encode the distribution as JSON and send the response
header('Content-Type: application/json');
echo json_encode($distribution);