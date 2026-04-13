<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Komerz - Email</title>
</head>

<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Roboto, Arial, sans-serif; background-color: #f0f2f5;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="padding: 40px 10px;">
        <tr>
            <td align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="600"
                    style="background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 8px 30px rgba(0,0,0,0.1);">

                    <tr>
                        <td align="center" style="background-color: #24292e; padding: 40px 20px;">
                            <h1
                                style="color: #ffffff; margin: 0; font-size: 32px; font-weight: 800; letter-spacing: -1px; text-transform: none;">
                                <span style="color: #4D58AE ;">K</span>
                                <span style="color: #C5C4C4 ;">o m e r</span>
                                <span style="color: #4D58AE ;">z</span>
                            </h1>
                            <p
                                style="color: #C5C4C4; margin-top: 5px; font-size: 14px; text-transform: uppercase; font-weight: 600; letter-spacing: 1px;">
                                {{ __('ui.emailSubject') }}
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 40px 30px;">
                            <h2 style="color: #24292e; font-size: 22px; margin-bottom: 10px; font-weight: 700;">
                                {{ __('ui.new_message_prefix') }}
                                <span style="color: #4D58AE;">{{ __('ui.new_message_highlight') }}</span>
                            </h2>

                            <p style="color: #6c757d; font-size: 15px; margin-bottom: 30px;">
                                {{ __('ui.contactSubtitle') }}
                            </p>

                            <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                style="margin-bottom: 25px;">
                                <tr>
                                    <td
                                        style="padding: 15px; background-color: #f8f9fa; border-radius: 10px; border: 1px solid #e9ecef;">
                                        <p
                                            style="margin: 0 0 8px 0; font-size: 12px; color: #adb5bd; text-transform: uppercase; font-weight: bold;">
                                            {{ __('ui.name') }}</p>
                                        <p style="margin: 0 0 15px 0; color: #24292e; font-weight: 600;">
                                            {{ $contactData['name'] }}</p>

                                        <p
                                            style="margin: 0 0 8px 0; font-size: 12px; color: #adb5bd; text-transform: uppercase; font-weight: bold;">
                                            {{ __('ui.email') }}</p>
                                        <p style="margin: 0 0 15px 0; color: #4e59d1; font-weight: 600;">
                                            {{ $contactData['email'] }}</p>

                                        <p
                                            style="margin: 0 0 8px 0; font-size: 12px; color: #adb5bd; text-transform: uppercase; font-weight: bold;">
                                            {{ __('ui.subject') }}</p>
                                        <p style="margin: 0; color: #24292e;">{{ $contactData['subject'] ?? '---' }}
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <p
                                style="margin: 0 0 8px 0; font-size: 12px; color: #adb5bd; text-transform: uppercase; font-weight: bold;">
                                {{ __('ui.message') }}</p>
                            <div
                                style="background-color: #ffffff; border: 1px solid #e9ecef; color: #495057; padding: 20px; border-radius: 10px; line-height: 1.6; font-size: 15px; white-space: pre-wrap;">
                                {{ $contactData['message'] }}
                            </div>


                        </td>
                    </tr>

                    <tr>
                        <td align="center"
                            style="padding: 30px; background-color: #f8f9fa; border-top: 1px solid #eeeeee;">
                            <p style="margin: 0; color: #adb5bd; font-size: 12px;">
                                {{ __('ui.emailFrom') }} <strong>Komerz Platform</strong>
                            </p>
                            <p style="margin: 5px 0 0 0; color: #ced4da; font-size: 11px;">
                                © {{ date('Y') }} Komerz. Built with style.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
