<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Roboto, Arial, sans-serif; background-color: #f0f2f5;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="padding: 40px 10px;">
        <tr>
            <td align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="600"
                    style="background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 8px 30px rgba(0,0,0,0.1);">

                    {{-- Header con Logo (Stile Dark come richiesto) --}}
                    <tr>
                        <td align="center" style="background-color: #24292e; padding: 40px 20px;">
                            <h1
                                style="color: #ffffff; margin: 0; font-size: 32px; font-weight: 800; letter-spacing: -1px;">
                                <span style="color: #4D58AE ;">K</span>
                                <span style="color: #C5C4C4 ;">o m e r</span>
                                <span style="color: #4D58AE ;">z</span>
                            </h1>
                        </td>
                    </tr>

                    {{-- Corpo Mail --}}
                    <tr>
                        <td style="padding: 40px 30px;">
                            <h2 style="color: #24292e; font-size: 22px; margin-bottom: 15px; font-weight: 700;">
                                {{ __('ui.thanksPurchase') }}, <span
                                    style="color: #4D58AE;">{{ $order->user->name }}!</span>
                            </h2>

                            <p style="color: #6c757d; font-size: 16px; margin-bottom: 25px;">
                                {{ __('ui.orderReceived') }} <strong
                                    style="color: #24292e;">#{{ $order->id }}</strong>.
                            </p>

                            {{-- Box Dettagli Ordine --}}
                            <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                style="margin-bottom: 25px;">
                                <tr>
                                    <td
                                        style="padding: 20px; background-color: #f8f9fa; border-radius: 12px; border: 1px solid #e9ecef;">

                                        <p
                                            style="margin: 0 0 5px 0; font-size: 11px; color: #adb5bd; text-transform: uppercase; font-weight: bold; letter-spacing: 0.5px;">
                                            {{ __('ui.shippingAddress') }}
                                        </p>
                                        <p style="margin: 0 0 15px 0; color: #24292e; font-size: 14px;">
                                            {{ $order->address }}, {{ $order->city }}
                                        </p>

                                        <p
                                            style="margin: 0 0 5px 0; font-size: 11px; color: #adb5bd; text-transform: uppercase; font-weight: bold; letter-spacing: 0.5px;">
                                            {{ __('ui.paidWith') }}
                                        </p>
                                        <p style="margin: 0 0 15px 0; color: #24292e; font-size: 14px;">
                                            {{ $brand }}
                                        </p>

                                        <p
                                            style="margin: 0 0 5px 0; font-size: 11px; color: #adb5bd; text-transform: uppercase; font-weight: bold; letter-spacing: 0.5px;">
                                            {{ __('ui.courier') }}
                                        </p>
                                        <p style="margin: 0; color: #24292e; font-size: 14px;">
                                            Komerz Express
                                        </p>

                                    </td>
                                </tr>
                            </table>

                            {{-- Totale --}}
                            <div style="text-align: right; padding: 10px 0;">
                                <p style="font-size: 18px; font-weight: 700; color: #198754; margin: 0;">
                                    {{ __('ui.totalPaid') }}: {{ number_format($order->total_price, 2) }}
                                    {{ __('ui.currency') }}
                                </p>
                            </div>

                        </td>
                    </tr>

                    {{-- Footer --}}
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
