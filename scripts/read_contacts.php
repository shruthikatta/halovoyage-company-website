<?php

$file = "../data/contacts.txt";

if(file_exists($file)){

$contacts = file($file);

foreach($contacts as $contact){

list($name,$email,$phone) = explode("|", trim($contact));

echo "<div style='margin-bottom:15px'>";
echo "<strong>$name</strong><br>";
echo "📧 $email<br>";
echo "📞 $phone";
echo "</div>";

}

}else{

echo "Contacts file not found.";

}
?>