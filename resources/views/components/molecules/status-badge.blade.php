@php
$text = App\Models\Visitation::STATUS_LIST[$visitation->status]['text'];
$color = App\Models\Visitation::STATUS_LIST[$visitation->status]['color'];
if ($visitation->status === App\Models\Visitation::STATUS_SCHEDULE_FIX && $visitation->scheduled_start_at?->isToday()) {
    $text = '当日';
    $color = 'blue';
}
@endphp
<p
    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $color }}-100 text-{{ $color }}-800">
    {{ $text }}
</p>
