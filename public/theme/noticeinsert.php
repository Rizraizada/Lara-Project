<?php
    $conn = mysqli_connect('localhost','root','', 'ibaseip') or die('Error Encountered');
	// class Notice{
        if (isset($_POST['submit']) ) {
            $title = $_POST['title'];
            $details = $_POST['details'];
            $author = $_POST['author'];
            $date =$_POST['date'];;

            global $mydb;
             
             $query = "INSERT into notice (remarks,details,author,date) values('$title','$details','$author','$date');";
             echo $title;
            //  $mydb->setQuery($query);
            //  $mydb->executeQuery();
             $result = mysqli_query($conn, $query);
           
             
             header("location:notice-board.php");
          
             
         } else echo "Failed";
    // }
    
?>