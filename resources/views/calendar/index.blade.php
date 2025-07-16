@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        #calendar {
            min-height: 600px;
            height: auto;
            background-color: #fff;
            border-radius: 1rem;
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
            background-color: #1A73E8;
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
    </style>
@endpush

@section('contents')
    <div class="container py-3">
        <div class="row">
            <div class="col-md-9">
                <div id="calendar"></div>
            </div>
            <div class="col-md-3">
                <div id="upcomingEvents" class="bg-white rounded shadow-sm p-3" style="min-height:600px;">
                    <h6 class="fw-bold mb-3">Upcoming Events</h6>
                    <ul class="list-group" id="upcomingEventsList">
                        <!-- Events will be injected here -->
                    </ul>
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
                        <div class="mb-3">
                            <label for="eventStart" class="form-label fw-semibold">Start</label>
                            <input type="datetime-local" class="form-control" id="eventStart" required>
                        </div>
                        <div class="mb-3">
                            <label for="eventEnd" class="form-label fw-semibold">End</label>
                            <input type="datetime-local" class="form-control" id="eventEnd" required>
                        </div>
                        <div class="mb-3">
                            <label for="eventDescription" class="form-label fw-semibold">Description</label>
                            <textarea class="form-control" id="eventDescription" rows="3"></textarea>
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
        document.addEventListener('DOMContentLoaded', function() {
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
                selectable: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: '{{ route('calendar.fetch') }}',

                select: function(info) {
                    resetModal();
                    const clickedDate = info.startStr + 'T08:00';
                    document.getElementById('eventStart').value = clickedDate;
                    document.getElementById('eventEnd').value = clickedDate;
                    eventModal.show();
                },

                eventClick: function(info) {
                    resetModal();
                    document.getElementById('eventId').value = info.event.id;
                    document.getElementById('eventTitle').value = info.event.title;
                    document.getElementById('eventStart').value = info.event.start.toISOString().slice(
                        0, 16);
                    document.getElementById('eventEnd').value = info.event.end ? info.event.end
                        .toISOString().slice(0, 16) : '';
                    document.getElementById('eventDescription').value = info.event.extendedProps
                        .description || '';
                    deleteEventBtn.classList.remove('d-none');
                    eventModal.show();
                },

                eventDidMount: function(info) {
                    var tooltipText = '<b>' + info.event.title + '</b>';
                    if (info.event.extendedProps.description) {
                        tooltipText += '<br>' + info.event.extendedProps.description;
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

            function loadUpcomingEvents() {
                $.ajax({
                    url: '{{ route('calendar.fetch') }}',
                    method: 'GET',
                    success: function(events) {
                        // Filter for upcoming events (today or later)
                        const now = new Date();
                        const upcoming = events.filter(e => new Date(e.start) >= now);
                        upcoming.sort((a, b) => new Date(a.start) - new Date(b.start));
                        const list = $('#upcomingEventsList');
                        list.empty();
                        if (upcoming.length === 0) {
                            list.append(
                                '<li class="list-group-item text-muted">No upcoming events.</li>');
                        } else {
                            upcoming.forEach(e => {
                                list.append(
                                    `<li class="list-group-item">
                                        <strong>${e.title}</strong><br>
                                        <small>${new Date(e.start).toLocaleString()}</small>
                                        ${e.description ? `<br><span class="text-muted">${e.description}</span>` : ''}
                                    </li>`
                                );
                            });
                        }
                    }
                });
            }

            calendar.render();
            loadUpcomingEvents();

            calendar.on('eventAdd', loadUpcomingEvents);
            calendar.on('eventChange', loadUpcomingEvents);
            calendar.on('eventRemove', loadUpcomingEvents);

            eventForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const eventId = document.getElementById('eventId').value;
                const title = document.getElementById('eventTitle').value;
                const start = document.getElementById('eventStart').value;
                const end = document.getElementById('eventEnd').value;
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
                        description
                    },
                    success: function() {
                        calendar.refetchEvents();
                        eventModal.hide();
                        Toast.fire({
                            icon: 'success',
                            title: eventId ? 'Event updated' : 'Event added'
                        });
                    },
                    error: function() {
                        Swal.fire('Error', 'Failed to save event.', 'error');
                    }
                });
            });

            deleteEventBtn.addEventListener('click', function() {
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
                            success: function() {
                                calendar.refetchEvents();
                                eventModal.hide();
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Event deleted'
                                });
                            },
                            error: function() {
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
