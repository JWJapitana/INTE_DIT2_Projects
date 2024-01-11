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
                color: #ffffff;
                font-family: Helvetica;
                background-image: url('giphy.gif');
                background-size: cover;
            }
            .buttonC{
                font-family: sans-serif;
                font-weight: bold;
                background: #FF9900;
                color: #000000;
                border-radius: 1vw;
                margin-left: 25%;
                display: inline-block;
            }
            form{   
                background-color: #000000;        
                margin: auto;
                margin-top:30px;
                width: 400px;
                border: 3px solid green;
                padding: 10px;
                color:green;
            }
            span {
                color:red;
            }
        </style>
    </head>
    <body>
        <div class="content">
            <!-- Error detection area -->
            <?php
                // define variables and set to empty values
                $fnameErr = $mnameErr = $lnameErr = $emailErr = $subjectErr = "";
                $fname = $mname = $lname = $sex = $email = $subject = "";

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Name input Error detect (Special Case detection)
                    if (empty($_POST["fname"])) {   // check if input contains whitespace only
                        $fnameErr = "Name is required"; // change value then return as new value
                    } else {
                        $fname = test_input($_POST["fname"]);
                        // check if name only contains letters and whitespace
                        if (!preg_match("/^[a-zA-Z-' ]*$/",$fname)) {
                            $fnameErr = "Only letters and white space allowed";
                        }
                    }
                    if (empty($_POST["mname"])) {
                        $mnameErr = "Name is required";
                    } else {
                        $mname = test_input($_POST["mname"]);
                        if (!preg_match("/^[a-zA-Z-' ]*$/",$mname)) {
                            $mnameErr = "Only letters and white space allowed";
                        }
                    }if (empty($_POST["lname"])) {
                        $lnameErr = "Name is required";
                    } else {
                        $lname = test_input($_POST["lname"]);
                        if (!preg_match("/^[a-zA-Z-' ]*$/",$lname)) {
                            $lnameErr = "Only letters and white space allowed";
                        }
                    }

                    // Email error detect (Email validity detection)
                    if (empty($_POST["email"])) {
                        $emailErr = "Email is required";
                    } else {
                        $email = test_input($_POST["email"]);
                        // check if e-mail address is well-formed
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $emailErr = "Invalid email format";
                        }
                    }

                    // Subject input Error detect (Normal error detection)
                    if (empty($_POST["subject"])) {
                        $subjectErr = "subject is required";
                    } else {
                        $subject = test_input($_POST["subject"]);
                    }

                    if (empty($_POST["email"]) != true && !filter_var($email, FILTER_VALIDATE_EMAIL) != true  && empty($_POST["fname"]) != true && !preg_match("/^[a-zA-Z-' ]*$/",$fname) != true){
                        $list = array(
                            array('Name: ',$fname, $mname, $lname),
                            array('Email: ',$email),
                            array('Subject Taken:', $subject)
                        );
                        // Input values to .csv file
                        $fp = fopen('Page1CSV.csv', 'w');
                        foreach ($list as $fields) {
                            fputcsv($fp, $fields);
                        }
                        fclose($fp);
                        // Go to page2
                        header("Location: /php_prac/Page2.php", true, 301);  
                        exit();  
                    }
                }

                function test_input($data) {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
            ?>
            <!-- Form assignment area -->
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                <label for="fname">First name:</label><br>
                <input type="text" id="fname" name="fname" required>
                <span>* <?php echo $fnameErr;// Calls value of fnameErr?></span>
                <br/>

                <label for="mname">Middle name:</label><br>
                <input type="text" id="mname" name="mname" required>
                <span>* <?php echo $mnameErr;?></span>
                <br/>

                <label for="lname">Last name:</label><br>
                <input type="text" id="lname" name="lname" required>
                <span>* <?php echo $lnameErr;?></span>
                <br/>

                <label for="email">Email:</label><br>
                <input type="text" id="email" name="email" required>
                <span>* <?php echo $emailErr;?></span>
                <br/>

                <label for="sex">Sex:</label><br>
                <select name="sex" id="sex" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <br/>

                <label for="subject">Subject Taken:</label><span> * <?php echo $subjectErr;?></span><br>
                <input type="radio" id="Math" name="Math" checked="checked">
                <label for="Math">Math</label><br>
                <input type="radio" id="Science" name="Science">
                <label for="css">Science</label><br>
                <input type="radio" id="Filipino" name="Filipino" >
                <label for="Filipino">Filipino</label><br/>
                <input type="radio" id="English" name="English" >
                <label for="English">English</label><br/>
                <br/>
                
                <input type="reset" class="buttonC"/><input type="Submit" name="Submit" class="buttonC"/><br/>
                <hr/>   
                <?php
                    // Check Input here
                    echo "<div style='transform: translate(40%, 30%);'>Check input</div><br/>";
                    echo "First name: ".$fname."<br/>";
                    echo "Middle name: ".$mname."<br/>";
                    echo "Last name: ".$lname."<br/>";
                    echo "Email: ".$email."<br/>";
                    echo "Gender: ".$sex."<br/>";
                    echo "Subject Taken: ".$subject."<br/>";
                ?> 
            </form>
        </div>
    </body>