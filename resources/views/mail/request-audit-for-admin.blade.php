新しい監査依頼が登録されました。<br>
以下のユーザに連絡してください。<br>
<br>
企業：{{ $request_audit->createdBy->company->name }}<br>
氏名：{{ $request_audit->createdBy->name }}<br>
メールアドレス：{{ $request_audit->createdBy->email }}<br>
<br>
依頼したいプラン：{{ $request_audit->plan }}<br><br>
監査代行したい案件概要：<br>
{!! nl2br(e($request_audit->description)) !!}
