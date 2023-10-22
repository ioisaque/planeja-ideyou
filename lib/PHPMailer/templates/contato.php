<?php
/* ################################################################################################################################################ */
$data = $_POST ? $_POST : ($_GET ? $_GET : []);
/* ################################################################################################################################################ */
?>
<!DOCTYPE html>
<html>

<head>
    <!-- META DEFAULT -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="viewport-fit=auto, initial-scale=1" />

    <meta name="robots" content="noindex, nofollow" />
    <meta name="author" content="IdeYou - Isaque Costa" />

    <!-- META CLIENT -->
    <meta name="description" content="Email Marketing - Contato via SITE." />
    <meta name="keywords" content="mailer, mail, contato, email, mensagem, site, prospecção, novo, nova, new" />

    <!-- CLIENT TITLE -->
    <title>IdeYou - Acelerando Ideias!</title>

    <!-- DEFAULT FAVICONS -->
    <link rel="shortcut icon" href="https://cdn.ideyou.com.br/defaults/img/favicon.png" />
    <link rel="apple-touch-icon" href="https://cdn.ideyou.com.br/defaults/img/touch-icon-iphone.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="https://cdn.ideyou.com.br/defaults/img/touch-icon-ipad.png" />
    <link rel="apple-touch-icon" sizes="167x167" href="https://cdn.ideyou.com.br/defaults/img/touch-icon-ipad-retina.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="https://cdn.ideyou.com.br/defaults/img/touch-icon-iphone-retina.png" />

    <link rel="apple-touch-startup-image" href="https://cdn.ideyou.com.br/defaults/img/launch_logo.png" />
    <style type="text/css">
        /* CLIENT-SPECIFIC STYLES */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        img {
            -ms-interpolation-mode: bicubic;
        }

        /* RESET STYLES */
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        table {
            border-collapse: collapse !important;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        /* MEDIA QUERIES */
        @media screen and (max-width: 480px) {
            .mobile-hide {
                display: none !important;
            }

            .mobile-center {
                text-align: center !important;
            }
        }

        /* ANDROID CENTER FIX */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }
    </style>
</head>

