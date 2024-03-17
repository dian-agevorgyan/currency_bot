<!-- resources/views/admin/bot_texts/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Bot Texts</h1>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Slug</th>
            <th>Text</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($texts as $text)
            <tr>
                <td>{{ $text->id }}</td>
                <td>{{ $text->slug }}</td>
                <td>{{ $text->text }}</td>
                <td>
                    <a href="{{ route('bot_texts.edit', $text) }}">Edit</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
