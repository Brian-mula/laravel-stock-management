<?php

use App\Models\Country;

$countries=Country::all();
?>
@extends('layouts.main')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{session('message')}}
                </div>
                @endif
                <div class="card-header bg-dark text-white">
                    <div class="row">
                        <div class="col">
                            <h4>List of Cities</h4>
                        </div>
                        <div class="col">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#city" class="btn btn-success float-right">Create City</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Country</th>
                                <th>City</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($cities as $key=> $city)
                            <tr>
                                <th>{{$key + 1}}</th>
                                <th>{{$city->country->name}}</th>
                                <th>{{$city->name}}</th>
                                <th>
                                    <div class="btn-group">
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#cityedit{{$city->id}}" class="btn btn-success"><i class="fa fa-edit"></i>Edit</a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#citydelete{{$city->id}}" class="btn btn-danger"><i class="fa fa-trash"></i>Del</a>
                                    </div>
                                </th>
                            </tr>
                            <!-- modal for editing city -->
                            <div class="modal right fade" id="cityedit{{$city->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create city</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="card">
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('cities.update',$city->id) }}">
                                                @csrf
                                                    @method('PUT')
                                                <div class="form-group row">
                                                    <label for="country_id" class="col-md-4 col-form-label text-md-right">{{ __('Country name:') }}</label>

                                                    <div class="col-md-6">
                                                    <select name="country_id" class="form-control" aria-label="Default select example">
                                                        <option selected>Select Country</option>
                                                        @foreach($countries as $country)
                                                        <option value="{{$country->id}}" {{$country->id == $city->country_id ? 'selected' : ''}}>{{$country->name}}</option>
                                                        @endforeach
                                                        </select>

                                                        @error('country_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('City name:') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$city->name) }}" required autocomplete="name" autofocus>

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
                                                            Update {{$city->name}}
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
                            <!-- end of the editing odal -->

                            <!-- modal for deleting a user -->
                            <div class="modal right fade" id="citydelete{{$city->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create city</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="card">
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('cities.destroy',$city->id) }}">
                                                @csrf
                                                    @method('Delete')
                                                
                                                
                                                    <p class="text-danger">Do you want to delete {{$city->name}}</p>
                                                <div class="form-group row mb-0">
                                                    <div class="col-md-6 offset-md-4">
                                                        <button type="submit" class="btn btn-primary">
                                                            Delete {{$city->name}}
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
                            <!-- end of delete modal -->
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal for creating city -->


<!-- Modal -->
<div class="modal right fade" id="city" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create city</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
      </div>
      <div class="modal-body">
      <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('cities.store') }}">
                @csrf

                <div class="form-group row">
                    <label for="country_id" class="col-md-4 col-form-label text-md-right">{{ __('Country name:') }}</label>

                    <div class="col-md-6">
                    <select name="country_id" class="form-control" aria-label="Default select example">
                        <option selected>Select Country</option>
                        @foreach($countries as $country)
                        <option value="{{$country->id}}">{{$country->name}}</option>
                        @endforeach
                        </select>

                        @error('country_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('City name:') }}</label>

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
                            {{ __('Create City') }}
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
<!-- end of creat modal -->

<style>
.modal.right .modal-dialog{
    top: 0;
    right: 0;
    margin-right: 0;
}
</style>
@endsection