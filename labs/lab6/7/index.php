<?php
setcookie('test', '123');
if (isset($_COOKIE['test']))
    echo $_COOKIE['test'];