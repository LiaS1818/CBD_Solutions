<?php
    require_once 'includes/app.php';
    require 'pdf.php';
    // Autenticar al usario

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if (isset($_POST["send"])) {
    $mail = new PHPMailer(true);
    
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'sorgoroto@gmail.com';                     //SMTP username
    $mail->Password   = 'qchzurzawjcwewcg';                               //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
    $mail->Port       = 465; 

    $mail->setFrom('sorgoroto@gmail.com');
    $mail->addAddress($_SESSION['usuario']);
    $mail->isHTML(true);

    $mail->Subject = 'Confirmacion de Compra Green Vitality CBD Solutions';
    $mail->Body = 'Resumen de la Compra';
    $mail->addAttachment($pdfFile, 'Reporte.pdf');
     $mail->send();
               echo 
               "
               <script>
               alert('Enviado Correctamente');
               </script>
               ";
    header('Location: /CBD_Solutions/index');
}
?>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="contacto.php" method="post">

        Email <input type="email" name="email"> <br>
    
        <button  type="submit" name="send">Sendme an email</button>
    </form>
</body>
</html> -->

