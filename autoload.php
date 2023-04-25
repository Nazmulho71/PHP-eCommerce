<?php

function autoload_models($className)
{
  if (file_exists(__DIR__ . "/models/$className.php"))
    require __DIR__ . "/models/$className.php";
}

function autoload_controllers($className)
{
  if (file_exists(__DIR__ . "/controllers/$className.php"))
    require __DIR__ . "/controllers/$className.php";
}

spl_autoload_register("autoload_models");
spl_autoload_register("autoload_controllers");
