<?php require_once "views/shared/headerLogin.php"; ?>

<div class="login">
    <h1>Ingresar</h1>

    <p class="text-blanco">
        <?php 
            
            if(isset($data["error"]) )
            {
                echo "<div class='alert alert-danger' role='alert'>";
                echo $data["error"]; 
                echo "</div>";
            }
        ?>
    </p>
    
    <form method="post" action="index.php?control=usuario&action=login">
    	<input type="number" name="cedula" placeholder="Cédula" required />
        <input type="password" name="contrasenia" placeholder="Contraseña" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large">Acceder</button>
    </form>
    <div class="text-blanco">
        ¿No está registrado? <a href="index.php?control=usuario&action=verRegistro">Registrese</a>
    </div>
</div>

</body>
</html>