<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Komerz - Richiesta Revisore</title>
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
                                style="color: #ffffff; margin: 0; font-size: 32px; font-weight: 800; letter-spacing: -1px;">
                                <span style="color: #4D58AE;">K</span>
                                <span style="color: #C5C4C4;">o m e r</span>
                                <span style="color: #4D58AE;">z</span>
                            </h1>
                            <p
                                style="color: #C5C4C4; margin-top: 5px; font-size: 14px; text-transform: uppercase; font-weight: 600; letter-spacing: 1px;">
                                {{ __('ui.revisorMailTitle') }}
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 40px 30px;">
                            <h2 style="color: #24292e; font-size: 22px; margin-bottom: 10px; font-weight: 700;">
                                {{ __('ui.revisorCandidateTitle') }} <span
                                    style="color: #4D58AE;">{{ __('ui.revisor') }}</span>
                            </h2>
                            <p style="color: #6c757d; font-size: 15px; margin-bottom: 30px;">
                                {{ __('ui.revisorMailSubtitle') }}
                            </p>

                            <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                style="margin-bottom: 30px;">
                                <tr>
                                    <td
                                        style="padding: 20px; background-color: #f8f9fa; border-radius: 12px; border: 1px solid #e9ecef;">
                                        <p
                                            style="margin: 0 0 5px 0; font-size: 12px; color: #adb5bd; text-transform: uppercase; font-weight: bold;">
                                            {{ __('ui.name') }}</p>
                                        <p
                                            style="margin: 0 0 15px 0; color: #24292e; font-weight: 600; font-size: 16px;">
                                            {{ $user->name }}</p>

                                        <p
                                            style="margin: 0 0 5px 0; font-size: 12px; color: #adb5bd; text-transform: uppercase; font-weight: bold;">
                                            {{ __('ui.email') }}</p>
                                        <p style="margin: 0; color: #4e59d1; font-weight: 600; font-size: 16px;">
                                            {{ $user->email }}</p>
                                    </td>
                                </tr>
                            </table>

                            <p
                                style="color: #495057; font-size: 15px; line-height: 1.6; margin-bottom: 25px; text-align: center;">
                                {{ __('ui.revisorMailAction') }}
                            </p>

                            <div style="text-align: center; margin-bottom: 20px;">
                                <a href="{{ route('make.revisor', compact('user')) }}"
                                    style="background-color: #4e59d1; color: #ffffff; padding: 18px 45px; border-radius: 12px; text-decoration: none; font-weight: bold; font-size: 15px; display: inline-block; box-shadow: 0 4px 15px rgba(78, 89, 209, 0.3); text-transform: uppercase;">
                                    {{ __('ui.revisorMailButton') }}
                                </a>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td align="center"
                            style="padding: 30px; background-color: #f8f9fa; border-top: 1px solid #eeeeee;">
                            <p style="margin: 0; color: #adb5bd; font-size: 12px;">
                                {{ __('ui.emailFrom') }} <strong>Komerz Admin Panel</strong>
                            </p>
                            <p style="margin: 5px 0 0 0; color: #ced4da; font-size: 11px;">
                                © {{ date('Y') }} Komerz. Gestione Collaboratori.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
