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








/************************/


// comment form
function get_comment(){

	$con = new PDO('mysql:host=127.0.0.1;dbname=ecom_db','root','');

    $commentObject = $con->query("SELECT * FROM comments");

    $commentObject->setFetchMode(PDO::FETCH_OBJ);

while($comment = $commentObject->fetch())
    {
        $comments = <<<DELIMETER
             <tr>
                     <td>$comment->id</td>
                     <td>$comment->name</td>
                     <td>$comment->message</td>
                                         
            <tr>
            DELIMETER;
    echo $comments;
    }
    } 



/*********************BAD ************/
    function comment(){
        
        $date = new DateTime('+1 day');
        setcookie('session','password_stolen', $date->getTimestamp(),'/',null,null,false);
        //,'/',null,null,true



        $con = new PDO('mysql:host=127.0.0.1;dbname=ecom_db','root','');

    if(isset($_POST['submit'])){
		
        $name   = ($_POST['name']);
        $message= ($_POST['message']); //htmlspecialchars(string)

        $commentQuery = $con->prepare("INSERT INTO comments(name, message) VALUES(:name, :message)");

        $commentQuery->execute([

            'name'=> $name,
            'message'=> $message


        ]);
    




    }}

/*************************************SAFE*******************************************************/


// function comment(){
        
//         $date = new DateTime('+1 day');
//         setcookie('session','password_stolen', $date->getTimestamp(),'/',null,null,true);
//         //,'/',null,null,http_only=true



//         $con = new PDO('mysql:host=127.0.0.1;dbname=ecom_db','root','');

//     if(isset($_POST['submit'])){
        
//         $name   = htmlspecialchars($_POST['name']);
//         $message= htmlspecialchars($_POST['message']); //htmlspecialchars(will help sanitize user input)

//         $commentQuery = $con->prepare("INSERT INTO comments(name, message) VALUES(:name, :message)");

//         $commentQuery->execute([

//             'name'=> $name,
//             'message'=> $message


//         ]);
    




//     }}




/****************************************************************************/
/*******************************************************************/



?>