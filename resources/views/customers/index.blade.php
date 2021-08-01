<?php

use App\Models\City;
use App\Models\Country;

$countries=Country::all();
$cities=City::all();

?>

@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <!-- @if(session()->has('message'))
                <div class="alert alert-success">{{session('message')}}</div>
                @endif -->
                <div class="card-header bg-dark text-white">
                    <div class="row">
                        <div class="col">
                            <h4>List Of Customers</h4>
                        </div>
                        <a href="#" data-toggle='modal' data-target="#customer" class="btn btn-success float-right">Add Customer</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Contact</th>
                                <th>Country</th>
                                <th>City</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customers as $key=>$customer)
                                <tr>
                                    <th>{{$key + 1}}</th>
                                    <th>{{$customer->first_name}}</th>
                                    <th>{{$customer->last_name}}</th>
                                    <th>{{$customer->contact}}</th>
                                    <th>{{$customer->country->name}}</th>
                                    <th>{{$customer->city->name}}</th>
                                    <th>
                                        <div class="btn-groupe">
                                            <a href="#" data-toggle="modal" data-target="#customeredit{{$customer->id}}" class="btn btn-success"><i class="fa fa-edit"></i>Edit</a>
                                            <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i>Del</a>
                                        </div>
                                    </th>
                                </tr>
                                <!-- modal for editing customer -->
                                <div class="modal right fade" id="customeredit{{$customer->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-white center" id="exampleModalLabel">Update {{$customer->first_name}}'s details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="card">
                                        <div class="card-body">
                                            <form method="POST" action="{{ route('customers.update',$customer->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group row">
                                                    <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First name:') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name',$customer->first_name) }}" required autocomplete="first_name" autofocus>

                                                        @error('first_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last name:') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name', $customer->last_name) }}" required autocomplete="last_name" autofocus>

                                                        @error('last_name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="contact" class="col-md-4 col-form-label text-md-right">{{ __('Contact:') }}</label>

                                                    <div class="col-md-6">
                                                        <input id="contact" type="tel" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact',$customer->contact) }}" required autocomplete="contact" autofocus>

                                                        @error('contact')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            
                                                <div class="form-group row">
                                                    <label for="country_id" class="col-md-4 col-form-label text-md-right">{{ __('Country name:') }}</label>

                                                    <div class="col-md-6">
                                                    <select name="country_id" class="form-control" aria-label="Default select example">
                                                        <option selected>Select Country</option>
                                                        @foreach($countries as $country)
                                                        <option value="{{$country->id}}" {{$country->id == $customer->country_id ? 'selected' : ''}}>{{$country->name}}</option>
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
                                                    <label for="city_id" class="col-md-4 col-form-label text-md-right">{{ __('City name:') }}</label>

                                                    <div class="col-md-6">
                                                    <select name="city_id" class="form-control" aria-label="Default select example">
                                                        <option selected>Select City</option>
                                                        @foreach($cities as $city)
                                                        <option value="{{$city->id}}" {{$city->id == $customer->city_id ? 'selected' : ''}}>{{$city->name}}</option>
                                                        @endforeach
                                                        </select>

                                                        @error('city_id')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                 <div class="form-group row mb-0">
                                                    <div class="col-md-6 offset-md-4">
                                                        <button type="submit" class="btn btn-primary">
                                                            {{ __('Update customer') }}
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

                                <!-- end of editing modal -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal for creating customer -->
<div class="modal right fade" id="customer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add a customer</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
      </div>
      <div class="modal-body">
      <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('customers.store') }}">
                @csrf

                <div class="form-group row">
                    <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First name:') }}</label>

                    <div class="col-md-6">
                        <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                        @error('first_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last name:') }}</label>

                    <div class="col-md-6">
                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                        @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="contact" class="col-md-4 col-form-label text-md-right">{{ __('Contact:') }}</label>

                    <div class="col-md-6">
                        <input id="contact" type="tel" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required autocomplete="contact" autofocus>

                        @error('contact')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
               
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
                    <label for="city_id" class="col-md-4 col-form-label text-md-right">{{ __('City name:') }}</label>

                    <div class="col-md-6">
                    <select name="city_id" class="form-control" aria-label="Default select example">
                        <option selected>Select City</option>
                        @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                        @endforeach
                        </select>

                        @error('city_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Add customer') }}
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
<!-- end of the creation modsl -->


<style>
    .modal.right .modal-dialog{
        top: 0;
        right: 0;
        margin-right: 0;
    }
    .modal-header{
        background-color: #6f42c1;
    }
</style>
@endsection