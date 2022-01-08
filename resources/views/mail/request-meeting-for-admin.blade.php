新しいWeb面談依頼が登録されました。<br>
<a href="{{ route('proposal.show', $proposal->uuid) }}">{{ $proposal->company->name }}様からの提案</a><br>
<br>
第一候補日：{{ $proposal->desired_1_meeting_at?->format('Y/m/d H:i:s') }}<br>
第二候補日：{{ $proposal->desired_2_meeting_at?->format('Y/m/d H:i:s') }}<br>
第三候補日：{{ $proposal->desired_3_meeting_at?->format('Y/m/d H:i:s') }}<br>
<br>
募集企業<br>
企業：{{ $project->createdBy->company->name }}<br>
氏名：{{ $project->createdBy->name }}<br>
メールアドレス：{{ $project->createdBy->email }}<br>
電話番号：{{ $project->createdBy->tel }}<br>
<br>
提案企業<br>
企業：{{ $proposal->createdBy->company->name }}<br>
氏名：{{ $proposal->createdBy->name }}<br>
メールアドレス：{{ $proposal->createdBy->email }}<br>
電話番号：{{ $proposal->createdBy->tel }}<br>
