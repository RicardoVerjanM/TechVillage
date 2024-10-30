<?php include('clientes/loyaout/parte1.php');

// Obtener el id de la categoría desde el GET
$id_get = $_GET['categoria'];

$sql_productos = "SELECT p.*, f.foto_1 
          FROM productos p
          JOIN fotos_producto f ON p.id_producto = f.id_producto WHERE p.id_categoria=$id_get";
$query_productos = $pdo->prepare($sql_productos);
$query_productos->execute();

$productos = $query_productos->fetchALL(PDO::FETCH_ASSOC);
//************************************************************ */
$sql_categoria = "SELECT * FROM categoria WHERE id_categoria = :id_categoria";
$query_categoria = $pdo->prepare($sql_categoria);
$query_categoria->bindParam(':id_categoria', $id_get, PDO::PARAM_INT);
$query_categoria->execute();

$categoria = $query_categoria->fetch(PDO::FETCH_ASSOC);

?>
<head>

<link rel="stylesheet" href="principal/css/content.css">
</head>

<div id="mainContainer">
    <h1> Productos de la categoria <?php echo $categoria['categoria']; ?></h1>
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

<script>
  // Función para cambiar la imagen principal
  function changeMainImage(imageBase64) {
    document.getElementById('mainProductImage').src = 'data:image/jpeg;base64,' + imageBase64;

    // Actualizar la clase 'active' en la miniatura seleccionada
    let thumbnails = document.querySelectorAll('.product-image-thumb');
    thumbnails.forEach(function(thumb) {
      thumb.classList.remove('active');
    });
    event.currentTarget.classList.add('active');
  }
</script>

</body>
</html>
