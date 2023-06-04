@include('components.dashcss')
@include('receptionist.components.aside')
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
                            <h4 class="card-title">Patients List</h4>

                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#createDoctorModal">
                            Register Patient
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
                            <table class="table" id="datatable" data-toggle="data-table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Age</th>
                                        <th>Blood Group</th>
                                        <th>Insurance</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patients as $patient)
                                        <tr>
                                            <td>{{ $patient->id }}</td>
                                            <td>{{ $patient->code }}</td>
                                            <td>{{ $patient->name }}</td>
                                            <td>{{ $patient->gender }}</td>
                                            <td>{{ $patient->age }}</td>
                                            <td>{{ $patient->blood_group }}</td>
                                            <td>{{ $patient->insurance }}</td>
                                            <td>
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#createOrderModal"
                                                    data-patient-id="{{ $patient->id }}">Create Order</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Modal for adding doctor -->
                            <div class="modal fade" id="createDoctorModal" tabindex="-1" role="dialog"
                                aria-labelledby="createDoctorModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="createDoctorModalLabel">Create Patient</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('patients.store') }}">
                                                @csrf

                                                <div class="mb-3">
                                                    <label for="code" class="form-label">Code</label>
                                                    <input type="text" class="form-control" id="code"
                                                        name="code" value="{{ Str::random(15) }}" readonly>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="names" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="names"
                                                        name="names" value="{{ old('names') }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="gender" class="form-label">Gender</label>
                                                    <select class="form-control" id="gender" name="gender">
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="age" class="form-label">Age</label>
                                                    <input type="number" class="form-control" id="age"
                                                        name="age" value="{{ old('age') }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="blood_group" class="form-label">Blood Group</label>
                                                    <input type="text" class="form-control" id="blood_group"
                                                        name="blood_group" value="{{ old('blood_group') }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="insurance" class="form-label">Insurance</label>
                                                    <input type="text" class="form-control" id="insurance"
                                                        name="insurance" value="{{ old('insurance') }}">
                                                </div>

                                                <button type="submit" class="btn btn-primary">Register</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.dashfooter')
</main>
@include('components.dashjs')
