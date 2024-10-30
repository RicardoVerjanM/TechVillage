<?php include('app/controllers/productos/controladorListaProductosCliente.php'); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> CONTENT | TECHVILLAGE </title>
    <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
    <!-- favicon -->
    <link rel="icon" href="https://yt3.ggpht.com/a/AGF-l78km1YyNXmF0r3-0CycCA0HLA_i6zYn_8NZEg=s900-c-k-c0xffffffff-no-rj-mo" type="image/gif" sizes="16x16">

    <link rel="stylesheet" href="./css/content.css">

    <style>
        body {
            margin: 0;
            font-family: 'Lato', sans-serif;
            overflow-x: hidden;
        }

        h1 {
            width: 90%;
            margin: auto;
            padding: 50px 0;
            letter-spacing: 2px;
            font-weight: 700;
            text-transform: capitalize;
        }

        #containerClothing,
        #containerAccessories {
            display: grid;
            grid-gap: 70px 20px;
            grid-template-columns: repeat(5, 1fr);
            width: 90%;
            margin: auto;
            padding-bottom: 40px;
        }

        #box {
            width: 100%;
            background-color: white;
            align-content: center;
            border-radius: 10px;
            box-shadow: 1px 2px 6px 2px rgb(219, 219, 219);
        }

        #box:hover {
            box-shadow: 1px 6px 3px 0 rgb(185, 185, 185);
        }

        #containerClothing img {
            width: 100%;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        #containerAccessories img {
            width: 100%;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        #details {
            padding: 0 15px;
            text-transform: capitalize;
        }

        #box a {
            text-decoration: none;
            color: rgb(29, 29, 29);
        }

        h3 {
            font-size: 16px;
        }

        h4 {
            font-weight: 100;
        }

        h2 {
            color: rgb(3, 94, 94);
        }

        /* ----------------------------- MEDIA QUERY --------------------------- */

        @media(max-width: 1070px) {
            h1 {
                font-size: 25px;
            }

            #containerClothing,
            #containerAccessories {
                width: 95%;
                grid-gap: 10px;
            }
        }

        @media(max-width: 850px) {
            h1 {
                width: 80%;
            }

            #containerClothing,
            #containerAccessories {
                display: grid;
                grid-gap: 70px 20px;
                grid-template-columns: repeat(3, 1fr);
                width: 80%;
            }
        }

        @media(max-width: 650px) {
            h1 {
                font-size: 20px;
            }

            h1 {
                width: 90%;
            }

            #containerClothing,
            #containerAccessories {
                width: 90%;
            }
        }

        @media(max-width: 600px) {
            h1 {
                width: 70%;
            }

            #containerClothing,
            #containerAccessories {
                width: 70%;
            }
        }

        @media(max-width: 505px) {
            h1 {
                width: 80%;
            }

            #containerClothing,
            #containerAccessories {
                width: 80%;
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>

</head>

<body>
<div id="mainContainer">
    <h1> Nuestros productos </h1>
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