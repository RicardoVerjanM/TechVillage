<?php include('../perfil/layout/parte1.php'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="border-radius: 20px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-center text-center">
                <div class="col-sm-12">
                    <h1 class="m-0">Bienvenido al panel de empresa</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content-wraper">
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-3 col-6 mx-auto">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h2>Lista de <br> pedidos</h2>
                            <br>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-eye"></i>
                        </div>
                        <a href="../perfil/lista_pedidos.php" class="small-box-footer">Ir <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-6 mx-auto">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h2>Agregar <br> producto</h2>
                            <br>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                        <a href="../perfil/agregar_producto.php" class="small-box-footer">Ir <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6 mx-auto">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h2>Mis <br> productos</h2>
                            <br>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-dolly"></i>
                        </div>
                        <a href="../../empresas/perfil/lista_productos.php" class="small-box-footer">Ir <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('../perfil/layout/parte2.php'); ?>
