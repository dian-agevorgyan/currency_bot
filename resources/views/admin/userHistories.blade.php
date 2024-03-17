<!-- resources/views/admin/userRequests.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Requests for {{ $user->name }}</h1>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Message</th>
            <th>Message ID</th>
            <th>Created</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($histories as $history)
            <tr>
                <td>{{ $history->id }}</td>
                <td>{{ $history->user_id }}</td>
                <td>{{ $history->message }}</td>
                <td>{{ $history->message_id }}</td>
                <td>{{ $history->created_at ?? 'null'}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
