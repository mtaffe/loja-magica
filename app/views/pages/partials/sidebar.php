<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar With Bootstrap</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>app/public/css/master.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark sticky">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-5 d-none d-sm-inline">Loja Mágica</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="<?php echo BASE_URL; ?>" class="nav-link align-middle px-0">
                                <i class="text-white fa-solid fa-house"></i> <span class="text-white ms-1 d-none d-sm-inline">Início</span>
                            </a>
                        </li>
                        <li>
                            <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="text-white fa-solid fa-cart-shopping"></i> <span class="text-white ms-1 d-none d-sm-inline">Pedidos</span>
                            </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="<?php echo BASE_URL; ?>order" class="text-white nav-link px-0"> <span class="d-none d-sm-inline">Listar Pedidos</span></a>
                                </li>
                                <li>
                                    <a href="<?php echo BASE_URL; ?>order/create" class="text-white nav-link px-0"> <span class="d-none d-sm-inline">Novo pedido</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="text-white">
                            <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="text-white fa-solid fa-users"></i> <span class="text-white ms-1 d-none d-sm-inline">Clientes</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="<?php echo BASE_URL; ?>client" class="nav-link px-0"> <span class="text-white d-none d-sm-inline">Lista de clientes</span></a>
                                </li>
                                <li>
                                    <a href="<?php echo BASE_URL; ?>client/create" class="nav-link px-0"> <span class="text-white d-none d-sm-inline">Novo Cliente</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="text-white">
                            <a href="#submenu5" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="text-white fa-solid fa-file-import"></i><span class="text-white ms-1 d-none d-sm-inline">Importar</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu5" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="<?php echo BASE_URL; ?>importIndex" class="nav-link px-0"> <span class="text-white d-none d-sm-inline">Importar clientes</span></a>
                                </li>
                                <li>
                                    <a href="<?php echo BASE_URL; ?>importIndex" class="nav-link px-0"> <span class="text-white d-none d-sm-inline">Importar pedidos</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="text-white">
                            <a href="#submenu4" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="text-white fa-solid fa-envelope"></i> <span class="text-white ms-1 d-none d-sm-inline">E-mails</span> </a>
                            <ul class="collapse nav flex-column ms-1" id="submenu4" data-bs-parent="#menu">
                                <li class="w-100">
                                    <a href="<?php echo BASE_URL; ?>mail/statement" class="nav-link px-0"> <span class="text-white d-none d-sm-inline">Comunicados para clientes</span></a>
                                </li>
                                <li class="w-100">
                                    <a href="<?php echo BASE_URL; ?>mail/order-status" class="nav-link px-0"> <span class="text-white d-none d-sm-inline">Atualização de status do pedido</span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown pb-4">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="text-white fa-solid fa-user"></i>
                            <span class="d-none d-sm-inline mx-1"><?php echo $user['username'] ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a href="<?php echo BASE_URL; ?>logout" class="dropdown-item" href="#">Sair</a></li>
                        </ul>
                    </div>

                </div>

            </div>
            <div class="col py-3">
                <section class="container">
                    <div class="header__main mb-5">
                        <h1>Loja Mágica<i class="fa-solid fa-shop"></i></h1>
                    </div>
                </section>
                <!-- # CONTENT # -->
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<script>
    let sidebar = document.getElementsByClassName("sidebar")[0];
    let sidebar_content = document.getElementsByClassName("content-wrapper")[0];

    window.onscroll = () => {
        let scrollTop = window.scrollY;
        let viewportHeight = window.innerHeight;
        let sidebarTop = sidebar.getBoundingClientRect().top + window.pageYOffset;
        let contentHeight = sidebar_content.getBoundingClientRect().height;

        if (scrollTop >= contentHeight - viewportHeight + sidebarTop) {
            sidebar_content.style.transform = `translateY(-${(contentHeight - viewportHeight + sidebarTop)}px)`;
            sidebar_content.style.position = "fixed";
        } else {
            sidebar_content.style.transform = "";
            sidebar_content.style.position = "";
        }
    };
    /*
        $('document').ready(function(){
          let sidebar = $('.sidebar');
          let sidebar_content =  $('.sidebar .content-wrapper')

          $(window).scroll(function(){
            let scrollTop = $(this).scrollTop();
            let viewportHeight = $(this).height();
            let sidebarTop = sidebar.offset().top; 
            let contentHeight = sidebar_content.height(); 
            if( scrollTop >= contentHeight - viewportHeight + sidebarTop) {
              sidebar_content.css('transform', `translateY(-${(contentHeight - viewportHeight + sidebarTop)}px)`); 
              sidebar_content.css('position', 'fixed'); 
            }
            else {
              sidebar_content.css('transform', ''); 
              sidebar_content.css('position', '');
            }
          });
        });*/
</script>

</html>