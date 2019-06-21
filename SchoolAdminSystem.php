<!DOCTYPE html>
<html>
<head>
	<title> School Admin System </title>
</head>
 
<body>
	<!--
    Admin username: "admin"
    Admin password: "admin"
    -->

	<?php
        $studentInfo = array();
        $file = "GradesData.txt";
        $studentStr = file_get_contents($file);
        $studentList = explode("\n", $studentStr);  //this is a 1-D array
        foreach($studentList as $index=>$student){
            $studentInfo[$index] = explode("\t", $student); //$studetnInfo is a 2-D array
        }

        function display2DArray($A){
            echo "<table border=1>";
                echo "<tr><th>Name</th><th>Email</th><th>Major</th><th>Grade</th></tr>";
                    foreach($A as $person){
                        echo "<tr>";
                            foreach($person as $info){
                                echo "<td>".$info."</td>";
                            }
                        echo "</tr>";
                    }
            echo "</table>";
            echo "<br/>";
        }

        function swapCols($m, $n){
            global $studentInfo;
            foreach($studentInfo as $index=>$person){
                $tmp = $studentInfo[$index][$m];
                $studentInfo[$index][$m] = $studentInfo[$index][$n];
                $studentInfo[$index][$n] = $tmp;
            }
        }
	?>

	<?php 
        $name = $email = $major = $Q1 = $Q2 = $Q3 = $Q4 = $showanswer = "";
    	$nameMSG = $emailMSG = "";
        $score = 0;
        $properFormatName = true;
        $properFormatEmail = true;
        
        if(isset($_POST["submit"])){
            $name = htmlspecialchars(trim($_POST["name"]));
            $email = htmlspecialchars(trim($_POST["email"]));
            $major = $_POST["major"];
            $Q1 = $_POST["Q1"];
            $Q2 = $_POST["Q2"];
            $Q3 = $_POST["Q3"];
            $Q4 = $_POST["Q4"];
            $showanswer = $_POST["showanswer"];

            if(empty($name)) {
                $nameMSG = "Name is required!"; 
                $properFormatName = false;
            }
            if(empty($email)) {
                $emailMSG = "Email is required!"; 
                $properFormatEmail = true;
            }
            else {
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $emailMSG = "Email is not in correct format!"; 
                    $properFormatEmail = true;
                }
            }
      		
        }
    ?>
    
    <?php 
        $showwhat = $studentName = $adminUser = $adminPass = $studentName = "";
        if(isset($_POST["submitme"])){
            $showwhat = $_POST["showwhat"];
            $studentName = $_POST["studentName"];
            $adminUser = $_POST["adminUser"];
            $adminPass = $_POST["adminPass"];
            $studentName = $_POST["studentName"];
        
            $properAdminUser = true;
            $properAdminPass = true;
            $userMSG = $passMSG = "";

            if($adminUser != "admin") {
                $userMSG = "Incorrect admin username!"; 
                $properAdminUser = false;
            }
            if($adminPass != "admin") {
                $passMSG = "Incorrect admin password!"; 
                $properAdminPass = false;
            }
    	}
	?>

	<h1>Welcome to this Web Based Test!!!</h1>
	<p>Please answer the following questions:</p>
	<hr/>
    
	<form method=POST action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
    Name: <input type="text" name="name" value="<?php echo $name?>"> <font color=red>* <?php echo $nameMSG; ?></font><br/><br/>
    E-mail: <input type="email" name="email" value="<?php echo $email?>"> <font color=red>* <?php echo $emailMSG; ?></font><br>
    <hr/>
	Choose your major area of study: 
    <select name="major">
        <option value="Digital Media" <?php if($major=="Digital Media") echo selected; ?> >Digital Media</option>
        <option value="Software" <?php if($major=="Software") echo selected; ?> >Software</option>
        <option value="Security" <?php if($major=="Security") echo selected; ?> >Security</option>
        <option value="Business" <?php if($major=="Business") echo selected; ?> >Business</option>
        <option value="Other" <?php if($major=="Other") echo selected; ?> >Other</option>
  	</select> <br/>
	<hr/>
    
    <p>Questons 1 (25points)</p>
    <p>If my name is Will Smith, what is my first name?</p>
    <input type="radio" value="A" name="Q1" <?php if($Q1=="A") {echo checked; $score+=25;} ?> >A. Will 
    	<?php if($showanswer=="YES" && $properFormatName && $properFormatEmail) echo "<-- Correct Answer" ?><br/>
    <input type="radio" value="B" name="Q1" <?php if($Q1=="B") echo checked; ?> >B. Smith<br/>
    <input type="radio" value="C" name="Q1" <?php if($Q1=="C") echo checked; ?> >C. Will Smith<br/>
    <input type="radio" value="D" name="Q1" <?php if($Q1=="D") echo checked; ?> >D. Smith Will<br/>
    <hr/>
    
    <p>Questons 2 (25points)</p>
    <p>If my favoriate color is red, what color I like most?</p>
    <input type="radio" value="A" name="Q2" <?php if($Q2=="A") echo checked; ?> >A. blue<br/>
    <input type="radio" value="B" name="Q2" <?php if($Q2=="B") echo checked; ?> >B. pink<br/>
    <input type="radio" value="C" name="Q2" <?php if($Q2=="C") {echo checked; $score+=25;} ?> >C. red 
    	<?php if($showanswer=="YES" && $properFormatName && $properFormatEmail) echo "<-- Correct Answer" ?><br/>
    <input type="radio" value="D" name="Q2" <?php if($Q2=="D") echo checked; ?> >D. black<br/>
    <hr/>
    
    <p>Questons 3 (25points)</p>
    <p>If I was born and grew up in New York, what is my hometown's name?</p>
    <input type="radio" value="A" name="Q3" <?php if($Q3=="A") echo checked; ?> >A. LA<br/>
    <input type="radio" value="B" name="Q3" <?php if($Q3=="B") echo checked; ?> >B. Las Vegas<br/>
    <input type="radio" value="C" name="Q3" <?php if($Q3=="C") echo checked; ?> >C. Detroit<br/>
    <input type="radio" value="D" name="Q3" <?php if($Q3=="D") {echo checked; $score+=25;} ?> >D. New York 
    	<?php if($showanswer=="YES" && $properFormatName && $properFormatEmail) echo "<-- Correct Answer" ?><br/>
    <hr/>

    <p>Questons 4 (25points)</p>
    <p>If my birthday is 10/27/1998, what is 10+27?</p>
    <input type="radio" value="A" name="Q4" <?php if($Q4=="A") echo checked; ?> >A. 27<br/>
    <input type="radio" value="B" name="Q4" <?php if($Q4=="B") {echo checked; $score+=25;} ?> >B. 37 
    	<?php if($showanswer=="YES" && $properFormatName && $properFormatEmail) echo "<-- Correct Answer" ?> <br/>
    <input type="radio" value="C" name="Q4" <?php if($Q4=="C") echo checked; ?> >C. 17<br/>
    <input type="radio" value="D" name="Q4" <?php if($Q4=="D") echo checked; ?> >D. 47<br/>
    <hr/>
    
    <input type="checkbox" name="showanswer" value="YES" <?php if($showanswer=="YES") echo checked; ?> > Show correct answers after submission.
    <br/><br/>
    <input type="submit" value="Submit this test" name="submit">
    <input type="submit" name="reset" value="Reset"> 
    </form>
    <hr/>
    
    <?php 
    	if(isset($_POST["submit"]) && $properFormatName && $properFormatEmail){
        	echo "Your score was: " . $score . "%<br/>";
        	$info = "";
            $info .= $name;
            $info .= "\t";
            $info .= $email;
            $info .= "\t";
            $info .= $major;
            $info .= "\t";
            $info .= $score;
            $info .= "\n";
            file_put_contents("GradesData.txt", $info, FILE_APPEND|LOCK_EX);
        }
    ?>
    

    <!--for admin -->
    <hr/>
    <div style="text-align:left;background-color:pink;width:50%;margin:auto;">
    
    <form method=POST action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <div style="text-align:right;margin-right: 20%;">
    Admin User: <input type="text" name="adminUser" value="<?php echo $adminUser; ?>">
    <font color=red>*<br/>
    	<?php if($adminUser != "admin") echo $userMSG; ?>
    </font><br/>
    Admin Pass: <input type="password" name="adminPass" value="<?php echo $adminPass; ?>">
    <font color=red>*<br/>
    	<?php if($adminPass != "admin") echo $passMSG; ?>
    </font><br>
    </div>

    <hr/>
    <div style="text-align:left;margin-left: 20%;">
    <input type="radio" name="showwhat" value="all" <?php if($showwhat=="all") echo checked; ?>>Show all grades<br/>
    <input type="radio" name="showwhat" value="sorted" <?php if($showwhat=="sorted") echo checked; ?>>Show all grades sorted in descending order <br/>
    <input type="radio" name="showwhat" value="p100" <?php if($showwhat=="p100") echo checked; ?>>Show all grades that are 100<br/>
    <input type="radio" name="showwhat" value="dm0" <?php if($showwhat=="dm0") echo checked; ?>>Show all grades that are 0 and are of Digital Media Major <br/>
    <input type="radio" name="showwhat" value="byname" <?php if($showwhat=="byname") echo checked; ?>>Find student(s)'s grade by name: <input type="text" name="studentName" value="<?php echo $studentName ?>"><br/>
    </div>

    <hr/>
    <div style="text-align:center;">
    <input type="submit" value="See grades" name="submitme"><input type="reset">
    </div>
    </form>
    </div>
    <hr/>
    
    <?php 
    if(isset($_POST["submitme"]) && $properAdminUser && $properAdminPass){  
        if($showwhat == "all"){
            echo "Showing all grades:<br/>";
            display2DArray($studentInfo);
        }
        
        if($showwhat == "sorted"){
            echo "Showing all grades in descending order:<br/>";
            swapCols(0,3);
            rsort($studentInfo);
            swapCols(0,3);
            display2DArray($studentInfo);
        }
        
        if($showwhat == "p100"){
            echo "Showing all greades that were 100:<br/>";
            
            echo "<table border=1>";
            echo "<tr><th>Name</th><th>Email</th><th>Major</th><th>Grade</th></tr>";
            foreach($studentInfo as $student){
            	if($student[3] == 100){
               	echo "<tr>";
                	foreach($student as $info) echo "<td>".$info."</td>";
            	echo "</tr>";
                }
            }
            echo "</table>";
        }
        
        if($showwhat == "dm0"){
            echo "Showing all grades that were 0 from Digital Media Majors:<br/>";
			echo "<table border=1>";
            echo "<tr><th>Name</th><th>Email</th><th>Major</th><th>Grade</th></tr>";
            foreach($studentInfo as $student){
            	if($student[2] == "Digital Media" && $student[3] == 0){
               	echo "<tr>";
                	foreach($student as $info) echo "<td>".$info."</td>";
            	echo "</tr>";
                }
            }
            echo "</table>";
        }

		if($showwhat == "byname"){
            echo "Showing all grades that were 0 from Digital Media Majors:<br/>";
			echo "<table border=1>";
            echo "<tr><th>Name</th><th>Email</th><th>Major</th><th>Grade</th></tr>";
            foreach($studentInfo as $student){
            	if($student[0] == $studentName){
               	echo "<tr>";
                	foreach($student as $info) echo "<td>".$info."</td>";
            	echo "</tr>";
                }
            }
            echo "</table>";
        }
	}
	?>

</body>
</html> 