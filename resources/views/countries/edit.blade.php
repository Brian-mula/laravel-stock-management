@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <div class="row">
                    <div class="col"><h4>Update {{$country->name}}</h4></div>
                    <div class="col">
                        <a href="{{route('countries.index')}}" class="btn btn-success float-right">Back</a>
                    </div>
                </div>
            </div>
        <div class="card-body">
            <form method="POST" action="{{ route('countries.update',$country->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Country name:') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$country->name) }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Update {{$country->name}}
                        </button>
                    </div>
                </div>
            </form>
                </div>
        </div>
        </div>
    </div>
</div>
@endsection