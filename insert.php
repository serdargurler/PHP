
<?php

$server="localhost";
$username="root";
$password="";
$dbname="inserticindatabase";

try {
$pdo = new PDO("mysql:host=".$server.";dbname=".$dbname,$username,$password);

}

catch(PDOException $e) {
echo "Veritabanına bağlanırken hata ile karşılaşıldı." .$e->getMessage();

}
$status="";
if ($_SERVER['REQUEST_METHOD']=='POST') {
$name= $_POST['name'];
$email= $_POST['email'];
$message= $_POST['message'];
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $status="Lütfen geçerli bir mail adresi giriniz.";

 }
else{

$sql="INSERT INTO inserticintablo (name, email, message) VALUES (:name, :email, :message) ";

$sorgu= $pdo->prepare($sql);

$sorgu->execute(['name' =>$name, 'email'=>$email, 'message'=> $message]);

$status="Gönderildi";
$name="";
$email="";
$message="";

}

}





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veri Gönder</title>
</head>
<body>
<form action="" method="POST" >
      
      İsim Soyisim <br>
          <input type="text" required name="name" id="name" 
            value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $name ?>">
        
            <hr>
        
          Email<br>
          <input type="text" required name="email" id="email" 
            value="<?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $email ?>">
        
            <hr>
        
          Mesaj:<br>
          <textarea name="message" required id="message" cols="30" rows="10"
            ><?php if($_SERVER['REQUEST_METHOD'] == 'POST') echo $message ?></textarea>
        
            <hr>
            <button type="submit">Gönder</button>
  
        <hr>
          <?php echo $status ?>




</body>
</html>
