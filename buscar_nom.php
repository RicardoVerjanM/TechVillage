<?php

include('clientes/loyaout/parte1.php');


if (isset($_GET['nombre_producto'])) {

    if ($_GET['nombre_producto'] ==null) {
        echo "<h2>Escribe un producto en el que estes interesado</h2>";
        exit;
    }

    $nombre_producto = $_GET['nombre_producto'];

    // Consulta para buscar productos por nombre y traer la foto_1
    $sql_productos = "
        SELECT p.*, f.foto_1
        FROM productos p
        JOIN fotos_producto f ON p.id_producto = f.id_producto
        WHERE p.nom_producto LIKE :nombre_producto";
    
    $query_productos = $pdo->prepare($sql_productos);
    $searchTerm = '%' . $nombre_producto . '%'; // Añadir comodines para la búsqueda
    $query_productos->bindParam(':nombre_producto', $searchTerm, PDO::PARAM_STR);
    $query_productos->execute();

    // Obtener los resultados
    $productos = $query_productos->fetchAll(PDO::FETCH_ASSOC);

    if ($productos==null) {
        echo "<h2>No existen productos con ese nombre</h2>";
        exit;
    }
}
?>
<head>

<link rel="stylesheet" href="principal/css/content.css">
</head>

<div id="mainContainer">
    <h1> Busqueda de: <?php echo $nombre_producto; ?></h1>
    <div id="containerClothing">
        <?php foreach ($productos as $producto): ?> 
            <div id="box">
                <a href="detalle_producto.php?id=<?php echo $producto['id_producto']; ?>">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($producto['foto_1']); ?>" alt="<?php echo $producto['nom_producto']; ?>">
                    <div id="details">
                        <h3><?php echo $producto['nom_producto']; ?></h3>
                        <h2>$<?php echo number_format($producto['precio_producto']); ?></h2>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

    </div>



    </div>
</body>

</html> 

<!-- AdminLTE and Bootstrap Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



</body>
</html>
