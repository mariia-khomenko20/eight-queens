<?php

session_start();

if (!empty($_SESSION["board"]))
    $board = $_SESSION["board"];
else
    $board = emptyBoard();

function saveBoard($board)
{
    $_SESSION["board"] = $board;
}

function alert($message)
{
    echo "<script type='text/javascript'>alert('$message');</script>";
}

function emptyBoard()
{
    return array_fill(0, 8, array_fill(0, 8, 0));
}

function setQueen($board, $row, $column)
{
    if ($board[$row][$column] != 0)
        alert("It is forbidden to put a queen in this cell!");
    else {
        $n = count($board);
        for ($c = 0; $c < $n; $c++) {
            // horizontal and vertical
            $board[$row][$c]++;
            $board[$c][$column]++;

            // diagonals
            $rp = $row + $c;
            $rm = $row - $c;
            $cp = $column + $c;
            $cm = $column - $c;

            if ($rp < $n && $cp < $n)
                $board[$rp][$cp]++;
            if ($rm >= 0 && $cm >= 0)
                $board[$rm][$cm]++;
            if ($rp < $n && $cm >= 0)
                $board[$rp][$cm]++;
            if ($rm >= 0 && $cp < $n)
                $board[$rm][$cp]++;
        }
        $board[$row][$column] = -1;
    }
    return $board;
}

function removeQueen($board, $row, $column)
{
    if ($board[$row][$column] === -1) {
        $n = count($board);
        for ($c = 0; $c < $n; $c++) {
            // horizontal and vertical
            $board[$row][$c]--;
            $board[$c][$column]--;

            // diagonals
            $rp = $row + $c;
            $rm = $row - $c;
            $cp = $column + $c;
            $cm = $column - $c;

            if ($rp < $n && $cp < $n)
                $board[$rp][$cp]--;
            if ($rm >= 0 && $cm >= 0)
                $board[$rm][$cm]--;
            if ($rp < $n && $cm >= 0)
                $board[$rp][$cm]--;
            if ($rm >= 0 && $cp < $n)
                $board[$rm][$cp]--;
        }
        $board[$row][$column] = 0;
    }
    return $board;
}

function replaceQueen($board, $row, $column)
{
    $board = removeQueen($board, $row, $column);
    for ($i = 0; $i < count($board[$row]); $i++) {
        if ($board[$row][$i] === 0 && $i != $column)
            return setQueen($board, $row, $i);
    }
    return null;
}

function resolvePuzzle($board)
{
    $result = array($board);
    $queensPositions = array();
    $row = 0;
    while ($row < count($board)) {
        $isSet = false;
        for ($i = 0; $i < count($board[$row]); $i++) {
            if ($board[$row][$i] === 0) {
                $board = setQueen($board, $row, $i);
                array_push($result, $board);
                array_push($queensPositions, [$row, $i]);
                $isSet = true;
                break;
            } else if ($board[$row][$i] === -1) {
                $isSet = true;
                break;
            }
        }

        if ($isSet)
            $row++;
        else {
            $lastQueen = array_pop($queensPositions);
            if ($lastQueen) {
                list($a, $b) = $lastQueen;
                $buffer = replaceQueen($board, $a, $b);
                if ($buffer) {
                    $board = $buffer;
                    array_push($result, $board);
                }
            } else {
                alert("The solution does not exist!");
                break;
            }
        }
    }
    return $result;
}

?>