<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office"
    xmlns:v="urn:schemas-microsoft-com:vml">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta content="width=device-width" name="viewport" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <title></title>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
        }

        table,
        td,
        tr {
            vertical-align: top;
            border-collapse: collapse;
        }

        * {
            line-height: inherit;
        }

        a[x-apple-data-detectors=true] {
            color: inherit !important;
            text-decoration: none !important;
        }

    </style>
    <style id="media-query" type="text/css">
        @media (max-width: 520px) {

            .block-grid,
            .col {
                min-width: 320px !important;
                max-width: 100% !important;
                display: block !important;
            }

            .block-grid {
                width: 100% !important;
            }

            .col {
                width: 100% !important;
            }

            .col>div {
                margin: 0 auto;
            }

            img.fullwidth,
            img.fullwidthOnMobile {
                max-width: 100% !important;
            }

            .no-stack .col {
                min-width: 0 !important;
                display: table-cell !important;
            }

            .no-stack.two-up .col {
                width: 50% !important;
            }

            .no-stack .col.num4 {
                width: 33% !important;
            }

            .no-stack .col.num8 {
                width: 66% !important;
            }

            .no-stack .col.num4 {
                width: 33% !important;
            }

            .no-stack .col.num3 {
                width: 25% !important;
            }

            .no-stack .col.num6 {
                width: 50% !important;
            }

            .no-stack .col.num9 {
                width: 75% !important;
            }

            .video-block {
                max-width: none !important;
            }

            .mobile_hide {
                min-height: 0px;
                max-height: 0px;
                max-width: 0px;
                display: none;
                overflow: hidden;
                font-size: 0px;
            }

            .desktop_hide {
                display: block !important;
                max-height: none !important;
            }
        }

    </style>
</head>

<body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #FFFFFF;">
    <table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; Margin: 0 auto; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; width: 100%;" valign="top" width="100%">
        <tbody>
            <tr style="vertical-align: top;" valign="top">
                <td style="word-break: break-word; vertical-align: top;" valign="top">
                    <div style="background-color:transparent;">
                        <div class="block-grid"
                            style="Margin: 0 auto; min-width: 320px; max-width: 500px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;">
                            <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
                                <div class="col num12"
                                    style="min-width: 320px; max-width: 500px; display: table-cell; vertical-align: top; width: 500px;">
                                    <div style="width:100% !important;">
                                        <div
                                            style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
                                            <div
                                                style="font-size:16px;text-align:center;font-family:Arial, Helvetica Neue, Helvetica, sans-serif">
                                                <div class="our-class">
                                                    <p style="text-align:justify">
                                                        Dear Marketing Team, <br /><br /><br />
                                                        There is a new {{$data->rsvp_type}} has been made with following
                                                        information below.
                                                    </p>
                                                    <br /><br /><br />
                                                    <table border="0" style="text-align:left">
                                                        <tr>
                                                            <td>Date</td>
                                                            <td>:</td>
                                                            <td>{{$data->date}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Reservation Number</td>
                                                            <td>:</td>
                                                            <td>{{$data->reservation_id}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Name</td>
                                                            <td>:</td>
                                                            <td>{{$data->cust_name}}</td>
                                                        </tr>
                                                    </table>
                                                    <br /><br /><br />
                                                    <p style="text-align:justify">
                                                        Please visit the back office site for more details by <a
                                                            href="{{route('reservation.index')}}">Click Here</a>.
                                                        <br /><br /><br />
                                                        Thanks for your attention.
                                                        <br /><br />
                                                        Regards,
                                                        <br /><br /><br />
                                                        Horison Team.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
