@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">


    <style>
        #calendar {
            min-height: 600px;
            height: auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 1rem;
        }

        .modal-content {
            border-radius: 0.5rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .modal-header,
        .modal-footer {
            border: none;
        }

        .form-control {
            border-radius: .75rem;
        }

        .btn-primary {
            background-color: #35478c;
            border: none;
            border-radius: .3rem;
        }

        .btn-danger {
            border-radius: .3rem;
        }

        #upcomingEvents {
            max-height: 600px;
            overflow-y: auto;
            font-size: 0.95rem;
        }

        @media(max-width: 768px) {
            #calendar {
                padding: .5rem;
            }
        }

        .fc,
        .fc-daygrid-day-number,
        .fc-col-header-cell,
        .fc-event,
        .fc-event-title,
        .fc-event-time,
        .fc-button,
        .fc-toolbar-title {
            color: rgb(9, 14, 69) !important;
        }

        .fc-event-main-frame {
            background-color: rgb(172, 240, 242) !important;
            border-color: rgb(180, 193, 231) !important;
        }

        .fc a,
        .fc-daygrid-day-number a,
        .fc-col-header-cell a {
            color: rgb(9, 14, 69) !important;
            text-decoration: none !important;

        }


        .fc-button {
            color: rgb(9, 14, 69) !important;
            background-color: #f8f9fa !important;
            border-color: #ddd !important;
        }


        .fc-button:hover,
        .fc-button:active,
        .fc-button.fc-button-active {
            color: rgb(9, 14, 69) !important;
        }
    </style>
@endpush

