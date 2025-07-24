@php
    use App\Models\Theme;
    $theme = Theme::findOrFail(1);
@endphp
© {{ now()->year }} {{$theme->footer}}
