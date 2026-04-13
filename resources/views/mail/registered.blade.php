<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Komerz - Welcome</title>
</head>

<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Roboto, Arial, sans-serif; background-color: #f0f2f5;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="padding: 40px 10px;">
        <tr>
            <td align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="600"
                    style="background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 8px 30px rgba(0,0,0,0.1);">

                    {{-- Header con Logo --}}
                    <tr>
                        <td align="center" style="background-color: #24292e; padding: 40px 20px;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 32px; font-weight: 800; letter-spacing: -1px;">
                                <span style="color: #4D58AE ;">K</span>
                                <span style="color: #C5C4C4 ;">o m e r</span>
                                <span style="color: #4D58AE ;">z</span>
                            </h1>
                            <p style="color: #C5C4C4; margin-top: 5px; font-size: 14px; text-transform: uppercase; font-weight: 600; letter-spacing: 1px;">
                                {{ __('ui.welcomeTitleRegistered') }}
                            </p>
                        </td>
                    </tr>

                    {{-- Corpo Mail --}}
                    <tr>
                        <td style="padding: 40px 30px;">
                            <h2 style="color: #24292e; font-size: 22px; margin-bottom: 10px; font-weight: 700;">
                                {{ __('ui.hello') }} 
                                <span style="color: #4D58AE;">{{ $user->name }}!</span>
                            </h2>

                            <p style="color: #6c757d; font-size: 15px; margin-bottom: 30px;">
                                {{ __('ui.joinCommunitySuccess') }}
                            </p>

                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 25px;">
                                <tr>
                                    <td style="padding: 15px; background-color: #f8f9fa; border-radius: 10px; border: 1px solid #e9ecef;">
                                        
                                        <p style="margin: 0 0 8px 0; font-size: 12px; color: #adb5bd; text-transform: uppercase; font-weight: bold;">
                                            {{ __('ui.fullName') }}</p>
                                        <p style="margin: 0 0 15px 0; color: #24292e; font-weight: 600;">
                                            {{ $user->name }}</p>

                                        <p style="margin: 0 0 8px 0; font-size: 12px; color: #adb5bd; text-transform: uppercase; font-weight: bold;">
                                            {{ __('ui.email') }}</p>
                                        <p style="margin: 0; color: #4e59d1; font-weight: 600;">
                                            {{ $user->email }}</p>

                                    </td>
                                </tr>
                            </table>

                            {{-- Bottone CTA (opzionale) --}}
                            <div align="center" style="margin-top: 30px;">
                                <a href="{{ url('/') }}" style="background-color: #4D58AE; color: #ffffff; padding: 15px 30px; text-decoration: none; border-radius: 8px; font-weight: bold; display: inline-block;">
                                    {{ __('ui.goToSite') }}
                                </a>
                            </div>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td align="center" style="padding: 30px; background-color: #f8f9fa; border-top: 1px solid #eeeeee;">
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
