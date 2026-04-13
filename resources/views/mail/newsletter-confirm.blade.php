<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komerz - Newsletter</title>
    <style>
        /* Questo assicura che su Maildev e mobile la tabella si stringa */
        @media screen and (max-width: 600px) {
            .main-table {
                width: 100% !important;
            }

            .content-td {
                padding: 20px !important;
            }
        }
    </style>
</head>

<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Helvetica, Arial, sans-serif; background-color: #f0f2f5;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%"
        style="padding: 20px 10px; background-color: #f0f2f5;">
        <tr>
            <td align="center">
                <table class="main-table" border="0" cellpadding="0" cellspacing="0" width="600"
                    style="background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 8px 30px rgba(0,0,0,0.1); max-width: 600px; width: 100%;">

                    {{-- HEADER --}}
                    <tr>
                        <td align="center" style="background-color: #24292e; padding: 40px 20px;">
                            <h1
                                style="color: #ffffff; margin: 0; font-size: 32px; font-weight: 800; letter-spacing: -1px; line-height: 1;">
                                <span style="color: #4D58AE;">K </span>
                                <span style="color: #C5C4C4;">o m e r</span>
                                <span style="color: #4D58AE;"> z</span>
                            </h1>
                            <p
                                style="color: #C5C4C4; margin: 10px 0 0 0; font-size: 14px; text-transform: uppercase; font-weight: 600; letter-spacing: 1px;">
                                {{ __('ui.newsletter_welcome_title') }}
                            </p>
                        </td>
                    </tr>

                    {{-- BODY --}}
                    <tr>
                        <td class="content-td" style="padding: 40px 30px; text-align: center;">
                            <h2
                                style="color: #24292e; font-size: 24px; margin: 0 0 10px 0; font-weight: 700; line-height: 1.2;">
                                {{ __('ui.newsletter_thanks') }}
                                <span style="color: #4D58AE;">{{ __('ui.newsletter_community') }}</span>
                            </h2>
                            <p style="color: #6c757d; font-size: 16px; line-height: 1.6; margin: 0 0 30px 0;">
                                {{ __('ui.newsletter_message_body') }}
                            </p>

                            <div
                                style="background-color: #f8f9fa; padding: 20px; border-radius: 10px; border: 1px solid #e9ecef; display: inline-block; min-width: 200px;">
                                <p
                                    style="margin: 0; font-size: 12px; color: #adb5bd; text-transform: uppercase; font-weight: bold; letter-spacing: 1px;">
                                    {{ __('ui.email') }}
                                </p>
                                <p
                                    style="margin: 5px 0 0 0; color: #4D58AE; font-weight: 600; font-size: 18px; word-break: break-all;">
                                    {{ $email }}
                                </p>
                            </div>
                        </td>
                    </tr>

                    {{-- FOOTER --}}
                    <tr>
                        <td align="center"
                            style="padding: 30px; background-color: #f8f9fa; border-top: 1px solid #eeeeee;">
                            <p style="margin: 0; color: #adb5bd; font-size: 12px; line-height: 1.4;">
                                {{ __('ui.emailFrom') }} <strong>Komerz Platform</strong>
                            </p>
                            <p style="margin: 5px 0 0 0; color: #ced4da; font-size: 11px;">
                                © {{ date('Y') }} Komerz.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
