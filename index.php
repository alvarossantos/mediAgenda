<?php
// Redireciona o usuário para o painel principal da aplicação.
// O principal.php já cuidará de redirecionar para o login.php se não houver sessão.
header("Location: principal.php");
exit;