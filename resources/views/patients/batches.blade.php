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
                            <h4 class="card-title">Patients Batches List</h4>

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
                            <table class="table" id="datatable" data-toggle="data-table">
                                <thead>
                                    <tr>
                                        <th>Batch Code</th>
                                        <th>Consultation Code</th>
                                        <th>Assigned Doctor</th>
                                        <th>Patient Info</th>
                                        <th>Assigned Nurses</th>
                                        <th>Batch Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patientBatches as $batch)
                                        <tr>
                                            <td>{{ $batch->code }}</td>
                                            <td>{{ $batch->consultation->code }}</td>
                                            <td>{{ $batch->consultation->doctor->names }}</td>
                                            <td>

                                                <ul>
                                                    <li>
                                                        {{ $batch->consultation->patientOrder->patient->names }}</li>
                                                    <li>
                                                        {{ $batch->consultation->patientOrder->patient->code }}</li>
                                                    <li>
                                                        {{ $batch->consultation->patientOrder->patient->gender }}</li>
                                                        <li>
                                                            {{ $batch->consultation->patientOrder->patient->age }}</li>
                                                </ul>

                                            </td>
                                            <td>
                                                <ul>
                                                    @foreach ($batch->nurses as $nurse)
                                                        <li>{{ $nurse->names }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                <button class="btn btn-warning btn-sm">
                                                    {{$batch->status}}
                                                </button>
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
