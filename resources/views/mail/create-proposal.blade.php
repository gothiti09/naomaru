{{ $proposal->project->company->name }}様<br>
<br>
お世話になっております。{{ config('app.name') }}です。<br>
<br>
御社の募集に新しい提案がありました。<br>
内容を確認してください。<br><br>
<a href="{{ route('proposal.show', $proposal->uuid) }}">{{ $proposal->company->name }}様からの提案</a><br>
<br>
宜しくお願いいたします。
