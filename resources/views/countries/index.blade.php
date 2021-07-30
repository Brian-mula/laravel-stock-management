@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
    <div class="card">
        @if(session()->has('message'))
        <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card-header bg-dark text-white">
            <div class="row">
                <div class="col">
                    <h4>Countries List</h4>
                </div>
                <div class="col">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#country" class="btn btn-success float-right">Creat Country</a>
                </div>
            </div>
        </div>
        <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($countries as $country)
                <tr>
                    <th scope="row">{{$country->id}}</th>
                    <th>{{$country->name}}</th>
                    <th>
                    <div class="btn-group float-right">
                            <a href="{{route('countries.edit',$country->id)}}" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i>Edit</a>
                            
                            <form method="POST" action="{{route('countries.destroy',$country->id)}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit"><i class="fa fa-trash" aria-hidden="true"></i>Del</button>
                            </form>
                        </div>
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
        </div>
        
    </div>
</div>

<!-- modal for creatind country -->


<!-- Modal -->
<div class="modal right fade" id="country"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="staticBackdropLabel">Create New Country</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times" aria-hidden="true"></i></button>
      </div>
      <div class="modal-body">
        <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('countries.store') }}">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Country name:') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

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
                            {{ __('Create country') }}
                        </button>
                    </div>
                </div>
            </form>
                </div>
        </div>
      </div>
      
    </div>
  </div>
</div>

<!-- modal for editing countries -->

<!-- end of the modal -->


<style>
    .modal.right .modal-dialog{
        top: 0;
        right: 0;
        margin-right: 0;
    }
</style>

@endsection