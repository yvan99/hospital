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
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Department</th>
                                        <th>Head of Department</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nurses as $nurse)
                                        <tr>
                                            <td>{{ $nurse->id }}</td>
                                            <td>{{ $nurse->name }}</td>
                                            <td>{{ $nurse->email }}</td>
                                            <td>{{ $nurse->phone }}</td>
                                            <td>{{ $nurse->department->name }}</td>
                                            <td>{{ $nurse->is_hod ? 'Yes' : 'No' }}</td>
                                            <td>
                                                <!-- Actions, e.g., edit and delete buttons -->
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
                                            <h5 class="modal-title" id="createDoctorModalLabel">Create Doctor</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('nurses.store') }}">
                                                @csrf

                                                <div class="mb-3">
                                                    <label for="names" class="form-label">Names</label>
                                                    <input type="text" class="form-control" id="names"
                                                        name="names" value="{{ old('names') }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email"
                                                        name="email" value="{{ old('email') }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">Phone</label>
                                                    <input type="text" class="form-control" id="phone"
                                                        name="phone" value="{{ old('phone') }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="text" class="form-control" id="password"
                                                        name="password" value="{{ Str::random(12) }}" required>
                                                    <button type="button" class="btn btn-secondary mt-2"
                                                        onclick="copyPassword()">Copy</button>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="department_id" class="form-label">Department</label>
                                                    <select class="form-control" id="department_id"
                                                        name="department_id">
                                                        @foreach ($departments as $department)
                                                            <option value="{{ $department->id }}">
                                                                {{ $department->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3 form-check">
                                                    <input type="checkbox" class="form-check-input" id="is_hod"
                                                        name="is_hod" value="1">
                                                    <label class="form-check-label" for="is_hod">Head of
                                                        Department</label>
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
