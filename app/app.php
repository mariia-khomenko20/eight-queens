<?php
$board = emptyBorder();

function alert($message)
{
    echo "<script type='text/javascript'>alert('$message');</script>";
}

function emptyBorder()
{
    return array_fill(0, 8, array_fill(0, 8, 0));
}

function clearBoard()
{
    global $board;
    $board = emptyBorder();
}
?>