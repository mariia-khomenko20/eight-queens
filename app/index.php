<?php
include "app.php";

$board[4][2] = 1;
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
        <div class="flex flex-col space-y-5">
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
                                if ($board[$i][$j] === 1)
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