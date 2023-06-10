@include('components.dashcss')

{{-- CALENDER FULL DEPENDENCY --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">

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

                        <div id="calendar"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.dashfooter')
</main>
<script>
    $(document).ready(function() {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month'
            },
            defaultView: 'month',
            editable: true,
            eventRender: function(event, element) {
                // Define an array of darker color options
                var colors = ['#4c4c4c', '#5d5d5d', '#333333', '#6b6b6b', '#474747'];
                
                // Generate a random index for the color options
                var randomIndex = Math.floor(Math.random() * colors.length);
                
                // Assign the color to the event element
                element.css({
                    'background-color': colors[randomIndex],
                    'color': '#fff' // Set text color to white
                });
            },
            events: [
                @foreach ($nurseTimetables as $timetable)
                    {
                        title: '{{ $timetable->nurse->names }}',
                        start: '{{ $timetable->date->format('Y-m-d') }}',
                        @if ($timetable->patientBatch)
                            url: '/patient-batches/{{ $timetable->patientBatch->id }}',
                        @endif
                    },
                @endforeach
            ]
        });
    });
</script>



@include('components.dashjs')

