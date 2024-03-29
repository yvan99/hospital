
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
                            <h4 class="card-title">Patients Requests</h4>

                        </div>

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
                                        <th>Order Code</th>
                                        <th>Description</th>
                                        <th>Payment Status</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patientOrders as $order)
                                        <tr>
                                            <td>{{ $order->code }}</td>
                                            <td>{{ $order->description }}</td>
                                            <td>{{ $order->payment_status }}</td>
                                            <th>{{ $order->created_at }}</th>
                                            <td>
                                                
                                                <!-- Conditional rendering based on is_hod -->
                                                @if (auth()->user()->is_hod && $order->status == 'initiated')
                                                    <!-- Button to trigger assign modal -->
                                                    <button type="button" class="btn btn-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#assignModal{{ $order->id }}">
                                                        Assign
                                                    </button>

                                                    <!-- Assign modal -->
                                                    <div class="modal fade" id="assignModal{{ $order->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="assignModalLabel{{ $order->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="assignModalLabel{{ $order->id }}">Assign
                                                                        Patient Order</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('doctors.assignPatientOrder', $order->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <div class="form-group">
                                                                            <label for="doctor_id">Assign Doctor</label>
                                                                            <select name="doctor_id" id="doctor_id"
                                                                                class="form-control form-select"
                                                                                required>
                                                                                <!-- Populate the doctors options here -->
                                                                                @foreach ($doctors as $doctor)
                                                                                    <option
                                                                                        value="{{ $doctor->id }}">
                                                                                        @if ($doctor->id == auth()->user()->id)
                                                                                            Assign to Me
                                                                                        @else
                                                                                            {{ $doctor->names }}
                                                                                        @endif
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="description">Description</label>
                                                                            <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
                                                                        </div>
                                                                        <button type="submit"
                                                                            class="btn btn-primary">Assign</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <span class="btn btn-sm btn-success">Assigned</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.dashfooter')
</main>
@include('components.dashjs')
