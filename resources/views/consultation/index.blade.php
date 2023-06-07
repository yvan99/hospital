@include('components.dashcss')
@include('doctor.components.aside')
<main class="main-content">
    <div class="position-relative ">
        <!--Nav Start-->
        @include('components.dasheader')
        <!--Nav End-->
    </div>
    <div class="content-inner container-fluid pb-0" id="page_layout">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Nurses List</h4>

                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#createDoctorModal">
                            Register Nurse
                        </button>

                    </div>
                    <div class="card-body">

                        <!-- Alert div for displaying messages -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="table-responsive border rounded">
                            <table id="datatable" class="table " data-toggle="data-table">
                                <thead>
                                    <tr>
                                        <th>Patient</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($consultations as $consultation)
                                        <tr>
                                            <td>{{ $consultation->patientOrder->patient->name }}</td>
                                            <td>{{ $consultation->description }}</td>
                                            <td>{{ $consultation->status }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#registerBatchModal{{ $consultation->id }}">
                                                    Register Batch
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Modal for registering patient batch -->
                            @foreach ($consultations as $consultation)
                                <div class="modal fade" id="registerBatchModal{{ $consultation->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="registerBatchModalLabel{{ $consultation->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="registerBatchModalLabel{{ $consultation->id }}">Register Patient
                                                    Batch</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('doctors.registerBatch', $consultation->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="nurse_ids">Assign Nurses</label>
                                                        <select name="nurse_ids[]" id="nurse_ids" class="form-control"
                                                            multiple required>
                                                            @foreach ($nurses as $nurse)
                                                                <option value="{{ $nurse->id }}">
                                                                    {{ $nurse->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="code">Code</label>
                                                        <input type="text" name="code" id="code"
                                                            class="form-control" value="{{ Str::random(15) }}"
                                                            readonly>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="status">Status</label>
                                                        <select name="status" id="status" class="form-control"
                                                            required>
                                                            <option value="pending">Pending</option>
                                                            <option value="completed">Completed</option>
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Register</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.dashfooter')
</main>
@include('components.dashjs')
