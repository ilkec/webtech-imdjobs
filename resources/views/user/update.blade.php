@extends('partials.app')

@section('title')
    Profile
@stop

@section('content')
    <h1>Profile</h1>
    <div class="container-profile">
        <div class="container-profile">
        <h4>All fields are required</h4>
            <form action="" method="post" enctype="multipart/form-data">
                @csrf

                @if( $errors->any() )
                    @component('components/alert')
                        @slot('type', 'danger')
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>   
                    @endcomponent
                @endif
     
                <div class="form_group">
                    <p>Profile picture</p>
                    <input type="file" name="image" class="btn mb-3" id="image" accept="image/*">    
                </div>
                <div class="form_group">
                    <label for="firstname">First name *</label>
                    <input value="@if(!empty(old('firstname'))) {{old('firstname')}}  @elseif(!empty($users->first_name)) {{$users->first_name}} @endif" class="form-control" type="text" name="firstname" id="firstname"  placeholder="Enter your first name">
                </div>
                <div class="form_group">
                    <label for="lastname">Last name *</label>
                    <input value="@if(!empty(old('lastname'))) {{old('lastname')}}  @elseif(!empty($users->last_name)) {{$users->last_name}} @endif" class="form-control" type="text" name="lastname" id="lastname" placeholder="Enter your last name">
                </div>
                <div class="form_group">
                    <label for="description">Description *</label>
                    <input value="@if(!empty(old('description'))) {{old('description')}}  @elseif(!empty($users->description)) {{$users->description}} @endif" type="input" name="description" class="form-control" id="description" placeholder="description">
                </div>
                <div class="form_group">
                    <label for="phonenumber">Phonenumber *</label>
                    <input value="@if(!empty(old('phonenumber'))) {{old('phonenumber')}}  @elseif(!empty($users->phone_number)) {{$users->phone_number}} @endif" class="form-control" type="text" name="phonenumber" id="phonenumber"  placeholder="Enter your phonenumber">
                </div>
                <div class="form_group">
                    <label for="city">City *</label>
                    <input value="@if(!empty(old('city'))) {{old('city')}}  @elseif(!empty($users->city)) {{$users->city}} @endif" type="input" name="city" class="form-control" id="city" placeholder="City">
                </div>
                
                @if($users->account_type == 1)
                    <div class="form_group">
                        <label for="education">Education *</label>
                        <input value="@if(!empty(old('education'))) {{old('education')}}  @elseif(!empty($users->education)) {{$users->education}} @endif" class="form-control" type="text" name="education" id="education"  placeholder="Enter your education">
                    </div>
                    <div class="form_group">
                        <label for="school">School *</label>
                        <input value="@if(!empty(old('school'))) {{old('school')}}  @elseif(!empty($users->school)) {{$users->school}} @endif" class="form-control" type="text" name="school" id="school"  placeholder="School">
                    </div>
                    <div class="form_group">
                        <p>Upload your cv</p>
                        <input type="file" name="cv" class="btn mb-3" id="cv" accept=".pdf">
                        <small id="fieldHelp" class="form-text text-muted">pdf files only</small>
                    </div>
                    <div class="form_group">
                        <label for="linkedin">Linkedin profile</label>
                        <input value="@if(!empty(old('linkedin'))) {{old('linkedin')}}  @elseif(!empty($users->linkedin)) {{$users->linkedin}} @endif" class="form-control" type="url" name="linkedin" id="linkedin"  placeholder="Enter the link to your linkedin account">
                    </div>
                    <div class="form_group">
                        <label for="dribbble">Dribbble profile</label>
                        <input value="@if(!empty(old('dribbble'))) {{old('dribbble')}}  @elseif(!empty($users->dribbble)) {{$users->dribbble}} @endif" class="form-control" type="url" name="dribbble" id="dribbble"  placeholder="Enter the link to your dribbble account">
                    </div>
                    <div class="form_group">
                        <label for="behance">Behance profile</label>
                        <input value="@if(!empty(old('behance'))) {{old('behance')}}  @elseif(!empty($users->behance)) {{$users->behance}} @endif" class="form-control" type="url" name="behance" id="behance"  placeholder="Enter the link to your behance account">
                    </div>
                    <div class="form_group">
                        <label for="github">Github profile</label>
                        <input value="@if(!empty(old('github'))) {{old('github')}}  @elseif(!empty($users->github)) {{$users->github}} @endif" class="form-control" type="url" name="github" id="github"  placeholder="Enter the link to your github account">
                    </div>
                    <div class="form_group">
                        <label for="website">Website</label>
                        <input value="@if(!empty(old('website'))) {{old('website')}}  @elseif(!empty($users->website)) {{$users->website}} @endif" class="form-control" type="url" name="website" id="website"  placeholder="Enter the link to your website">
                        
                    </div>
                @endif
                <small id="fieldHelp" class="form-text text-muted">*These fields are required</small>
                <button type="submit" class="btn btn-primary" name="register-student">update profile</button>
            </form>
        </div>
    </div>
@stop 
