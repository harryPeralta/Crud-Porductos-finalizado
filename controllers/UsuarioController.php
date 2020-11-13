<?php

class UsuarioController
{
    public function __construct()
    {
        require_once "models/Usuario.php";   
        if(!isset($_SESSION))
        {
            session_start();
        }
    }

    public function verLogin()
    {
        $data["titulo"] = "Iniciar sesión";
        require_once "views/usuario/login.php";
    }

    public function verRegistro()
    {
        $data["titulo"] = "Registro";
        require_once "views/usuario/registro.php";
    }

    public function registrar()
    {
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $contrasenia = $_POST['contrasenia'];

        $usuario = new Usuario();
        $usuario->store($cedula, $nombre, $email, $contrasenia);
        
        //redireccionar
        header("location: index.php?control=usuario&action=verLogin");
    }

    public function login()
    {
        $cedula = $_POST['cedula'];
        $contrasenia = $_POST['contrasenia'];

        $usuario = new Usuario();
        $user = $usuario->consultarUsuario($cedula);
        //var_dump($user);
        
        if( $user == null )
        {
            //echo "Usuario no encontrado";
            $data["titulo"] = "Iniciar sesión";
            $data["error"] = "Usuario no encontrado";
            require_once "views/usuario/login.php";
        }
        else
        {
            //verificar contrseña
            if(password_verify($contrasenia, $user['contrasenia']))
            {
                //echo "Usuario autenticado";
                
                // Variables de sesión
                $_SESSION["cedula"] = $user["cedula"];
    
                header("location: index.php");
            }
            else
            {
                //echo "Contraseña incorrecta";
                $data["titulo"] = "Iniciar sesión";
                $data["error"] = "Contraseña incorrecta";
                require_once "views/usuario/login.php";
            }
        }
    }
    public function logout()
    {
        unset($_SESSION["cedula"]);
        header("location: index.php?control=usuario&action=verLogin");

    }
}

?>
