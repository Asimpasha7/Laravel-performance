@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('TOP 100 Movies') }}</div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Release Year</th>
                                <th>Avg Rating</th>
                                <th>Votes</th>
                            </tr>
                        </thead>
                        <tbody>

                        {{--@dd($movies )--}}
                                @foreach ($movies as $movie)
                                    <tr>
                                        <td>{{ $loop->iteration }}. {{ $movie->title }}</td>
                                        <td>{{ $movie->category }}</td>
                                        <td>{{ $movie->release_year }}</td>
                                        <td>{{ number_format($movie->average_rating, 2) }}</td>
                                        <td> </td>
                                    </tr>
                                @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
