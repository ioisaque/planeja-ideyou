<?php
require_once("init.php");

if (true === false)
    return Core::framePage("https://cdn.ideyou.com.br/_error/503.html");

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <!-- META -->
    <meta name="robots" content="index, follow">
    <meta name="author" content="IdeYou - Isaque Costa">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>
        Planejamento by <?= COMPANY_NAME; ?>
    </title>
    <meta name="keywords" content="">
    <meta name="description" content="Desenvolvido por IdeYou - Acelerando Ideias!">
    <meta content="Planejamento by <?= COMPANY_NAME; ?>" property="og:title">
    <meta content="Desenvolvido por IdeYou - Acelerando Ideias!" property="og:description">

    <!-- PWA -->
    <link charset="UTF-8" rel="manifest" href="manifest.json">
    <meta name="theme-color" content="#012060">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="white">
    <meta name="apple-mobile-web-app-title" content="Planejamento by <?= COMPANY_NAME; ?>">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0,viewport-fit=cover">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="assets/images/icons/apple-icon-180.png">
    <link rel="icon" type="image/png" sizes="64x64" href="assets/images/icons/favicon-64.png">
    <link rel="icon" type="image/png" sizes="196x196" href="assets/images/icons/favicon-196.png">
    <meta name="msapplication-square70x70logo" content="assets/images/icons/mstile-icon-128.png">
    <meta name="msapplication-square150x150logo" content="assets/images/icons/mstile-icon-270.png">
    <meta name="msapplication-square310x310logo" content="assets/images/icons/mstile-icon-558.png">
    <meta name="msapplication-wide310x150logo" content="assets/images/icons/mstile-icon-558-270.png">

    <!-- SPLASH -->
    <link rel="apple-touch-startup-image" href="assets/splash/apple-splash-2048-2732.jpg" media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="assets/splash/apple-splash-2732-2048.jpg" media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="assets/splash/apple-splash-1668-2388.jpg" media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="assets/splash/apple-splash-2388-1668.jpg" media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="assets/splash/apple-splash-1536-2048.jpg" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="assets/splash/apple-splash-2048-1536.jpg" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="assets/splash/apple-splash-1668-2224.jpg" media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="assets/splash/apple-splash-2224-1668.jpg" media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="assets/splash/apple-splash-1620-2160.jpg" media="(device-width: 810px) and (device-height: 1080px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="assets/splash/apple-splash-2160-1620.jpg" media="(device-width: 810px) and (device-height: 1080px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="assets/splash/apple-splash-1284-2778.jpg" media="(device-width: 428px) and (device-height: 926px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="assets/splash/apple-splash-2778-1284.jpg" media="(device-width: 428px) and (device-height: 926px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="assets/splash/apple-splash-1170-2532.jpg" media="(device-width: 390px) and (device-height: 844px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="assets/splash/apple-splash-2532-1170.jpg" media="(device-width: 390px) and (device-height: 844px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="assets/splash/apple-splash-1125-2436.jpg" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="assets/splash/apple-splash-2436-1125.jpg" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="assets/splash/apple-splash-1242-2688.jpg" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="assets/splash/apple-splash-2688-1242.jpg" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="assets/splash/apple-splash-828-1792.jpg" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="assets/splash/apple-splash-1792-828.jpg" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="assets/splash/apple-splash-1242-2208.jpg" media="(device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="assets/splash/apple-splash-2208-1242.jpg" media="(device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="assets/splash/apple-splash-750-1334.jpg" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="assets/splash/apple-splash-1334-750.jpg" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)">
    <link rel="apple-touch-startup-image" href="assets/splash/apple-splash-640-1136.jpg" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)">
    <link rel="apple-touch-startup-image" href="assets/splash/apple-splash-1136-640.jpg" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)">

    <!-- Bootstrap Core CSS -->
    <link charset="UTF-8" rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link charset="UTF-8" rel="stylesheet" href="assets/js/bootstrap-datepicker/css/bootstrap-datepicker.min.css" />

    <!-- Base CSS -->
    <link charset="UTF-8" rel="stylesheet" href="assets/css/style.css">

    <!-- Custom CSS -->
    <link charset="UTF-8" rel="stylesheet" href="assets/css/id_custom.css">
    <link charset="UTF-8" rel="stylesheet" href="assets/css/id_buttons.css">
    <link charset="UTF-8" rel="stylesheet" href="assets/css/website.css">

    <!-- Core JS -->
    <script type="text/javascript" charset="UTF-8" src="assets/js/_jquery.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="assets/js/_popper.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="assets/js/_bootstrap.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="assets/js/_bootstrap_growl.min.js"></script>
</head>


<body class="fix-header fix-sidebar card-no-border disable-dbl-tap-zoom">
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- /////////////////////////////////////////////////////////////////// -->
        <!-- TOPBAR -->
        <!-- /////////////////////////////////////////////////////////////////// -->
        <div id="topbar" class="id_bg-themecolor">
            <div class="app-title">
                <a href="./">
                    <img src="assets/images/EEJPII.jpg" alt="<?= COMPANY_NAME; ?>" />
                    <img class="christmas_hat" src="assets/images/christmas_hat.png" alt="Ho Ho Ho" />
                </a>
                <h2 class="text-white text-bold">Planejamento de Aula</h2>
                <div class="d-md-block d-none">
                </div>
            </div>
            <div class="store-waves"></div>
        </div>
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Preloader - style you can find in spinners.css -->
            <!-- ============================================================== -->
            <div class="preloader">
                <svg class="circular" viewBox="25 25 50 50">
                    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
                </svg>
            </div>
            <!-- ============================================================== -->
            <!-- Start Content-->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <label class="text-bold">Planejamentos Recentes: </label>
                                <div id="planejamentos"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 d-md-block d-none">
                        <button type="reset" form="processarPlanejamento" class="btn btn-card btn-athenas" style="font-size: 2.5rem;">
                            <i class="mdi mdi-broom"></i>
                        </button>
                    </div>
                    <div class="col-md-2 d-md-block d-none">
                        <button type="submit" form="processarPlanejamento" class="btn btn-card btn-info" style="font-size: 2.5rem;">
                            <i class="mdi mdi-printer"></i>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <form id="processarPlanejamento" action="print.php" method="POST" target="_blank">
                            <input type="hidden" name="id" value="">
                            <div class="card mb-2">
                                <div class="card-body row">
                                    <div class="form-group col-md-5">
                                        <label>Professor</label>
                                        <input type="text" name="professor" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Código</label>
                                        <input type="text" name="codigo" class="form-control text-center" required>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Ano/Turma</label>
                                        <input type="text" name="turma" class="form-control text-center" required>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label>Área de Conhecimento/Componente Currícular</label>
                                        <input type="text" name="componente_curricular" class="form-control" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>Bimestre</label>
                                        <select name="bimestre" class="form-control custom-select" required>
                                            <option value="0">Selecione uma opção...</option>
                                            <option value="1º">1º BIMESTRE</option>
                                            <option value="2º">2º BIMESTRE</option>
                                            <option value="3º">3º BIMESTRE</option>
                                            <option value="4º">4º BIMESTRE</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Período</label>
                                        <div class="input-daterange input-group">
                                            <input type="text" name="periodo_i" value="<?= DATA(); ?>" class="form-control id_bg-dynamic b-0 text-center datepicker id_font10x" required>
                                            <div class="input-group-append pointer">
                                                <span class="id_font18x px-4 text-themecolor"><i class="mdi mdi-calendar-range"></i></span>
                                            </div>
                                            <input type="text" name="periodo_f" value="<?= DATA(); ?>" class="form-control id_bg-dynamic b-0 text-center datepicker id_font10x" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="text-bold">Unidade Temática: </label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea name="unidade_tematica" class="form-control mb-0 slimScrollDiv" style="height: 125px;" placeholder="..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="text-bold">Objeto de Conhecimento: </label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea name="objeto_de_conhecimento" class="form-control mb-0 slimScrollDiv" style="height: 125px;" placeholder="..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="text-bold">Habilidade: </label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea name="habilidade" class="form-control mb-0 slimScrollDiv" style="height: 125px;" placeholder="..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="text-bold">Competências Específicas: </label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea name="competencias_especificas" class="form-control mb-0 slimScrollDiv" style="height: 125px;" placeholder="..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="text-bold">Expectativa de Aprendizagem: </label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea name="expectativa_de_aprendizagem" class="form-control mb-0 slimScrollDiv" style="height: 125px;" placeholder="..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="text-bold">Espaço de Aula: </label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea name="espaco_de_aula" class="form-control mb-0 slimScrollDiv" style="height: 125px;" placeholder="..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="text-bold">Materiais Utilizados: </label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea name="materiais_utilizados" class="form-control mb-0 slimScrollDiv" style="height: 125px;" placeholder="..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="text-bold">Organização dos Alunos: </label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea name="organizacao_dos_alunos" class="form-control mb-0 slimScrollDiv" style="height: 125px;" placeholder="..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="text-bold">Metodologias/Estratégias de Ensino: </label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea name="metodologias_de_ensino" class="form-control mb-0 slimScrollDiv" style="height: 125px;" placeholder="..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="text-bold">Forma de Avaliação: </label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea name="forma_de_avaliacao" class="form-control mb-0 slimScrollDiv" style="height: 125px;" placeholder="..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="text-bold">Unidade Temática/Práticas de Linguagens: </label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea name="praticas_de_linguagem" class="form-control mb-0 slimScrollDiv" style="height: 125px;" placeholder="..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="text-bold">Habilidades: </label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea name="habilidades" class="form-control mb-0 slimScrollDiv" style="height: 125px;" placeholder="..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="text-bold">Metodologias/Estratégias de Ensino: </label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea name="estrategias_de_ensino" class="form-control mb-0 slimScrollDiv" style="height: 125px;" placeholder="..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="text-bold">Avaliações/Formas: </label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea name="avaliacoes_formas" class="form-control mb-0 slimScrollDiv" style="height: 125px;" placeholder="..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label class="text-bold">Anexos: </label>
                                        </div>
                                        <div id="anexos" class="col-md-9">
                                            <div class="row">
                                                <div class="col-5">
                                                    <label>Descrição</label>
                                                    <input type="text" name="descricao[0]" class="form-control">
                                                </div>
                                                <div class="col-5">
                                                    <label>Link</label>
                                                    <input type="text" name="link[0]" class="form-control">
                                                </div>
                                                <div class="col-2">
                                                    <label> </label>
                                                    <button type="button" onClick="addAnexo()" class="btn p-1 btn-block btn-success">
                                                        <i class="mdi id_font14x mdi-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Page Content -->
                <!-- ============================================================== -->
                <a href="https://ideyou.com.br" target="_blank" class="footer">
                    <img src="assets/images/system-copyrights.png" alt="Desenvolvido por IdeYou.">
                </a>
            </div>
            <!-- ============================================================== -->
            <!-- End Content/-->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- NOTIFICATION -->
    <!-- ============================================================== -->
    <div id="install-prompt" class="app-notbar text-main border-main border-top id_bg-white d-none">
        <img class="pointer" src="assets/images/system-icon.svg" alt="<?= COMPANY_NAME; ?>" />
        <a href="#" class="text-main text-bold pointer">Instale o App!</a>
        <i class="mdi mdi-close m-0 p-3"></i>
    </div>
    <!-- ============================================================== -->
    <!-- NAVIGATION -->
    <!-- ============================================================== -->
    <div class="app-navbar waves-effect waves-dark border-top id_bg-themecolor border-themecolor">
        <button type="reset" form="processarPlanejamento" class="w-100 no-bg no-border text-white">
            <i class="mdi mdi-broom"></i> Resetar
        </button>
        <button type="submit" form="processarPlanejamento" class="w-100 no-bg no-border text-white">
            <i class="mdi mdi-printer"></i> Imprimir
        </button>
    </div>
    <!-- ============================================================== -->
    <!-- All Scripts -->
    <!-- ============================================================== -->
    <script type="text/javascript" charset="UTF-8" src="assets/js/moment.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="assets/js/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="assets/js/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js"></script>
    <script type="text/javascript" charset="UTF-8" src="assets/js/_ideyou.core.functions.js"></script>
    <script type="text/javascript" charset="UTF-8" src="assets/js/_ideyou.core.js"></script>
    <?php
    $today = DateTime::createFromFormat('d/m/Y', strval(DATA()));
    $startDate = DateTime::createFromFormat('d/m', '01/11');
    $endDate = DateTime::createFromFormat('d/m', '31/12');

    $startDate->setDate($today->format('Y'), $startDate->format('m'), 1);
    $endDate->setDate($today->format('Y'), $endDate->format('m'), 31);
    ?>

    <?php if ($today >= $startDate && $today <= $endDate) : ?>
        <script type="text/javascript" charset="UTF-8" src="https://unpkg.com/magic-snowflakes/dist/snowflakes.min.js"></script>
        <script>
            var sf = new Snowflakes({
                color: "#ffffff",
                count: 150,
                minOpacity: 0.4,
                minSize: 5,
                maxSize: 25
            });
        </script>
        <style>
            .christmas_hat {
                display: inline-flex;
            }

            #topbar {
                background-image: url('assets/images/christmas_lights.png');
            }

            .app-title {
                background-image: url('assets/images/christmas_tree.png');
            }
        </style>
    <?php endif; ?>
    <!-- ============================================================== -->
    <!-- End Scripts -->
    <!-- ============================================================== -->
</body>

</html>