@section('contents')
    <div class="container py-3">
        <h1 class="h3 mb-4 text-gray-800">Calendar of Activities</h1>
        <div class="row">
            <div class="col-md-9">
                <div id="calendar"></div>
            </div>
            <div class="col-md-3">
                <div class="bg-white rounded shadow-sm p-3" style="min-height:600px;">
                    <h6 class="fw-bold mb-3">Upcoming Events</h6>
                    <div class="mb-2">
                        <select id="eventDateFilter" class="form-select form-select-sm">
                            <option value="week">This Week</option>
                            <option value="month">This Month</option>
                            <option value="year">This Year</option>
                        </select>
                    </div>
                    <div id="upcomingEvents" style="max-height: 540px; overflow-y: auto;">
                        <ul class="list-group" id="upcomingEventsList">
                            <!-- Events will be injected here -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Event Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="eventForm" class="w-100">
                @csrf
                <input type="hidden" id="eventId">
                <div class="modal-content">
                    <div class="modal-header bg-light">
                        <h5 class="modal-title fw-semibold" id="eventModalLabel">Add / Edit Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-4">
                        <div class="mb-3">
                            <label for="eventTitle" class="form-label fw-semibold">Title</label>
                            <input type="text" class="form-control" id="eventTitle" required>
                        </div>
                        <div class="mb-3 row">
                            <div class="col-md-6">
                                <label for="eventStart" class="form-label fw-semibold">Start</label>
                                <input type="datetime-local" class="form-control" id="eventStart" required>
                            </div>
                            <div class="col-md-6">
                                <label for="eventEnd" class="form-label fw-semibold">End</label>
                                <input type="datetime-local" class="form-control" id="eventEnd" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="eventLocation" class="form-label fw-semibold">Location</label>
                            <input class="form-control" id="eventLocation" rows="3"></input>
                        </div>
                        <div class="mb-3">
                            <label for="eventAssigned" class="form-label fw-semibold">Assigned To</label>
                            <input class="form-control" id="eventAssigned" required rows="3"></input>
                        </div>
                        <div class="mb-3">
                            <label for="eventProject" class="form-label fw-semibold">Project</label>
                            <select class="form-select" id="eventProject" required>
                                <!-- Options will be populated here -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="eventDescription" class="form-label fw-semibold">Description</label>
                            <textarea class="form-control" id="eventDescription" rows="3" draggable="true"
                                style="resize: both;"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-between px-4 pb-4">
                        <button type="button" id="deleteEventBtn" class="btn btn-danger d-none">Delete</button>
                        <button type="submit" class="btn btn-primary">Save Event</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.18/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });

            var calendarEl = document.getElementById('calendar');
            var eventModal = new bootstrap.Modal(document.getElementById('eventModal'));
            var eventForm = document.getElementById('eventForm');
            var deleteEventBtn = document.getElementById('deleteEventBtn');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                timeZone: 'Asia/Manila',
                selectable: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: function (fetchInfo, successCallback, failureCallback) {
                    $.when(
                        $.get('{{ route('calendar.fetch') }}'),      // user events
                        $.get('{{ route('holidays.fetch') }}', { year: new Date().getFullYear() }) // holiday events
                    ).done(function (userEvents, holidayEvents) {
                        // $.when returns arrays: [data, status, xhr]
                        const merged = [...userEvents[0], ...holidayEvents[0]];
                        successCallback(merged);
                    }).fail(failureCallback);
                },

                select: function (info) {
                    resetModal();
                    const clickedDate = info.startStr + 'T08:00';
                    document.getElementById('eventStart').value = clickedDate;
                    const endDate = info.endStr ? info.endStr + 'T08:00' : '';
                    document.getElementById('eventEnd').value = endDate;
                    eventModal.show();
                },
                nextDayThreshold: '12:00',
                eventClick: function (info) {
                    resetModal();
                    document.getElementById('eventId').value = info.event.id;
                    document.getElementById('eventTitle').value = info.event.title;
                    document.getElementById('eventStart').value = info.event.start.toISOString().slice(
                        0, 16);
                    document.getElementById('eventEnd').value = info.event.end ? info.event.end
                        .toISOString().slice(0, 16) : '';
                    document.getElementById('eventLocation').value = info.event.extendedProps
                        .location ?? '';
                    document.getElementById('eventDescription').value = info.event.extendedProps
                        .description ?? '';
                    deleteEventBtn.classList.remove('d-none');
                    eventModal.show();
                },

                eventDidMount: function (info) {
                    var tooltipText = '<b>' + info.event.title + '</b>';
                    if (info.event.extendedProps.isHoliday) {

                        info.el.style.backgroundColor = 'rgba(205, 223, 249, 0.5)';
                        info.el.style.color = 'rgb(22, 25, 59)';
                        info.el.style.opacity = '1';
                        //info.el.style.fontWeight = 'bold';
                        info.el.style.textAlign = 'center';
                        info.el.style.lineHeight = '20px';
                        info.el.style.fontSize = '16px';
                        info.el.style.padding = '15px 10px';
                        info.el.style.zIndex = 10;
                    }
                    if (info.event.extendedProps.location) {
                        tooltipText += '<br>' + info.event.extendedProps.location;
                    }

                    new bootstrap.Tooltip(info.el, {
                        title: tooltipText,
                        html: true,
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body'
                    });
                }
            });

            let upcomingEventsCache = [];

            function loadUpcomingEvents(filter = 'week') {
                $.ajax({
                    url: '{{ route('calendar.fetch') }}',
                    method: 'GET',
                    success: function (events) {
                        const now = new Date();
                        let start = new Date(now);
                        let end = new Date(now);

                        if (filter === 'week') {
                            end.setDate(start.getDate() + 7);
                        } else if (filter === 'month') {
                            start = new Date(now.getFullYear(), now.getMonth(), 1); // start of month
                            end = new Date(now.getFullYear(), now.getMonth() + 1, 0, 23, 59, 59); // end of month
                        } else if (filter === 'year') {
                            start = new Date(now.getFullYear(), 0, 1); // Jan 1
                            end = new Date(now.getFullYear(), 11, 31, 23, 59, 59); // Dec 31
                        }

                        const filteredEvents = events.filter(e => {
                            const eventStart = new Date(e.start);
                            return eventStart >= start && eventStart <= end;
                        });

                        filteredEvents.sort((a, b) => new Date(a.start) - new Date(b.start));
                        upcomingEventsCache = filteredEvents;
                        renderUpcomingEvents(filteredEvents);
                    }
                });
            }


            function renderUpcomingEvents(events) {
                const list = $('#upcomingEventsList');
                list.empty();
                if (events.length === 0) {
                    list.append('<li class="list-group-item text-muted">No upcoming events.</li>');
                } else {
                    events.forEach(e => {
                        list.append(
                            `<li class="list-group-item upcoming-event-item"
                                    data-id="${e.id}"
                                    data-title="${e.title}"
                                    data-start="${e.start}"
                                    data-end="${e.end || ''}"
                                    data-location="${e.location || ''}"
                                    data-assigned="${e.assigned || ''}"
                                    data-project="${e.project || ''}"
                                    data-description="${e.description || ''}">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <strong>${e.title}</strong>
                                                        <button class="btn btn-close btn-sm delete-event-btn" data-id="${e.id}" title="Delete"></button>
                                                    </div>
                                                    <div>
                                                        <div>
                                                            <div class="text-muted">
                                                                <i class="bi bi-calendar-event me-1"></i>
                                                                ${new Date(e.start).toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: 'short',
                                day: 'numeric'
                            })}
                                                                ${e.end ? ` - ${new Date(e.end).toLocaleDateString('en-US', {
                                year: 'numeric',
                                month: 'short',
                                day: 'numeric'
                            })}` : ''}
                                                            </div>
                                                            <div class="text-muted">
                                                                <i class="bi bi-clock-fill me-1"></i>
                                                                ${new Date(e.start).toLocaleTimeString('en-US', {
                                hour: 'numeric',
                                minute: '2-digit'
                            })}
                                                                ${e.end ? ` - ${new Date(e.end).toLocaleTimeString('en-US', {
                                hour: 'numeric',
                                minute: '2-digit'
                            })}` : ''}
                                                                ${e.location ? `<br><span class="text-muted"><i class="bi bi-geo-alt-fill me-1"></i>${e.location}</span>` : `<br><span class="text-muted"><i class="bi bi-geo-alt-fill me-1"></i>No location set.</span>`}
                                                            </div>
                                                    </div>
                                                </li>`
                        );
                    });
                }

                $('.upcoming-event-item').off('click').on('click', function () {
                    resetModal();

                    // Fill modal with clicked event's data
                    $('#eventId').val($(this).data('id'));
                    $('#eventTitle').val($(this).data('title'));
                    $('#eventStart').val(new Date($(this).data('start')).toISOString().slice(0, 16));
                    

                    const end = $(this).data('end');
                    if (end) {
                        $('#eventEnd').val(new Date(end).toISOString().slice(0, 16));
                    }

                    $('#eventLocation').val($(this).data('location'));
                    $('#eventAssigned').val($(this).data('assigned'));
                    $('#eventDescription').val($(this).data('description'));

                    $('#deleteEventBtn').removeClass('d-none');

                    // Show the modal
                    eventModal.show();
                });

                // Attach event handlers after rendering
                $('.delete-event-btn').off('click').on('click', function (e) {
                    e.stopPropagation();
                    const eventId = $(this).data('id');
                    const formTitle = $(this).closest('.list-group-item').find('div').first().text();
                    if (!eventId) return;
                    Swal.fire({
                        title: 'Delete event?',
                        html: `You are about to delete <span style="color: red; font-style: italic; font-style: underline;">${formTitle}</span>. This action cannot be undone.`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '/calendar/' + eventId,
                                method: 'DELETE',
                                data: {
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function () {
                                    calendar.refetchEvents();
                                    loadUpcomingEvents($('#eventDateFilter').val());
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Event deleted'
                                    });
                                },
                                error: function () {
                                    Swal.fire('Error', 'Failed to delete event.',
                                        'error');
                                }
                            });
                        }
                    });
                });


            }

            $('#eventDateFilter').on('change', function () {
                const filterValue = $(this).val();
                loadUpcomingEvents(filterValue);
            });

            calendar.render();
            loadUpcomingEvents();

            calendar.on('eventAdd', loadUpcomingEvents);
            calendar.on('eventChange', loadUpcomingEvents);
            calendar.on('eventRemove', loadUpcomingEvents);

            eventForm.addEventListener('submit', function (e) {
                e.preventDefault();

                const eventId = document.getElementById('eventId').value;
                const title = document.getElementById('eventTitle').value;
                const start = document.getElementById('eventStart').value;
                const end = document.getElementById('eventEnd').value;
                const location = document.getElementById('eventLocation').value;
                const description = document.getElementById('eventDescription').value;

                let url = eventId ? '/calendar/' + eventId : '{{ route('calendar.store') }}';
                let method = eventId ? 'PUT' : 'POST';

                $.ajax({
                    url: url,
                    method: method,
                    data: {
                        _token: '{{ csrf_token() }}',
                        title,
                        start,
                        end,
                        location,
                        assigned,
                        project,
                        description
                    },
                    success: function () {
                        calendar.refetchEvents();
                        eventModal.hide();
                        Toast.fire({
                            icon: 'success',
                            title: eventId ? 'Event updated' : 'Event added'
                        });
                    },
                    error: function () {
                        Swal.fire('Error', 'Failed to save event.', 'error');
                    }
                });
            });

            deleteEventBtn.addEventListener('click', function () {
                var eventId = document.getElementById('eventId').value;
                if (!eventId) return;

                Swal.fire({
                    title: 'Delete event?',
                    text: 'This action cannot be undone.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/calendar/' + eventId,
                            method: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function () {
                                calendar.refetchEvents();
                                eventModal.hide();
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Event deleted'
                                });
                            },
                            error: function () {
                                Swal.fire('Error', 'Failed to delete event.', 'error');
                            }
                        });
                    }
                });
            });

            function resetModal() {
                eventForm.reset();
                document.getElementById('eventId').value = '';
                deleteEventBtn.classList.add('d-none');
            }
        });
    </script>
@endpush