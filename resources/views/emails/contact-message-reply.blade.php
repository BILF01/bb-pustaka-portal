<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $subjectLine }}</title>
</head>
<body style="margin:0;padding:0;background:#f5f7f5;font-family:Arial,Helvetica,sans-serif;color:#222;">
    <table
        role="presentation"
        width="100%"
        cellspacing="0"
        cellpadding="0"
        style="background:#f5f7f5;padding:32px 16px;"
    >
        <tr>
            <td align="center">
                <table
                    role="presentation"
                    width="100%"
                    cellspacing="0"
                    cellpadding="0"
                    style="max-width:640px;background:#ffffff;border-radius:12px;overflow:hidden;border:1px solid #e5e7e5;"
                >
                    <tr>
                        <td style="padding:24px 28px;background:#1b5e20;color:#ffffff;">
                            <div style="font-size:18px;font-weight:700;">
                                BB Pustaka
                            </div>

                            <div style="margin-top:4px;font-size:13px;opacity:.85;">
                                Balai Besar Perpustakaan dan Literasi Pertanian
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:28px;">
                            <p style="margin:0 0 18px;font-size:15px;line-height:1.7;">
                                Yth. {{ $contactMessage->name }},
                            </p>

                            <div style="font-size:15px;line-height:1.8;white-space:pre-line;">{{ $replyMessage }}</div>

                            <div style="margin-top:28px;padding-top:20px;border-top:1px solid #e5e7e5;">
                                <p style="margin:0 0 8px;font-size:12px;font-weight:700;color:#667066;">
                                    PESAN ANDA SEBELUMNYA
                                </p>

                                <div style="padding:14px 16px;background:#f7f8f7;border-radius:8px;font-size:13px;line-height:1.7;color:#596159;white-space:pre-line;">{{ $contactMessage->message }}</div>
                            </div>

                            <p style="margin:28px 0 0;font-size:14px;line-height:1.7;">
                                Hormat kami,<br>
                                <strong>BB Pustaka</strong>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>