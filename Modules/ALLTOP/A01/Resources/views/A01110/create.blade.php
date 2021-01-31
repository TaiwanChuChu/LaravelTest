@extends('layouts.app')

@section('title')
    A01110-Base Create
@endsection

@section('content')
    <div class="form-group">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul style="color: white;">
                    @foreach ($errors->all() as $error)
                        <li class="text-dark">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    {{-- optional block --}}
    <div class="mb-3">
        <a href="{{ route('a01110.index') }}" class="btn btn-danger">Exit</a>
    </div>
    <form method="post" action="{{ route('a01110.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
