<?php
require_once('salvaresp.php');
$erros = [];
  $request = array_map('trim',$_REQUEST);
  $request = filter_var_array(
    $request,
    [
      'evento' => FILTER_DEFAULT,
      'data' => FILTER_DEFAULT,
      'turno' => FILTER_DEFAULT,
      'descricao' => FILTER_DEFAULT
    ]
  );
$evento = $request['evento'];
if ($evento == false)
{
  $erros[] = "Evento não preenchido!";
}
else if(strlen($evento)<3 || strlen($evento)>35)
{
  $erros[] = "O evento tem que ter ao menos 3 letras e no máximo 100!";
}
$data = $resquest['data'];
$data = DateTime::createFromFormat('d-m-Y', $data);
if ($data == false)
{
  $erros[] = "Valor de Data inválida!";
}
$turno = $request['turno'];

if ($turno == false)
{
  $erros[] = "Horário não preenchido";
}
else if ($request['turno']=='manha'){
$turno = 1;
}
$descricao = $request['descricao'];
if ($descricao == false)
{
  $erros[] = "Descrição não preenchido!";
}
else if(strlen($descricao)<3 || strlen($descricao)>1000)
{

  $erros[] = "A descrição tem que ter ao menos 3 letras e no máximo 1000!";
}



  if (empty($erros))
{
      $novoEvento = [
      'evento' => $request['evento'],
      'data' => $request['data'],
      'hora' => $request['hora'],
      'descricao' => $request['descricao']
    ];
   InsereEvento($novoEvento);
   header('Location: ../Codigo/login.php');
}
else
{
  echo '<h1>Dados Inválidos</h1>';
  echo '<ul>';
  foreach ($erros as $msgErro)
  {
      echo "<li>$msgErro</li>";
    echo '</ul>';
    echo '<a href = "javascript:history.back()"> voltar</a>';
  }
}
?>
