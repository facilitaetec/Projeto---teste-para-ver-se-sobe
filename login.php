<?php
$servername = "localhost";
$username = "root";
$password = "usbw";
$dbkoi = "bd_koi";

// $email = "teste@email.com"; // Substitua por um valor real, provavelmente obtido a partir de um formulário de login
// $senha = "teste123"; // Substitua por um valor real, provavelmente obtido a partir de um formulário de login e processado por funções de hash ou encriptação

session_start();
$_SESSION["logado"]=false;

if(isset($_POST["email"], $_POST["password"]))
{
    $email=$_POST["email"];
    $senha=$_POST["password"];
}

$conn = new PDO("mysql:host=$servername;dbname=$dbkoi", $username, $password);
// set the PDO error mode to exception
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// prepara a instrução SQL
$stmt = $conn->prepare("SELECT mail_user, snh_user FROM tb_usuario WHERE mail_user = :email AND snh_user = :password");

// vincula o parâmetro :email e :password ao parâmetro do vinculo correspondente
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $senha);

// executa a instrução SQL
    $stmt->execute();

// recupera a linha
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    // redireciona o usuário para a página desejada
    $_SESSION["logado"]=true;
    header("Location: perfil.html");
} else {
    // informa o usuário de que as credenciais estão incorretas
}       