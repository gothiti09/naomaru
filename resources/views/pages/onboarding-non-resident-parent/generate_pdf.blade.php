<!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body {
            font-family: ipaexm;
        }

    </style>
</head>

<body>
    <h6>{{ today()->format('Y年m月d日') }}</h6>
    <h3 style="text-align: center">面会交流サービス「らえる」のご登録のお願い</h3>
    <h6 style="text-align: right">らえる事務局</h6>

    <h5>
        面会交流の日程や場所調整等を面会交流サービス「らえる」を通じて行えるように、<br>
        以下のQRコードよりご登録いただきますよう、よろしくお願い致します。
    </h5>

    <h4 style="margin: 20px 0px 5px 0px;">１．面会交流サービス「らえる」とは</h4>
    <h5 style="margin: 5px 15px;">
        面会交流の支援に特化したウェブサービスとなります。<br>
        普段ご利用されているスマートフォンやパソコンのブラウザで、先方と連絡先を交換せずに<br>
        面会交流の日時・場所の調整や当日の連絡、緊急連絡を簡単に行うことができます。<br>
        詳細は、「らえる」の公式サイトをご覧ください。<br>
        公式サイト：<a href="https://raeru.jp" target="_blank">https://raeru.jp</a>

    </h5>
    <h4 style="margin: 20px 0px 5px 0px;">２．登録方法</h4>
    <h5 style="margin: 5px 15px;">
        以下のQRコードを読み取り、氏名、メールアドレス等の登録をお願いします。<br>
        なお、登録内容は相手には開示されませんので、ご安心ください。
    </h5>
    <div>
        <img src="{!! $dataUri !!}">
    </div>

    <h4 style="margin: 20px 0px 5px 0px;">３．使用方法</h4>
    <h5 style="margin: 5px 15px;">
        直感で操作ができるように工夫しておりますが、よく頂く質問に対して回答をしています。<br>
        よくある質問：<a href="https://raeru.jp/faq" target="_blank">https://raeru.jp/faq</a>
    </h5>

    <h4 style="margin: 20px 0px 5px 0px;">４．お問い合わせ</h4>
    <h5 style="margin: 5px 15px;">
        らえる事務局：info@raeru.jp<br>
        ※本サービスにおけるお問い合わせ先であり、<br>
        面会交流についてのお問い合わせは一切受け付けておりません。
    </h5>
    <h5>以上</h5>

</body>

</html>
