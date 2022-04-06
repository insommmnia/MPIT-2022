<?php

// Инициализировать сессию.
// Если you are using session_name("something"), don't forget it now!
session_start();
// Unset все переменные сессии.
session_unset();
// Наконец, разрушить сессию.
session_destroy();
header('Location: ../index.php');

?>