<?php  require "views/shared/header.php"; ?>
    <div class="container">
        <h1><?php echo $data["titulo"] ?></h1>

        <table class="table">
            <thead>
                <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Proveedor</th>
                </tr>
            </thead>
            <tbody>
                    <tr>
                        <td><?= $data["marca"] ["id"]; ?></td>
                        <td><?= $data["marca"] ["nombre"]; ?></td>
                        <td><?= $data["marca"] ["proveedor"]; ?></td>
                    </tr>

            </tbody>
        </table>
    </div>
    <?php  require "views/shared/footer.php"; ?>