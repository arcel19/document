@props(['log'])
<div class="card mb-3 container text-center">
    <div class="card-body">
        @if (
            \App\Models\LogHistory::count() > 0 &&
                (auth()->user()->user_type == 'Admin' || auth()->user()->user_type == 'Teacher'))
            <a href="{{ route('delete-all-log') }}" class="btn btn-outline-danger"><b>Delete all</b></a><br>
        @endif
        <br>
        <table id="myProjectTable" class="table-secondary table-hover mb-2 align-middle" style="width:100%">
            <thead>
                <tr>
                    <th>Log</th>
                    {{-- <th>Time of Login</th> --}}
                    {{-- <th>Action</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach (\App\Models\LogHistory::orderByDesc('created_at')->get() as $log)
                    <tr>
                        <td>{{ $log->message }}</td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center align-items-center mt-3">
    {{-- <button type="button" class="btn btn-lg bg-success text-white fw-bold">DOWNLOAD</button> --}}
</div>

<!-- Delete Log history -->
</div>
<div class="modal fade" id="delete" tabindex="-1" aria-labelledby="deleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-3 fs-lg-5 text-success d-flex font-weight-bold" id="deleteLabel">DELETE ?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body font-weight-bold">
                DO YOU REALLY WANT TO DELETE ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success bg-success btn-lg btn-sm text-white"
                    data-bs-dismiss="modal">NO</button>
                <button type="button" class="btn btn-danger bg-danger btn-lg btn-sm text-white">YES</button>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Row end  -->

</div>
</div>
</div>
