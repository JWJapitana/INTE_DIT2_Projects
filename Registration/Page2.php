<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Module 6 to 7 Excercise</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <meta name="author" content="John Walter S. Japitana"/>
        <style>
            .content {
                padding: 10px;
            }
            body {
                background-color: #000000;
                color: #ffffff;
                font-family: Helvetica;
            }
            form{           
                margin: auto;
                width: 170px;
                border: 3px solid green;
                padding: 10px;
            }
            .buttonz,button{
                font-family: sans-serif;
                font-weight: bold;
                background: #FF9900;
                color: #000000;
                border-radius: 1vw;
                display: inline-block;
            }
        </style>
    </head>
    <body>
        <div class="content">
            <!-- Form assignment area -->
            <form>
                <?php
                    // File: Page1CSV.csv as $inputfile
                    $inputfile = file("Page1CSV.csv");

                    $data_lines = array();
                    foreach ($inputfile as $line)   // For each value in $inputfile as value for $line
                    {
                        $data_lines[] = explode(";", $line);
                    }

                    //Get column headers.
                    $first_line = array();
                    foreach ($data_lines[0] as $dl)
                    {
                        $first_line[] = explode("=", $dl);
                    }
                    $headers = array();
                    foreach ($first_line as $fl)
                    {
                        $headers[] = $fl[0];
                    }

                    // Get row content.
                    $data_cells = array();
                    for ($i = 0; $i < count($data_lines); $i++)
                    {
                        $data_cell = array();
                        for ($j = 0; $j < count($headers); $j++)
                        {
                            $data_cell[$j] = substr($data_lines[$i][$j], strpos($data_lines[$i][$j], "=")+1);
                        }
                        $data_cells[$i] = $data_cell;
                        unset($data_cell);
                    }
                ?>
                <table border="1">
                    <?php foreach ($data_cells as $data_cell): ?>
                    <tr>
                        <?php for ($k = 0; $k < count($headers); $k++): ?>
                            <td><?php echo $data_cell[$k]; ?></td>
                        <?php endfor; ?>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </form>
        </div>
    </body>