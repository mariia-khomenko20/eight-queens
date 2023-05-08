<?php
include "app.php";

if (isset($_POST['set_queen'])) {
    $row = $_POST["row"];
    $column = $_POST["column"];
    if (validateCellIndexes($row, $column))
        setQueen($row, $column);
}

if (isset($_POST['remove_queen'])) {
    $row = $_POST["row"];
    $column = $_POST["column"];
    if (validateCellIndexes($row, $column))
        removeQueen($row, $column);
}

if (isset($_POST['clear_board'])) {
    clearBoard();
}

if (isset($_POST['start'])) {

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
    <div class="flex w-screen h-screen justify-center py-10">
        <div class="flex flex-col space-y-10">
            <form method="post">
                <div class="flex flex-col space-y-5">
                    <div class="flex flex-row space-x-3 items-end">
                        <div class="flex flex-col space-y-1">
                            <label class="text-sm">Row</label>
                            <input name="row" maxlength="1"
                                class="w-24 rounded-sm py-1 px-3 outline outline-1 focus:outline-2">
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label class="text-sm">Column</label>
                            <input name="column" maxlength="1"
                                class="w-24 rounded-sm py-1 px-3 outline outline-1 focus:outline-2">
                        </div>
                        <button name="set_queen"
                            class="rounded-sm h-12 px-10 text-white bg-blue-800 hover:bg-blue-700">Set Queen</button>
                        <button name="remove_queen"
                            class="rounded-sm h-12 px-10 text-white bg-red-800 hover:bg-red-700">Remove Queen</button>
                        <button name="clear_board"
                            class="rounded-sm h-12 px-10 text-white bg-red-800 hover:bg-red-700">Clear Board</button>
                    </div>
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
                            echo "<th>$i</th>";
                            $a = $i % 2;
                            for ($j = 0; $j < count($board[$i]); $j++) {
                                $b = $j % 2;
                                if ($a != $b)
                                    $color = "bg-gray-800 text-slate-200";
                                else
                                    $color = "bg-slate-200 text-gray-800";
                                echo "<td><div class='flex items-center justify-center w-14 h-14 p-1 fill-current $color'>";
                                if ($board[$i][$j] === -1)
                                    echo file_get_contents("./assets/queen.svg");
                                else if ($board[$i][$j] > 0)
                                    echo $board[$i][$j];
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