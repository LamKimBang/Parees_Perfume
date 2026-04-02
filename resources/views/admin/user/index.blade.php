@extends('layouts.admin')

@section( 'content')
<!-- user -->
<div class="container-fluid">
    <!-- filter -->
    <div class="form-group">
        <div class="row ">
            <div class="col-sm-2">
                <button id="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="fas fa-plus"></i>
                    &nbsp;
                    Create user</button>

            </div>
        </div>
    </div>

    <!-- Phần table list user -->
    <div class="form-group">
        <div class="row">
            <div class="col-sm-12">
                <table class="table table-striped table-busered table-hover" id="table-user">
                    <thead class="bg-dark ">
                        <tr>
                            <th>#</th>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Date of Birth</th>
                            <th>Full name</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Home Address</th>
                            <th>Company Address</th>
                            <th>User status</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td></td>
                            <td>{{$user->id}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{Datetime::createFromFormat('Y-m-d',$user->date_of_birth)->format('d/m/Y') }}</td>
                            <td>{{$user->full_name}}</td>
                            <td>{{$user->gender_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->home_address}}</td>
                            <td>{{$user->company_address}}</td>
                            <td>{{$user->status_name}}</td>
                            <td>{{$user->role_name}}</td>
                            <td>
                                <a href="{{url('/admin/user/updateuser?id=' . $user->id)}}"> <i class="fas fa-edit text-primary edit-user" style="cursor: pointer;" data-toggle="tooltip" title="Edit user">&nbsp;</i></a>
                            </td>
                         
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Phần paging-->
    <div class="row form-group pt-3">
        <div class="col-sm-12 ">
            <ul id="ul-paging" class="pagination justify-content-center">

            </ul>
        </div>
    </div>

</div>

<!-- Add -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{asset('admin/user/insert')}}" id="register_form" method='post'>
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">

                    </div>
                    @error ('username')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div class="form-group">
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Fullname" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Fullname'">
                    </div>
                    @error ('full_name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div class="form-group">
                        <select name="gender" class="form-select">
                            @foreach($genders as $gender)
                            <option value="{{$gender->id}}">{{$gender->gender_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error ('gender')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div class="form-group">
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone'">
                    </div>
                    @error ('phone')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div class="form-group">
                        <input type="text" class="form-control" id="date_of_birth" name="date_of_birth" placeholder="Date of Birth (mm/dd/yyyy)" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Date of Birth'">
                    </div>
                    @error ('date_of_birth')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div class="form-group">
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email Address'">
                    </div>
                    @error ('email')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div class="form-group">
                        <input type="text" class="form-control" id="home_address" name="home_address" placeholder="Home Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Home Address'">
                    </div>
                    @error ('home_address')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div class="form-group">
                        <input type="text" class="form-control" id="company_address" name="company_address" placeholder="Company Address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Company Address'">
                    </div>
                    @error ('company_address')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                    </div>
                    @error ('password')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div class="form-group">
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'">
                    </div>
                    @error ('confirmPassword')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" value="submit" class="btn btn-primary" name="btnInsert">Add user</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- EDIT -->
<div class="modal fade" id="modal-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{asset('admin/user/updateUser')}}?id={{$user->id}}" id="register_form" method='post'>
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control" name="user_id" id="user_id" readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="username_update" name="username">
                    </div>
                    @error ('username')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div class="form-group">
                        <input type="text" class="form-control" id="full_name_update" name="full_name" placeholder="Fullname">
                    </div>
                    @error ('full_name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror

                    <div class="form-group">
                        <select name="gender_update" class="form-select">
                            @foreach($users as $user)
                            @foreach($genders as $gender)
                            <option value="{{$gender->id}}" @if($gender->id == $user->ge_id) selected="selected" @endif>{{$gender->gender_name}}</option>
                            @endforeach
                            @endforeach
                        </select>
                    </div>
                    @error ('gender')
                    <span class="text-danger">{{$message}}</span>
                    @enderror

                    <div class="form-group">
                        <input type="text" class="form-control" id="phone_update" name="phone" placeholder="Phone">
                    </div>
                    @error ('phone')
                    <span class="text-danger">{{$message}}</span>
                    @enderror

                    <div class="form-group">
                        <input type="text" class="form-control" id="date_of_birth_update" name="date_of_birth">
                    </div>
                    @error ('date_of_birth')
                    <span class="text-danger">{{$message}}</span>
                    @enderror


                    <div class="form-group">
                        <input type="text" class="form-control" id="email_update" name="email" placeholder="Email Address">
                    </div>
                    @error ('email')
                    <span class="text-danger">{{$message}}</span>
                    @enderror

                    <div class="form-group">
                        <input type="text" class="form-control" id="home_address_update" name="home_address" placeholder="Home Address">
                    </div>
                    @error ('home_address')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div class="form-group">
                        <input type="text" class="form-control" id="company_address_update" name="company_address">
                    </div>
                    @error ('company_address')
                    <span class="text-danger">{{$message}}</span>
                    @enderror


                    <div class="form-select">
                        <select id="role_update" name="role" class="form-select">
                            @foreach($roles as $role)
                            <option value="{{$role->id}}">{{$role->role_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-select">
                        <select name="status_update" class="form-select">
                            @foreach($users_status as $userstatus)
                            <option value="{{$userstatus->id}}">{{$userstatus->status_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" value="submit" class="btn btn-primary">Edit user</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    index = 1;
    var table = $('#table-user').DataTable({
        columnDefs: [{ // map column index
                targets: 0,
                render: function() {
                    return index++;
                }
            },

            // { // map column Action
            //     targets: 12,
            //     class: "text-center",
            //     render: function() {
            //         return `
            //             <i class="fas fa-edit text-primary edit-user" 
            //             style="cursor: pointer;" data-toggle="tooltip" title="Confirm">
            //             `;
            //     }
            // }
        ],
    });

    // $(document).ready(function(pThis) {
    //     table;
        // click icon edit user open form UPDATE user
        // $('#table-user').on('click', '.edit-user', function() {
        //     $('#modal-user').modal("show");
        //     var tableRow = $(this).parents('tr');
        //     var dataCell = table.row(tableRow).data();
        //     $('#user_id').val(dataCell[1]);
        //     $('#username_update').val(dataCell[2]);
        //     $('#date_of_birth_update').val(dataCell[3]);
        //     $('#full_name_update').val(dataCell[4]);
        //     $('#gender_update').val(dataCell[5]);
        //     $('#email_update').val(dataCell[6]);
        //     $('#phone_update').val(dataCell[7]);
        //     $('#home_address_update').val(dataCell[8]);
        //     $('#company_address_update').val(dataCell[9]);
        //     $('#user_status').val(dataCell[10]);
        //     $('#role_update').val(dataCell[11]);
            // $('#role_id').val(dataCell[12]);
            // $('#status_id').val(dataCell[13]);
    //         // $('#gender_id').val(dataCell[14]);
    //     });
    // });
</script>
@endsection