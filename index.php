<?php include('clientes/loyaout/parte1.php') ?>
<?php include('principal/slider.php') ?>
<?php include('principal/content.php') ?>

<!-- AdminLTE and Bootstrap Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- SweetAlert2 CSS -->

<script src="path_to_adminlte_js/adminlte.min.js"></script>
<script src="./principal/jQuery3.4.1.js"></script>

<!-- slider JS START -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script>
  $(document).ready(function() {
    $('#containerSlider').slick({
      dots: true,
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 1500,
    });
  });
</script>

</body>

</html>