<body style="
      margin: 0 !important;
      padding: 0 !important;
      background-color: #eeeeee;
    " bgcolor="#eeeeee">

    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td align="center" style="background-color: #eeeeee" bgcolor="#eeeeee">
                <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px">
                    <tr>
                        <td align="center" valign="top" style="font-size: 0; padding: 35px" bgcolor="#000">
                            <!--[if (gte mso 9)|(IE)]>
                <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
                <tr>
                <td align="left" valign="top" width="300">
                <![endif]-->
                            <div style="
                    display: block;
                    width: 100%;
                  ">
                                <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td align="center" valign="top">
                                            <a href="https://ideyou.com.br" target="_blank" style="color: #ffffff; text-decoration: none"><img src="https://cdn.ideyou.com.br/assets/logos/logo-w.png" width="240" height="160" style="display: block; border: 0px" /></a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <!--[if (gte mso 9)|(IE)]>
                </td>
                <td align="right" width="300">
                <![endif]-->
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 35px 35px 20px 35px; background-color: #ffffff" bgcolor="#ffffff">
                            <!--[if (gte mso 9)|(IE)]>
                <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
                <tr>
                <td align="center" valign="top" width="600">
                <![endif]-->
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px">
                                <tr>
                                    <td align="center" style="
                        font-family: Open Sans, Helvetica, Arial, sans-serif;
                        font-size: 16px;
                        font-weight: 400;
                        line-height: 24px;
                        padding: 25px 0;
                      ">
                                        <h2 style="
                          font-size: 30px;
                          font-weight: 800;
                          line-height: 36px;
                          color: #333333;
                          margin: 0;
                        ">
                                            <?= $data['subject']; ?>
                                            <?php unset($data['subject']); ?>
                                        </h2>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="left" style="padding-bottom: 40px">
                                        <table cellspacing="0" cellpadding="0" border="0" width="100%">
                                            <?php if ($data) : ?>
                                                <?php foreach ($data as $name => $val) : ?>
                                                    <?php if (strpos($val, '@') !== false && strpos($val, '.') !== false) : ?>
                                                        <tr style="border-bottom: 2px solid #eeeeee;">
                                                            <td align="left" style="
                              font-family: Open Sans, Helvetica, Arial,
                                sans-serif;
                              font-size: 16px;
                              font-weight: 600;
                              line-height: 24px;
                              padding: 15px 10px 5px 10px;
                            ">
                                                                <?= ucfirst($name); ?>
                                                            </td>
                                                            <td align="justify" style="
                              font-family: Open Sans, Helvetica, Arial,
                                sans-serif;
                              font-size: 16px;
                              font-weight: 400;
                              line-height: 24px;
                              padding: 15px 10px 5px 10px;
                            ">
                                                                <?= '<a href="mailto:' . $val . '">' . $val . '</a>'; ?>
                                                            </td>
                                                        </tr>
                                                    <?php else : ?>
                                                        <tr style="border-bottom: 2px solid #eeeeee;">
                                                            <td align="left" style="
                              font-family: Open Sans, Helvetica, Arial,
                              sans-serif;
                              font-size: 16px;
                              font-weight: 600;
                              line-height: 24px;
                              padding: 15px 10px 5px 10px;
                              ">
                                                                <?= ucfirst($name); ?>
                                                            </td>
                                                            <td align="justify" style="
                              font-family: Open Sans, Helvetica, Arial,
                              sans-serif;
                              font-size: 16px;
                              font-weight: 400;
                              line-height: 24px;
                              padding: 15px 10px 5px 10px;
                              ">
                                                                <?= $val; ?>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td align="justify" style="
                              font-family: Open Sans, Helvetica, Arial,
                              sans-serif;
                              font-size: 16px;
                              font-weight: 400;
                              line-height: 24px;
                              padding: 15px 10px 5px 10px;
                              ">
                                                        <?= 'Nenhum dado recebido, pode haver ou não algum problema com o seu formulário de contato.<br>' .
                                                            '<a style="color: #0076f3;text-decoration: none;" href="https://api.whatsapp.com/send?phone=5531995882203&text=Ol%C3%A1,%20recebi%20um%20e-mail%20me%20dizendo%20que%20pode%20haver%20um%20problema%20com%20meu%20site!" target="_blank"><b>Entre em contato conosco!</b></a>' .
                                                            '<br><br>' .
                                                            'Pedimos desculpas pelo transtorno.'; ?>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <!--[if (gte mso 9)|(IE)]>
                </td>
                </tr>
                </table>
                <![endif]-->
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 35px 60px 0px; background-color: #000" bgcolor="#000">
                            <!--[if (gte mso 9)|(IE)]>
                <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
                <tr>
                <td align="center" valign="top" width="600">
                <![endif]-->
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; margin:25px 0px 0px;">
                                <tr>
                                    <td align="center">
                                        <a href="https://instagram.com/ideyou.com.br/" target="_blank">
                                            <img src="https://cdn.ideyou.com.br/assets/socials/instagram.png" width="37" height="37" style="display: block; border: 0px;" />
                                        </a>
                                    </td>

                                    <td align="center">
                                        <a href="https://linkedin.com/company/ideyou" target="_blank">
                                            <img src="https://cdn.ideyou.com.br/assets/socials/linkedin.png" width="37" height="37" style="display: block; border: 0px" />
                                        </a>
                                    </td>

                                    <td align="center">
                                        <a href="https://ideyou.com.br" target="_blank">
                                            <img src="https://cdn.ideyou.com.br/assets/socials/global.png" width="37" height="37" style="display: block; border: 0px" />
                                        </a>
                                    </td>

                                    <td align="center">
                                        <a href="https://behance.net/isaquecosta" target="_blank">
                                            <img src="https://cdn.ideyou.com.br/assets/socials/behance.png" width="37" height="37" style="display: block; border: 0px" />
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            <!--[if (gte mso 9)|(IE)]>
                </td>
                </tr>
                </table>
                <![endif]-->
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 35px; background-color: #000" bgcolor="#000">
                            <!--[if (gte mso 9)|(IE)]>
                <table align="center" border="0" cellspacing="0" cellpadding="0" width="600">
                <tr>
                <td align="center" valign="top" width="600">
                <![endif]-->
                            <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px">

                                <tr>
                                    <td align="center" style="
                        font-family: Open Sans, Helvetica, Arial, sans-serif;
                        font-size: 14px;
                        font-weight: 400;
                        line-height: 24px;
                      ">
                                        <p style="
                          font-size: 12px;
                          font-weight: 400;
                          line-height: 20px;
                          color: #fff;
                        ">
                                            <a href="#" style="color: #fff">Ver no navegador</a>
                                            |
                                            IdeYou @ <?= date('Y'); ?>
                                            |
                                            <a href="https://ideyou.com.br" target="_blank" style="color: #fff"> Desinscrever-se</a>

                                        </p>
                                    </td>
                                </tr>
                            </table>
                            <!--[if (gte mso 9)|(IE)]>
                </td>
                </tr>
                </table>
                <![endif]-->
                        </td>
                    </tr>
                </table>

                <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
            </td>
        </tr>
    </table>

</body>

</html>
