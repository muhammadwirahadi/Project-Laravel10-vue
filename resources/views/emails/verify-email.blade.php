<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email</title>
</head>

<body style="font-family: Arial; background:#f6f6f6; padding:20px;">

    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <table width="500" style="background:white; padding:20px; border-radius:10px;">

                    <!-- LOGO -->
                    <tr>
                        <td align="center">
                            <img src="{{ asset('storage/img/logo-badilag.png') }}" width="40">
                            <h2 style="margin-top:10px; color:#333;">Sistem Informasi Magang Badilag</h2>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <p style="font-size:16px; color:#444;">
                                Halo <strong>{{ $name }}</strong>,
                            </p>
                            <p style="font-size:14px; color:#555;">
                                Terima kasih telah mendaftar. Klik tombol di bawah untuk memverifikasi email Anda.
                            </p>
                        </td>
                    </tr>

                    <!-- Button -->
                    <tr>
                        <td align="center" style="padding-top:20px;">
                            <a href="{{ $url }}"
                                style="background:#3b82f6; color:white; padding:12px 20px; 
                                      border-radius:6px; text-decoration:none; font-size:16px;">
                                Verifikasi Email
                            </a>
                        </td>
                    </tr>

                    <!-- Info tambahan -->
                    <tr>
                        <td style="padding-top:20px; font-size:12px; color:#777;">
                            Jika tombol tidak berfungsi, buka link berikut:
                            <br><br>
                            <a href="{{ $url }}">{{ $url }}</a>
                            <br><br>
                            Email ini otomatis, mohon tidak dibalas.
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top:20px; font-size:12px; color:#777;">
                            Jika Anda tidak merasa membuat akun, abaikan email ini.
                            <br><br>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>

</html>
