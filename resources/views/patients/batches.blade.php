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
                                        <th>Note</th>
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
                                                        {{ $batch->consultation->patientOrder->patient->age }} years
                                                    </li>
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
                                                    {{ $batch->status }}
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#noteModal"
                                                    data-patient-batch-id="{{ $patientBatch->id }}">Note</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Add this modal markup at the bottom of the view file -->
                            <div class="modal fade" id="noteModal" tabindex="-1" role="dialog"
                                aria-labelledby="noteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="noteModalLabel">Patient Batch Notes</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Notes content will be dynamically loaded here -->
                                        </div>
                                        <div class="modal-footer">
                                            <form id="sendNoteForm" action="{{ route('notes.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="patient_batch_id" id="patientBatchId">
                                                <textarea class="form-control" name="message" rows="3" placeholder="Type your message..." required></textarea>
                                                <button type="submit" class="btn btn-primary">Send</button>
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

<script>
    $(function() {
        $('#noteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var patientBatchId = button.data('patient-batch-id'); // Extract info from data-* attributes
            var modal = $(this);

            // Set the patient batch ID in the hidden form input
            modal.find('#patientBatchId').val(patientBatchId);

            // Fetch and load the notes for the patient batch
            $.ajax({
                url: '/doctor/notes/' + patientBatchId,
                type: 'GET',
                dataType: 'html',
                success: function(response) {
                    modal.find('.modal-body').html(response);
                }
            });
        });

        $('#sendNoteForm').on('submit', function(event) {
            event.preventDefault();

            var form = $(this);

            // Submit the note form via AJAX
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'html',
                success: function(response) {
                    $('#noteModal').modal('hide');
                }
            });
        });
    });
</script>
