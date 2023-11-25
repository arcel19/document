@props(['document'])
<div class="content-wrapper">
    <div class="card-deck text-center">
        <div class="card col-lg-12 mb-4 px-0">
            <div class="card-body ml-11">
                <h5 class="card-title">Outbound</h5>

                <!-- Button trigger modal -->



                <div class="table-responsive">
                    <table class="center-aligned-table table">
                        <thead>
                            <tr class="text-primary">
                                <th>document Id</th>
                                <th>document Name</th>
                                <th>Created On</th>
                                <th>N_ Files</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($document as $doc)
                                <tr class="">
                                    <td>#doc{{ $doc->id }}</td>
                                    <td>{{ $doc->name }}</td>
                                    <td>{{ \Carbon\carbon::parse($doc->created_at)->format('d, M,Y') }}</td>
                                    <td>{{ $doc->file->count() }}</td>
                                    <td>Credit card</td>
                                    <td><a href="#" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#viewModal{{ $doc->id }}">View</a></td>
                                    <td><a href="#" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $doc->id }}">Delete</a></td>
                                    <td><a href="#" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#sendModal{{ $doc->id }}">Send</a></td>
                                </tr>

                                <!-- viewModal -->
                                <div class="modal fade" id="viewModal{{ $doc->id }}" tabindex="-1"
                                    aria-labelledby="viewModal" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="viewModal"> Document:
                                                    {{ $doc->name }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">List of Files:</label>
                                                    @forelse ($doc->file->where('document_id', $doc->id) as $f)
                                                        <div class="container mb-3">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <div class="row">
                                                                                <div class="col-8">
                                                                                    <h5 class="card-title">{{ $f->name }}</h5>
                                                                                </div>
                                                                                <div class="col-4 text-end">
                                                                                    <a href="{{ $f->path }}" target="_blank" class="btn btn-warning">
                                                                                        <i class="fa fa-eye"></i> View
                                                                                    </a>
                                                                                    <a href="{{ $f->path }}" class="btn btn-success" download="{{ $f->name }}">
                                                                                        <i class="fa fa-download"></i> Download
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <p>No documents found.</p>
                                                    @endforelse
                                                </div>



                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- modal --}}


                                 <!-- send Modal -->
    <div class="modal fade" id="sendModal{{ $doc->id }}" tabindex="-1" aria-labelledby="sendModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="sendModal">Sent document to:</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('send',$doc->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                    <select class="form-select" multiple aria-label="Multiple select example" name="receiver[]">
                        @foreach ( \App\Models\user::all() as $user )
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                        {{-- <option selected>Send To : </option> --}}


                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Send</button>
                </div>
            </form>

            </div>
        </div>
    </div>

    {{-- modal --}}

    {{-- deleteModal --}}
 <div class="modal fade" id="deleteModal{{ $doc->id }}" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h1 class="modal-title fs-5" id="deleteModal"> Are you  sure you want to delete it ? </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('document.destroy',$doc) }}" method="POSt">
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Insert a Document</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('document.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Document Name</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" name='name'
                                placeholder="Document name">
                            @error('name')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">Multiple files </label>
                            <input class="form-control" type="file" name="path[]" id="formFileMultiple" multiple>
                            @error('path')
                                <span class="text-danger"> {{ $message }}</span>
                            @enderror
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
