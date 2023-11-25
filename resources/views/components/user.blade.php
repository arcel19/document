@props(['users'])
<div class="content-wrapper">
    <div class="card-deck text-center">
        <div class="card col-lg-12 mb-4 px-0">
            <div class="card-body ml-11">
                <h5 class="card-title">Users List</h5>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Add User
                </button>


                <div class="table-responsive">
                    <table class="center-aligned-table table">
                        <thead>
                            <tr class="text-primary">
                                <th>User Id</th>
                                <th> Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>User Type</th>
                                <th></th>
                                <th></th>
                                <th>state</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>




                            @foreach ($users as $user )
                            <tr class="">
                                <td>#user{{$user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->user_type }}</td>
                                <td><a href="#" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#viewModal">View</a></td>
                                <td><a href="#" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}">Delete</a></td>
                                <td>
                                    <form action="{{ route('state', $user) }}" method="POST">
                                        <div class="">
                                            @csrf
                                            @method('PUT')
                                            <select id="inputState" class="form-select btn btn-outline-success btn-sm" name="state">
                                                <option value="1" @if ($user->state) selected @endif>active</option>
                                                <option value="0" @unless ($user->state) selected @endunless>in_active</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-outline-success btn-sm"> update</button>
                                    </form>
                                </td>
                            </tr>

 {{-- deleteModal --}}
 <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h1 class="modal-title fs-5" id="deleteModal"> Are you  sure you want to delete it ? </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('user.destroy',$user) }}" method="POSt">
                @method('delete')
                @csrf
                <div class="modal-body text-center">
                    <button type="submit" class="btn  btn-outline-danger">Yes</button>
                    <button type="button" class="btn btn-outline-success" data-bs-dismiss="modal">No</button>

                </div>
            </form>


        </div>
    </div>
</div>
{{-- deleteModal --}}

                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- addModal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Insert an user</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="inputEmail4">
                            @error('email')
                                <p class="text-danger"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="inputPassword4">
                            @error('password')
                                <p class="text-danger"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="inputAddress"
                                placeholder="User name">
                                @error('name')
                                <p class="text-danger"> {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Phone</label>
                            <input type="number" name="phone" class="form-control" id="inputPassword4">
                            @error('phone')
                                <p class="text-danger"> {{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="inputState" class="form-label">User Type</label>
                            <select id="inputState" class="form-select" name="user_type">
                                <option selected>Choose...</option>
                                <option value="Admin">Admin</option>
                                <option value="Teacher">Teacher</option>
                                <option value="Etudiant">Etudiant</option>
                            </select>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>


            </div>
        </div>
    </div>

    {{-- modal --}}

    <!-- viewModal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="viewModal"> Document:</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1"
                            placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1"
                            placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1"
                            placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="formFileMultiple" class="form-label">Multiple files input example</label>
                        <input class="form-control" type="file" id="formFileMultiple" multiple>
                    </div>




                    <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm"
                        aria-label=".form-control-sm example">
                    <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm"
                        aria-label=".form-control-sm example">
                    <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm"
                        aria-label=".form-control-sm example">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal --}}

    <!-- send Modal -->
    <div class="modal fade" id="sendModal" tabindex="-1" aria-labelledby="sendModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="sendModal">Sent document to:</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <select class="form-select" multiple aria-label="Multiple select example">
                        <option selected>Send To : </option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning">Send</button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal --}}


</div>
</div>
{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
      </button>
      <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>

      modal --}}
