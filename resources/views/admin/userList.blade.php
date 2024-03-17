<!-- resources/views/admin/userList.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>User List</h1>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>First name</th>
            <th>Last name</th>
            <th>Telegram ID</th>
            <th>Telegram username</th>
            <th>Language code</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td><a href="{{ route('admin.userHistories', ['userId' => $user->id]) }}">{{ $user->id }}</a></td>
                <td>{{ $user->first_name }}</td>
                <td>{{ $user->last_name ?? 'null' }}</td>
                <td>{{ $user->telegram_id }}</td>
                <td>{{ $user->telegram_username }}</td>
                <td>{{ $user->language_code }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
