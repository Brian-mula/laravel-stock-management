
<?php

use App\Models\City;
use App\Models\Country;

$countries=Country::all();
$cities=City::all();

?>

@extends('layouts.main')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <div class="row">
                        <div class="col">
                            <h4>Employee List</h4>
                        </div>
                        <a href="#" data-toggle="modal" data-target="#employee" class="btn btn-success float-right">Create Employee</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>First name</th>
                                <th>Last name</th>
                                <th>country</th>
                                <th>City</th>
                                <th>Address</th>
                                <th>salary</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $key=>$employee)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$employee->username}}</td>
                                    <td>{{$employee->first_name}}</td>
                                    <td>{{$employee->last_name}}</td>
                                    <td>{{$employee->country->name}}</td>
                                    <td>{{$employee->city->name}}</td>
                                    <td>{{$employee->address}}</td>
                                    <td>Ksh. {{$employee->salary}}</td>
                                    <td>
                                        <div class="btn-groupe">
                                            <a href="#" class="btn btn-success"><i class="fa fa-edit"></i>Edit</a>
                                            <a href="#" class="btn btn-danger"><i class="fa fa-trash"></i>Del</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal for creating an employee -->
<div class="modal right fade" id="employee" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add an Employee</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
      </div>
      <div class="modal-body">
      <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('employees.store') }}">
                @csrf

                <div class="form-group row">
                    <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username:') }}</label>

                    <div class="col-md-6">
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!-- first name -->
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
                    <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address:') }}</label>

                    <div class="col-md-6">
                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="salary" class="col-md-4 col-form-label text-md-right">{{ __('Salary:') }}</label>

                    <div class="col-md-6">
                        <input id="salary" type="number" min="0" step="0.01" max="1000000" class="form-control @error('salary') is-invalid @enderror" name="salary" value="{{ old('salary') }}" required autocomplete="salary" autofocus>

                        @error('salary')
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
                            {{ __('Add Employee') }}
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
<!-- end of employee creation modal -->

<style>
.modal.right .modal-dialog{
    top: 0;
    right: 0;
    margin-right: 0;
}

</style>
@endsection