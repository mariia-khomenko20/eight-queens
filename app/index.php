<?php
include "app.php";

if (isset($_POST['set_queen'])) {
    $row = $_POST["row"];
    $column = $_POST["column"];
    $board = setQueen($board, $row, $column);
    saveBoard($board);
}

if (isset($_POST['remove_queen'])) {
    $row = $_POST["row"];
    $column = $_POST["column"];
    $board = removeQueen($board, $row, $column);
    saveBoard($board);
}

if (isset($_POST['clear_board'])) {
    $board = emptyBoard();
    saveBoard($board);
}

if (isset($_POST['resolve_puzzle'])) {
    header('Location: result.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.2/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Eight Queens Puzzle</title>
</head>

<body>
    <div class="flex w-screen h-screen justify-center py-7">
        <div class="flex flex-col space-y-10">
            <div class="flex justify-center text-2xl font-bold">
                Eight Queens Puzzle
            </div>
            <form method="post" class="flex flex-col space-y-5">
                <div class="flex flex-row items-end justify-between">
                    <label class="flex flex-col">
                        Row
                        <input name="row" type="number" value="0" min="0" max="7"
                            class="rounded-sm mt-1 py-1 pl-3 outline outline-1 focus:outline-2">
                    </label>

                    <label class="flex flex-col">
                        Column
                        <input name="column" type="number" value="0" min="0" max="7"
                            class="rounded-sm mt-1 py-1 pl-3 outline outline-1 focus:outline-2">
                    </label>
                    <button name="set_queen"
                        class="rounded-sm h-12 px-8 font-bold text-white bg-blue-800 hover:bg-blue-700 focus:outline-none">
                        Set Queen
                    </button>
                    <button name="remove_queen"
                        class="rounded-sm h-12 px-8 font-bold text-white bg-red-800 hover:bg-red-700 focus:outline-none">
                        Remove Queen
                    </button>
                </div>
                <div class="flex flex-row justify-between">
                    <button name="resolve_puzzle"
                        class="rounded-sm w-64 h-12 px-8 font-bold text-white bg-green-800 hover:bg-green-700 focus:outline-none">
                        Resolve Puzzle
                    </button>
                    <button name="clear_board"
                        class="rounded-sm w-64 h-12 px-8 font-bold text-white bg-red-800 hover:bg-red-700 focus:outline-none">
                        Clear Board
                    </button>

                </div>
            </form>
            <div class="flex flex-row">
                <table id="board">
                    <thead>
                        <tr>
                            <th></th>
                            <?php
                            for ($i = 0; $i < count($board); $i++) {
                                echo "<th>$i</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < count($board); $i++) {
                            echo "<tr>";
                            echo "<th class='pr-1'>$i</th>";
                            $a = $i % 2;
                            for ($j = 0; $j < count($board[$i]); $j++) {
                                $b = $j % 2;
                                if ($a != $b)
                                    $color = "bg-gray-800 text-slate-200";
                                else
                                    $color = "bg-slate-200 text-gray-800";
                                echo "<td><div class='flex items-center justify-center w-16 h-16 p-1 fill-current $color'>";
                                if ($board[$i][$j] === -1)
                                    echo file_get_contents("./assets/queen.svg");
                                echo "</div></td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>