@php
    use App\Models\Theme;
    $theme = Theme::findOrFail(1);
    $domain = Config::get('app.url');
    // $domain = 'https://bbf.digital/dma2023/nomination';
    $amount = $theme->amount;
    $vat = $theme->amount *= 0.15;
    $total = $amount + $vat;
@endphp
<!DOCTYPE htmlPUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment Confirmation</title>
    <style type="text/css">
        body {
            background-image: linear-gradient(rgba(255, 255, 255, 0.9),
                    rgb(255, 255, 255, 0.9)),
                url({{$domain.'/public/assets/img/'.$theme->background}});
            margin: 0;
        }

        table {
            border-spacing: 0;
            padding: 20px;
        }

        td {
            padding: 0;
        }

        .main-table {
            max-width: 600px;
            background-image: linear-gradient(rgba(255, 255, 255, 0.5),
                    rgb(255, 255, 255, 0.5)),
                url({{$domain.'/public/assets/img/'.$theme->background}});
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            padding: 10px;
            border-spacing: 0;
            margin: 0 auto;
        }

        .container {
            /* max-width: 600px; */
            background-color: #ffffff;
            background-image: linear-gradient(rgba(255, 255, 255, 0.9),
                    rgb(255, 255, 255, 0.9)),
                url({{$domain.'/public/assets/img/'.$theme->iconbg}});
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center center;
        }

        .logo {
            text-align: center;
            font-size: 0;
        }

        .logo .column {
            width: 100%;
            max-width: 300px;
            display: inline-block;
            vertical-align: middle;
        }

        .logo .column a {
            text-decoration: none;
            vertical-align: middle;
            color: tomato;
        }

        .logo .column strong {
            vertical-align: middle;
            color: tomato;
        }

        .button {
            display: block;
            padding: 7px 20px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            color: #000 !important;
            background-image: linear-gradient(rgba(255, 255, 255, 0.5),
                    rgb(255, 255, 255, 0.5)),
                url({{$domain.'/public/assets/img/'.$theme->background}});
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin: 20px auto;
            width: 20%;
            text-align: center;
        }

        .button:hover {
            background-image: linear-gradient(rgba(122, 122, 122, 0.7),
                    rgba(122, 122, 122, 0.7)),
                url({{$domain.'/public/assets/img/'.$theme->background}});
            /* background-color: #cdcdcd !important; */
            color: #fff !important;
        }

        .footer {
            /* max-width: 600px; */
            margin: 100px auto 0px;
            color: #fff;
            padding: 10px;
            text-align: center;
            font-size: 14px;
            box-shadow: 0 2px 8px rgba(71, 71, 71, 0.5);
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url({{$domain.'/public/assets/img/'.$theme->background}});
            background-size: cover;
            background-position: center;
        }

        .footer a {
            color: #999999;
            text-decoration: none;
        }

        .footer p {
            text-align: center;
            margin: 20px 0px 5px;
        }

        .footer a:hover {
            color: #555555;
        }

        .fa {
            padding: 7px;
            font-size: 13px;
            width: 20px;
            text-align: center;
            text-decoration: none;
            margin: 10px 5px;
            color: white !important;
        }

        .fa:hover {
            opacity: 0.7;
        }

        .footer img {
            width: 36px !important;
            border: 0px !important;
            display: inline !important;
        }

        @media only screen and (max-width: 600px) {
            img {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 50%;
            }

            .button {
                display: block;
                padding: 10px 15px;
                font-size: 14px;
                margin: 20px auto;
                width: 40%;
            }

            .footer a {
                color: #999999;
                text-decoration: underline;
                border: none;
            }

            .fa {
                padding: 0px;
                font-size: 12px;
                width: 20px;
                text-align: center;
                text-decoration: none;
                margin: 0px 5px;
                color: white !important;
            }
        }
    </style>
</head>

<body>
    <center class="main-table">
        <div class="container">
            <table width="100%">
                <!-- <tr>
                    <td height="8" style="background-color: rgb(94, 255, 0);"></td>
                </tr> -->

                <!-- <tr>
                    <td style="padding: 15px 0 5px;">
                        <table width="100%">
                            <tr>
                                <td class="logo">
                                    <table class="column">
                                        <tr>
                                            <td style="padding: 5px 0px 10px 50px;">
                                                <a href="https://bbf.digital/fintech-award-2023/"><img src="https://bbf.digital/fintech-award-2023/wp-content/uploads/2023/06/Fintech-Logo-01-e1686660175351.png" alt="Logo" width="140"></a>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="column">
                                        <tr>
                                            <td style="padding: 5px 0px 10px 50px;">
                                                <a href="#"><img src="https://bbf.digital/wp-content/uploads/2023/06/telephone-auricular-with-cable.png" alt="Phone Icon" width="20"></a>
                                                <strong>01763872217</strong>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr> -->
                <tr>
                    <td style="text-align: center; padding: 10px 0px">
                        <a href="{{$theme->url}}"><img
                                src="{{$domain.'/public/assets/img/'.$theme->logo}}"
                                alt="" width="140" /></a>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 20px 0">
                        <p>Hello <strong>{{ $name }}</strong>,</p>
                        <p>
                            We have received your payment of <b>{{ number_format($total) }}</b> Taka from
                            <b>{{ $organization }}</b> under the category of
                            <b>"{{ $category }}"</b> successfully @if ($card_issuer != '')
                                through <b>{{ $card_issuer }}</b>
                                @else
                                    by <b>online payment</b>
                            @endif.
                            Your submission id is <b>{{ $transaction_id }}.</b>
                        </p>
                        <p>
                            If you have any concerns, please do not hesitate to
                            contact us. We are always happy to help.
                        </p>
                        <p>Best regards,<br /><strong>Team {{Config::get('app.name')}}</strong></p>
                    </td>
                </tr>
            </table>
        </div>
    </center>
    <table width="100%" class="footer">
        <tr>
            <td style="text-align: center; padding: 10px 0px">
                <h3>Follow our events and news on our social networks</h3>
                <a href="https://www.facebook.com/Official.BBF" class="fa"><img
                                src="https://cdn.bbf.digital/wp-content/uploads/2024/09/22180519/facebook.png" alt="Facebook"></a>

                        <a href="https://twitter.com/BBFBangladesh" class="fa"><img
                                src="https://cdn.bbf.digital/wp-content/uploads/2024/09/22180517/twitter.png" alt="Twitter"></a>

                        <a href="https://www.linkedin.com/company/bangladesh-brand-forum/mycompany/" class="fa"><img
                                src="https://cdn.bbf.digital/wp-content/uploads/2024/09/22180515/linkedin.png" alt="Linkedin"></a>

                        <a href="https://www.youtube.com/@BangladeshBrandForum" class="fa"><img
                                src="https://cdn.bbf.digital/wp-content/uploads/2024/09/22180523/youtube.png" alt="Youtube"></a>

                        <a href="https://www.instagram.com/bangladesh_brand_forum/" class="fa"><img
                                src="https://cdn.bbf.digital/wp-content/uploads/2024/09/22180521/instagram.png" alt="Instagram"></a>

                <p>© {{ now()->year }} Bangladesh Brand Forum. All rights reserved.</p>
            </td>
        </tr>
    </table>
</body>

</html>
