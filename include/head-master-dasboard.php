<?php

use function PHPSTORM_META\type;
?>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
<link rel="icon" type="image/png" href="./assets/img/icon-logoagresid.png">
<!--     Fonts and icons     -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,700" rel="stylesheet" />
<!-- Nucleo Icons -->
<link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
<link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
<!-- CSS Files -->
<link id="pagestyle" href="./assets/css/argon-dashboard.css?<?= time(); ?>" rel="stylesheet" />
<!-- Data Table -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="./assets/dataTable/dataTables.modif.css?<?= time(); ?>">
<!-- Sweet Alert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="./assets/sweetalert2/sweetalert2.min.css?<?= time(); ?>">

<script>
  $(document).ready(function() {
    $(".lds-dual-ring").fadeOut();
  })
</script>

<script>
  let colorMode1 = sessionStorage.getItem('mode1');
  let colorMode2 = sessionStorage.getItem('mode2');
  let colorMode3 = sessionStorage.getItem('mode3');
  if (colorMode1 && colorMode2 && colorMode3) {
    document.querySelector(':root').style.setProperty('--color-theme', colorMode1);
    document.querySelector(':root').style.setProperty('--color-theme-2', colorMode2);
    document.querySelector(':root').style.setProperty('--color-theme-3', colorMode3);
  }
</script>
</head>