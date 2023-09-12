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
                            <h4 class="card-title">Nurses shifts scheduler</h4>
                        </div>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#createDoctorModal">
                            Shift nurses
                        </button>
                    </div>

                    <div class="card-body">
                        @foreach ($nurseScheduleStatus as $notification)
                            <div class="mb-5">
                                <div class="alert alert-info">
                                    <form action="{{ route('delete.invitation') }}" method="POST" class="d-flex justify-content-between align-items-center">
                                        @csrf
                                        <div>{{ $notification->message }}</div>
                                        <input type="hidden" name="invitation" value="{{ $notification->id }}">
                                        <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createDoctorModal">
                                            Ok
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach

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

                        <div id="calendar"></div>
                    </div>

                    <!-- Modal for adding doctor -->
                    <div class="modal fade" id="createDoctorModal" tabindex="-1" role="dialog"
                        aria-labelledby="createDoctorModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createDoctorModalLabel">Shift nurses</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('change.nurse.shift') }}">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="department_id" class="form-label">Datetime</label>
                                            <select class="form-control form-select" id="newDate" name="newDate" onchange="getNurses(this)">
                                                <option>Select Date</option>
                                                @foreach ($nurseTimetables->unique('date') as $timetable)
                                                    <option value="{{ $timetable->date->format('Y-m-d') }}">{{ $timetable->date->format('Y-m-d') }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="department_id" class="form-label">Current Nurse</label>
                                            <select class="form-control form-select" id="currentNurses" name="old_nurse">
                                                <option value="">Select Current Nurses | on date</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="department_id" class="form-label">New nurse</label>
                                            <select class="form-control form-select" id="new_nurse" name="new_nurse">
                                                <option value="">Select New Nurses</option>
                                                @foreach ($nurses as $nurse)
                                                    <option value="{{ $nurse->id }}">{{ $nurse->names }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="events-data" data-events="{{ json_encode($nurseTimetables->map(function($timetable) {
        $title = $timetable->confirmed == 1 ? strtoupper(optional($timetable->nurse)->names) : strtoupper(optional($timetable->nurse)->names . "\n (wait Confirmation)");
        $start = $timetable->date->format('Y-m-d');
        $data = $timetable->id . ' - ' . $timetable->date->format('Y-m-d');

        return [
            'title' => $title,
            'start' => $start,
            'data' => $data,
        ];
    })->toArray()) }}"></div>

    @include('components.dashfooter')
</main>

<script>
    async function getNurses(element) {
        const apiUrl = `/api/receptionist/timetable/${element.value}`;

        const requestOptions = {
            method: 'GET',
            headers: { 'Content-Type': 'application/json' },
        };

        await fetch(apiUrl, requestOptions)
            .then(response => response.json())
            .then(data => {
                document.getElementById('currentNurses').innerHTML = "";

                data.data.forEach((value, index, array) => {
                    document.getElementById('currentNurses').innerHTML += `<option value='${value.nurse.id}'>${value.nurse.names}</option>`
                });
            });
    }

    var events = JSON.parse(document.getElementById('events-data').getAttribute('data-events'));

    $(document).ready(function() {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month'
            },
            defaultView: 'month',
            editable: false,
            eventRender: function(event, element) {
                // Define an array of darker color options
                var colors = ['#026852', '#0073be','#444'];

                // Generate a random index for the color options
                var randomIndex = Math.floor(Math.random() * colors.length);

                // Assign the color to the event element
                element.css({
                    'background-color': colors[randomIndex],
                    'color': '#fff' // Set text color to white
                });

                let identifier = Math.random().toString(36).substring(2);

                element[0].setAttribute('parsed', event.data);
                element[0].setAttribute('indentifier', identifier);
            },

            events: events,
        });
    });
</script>


@include('components.dashjs')

