<? require 'constants.php' ?>
<? require 'router.php' ?>
<? require 'routes.php' ?>
<? Router::callControllerMethod($_GET['route']) ?>