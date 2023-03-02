    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 mt-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-2">

        <!-- Toogle Sidebar -->
        <li class="nav-item d-xl-none pe-3 d-flex align-items-center">
          <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
            <div class="sidenav-toggler-inner">
              <i class="sidenav-toggler-line bg-white"></i>
              <i class="sidenav-toggler-line bg-white"></i>
              <i class="sidenav-toggler-line bg-white"></i>
            </div>
          </a>
        </li>

        <li class="nav-item pe-3 d-flex align-items-center">
          <a href="javascript:history.back()" class="nav-link text-white p-0">
            <i class="fas fa-arrow-alt-circle-left pt-1" style='font-size:18px'></i>
          </a>
        </li>

        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
          <ul class="navbar-nav  justify-content-end">

            <!-- Notifications -->
            <?php if ($_SESSION["jabatan"] != "sales") { ?>
              <li class="nav-item dropdown pe-3 d-flex align-items-center">
                <div class="nav-link text-white p-0 me-1" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-bell cursor-pointer"></i>
                  <span class="badge badge-danger badge-counter"><?= count($newUsers) + count($newSKU) + count($requestAcc) ?></span>

                </div>
                <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n0" aria-labelledby="dropdownMenuButton">
                  <?php if ($_SESSION["jabatan"] != "admin") { ?>
                    <!-- notif konfirmasi user -->
                    <?php
                    $countUsers = count($newUsers);
                    $count = 0;
                    if ($countUsers < 3) {
                      $count = $countUsers;
                    } else {
                      $count = 3;
                    }
                    ?>
                    <?php for ($i = 0; $i < $count; $i++) : ?>
                      <li class="mb-2">
                        <div class="dropdown-item border-radius-md">

                          <div class="d-flex py-1">
                            <h6 class="text-sm font-weight-normal mb-1">

                              Konfirmasi <span class="font-weight-bold"><?= $newUsers[$i]["nama"] ?></span>
                              sebagai <span class="font-weight-bold"><?= $newUsers[$i]["jabatan"] ?></span>
                            </h6>
                          </div>
                          <a href=# class="btn btn-xs bg-success text-white cAccUser" data-id="<?= $newUsers[$i]["id"] ?>" data-name="<?= $newUsers[$i]["username"] ?>">Terima</a>
                          <a href=# class="btn btn-xs bg-danger text-white cDeleteUser" data-id="<?= $newUsers[$i]["id"] ?>" data-name="<?= $newUsers[$i]["username"] ?>">Tolak</a>

                        </div>
                      <?php endfor; ?>
                      <a class="dropdown-item text-center small text-gray-500" href="show-all-reqUser.php">Show All Users</a>
                      </li>
                      <!-- end notif konfirmasi user -->

                      <!-- notif request acc -->
                      <?php
                      $countReq = count($requestAcc);
                      $count1 = 0;
                      if ($countReq < 3) {
                        $count1 = $countReq;
                      } else {
                        $count1 = 3;
                      }
                      ?>
                      <?php for ($x = 0; $x < $count1; $x++) : ?>
                        <li class="mb-2">
                          <div class="dropdown-item border-radius-md">

                            <div class="d-flex py-1">
                              <h6 class="text-sm font-weight-normal mb-1">

                                Konfirmasi <span class="font-weight-bold"><?= $requestAcc[$x]["nama"] ?></span> meminta akses
                              </h6>
                            </div>
                            <a href=# class="btn btn-xs bg-success text-white cAccAkUser" data-id="<?= $requestAcc[$x]["id"] ?>" data-name="<?= $requestAcc[$x]["username"] ?>">Terima</a>
                            <a href=# class="btn btn-xs bg-danger text-white cDenyAkUser" data-id="<?= $requestAcc[$x]["id"] ?>" data-name="<?= $requestAcc[$x]["username"] ?>">Tolak</a>

                          </div>
                        <?php endfor; ?>
                        <a class="dropdown-item text-center small text-gray-500" href="show-all-reqAcc.php">Show All Request Access</a>
                        </li>
                      <?php } ?>
                      <!-- end request acc -->
                      <!-- notif new sku -->
                      <?php
                      $countSku = count($newSKU);
                      $count2 = 0;
                      if ($countSku < 3) {
                        $count2 = $countSku;
                      } else {
                        $count2 = 3;
                      }
                      ?>
                      <?php for ($j = 0; $j < $count2; $j++) : ?>
                        <li class="mb-2">
                          <div class="dropdown-item border-radius-md">

                            <div class="d-flex py-1">
                              <h6 class="text-sm font-weight-normal mb-1">

                                SKU <span class="font-weight-bold"><?= $newSKU[$j]["sku"] ?></span>
                                baru
                              </h6>
                            </div>

                          </div>
                        <?php endfor; ?>
                        <a class="dropdown-item text-center small text-gray-500" href="show-all-sku.php">Show All SKU</a>
                        </li>
                        <!-- end notif sku -->
                      <?php } ?>

                </ul>

              </li>

              <!-- User Setting -->
              <li class="nav-item dropdown d-flex align-items-center">
                <div class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-user cursor-pointer me-sm-1"></i>
                </div>
                <ul class="dropdown-menu  dropdown-menu-end  px-2 py-2 me-sm-n4" aria-labelledby="dropdownMenuButton">
                  <li class="mb-1">
                    <a href="setting.php" class="dropdown-item border-radius-md">
                      <div class="d-flex py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <div class="my-auto">
                            <i class="fas fa-cog me-1"></i>
                            <span class="text-sm font-weight-bold">Setting</span>
                          </div>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li class="mb-1">
                    <a href="#" class="dropdown-item border-radius-md" data-bs-toggle="modal" data-bs-target="#logoutModal">
                      <div class="d-flex py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <div class="my-auto">
                            <i class="fas fa-sign-out-alt me-1"></i>
                            <span class="text-sm font-weight-bold">Logout</span>
                          </div>
                        </div>
                      </div>
                    </a>
                  </li>
                </ul>
              </li>
          </ul>
        </div>
        <script>
          $('.cDeleteUser').click(function() {
            var id_user = $(this).attr('data-id');
            var username = $(this).attr('data-name');
            Swal.fire({
              title: 'Apakah kamu yakin?',
              text: "Kamu akan menghapus user dengan nama " + username + ".",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#2dce89',
              cancelButtonColor: '#f5365c',
              confirmButtonText: 'Ya, hapus',
              cancelButtonText: 'Tidak, batalkan'
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = "function/user-delete.php?id=" + id_user
              }
            })
          });

          $('.cAccUser').click(function() {
            var id_user = $(this).attr('data-id');
            var username = $(this).attr('data-name');
            Swal.fire({
              title: 'Apakah kamu yakin?',
              text: "Kamu akan mengonfirmasi user dengan nama " + username + ".",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#2dce89',
              cancelButtonColor: '#f5365c',
              confirmButtonText: 'Ya, konfirmasi',
              cancelButtonText: 'Tidak, batalkan',
              reverseButtons: true
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = "function/user-accept.php?id=" + id_user
              }
            })
          });

          $('.cAccAkUser').click(function() {
            var id_user = $(this).attr('data-id');
            var username = $(this).attr('data-name');
            Swal.fire({
              title: 'Apakah kamu yakin?',
              text: "Kamu akan mengonfirmasi akses user dengan nama " + username + ".",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#2dce89',
              cancelButtonColor: '#f5365c',
              confirmButtonText: 'Ya, konfirmasi',
              cancelButtonText: 'Tidak, batalkan',
              reverseButtons: true
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = "function/user-request-accept.php?id=" + id_user
              }
            })
          });

          $('.cDenyAkUser').click(function() {
            var id_user = $(this).attr('data-id');
            var username = $(this).attr('data-name');
            Swal.fire({
              title: 'Apakah kamu yakin?',
              text: "Kamu akan menghapus permintaan akses user dengan nama " + username + ".",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#2dce89',
              cancelButtonColor: '#f5365c',
              confirmButtonText: 'Ya, hapus',
              cancelButtonText: 'Tidak, batalkan',
              reverseButtons: true
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = "function/user-request-delete.php?id=" + id_user
              }
            })
          });
        </script>
      </div>
    </nav>
    <!-- End Navbar -->