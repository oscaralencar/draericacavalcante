<?
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$mensagem = $_POST['mensagem'];

// Inclui o arquivo class.phpmailer.php localizado na pasta phpmailer
require_once 'phpmailer/class.phpmailer.php';
require_once 'phpmailer/class.smtp.php';

// Inicia a classe PHPMailer
$mail = new PHPMailer();

// Define os dados do servidor e tipo de conexão
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsSMTP(); // Define que a mensagem será SMTP
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

$mail->Host = "smtp.draericacavalcante.com.br"; // Endereço do servidor SMTP
$mail->SMTPAuth = true; // Usa autenticação SMTP? (opcional)
$mail->Username = 'contato@draericacavalcante.com.br'; // Usuário do servidor SMTP
$mail->Password = 'dra1010dra'; // Senha do servidor SMTP



// Define o remetente
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\
$mail->AddReplyTo($_POST['email'], $_POST['nome']);
$mail->From = "contato@draericacavalcante.com.br"; // Seu e-mail
$mail->FromName = "Contato Via Site"; // Seu nome

// Define os destinatário(s)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//$mail->AddAddress($_POST['email'], $_POST['nome']);
$mail->AddAddress('ericagcavalcante@yahoo.com.br');
//$mail->AddCC('ciclano@site.net', 'Ciclano'); // Copia
//$mail->AddBCC('fulano@dominio.com.br', 'Fulano da Silva'); // Cópia Oculta

// Define os dados técnicos da Mensagem
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
$mail->CharSet = 'charset=utf-8'; // Charset da mensagem (opcional)

// Define a mensagem (Texto e Assunto)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
$mail->Subject  = "Contato via Portal"; // Assunto da mensagem
$mail->Body = 'Nome: ('.$nome.') <br> Email: ( '.$email.' )<br>Telefone: ( '.$telefone.' )<br>Mensagem:'.$mensagem;
//$mail->AltBody = "Este é o corpo da mensagem de teste, em Texto Plano! \r\n :)";

// Define os anexos (opcional)
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
//$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo


	// Envia o e-mail
//	if ($enviado = $mail->Send()) {
//		echo 'e-mail enviado';
//		die;
//	} else {
//		echo '<br> email não enviado';
//		die;
//	}


// Envia o e-mail
$enviado = $mail->Send();

// Limpa os destinatários e os anexos
$mail->ClearAllRecipients();
$mail->ClearAttachments();

// Exibe uma mensagem de resultado
if ($enviado) {
	//echo "E-mail enviado com sucesso!";
	header( 'Location: index.php?mensagem=enviada' );
} else {
	//echo "Não foi possível enviar o e-mail.";
	//echo "<b>Informações do erro:</b> " . $mail->ErrorInfo;
	header( 'Location: index.php?mensagem=erro' );
}
?>