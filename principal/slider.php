<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> SLIDER | E-COMMERCE WEBSITE </title>
    <!-- favicon -->
    <link rel="icon" href="https://yt3.ggpht.com/a/AGF-l78km1YyNXmF0r3-0CycCA0HLA_i6zYn_8NZEg=s900-c-k-c0xffffffff-no-rj-mo" type="image/gif" sizes="16x16">
    <!-- EXTERNAL LINKS -->
    <script src="http://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
    <script src="./principal/jQuery3.4.1.js"></script>
    <style>
        body {
            margin: 0;
        }

        #containerSlider {
            margin: auto;
            width: 90%;
            text-align: center;
            padding-top: 100px;
            box-sizing: border-box;
        }

        #containerSlider img {
            width: 100%;
            /* Ocupa todo el ancho del contenedor */
            height: auto;
            /* Mantiene la proporción de la imagen */
            text-align: center;
            align-content: center;
        }

        /* Ajustes para pantallas pequeñas */
        @media (max-width: 732px) {
            #containerSlider img {
                height: auto;
                /* Mantén la altura automática */
            }
        }

        @media (max-width: 500px) {
            #containerSlider img {
                height: auto;
                /* Mantén la altura automática */
            }
        }
    </style>

</head>

<body>
    <section>
        <div id="containerSlider">
            <div id="slidingImage"> <a href="../../www.TechVillage.com/detalle_producto.php?id=77"> <img src="../../www.TechVillage.com/principal/img/img2.png" alt="image2"></a> </div>
            <div id="slidingImage"> <a href="../../www.TechVillage.com/detalle_producto.php?id=75"><img src="../../www.TechVillage.com/principal/img/img3.png" alt="image3"></a> </div>
            <div id="slidingImage"> <a href="../../www.TechVillage.com/detalle_producto.php?id=76"><img src="../../www.TechVillage.com/principal/img/img4.png" alt="image4"></a> </div>
        </div>
    </section>
</body>
<!-- <script src=“https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js”></script> -->


</html>