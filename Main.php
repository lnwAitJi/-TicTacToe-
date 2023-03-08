<?php
/** --------------[ OvO ]-------------- */
function type($input01)
{
    $string = $input01;
    $c = strlen($string);
    for ($i = 0; $i < $c; $i++) {
        echo ($string[$i]);
        usleep(1);
    }
}
/** --------------[ OvO ]-------------- */
function readline($prompt = ""):string{
    if($prompt){
        if(is_array($prompt)){
            var_dump($prompt);
        }else {
            type($prompt."");
        }
    }
    $fp = fopen("php://stdin","r");
    $line = rtrim(fgets($fp, 1024));
    if(empty($line)){
        return '';
    }
    return $line;    
}
/** --------------[ OvO ]-------------- */
function printBoard($board) {
    echo("\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n\n");
    echo(" " . $board[0] . " : " . $board[1] . " : " . $board[2] . "\n");
    echo("-----------\n");
    echo(" " . $board[3] . " : " . $board[4] . " : " . $board[5] . "\n");
    echo("-----------\n");
    echo(" " . $board[6] . " : " . $board[7] . " : " . $board[8] . "\n");
}
/** --------------[ OvO ]-------------- */
function getPlayerMove($playerSymbol, $board) {
    while (true) {
        $move = readline("\nTURN: $playerSymbol\nEnter your move [ 1-9 ] :");
        if (!is_numeric($move) || $move < 1 || $move > 9) {
            printBoard($board);
            type("sorry, support [ 1-9 ]\n");
            continue;
        }
        $index = $move - 1; // convert to zero-indexed array index
        if ($board[$index] != " ") {
            printBoard($board);
            type("This place has been taken!\n");
            continue;
        }
        return $index;
    }
}
/** --------------[ OvO ]-------------- */
function checkForWin($board) {
    $winningCombos = array(
        array(0, 1, 2),
        array(3, 4, 5),
        array(6, 7, 8),
        array(0, 3, 6),
        array(1, 4, 7),
        array(2, 5, 8),
        array(0, 4, 8),
        array(2, 4, 6)
    );
    foreach ($winningCombos as $combo) {
        if (
            $board[$combo[0]] != " " &&
            $board[$combo[0]] == $board[$combo[1]] &&
            $board[$combo[1]] == $board[$combo[2]]
        ) {
            return $board[$combo[0]];
        }
    }
    return null;
}
/** --------------[ OvO ]-------------- */
function playGame() {
    $board = array(" ", " ", " ", " ", " ", " ", " ", " ", " ");
    $playerSymbols = array("X", "O");
    $currentPlayer = 0;
    $winner = null;
    while ($winner === null && in_array(" ", $board)) {
        printBoard($board);
        $move = getPlayerMove($playerSymbols[$currentPlayer], $board);
        $board[$move] = $playerSymbols[$currentPlayer];
        $winner = checkForWin($board);
        $currentPlayer = ($currentPlayer + 1) % 2;
    }
    printBoard($board);
    if ($winner === null) {
        type("It's a tie!\n");
    } else {
        type("$winner is wins!!\n");
    }
}
/** --------------[ Let Start! ]-------------- */
playGame();
?>