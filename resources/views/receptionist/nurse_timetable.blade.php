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

                let identifier = Math.random().toString(36).substring(2);

                element[0].setAttribute('parsed', event.data);
                element[0].setAttribute('indentifier', identifier);
            },

            events: [
                @foreach ($nurseTimetables as $timetable) {
                    title: '{{ $timetable->nurse->names }}'.toUpperCase(),
                    start: '{{ $timetable->date->format('Y-m-d') }}',
                    data: '{{ $timetable->id }} - {{ $timetable->date->format('Y-m-d') }}'
                },
                @endforeach
            ]
        });
    });

    $(document).ready(function() {
        let dragable = document.querySelectorAll('.fc-day-grid-event');
        let droppable = document.querySelectorAll('.fc-event-container');

        dragable.forEach(element => {
            element.setAttribute('id', 'draggable');
            element.setAttribute('draggable', 'true');

            // Add event listeners to the draggable element
            element.addEventListener('dragstart', handleDragStart);
            element.addEventListener('dragend', handleDragEnd);

            element.parentNode.setAttribute('data-date', element.getAttribute('parsed').split(' - ')[1]);
        });

        droppable.forEach(element => {
            element.setAttribute('id', 'droppable');

            // Add event listeners to the droppable element
            element.addEventListener('dragover', handleDragOver);

            element.addEventListener('drop', (event) => {
                event.preventDefault();

                const data = event.dataTransfer.getData('text/plain');
                const draggedElement = document.getElementById(data);

                let changable = draggedElement.getAttribute('parsed').split(' - ');

                let pasedData = {
                    nurse_id: changable[0],
                    new_date: element.getAttribute('data-date')
                };

                submitChanges(pasedData);

                element.appendChild(draggedElement);
            });
        });

        // Function to handle the drag start event
        function handleDragStart(event) {
            event.dataTransfer.setData('text/plain', event.target.id);
            event.target.classList.add('dragging');
        }

        // Function to handle the drag end event
        function handleDragEnd(event) {
            event.target.classList.remove('dragging');
        }

        // Function to handle the drag over event
        function handleDragOver(event) {
            event.preventDefault();
        }

        function submitChanges(changable) {
            const apiUrl = '/api/receptionist/timetable-changes';

            console.log(changable);

            const dataToSend = {
                timetable_id: changable.nurse_id,
                newDate: changable.new_date,
            };

            console.log(dataToSend)

            const requestOptions = {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(dataToSend),
            };

            fetch(apiUrl, requestOptions).then(response => {
                // window.location.reload();
            }).catch(error => {
                alert("Unable to swap nurses");
            });
        }
    });
</script>


@include('components.dashjs')

