<?php
$to = "pawanmalhotra1995@gmail.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: mandibill.com";
if (mail($to, $subject, $txt, $headers)) {
    echo ("Message successfully sent!");
} else {
    echo ("Message delivery failed...");
}
?>