<?php
function &call_mysqli()
{
    static $_mysqli = null; // the singleton pattern 
    if (is_null($_mysqli)) {
        // connect to MySQLi server, call mysqli class  
        $_mysqli = new mysqli("containers-us-west-171.railway.app", "root", "3nl9hcFkweHoHLMi2nbh", "railway");

        // echo "Conectado";

        // if connection fails, display error message 
        if (mysqli_connect_errno()) {
            printf("No se pudo conectar a la Base de Datos. Errorcode: %s\n", mysqli_connect_error());
            exit();
        } // end if connect error   
    }
    return $_mysqli;
}
