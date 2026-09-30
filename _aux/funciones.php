<?php 
function guardarError($mensaje){
    $_SESSION['error']=$mensaje;
}

function imprimirMensaje(){
    if(isset($_SESSION['error'])){
        echo '<div class="error" id="mensajeError">'.$_SESSION['error'].'</div>';
        unset($_SESSION['error']);
    } 
}

function traducirHora($horaId){
    switch($horaId){
        case 0:  $hora = "09:00-10:00"; break; 
        case 1:  $hora = "10:00-11:00"; break;
        case 2:  $hora = "11:00-12:00"; break;
        case 3:  $hora = "12:00-13:00"; break;
        case 4:  $hora = "13:00-14:00"; break;
        case 5:  $hora = "14:00-15:00"; break;
        case 6:  $hora = "15:00-16:00"; break;
    }

    return $hora;
}
