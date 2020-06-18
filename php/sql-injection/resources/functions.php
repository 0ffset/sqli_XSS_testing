<?php


// helper functions
function last_id(){
    global $connection;
   return mysqli_insert_id($connection);
}

function set_message($msg){

if(!empty($msg)){
	$_SESSION['message'] = $msg;
} else{
	$msg = "";
}	
}

function set_message2($msg2){

if(!empty($msg2)){
    $_SESSION['message2'] = $msg2;
} else{
    $msg2 = "";
}   
}

function display_message(){

	if(isset($_SESSION['message'])){
		echo $_SESSION['message'];
		unset($_SESSION['message']);
	}
}

function display_message2(){

    if(isset($_SESSION['message2'])){
        echo $_SESSION['message2'];
        unset($_SESSION['message2']);
    }
}




function redirect($location){

header("Location: $location");

}

function query($sql){
	global $connection; 
	return mysqli_query($connection, $sql);
}


function confirm($result){
	global $connection;
	if(!$result){

    			die("QUERY FAILED" . mysqli_error($connection));}

    		}


// to prevent sqli injection
function escape_string($string){

	global $connection;
	return mysqli_real_escape_string($connection, $string);
}

function fetch_array($result){

	return mysqli_fetch_array($result);
}




/*****************************SQLi-SAFE***************************************/
function login_user(){

try{
        $con = new PDO('mysql:host=127.0.0.1;dbname=ecom_db','root','');

        if(isset($_POST['submit'])){

        $username = escape_string($_POST['username']);  //
        $password = escape_string($_POST['password']);
        $user = array('1');
        $reg = array('1');
        $user = $con->prepare("
        SELECT * FROM users
        WHERE username = ?
        AND password = ?
        ");

        $userExcution = $user->execute([$username, $password]);
        $user = $user->fetchAll(PDO::FETCH_OBJ);

         


         $regQuery = $con->prepare("SELECT * FROM register WHERE username = :username ");
         $regQuery->execute([ 'username'=> $username, ]);


    $reg = $regQuery->fetch(PDO::FETCH_OBJ);
 
                        
               if(empty($user)){
                                
                                            if($reg == true){
                                            $db_password = $reg->password;
                                                    if(password_verify($password, $db_password)){


                                                                        redirect("index.php");
                                                                        set_message2("Welcome"." ".$username);


                                                    } else {

                                                                        redirect("index.php");
                                                                        set_message("incorrect password");


                                                    }
                                            }
                                            else
                                            {
                                                                   redirect("index.php");
                                                            set_message("User does not exits");
                                            }



                               
                            }
   
                
                else{
                    $_SESSION['username'] = $username;   
                    redirect("index.php");
                    set_message2("Welcome ADMIN");
                 
                }
}
} catch (PDOException $e) {
die("Error occurred:");
}
}




/******************************BAD FUNCTION******************************/


function login_user(){

if(isset($_POST['submit'])){

$username = ($_POST['username']); 
$password = ($_POST['password']);  

$query = query("SELECT * FROM users WHERE username = '{$username}' AND password = '{$password }' ");
confirm($query);
error_reporting(0);    //show errors-is set to off

if(mysqli_num_rows($query) == 0) {
set_message("Please try again");
redirect("index.php");
} else {
                                        
$_SESSION['username'] = $username;   
redirect("index.php");
set_message2("Welcome ADMIN");
}
}}
/*****************************************************************************/

//takes input $string and removes any chars not in $whitelist
//Sample code to sanitize user input
function whitelist($string, $whitelist)
{

    $strlen = strlen($string);
    $whtlen = strlen($whitelist);
    $good_char = false;

    for($i = 0; $i < $strlen; $i++)
    {

       for($j = 0; $j < $whtlen; $j++)
       {

           if($string[$i] == $whitelist[$j])
           {
               $good_char = true;
           }    

       }
       if($good_char == false)
       {
          $string[$i] = " "; 

       }
       $good_char = false;

    } 
    $new = str_replace(" ", '&nbsp;' , $string);
    $w = trim($string);
    echo $w;   
}

$string = ""; //INPUT STRING
$whitelist = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

//whitelist($string,$whitelist);

/***************************************/
/***************************************/
function register_user(){

    $con = new PDO('mysql:host=127.0.0.1;dbname=ecom_db','root','');

if(isset($_POST['submit'])){
   

    $username = ($_POST['username']); 
    $email    = ($_POST['email']); //
    $password = ($_POST['password']);


//$user = array('1');
        $user = $con->prepare("
        SELECT * FROM register
        WHERE username = ?
        ");

        $userExcution = $user->execute([$username]);
        $user = $user->fetchAll(PDO::FETCH_OBJ);
        //var_dump($user);

                if(empty($user) && !empty($username) && !empty($email) && !empty($password)){
                            
                        $registerQuery = $con->prepare("INSERT INTO register(username,email,password) VALUES(:username, :email, :password)");

                        $registerQuery->execute([

                        'username'=> $username,
                        'email'=> $email,
                        'password'=>password_hash($password, PASSWORD_BCRYPT, [12])]);

                    redirect("index.php");
                    set_message2("Sucessfull please login in");
                    
                }
                else{
                    set_message("Please try again");
                    redirect("register.php");
                }
}
}




/************************/









?>