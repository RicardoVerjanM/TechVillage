<?php include('clientes/loyaout/parte1.php');

$id_get = $_GET['id'];

// Consulta para obtener los detalles del producto
$sql_productos = "SELECT * FROM productos WHERE id_producto = :id_producto;";
$query_productos = $pdo->prepare($sql_productos);
$query_productos->bindParam(':id_producto', $id_get, PDO::PARAM_INT);
$query_productos->execute();
$producto = $query_productos->fetch(PDO::FETCH_ASSOC);

// Consulta para obtener todas las fotos del producto
$sql_fotos = "SELECT * FROM fotos_producto WHERE id_producto = :id_producto;";
$query_fotos = $pdo->prepare($sql_fotos);
$query_fotos->bindParam(':id_producto', $id_get, PDO::PARAM_INT);
$query_fotos->execute();
$fotos = $query_fotos->fetch(PDO::FETCH_ASSOC);

// Verificar si el producto está en el carrito
$sql_carrito = "SELECT * FROM carrito WHERE id_cliente = :id_cliente AND id_producto = :id_producto;";
$query_carrito = $pdo->prepare($sql_carrito);
$query_carrito->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
$query_carrito->bindParam(':id_producto', $id_get, PDO::PARAM_INT);
$query_carrito->execute();
$producto_en_carrito = $query_carrito->fetch(PDO::FETCH_ASSOC);
?>

<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (isset($_SESSION['mensaje']) && isset($_SESSION['icon'])) {
  $respuesta = $_SESSION['mensaje'];
  $icon = $_SESSION['icon'];
?>
  <script>
    Swal.fire({
      position: "top-center",
      icon: "<?php echo $icon; ?>",
      title: "<?php echo $respuesta; ?>",
      showConfirmButton: false,
      timer: 2000
    });
  </script>
<?php
}

unset($_SESSION['mensaje']);
unset($_SESSION['icon']);
?>

<div class="container py-4">
  <div class="row justify-content-center">
    <div class="col-12 bg-white shadow-sm rounded p-4">
      <main>
        <div class="container">
          <div class="row">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none"><?php echo htmlspecialchars($producto['nom_producto']); ?></h3>

              <!-- Imagen principal del producto -->
              <div class="col-12" style="position: relative;">
                <div class="image-container">
                  <img id="mainProductImage" src="data:image/jpeg;base64,<?php echo base64_encode($fotos['foto_1']); ?>" class="product-image" alt="Product Image">
                  <!-- Div para mostrar la imagen en zoom -->
                  <div id="zoomLens"></div>
                  <div id="zoomedImageContainer">
                    <img id="zoomedImage" src="data:image/jpeg;base64,<?php echo base64_encode($fotos['foto_1']); ?>" class="zoomed-image" alt="Zoomed Image">
                  </div>
                </div>
              </div>

              <!-- Miniaturas de las imágenes -->
              <div class="col-12 product-image-thumbs">
                <?php if (!empty($fotos['foto_1'])) { ?>
                  <div class="product-image-thumb active" onclick="changeMainImage('<?php echo base64_encode($fotos['foto_1']); ?>')">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($fotos['foto_1']); ?>" alt="Product Image">
                  </div>
                <?php } ?>
                <?php if (!empty($fotos['foto_2'])) { ?>
                  <div class="product-image-thumb" onclick="changeMainImage('<?php echo base64_encode($fotos['foto_2']); ?>')">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($fotos['foto_2']); ?>" alt="Product Image">
                  </div>
                <?php } ?>
                <?php if (!empty($fotos['foto_3'])) { ?>
                  <div class="product-image-thumb" onclick="changeMainImage('<?php echo base64_encode($fotos['foto_3']); ?>')">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($fotos['foto_3']); ?>" alt="Product Image">
                  </div>
                <?php } ?>
                <?php if (!empty($fotos['foto_4'])) { ?>
                  <div class="product-image-thumb" onclick="changeMainImage('<?php echo base64_encode($fotos['foto_4']); ?>')">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($fotos['foto_4']); ?>" alt="Product Image">
                  </div>
                <?php } ?>
                <?php if (!empty($fotos['foto_5'])) { ?>
                  <div class="product-image-thumb" onclick="changeMainImage('<?php echo base64_encode($fotos['foto_5']); ?>')">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($fotos['foto_5']); ?>" alt="Product Image">
                  </div>
                <?php } ?>
              </div>
            </div>

            <!-- Columna para los detalles del producto -->
            <div class="col-md-6 order-md-2">
              <h2><?php echo htmlspecialchars($producto['nom_producto']); ?></h2>
              <h3>$<?php echo number_format($producto['precio_producto']); ?></h3>
              <p class="lead"><?php echo htmlspecialchars($producto['descripcion']); ?></p>

              <!-- Botones para agregar al carrito o eliminar del carrito -->
              <div class="mt-4">
                <?php if ($producto_en_carrito) { ?>
                  <!-- Formulario para eliminar del carrito -->
                  <form action="app/controllers/clientes/controladorEliminarCarrito.php" method="get">
                    <input type="hidden" name="id" value="<?php echo $id_get; ?>">
                    <button type="submit" class="btn btn-danger btn-lg">
                      <i class="fas fa-trash"></i> Eliminar del carrito
                    </button>
                  </form>
                <?php } else { ?>
                  <!-- Formulario para agregar al carrito -->
                  <form action="app/controllers/clientes/controladorAgregarCarrito.php" method="post">
                    <input type="hidden" name="id_producto" value="<?php echo $id_get; ?>">
                    <button type="submit" class="btn btn-success btn-lg">
                      <i class="fas fa-cart-plus"></i> Agregar al carrito
                    </button>
                  </form>
                <?php } ?>
                <br>

                <!-- Formulario para realizar el pedido -->
                <form action="realizar_pedido.php" method="get">
                  <input type="hidden" name="id_producto" value="<?php echo $id_get; ?>">
                  <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-shopping-bag"></i> Realizar pedido
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

