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
                            <h4 class="card-title">Assigned Patient Batches schedule</h4>

                        </div>
                        {{-- @if ($isDuplicate !=1)
                        <a href="/doctor/generate-schedule" id="submitButton" class="btn btn-primary">
                            Generate TimeTable
                        </a>
                        @endif --}}
                      
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

                // Add the code information to the event element
                // element.find('.fc-title').append('<br>' + event.description);
            },
            
            events: [
                @foreach ($nurseTimetables as $timetable)
                    {
                        title: '{{ $timetable->nurse->names }}'.toUpperCase(),
                        start: '{{ $timetable->date->format('Y-m-d') }}',    
                    },
                @endforeach
            ]
        });
    });
</script>
{{-- // @if ($timetable->patientBatch)

//     description: ' {{ $timetable->patientBatch->code }}', // Add the code info
// @endif --}}

@include('components.dashjs')

