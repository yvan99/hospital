@include('components.dashcss')
@include('nurse.components.aside')
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
                            <h4 class="card-title">Assigned Patients Batches List</h4>
                        </div>
                        <a href="{{ route('invitations') }}" class="btn btn-primary">
                            Invitations
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive border rounded">
                            <table class="table" id="datatable" data-toggle="data-table">
                                <thead>
                                    <tr>
                                        <th>Batch Code</th>
                                        <th>Consultation Code</th>
                                        <th>Assigned Doctor</th>
                                        <th>Patient Info</th>
                                        <th>Batch Status</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if ($patientBatches->count() > 0)
                                        @foreach ($patientBatches as $batch)
                                            <tr>
                                                <td>{{ $batch->code }}</td>
                                                <td>{{ $batch->consultation->code }}</td>
                                                <td>{{ $batch->consultation->doctor->names }}</td>
                                                <td>

                                                    <ul>
                                                        <li>
                                                            {{ $batch->consultation->patientOrder->patient->names }}
                                                        </li>
                                                        <li>
                                                            {{ $batch->consultation->patientOrder->patient->code }}</li>
                                                        <li>
                                                            {{ $batch->consultation->patientOrder->patient->gender }}
                                                        </li>
                                                        <li>
                                                            {{ $batch->consultation->patientOrder->patient->age }} years
                                                        </li>
                                                    </ul>

                                                </td>

                                                <td>
                                                    <button class="btn btn-success btn-sm">
                                                        {{ $batch->status }}
                                                    </button>
                                                </td>
                                                <td>
                                                    <a href="/nurse/notes/{{ $batch->id }}"
                                                        class="btn btn-sm btn-info">Progress Notes</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <h2>No assigned Consultations</h2>

                                    @endif

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