<script>
  // Cambiar la imagen principal
  function changeMainImage(imageBase64) {
    const mainImage = document.getElementById('mainProductImage');
    const zoomedImage = document.getElementById('zoomedImage');
    mainImage.src = 'data:image/jpeg;base64,' + imageBase64;
    zoomedImage.src = 'data:image/jpeg;base64,' + imageBase64;

    let thumbnails = document.querySelectorAll('.product-image-thumb');
    thumbnails.forEach(function(thumb) {
      thumb.classList.remove('active');
    });
    event.currentTarget.classList.add('active');
  }

  // Obtener elementos
  const mainImage = document.getElementById('mainProductImage');
  const zoomLens = document.getElementById('zoomLens');
  const zoomedImage = document.getElementById('zoomedImage');
  const zoomedImageContainer = document.getElementById('zoomedImageContainer');

  mainImage.addEventListener('mousemove', function(event) {
    const rect = mainImage.getBoundingClientRect();
    const x = event.clientX - rect.left;
    const y = event.clientY - rect.top;

    const lensWidth = zoomLens.offsetWidth;
    const lensHeight = zoomLens.offsetHeight;

    let lensX = x - lensWidth / 2;
    let lensY = y - lensHeight / 2;

    if (lensX < 0) lensX = 0;
    if (lensY < 0) lensY = 0;
    if (lensX > rect.width - lensWidth) lensX = rect.width - lensWidth;
    if (lensY > rect.height - lensHeight) lensY = rect.height - lensHeight;

    zoomLens.style.left = lensX + 'px';
    zoomLens.style.top = lensY + 'px';

    const zoomFactor = 2;
    const backgroundX = (lensX / rect.width) * 100;
    const backgroundY = (lensY / rect.height) * 100;

    zoomedImage.style.transformOrigin = `${backgroundX}% ${backgroundY}%`;
    zoomedImage.style.transform = `scale(${zoomFactor})`;

    zoomedImageContainer.style.display = 'block';
  });

  mainImage.addEventListener('mouseleave', function() {
    zoomedImageContainer.style.display = 'none';
  });
</script>

<style>
  .bg-white {
    background-color: #ffffff;
  }

  .shadow-sm {
    box-shadow: 0 .125rem .25rem rgba(0,0,0,.075);
  }

  .py-4 {
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
  }

  .product-image {
    width: 100%;
    max-width: 400px;
    height: auto;
    cursor: crosshair;
  }

  .image-container {
    position: relative;
  }

  #zoomLens {
    position: absolute;
    width: 100px;
    height: 100px;
    border: 2px solid #000;
    display: none;
  }

  #zoomedImageContainer {
    position: absolute;
    display: none;
    z-index: 1000;
    top: 0;
    left: calc(100% + 20px);
    width: 300px;
    height: 300px;
    overflow: hidden;
    border: 1px solid #ccc;
  }

  .zoomed-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .product-image-thumb {
    cursor: pointer;
  }

  .product-image-thumb.active img {
    border: 2px solid #007bff;
  }
</style>