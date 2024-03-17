<!-- resources/views/admin/bot_texts/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Edit Bot Text</h1>

    <form method="POST" action="{{ route('bot_texts.update', ['bot_text' => $text]) }}">
        @csrf
        @method('PUT')
        <label for="text">Text:</label>
        <textarea name="text" id="text" rows="4" required>{{ $text->text }}</textarea>

        <button type="submit">Update</button>
    </form>

    <style>
        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
@endsection
