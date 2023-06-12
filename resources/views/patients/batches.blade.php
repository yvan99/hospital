@include('components.dashcss')
@include('doctor.components.aside')

<style>
    :root {
        --send-bg: #0B93F6;
        --send-color: white;
        --receive-bg: #E5E5EA;
        --receive-text: black;
        --page-background: white;
    }

    body {
        font-family: "Helvetica Neue", Helvetica, sans-serif;
        font-size: 20px;
        font-weight: normal;
        max-width: 450px;
        margin: 50px auto;
        display: flex;
        flex-direction: column;
        background-color: var(--page-background);
    }

    .message {
        max-width: 255px;
        word-wrap: break-word;
        margin-bottom: 12px;
        line-height: 24px;
        position: relative;
        padding: 10px 20px;
        border-radius: 25px;
    }

    .message:before,
    .message:after {
        content: "";
        position: absolute;
        bottom: 0;
        height: 25px;
    }

    .send {
        color: var(--send-color);
        background: var(--send-bg);
        align-self: flex-end;
    }

    .send:before {
        right: -7px;
        width: 20px;
        background-color: var(--send-bg);
        border-bottom-left-radius: 16px 14px;
    }

    .send:after {
        right: -26px;
        width: 26px;
        background-color: var(--page-background);
        border-bottom-left-radius: 10px;
    }

    .receive {
        background: var(--receive-bg);
        color: var(--receive-text);
        align-self: flex-start;
    }

    .receive:before {
        left: -7px;
        width: 20px;
        background-color: var(--receive-bg);
        border-bottom-right-radius: 16px 14px;
    }

    .receive:after {
        left: -26px;
        width: 26px;
        background-color: var(--page-background);
        border-bottom-right-radius: 10px;
    }
</style>
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
                                                <button class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#noteModal"
                                                    data-patient-batch-id="{{ $batch->id }}">Note</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Add this modal markup at the bottom of the view file -->
                            <!-- Create Note Modal -->
                            <div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="noteModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="noteModalLabel">Add Note</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('notes.store') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">

                                                @foreach ($notes as $note)
                                                    @if ($note->user_type === 'doctor')
                                                        <p class="message send">{{ $note->message }}</p>
                                                    @else
                                                        <p class="message receive">{{ $note->message }}</p>
                                                    @endif
                                                @endforeach

                                                <input type="hidden" name="patient_batch_id"
                                                    value="{{ $batch->id }}">
                                                <div class="mb-3">
                                                    <label for="message" class="form-label">Message</label>
                                                    <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Add Note</button>
                                            </div>
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
                    console.log(response)
                    modal.find('.modal-body').html(response);
                }
            });
        });

        $('#sendNoteForm').on('submit', function(event) {
            event.preventDefault();

            var form = $(this);
            var patientBatchId = form.find('#patientBatchId')
        .val(); // Get the patient batch ID from the hidden input

            // Submit the note form via AJAX
            $.ajax({
                url: form.attr('action') + '/' +
                patientBatchId, // Append the patient batch ID to the URL
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
