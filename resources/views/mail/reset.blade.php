<!DOCTYPE html>
<html>
<head>
 <title>Solicitação de Redefinição de Senha</title>
</head>
<body>
 
 <h2>Prezado {{$name}},</h2>

 <p>Sua solicitação de redefinição de senha foi recebida com sucesso. Para confirmar a redefinição de sua senha,
pedimos a gentileza de clicar no botão abaixo:</p>

 <a href="{{$link}}" target="_blank" style="color: white; text-decoration: none;font-size: 18px;">
 <h5 style="width: 150px;background-color: #1ac0ff; padding: 15px 2rem;border-radius: 7px;cursor: pointer;"
>Redefinir sua senha</h5></a>

<br>

<p>Atenciosamente,</p>
<p>Sistema de Produtos</p>
 
<footer 
style="text-align: center; background-color: #004768;color: white;padding: 10px; margin-top: 5rem;"
>Sistema de Produtos LTDA © {{date('Y')}}</footer>
</body>
</html> 