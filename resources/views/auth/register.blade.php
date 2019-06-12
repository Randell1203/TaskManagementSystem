@extends('layouts.app')

@section('content')
<div class="row justify-content-center my-2">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header font-weight-bold">{{ __('Create Account') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="firstName">First Name <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" placeholder="Ex. Juan" id="firstName" name="firstName">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="middleName">Middle Name <span class="text-primary">(optional)</i></label>
                            <input type="text" class="form-control" placeholder="Ex. Carlos" id="middleName" name="middleName">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="lastName">Last Name <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" placeholder="Ex. Dela Cruz" id="lastName" name="lastName">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email Address <i class="text-danger">*</i></label>
                            <input type="email" class="form-control" placeholder="Ex. juanCarlos23@gmail.com" id="email" name="email">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="username">Username <i class="text-danger">*</i></label>
                            <input type="text" class="form-control" placeholder="Ex. JuanDelaCruz03" id="username" name="username">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">Password <i class="text-danger">*</i></label>
                            <input type="password" class="form-control"  id="password" name="password">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="password_confirmation">Confirm Password <i class="text-danger">*</i></label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="contactNo">Contact No. <span class="text-primary">(optional)</i></label>
                            <input type="text" class="form-control" placeholder="Ex. 09501234567" id="contactNo" name="contactNo">
                        </div>

        
                        <div class="form-group col-md-6">
                            <label for="userType">User Type <i class="text-danger">*</i></label>
                            <select name="userType" id="userType" class="form-control">
                                <option value="0" disabled selected>--Select User Type--</option>
                                <option value="1">Admin</option>
                                <option value="1">Manager</option>
                                <option value="2">Team Leader</option>
                                <option value="3">Team Member</option>
                            </select>
                        </div>
                        
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="department">Department <i class="text-danger">*</i></label>
                            <select name="department" id="department" class="form-control">
                                <option value="0" disabled selected>--Select Department--</option>
                                <option value="1">Information Technology</option>
                                <option value="2">Accounting</option>
                                <option value="3">Marketing</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="jobTitle">Job Title <i class="text-danger">*</i></label>
                            <select name="jobTitle" id="jobTitle" class="form-control">
                                <option value="0" disabled selected>--Select Job Title--</option>
                                <option value="1">Software Developer</option>
                                <option value="2">Ghrapic Designer</option>
                                <option value="3">System Admin</option>
                            </select>
                        </div>
                    </div>

                    
                    <div class="form-group row mb-0">
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-secondary">
                                {{ __('Clear') }} <i class="fas fa-undo"></i>
                            </button>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Create Account') }} <i class="fas fa-user"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
