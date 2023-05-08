<?php

session_start();

if (!empty($_SESSION["board"]))
    $board = $_SESSION["board"];
else
    $board = emptyBorder();

if (!empty($_SESSION["queensCount"]))
    $queensCount = $_SESSION["queensCount"];
else
    $queensCount = 8;

function saveValues()
{
    global $board, $queensCount;
    $_SESSION["board"] = $board;
    $_SESSION["queensCount"] = $queensCount;
}

function alert($message)
{
    echo "<script type='text/javascript'>alert('$message');</script>";
}

function emptyBorder()
{
    return array_fill(0, 8, array_fill(0, 8, 0));
}

function validateCellIndexes($row, $column)
{
    global $board;
    if (isset($row) && isset($column)) {
        if (is_numeric($row) && is_numeric($column) && $row < count($board) && $column < count($board)) {
            return true;
        } else
            alert("Enter the correct values!");
    } else
        alert("Enter all values!");
    return false;
}

function clearBoard()
{
    global $board, $queensCount;
    $board = emptyBorder();
    $queensCount = 8;
    saveValues();
}

function setQueen($row, $column)
{
    global $board, $queensCount;
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
        $queensCount--;
        saveValues();
    }
}

function removeQueen($row, $column)
{
    global $board, $queensCount;
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
        $queensCount++;
        saveValues();
    }
}
?>