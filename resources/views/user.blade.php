@extends('layout')
@section('page-title', $user->name)

@section('page-content')
<section id="main">
    <header>
        <span class="avatar"><img src="/images/users/{{ $user->id }}.jpg" alt="" /></span>
        <h1>{{ $user->name }}</h1>
        <div>{{ $user->comments }}</div>
    </header>
</section>

<footer id="footer">
    <ul class="copyright">
        <li>&copy; Pictureworks</li>
    </ul>
</footer>
@endsection