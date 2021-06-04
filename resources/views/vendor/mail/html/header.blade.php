<tr>
<td class="header">
<a href="{{route('inicios.index')}}" height="50" width="200">
@if (trim($slot) === 'Laravel')
<img src="https://i.postimg.cc/Y9pdhC1p/logo.png">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
