@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/users_index.css') }}">
@endsection

@section('content')
<section class="users">
    <div class="users__inner">
        <table class="users-table">
            <thead class="table-head">
                <tr>
                    <th>id</th>
                    <th>名前</th>
                    <th>メールアドレス</th>
                </tr>
            </thead>
            <tbody class="table-data">
                @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td><a href="{{ route('users.attendance' , $user->id ) }}">{{$user->name}}</a></td>
                    <td>{{$user->email}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection