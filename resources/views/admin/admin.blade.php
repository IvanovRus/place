@extends('admin.app')
@section('content')
<table class="posters">
	<tr><th>Пользователь</th><th>Описание</th><th>Дейсивие</th></tr>
	@foreach($posters as $poster)
		<tr class="posters__line posters__line--status{{ $poster->status }}" data-poster="{{  $poster->id }}">
			<td>{{ $poster['user']['name'] }}</td>
			<td>{{ $poster->message }}</td>
			<td>
				<button class="js-poster-accept">Принять</button>
				<button class="js-poster-deny">Отклонить</button>
				<button class="js-poster-delete">Удалить</button>
			</td>
		</tr>
	@endforeach
</table>
@endsection