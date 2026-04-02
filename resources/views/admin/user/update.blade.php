@extends('layouts.admin')

@section( 'content')
<h5>Update User</h5>
<br><br>

<form action="{{asset('admin/user/processupdateuser')}}" method='post'>
    @csrf
    <div class="form-group">
        Id User<input type="text" class="form-control" name="id" id="user_id" value="{{$user->id}}" readonly>
    </div>
    <div class="form-group">
        Username<input type="text" class="form-control" id="username" name="username" value="{{$user->username}}" required>
    </div>
    @error ('username')
    <span class="text-danger">{{$message}}</span>
    @enderror
    <div class="form-group">
        Fullname <input type="text" class="form-control" id="full_name" name="full_name" value="{{$user->full_name}}" required>
    </div>
    @error ('full_name')
    <span class="text-danger">{{$message}}</span>
    @enderror

    <div class="form-group">
        Gender
        <select name="gender" class="form-select">
            @foreach($genders as $gender)
            <option value="{{$gender->id}}" {{$user->gender_id == $gender->id ? 'selected' : ''}}>{{$gender->gender_name}}</option>
            @endforeach
        </select>
    </div>
    @error ('gender')
    <span class="text-danger">{{$message}}</span>
    @enderror

    <div class="form-group">
        Phone<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="{{$user->phone}}" required>
    </div>
    @error ('phone')
    <span class="text-danger">{{$message}}</span>
    @enderror

    <div class="form-group">
        Date of birth<input type="text" class="form-control" id="date_of_birth" name="date_of_birth" value="{{DateTime::createFromFormat('Y-m-d', $user->date_of_birth)->format('d/m/Y')}}">
    </div>
    @error ('date_of_birth')
    <span class="text-danger">{{$message}}</span>
    @enderror
    <div class="form-group">
        Email <input type="text" class="form-control" id="email" name="email" value="{{$user->email}}" required>
    </div>
    @error ('email')
    <span class="text-danger">{{$message}}</span>
    @enderror

    <div class="form-group">
        Home Address <input type="text" class="form-control" id="home_address" name="home_address" value="{{$user->home_address}}"required>
    </div>
    @error ('home_address')
    <span class="text-danger">{{$message}}</span>
    @enderror
    <div class="form-group">
        Company Address <input type="text" class="form-control" id="company_address" name="company_address" value="{{$user->company_address}}"required>
    </div>
    @error ('company_address')
    <span class="text-danger">{{$message}}</span>
    @enderror
    <div class="form-group">
        Role
        <select name="role_id" class="form-select">
            @foreach($roles as $role)
            <option value="{{$role->id}}" {{$user->role_id == $role->id ? 'selected' : ''}}>{{$role->role_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        User status
        <select name="user_status_id" class="form-select">
            @foreach($users_status as $userstatus)
            <option value="{{$userstatus->id}}" {{$userstatus->user_status_id == $userstatus->id ? 'selected' : ''}}>{{$userstatus->status_name}}</option>
            @endforeach
        </select>
    </div>
    <div class="modal-footer">
        <a href="{{url('/admin/user')}}"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></a>
        <button type="submit" value="submit" class="btn btn-primary">Edit user</button>
    </div>
</form>

@endsection