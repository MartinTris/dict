@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
@endpush

@section('contents')
    <div id="calendar" style="height: 800px;"></div>

    <!-- Event Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="eventForm">
                @csrf
                <input type="hidden" id="eventId">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventModalLabel">Add / Edit Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="eventTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="eventTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="eventStart" class="form-label">Start</label>
                            <input type="datetime-local" class="form-control" id="eventStart" required>
                        </div>
                        <div class="mb-3">
                            <label for="eventEnd" class="form-label">End</label>
                            <input type="datetime-local" class="form-control" id="eventEnd" required>
                        </div>
                        <div class="mb-3">
                            <label for="eventDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="eventDescription"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
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
                selectable: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: '{{ route('calendar.fetch') }}',

                select: function (info) {
                    resetModal();
                    document.getElementById('eventStart').value = info.startStr.slice(0, 16);
                    document.getElementById('eventEnd').value = info.endStr ? info.endStr.slice(0, 16) : info.startStr.slice(0, 16);
                    eventModal.show();
                },

                eventClick: function (info) {
                    resetModal();
                    document.getElementById('eventId').value = info.event.id;
                    document.getElementById('eventTitle').value = info.event.title;
                    document.getElementById('eventStart').value = info.event.start.toISOString().slice(0, 16);
                    document.getElementById('eventEnd').value = info.event.end ? info.event.end.toISOString().slice(0, 16) : '';
                    document.getElementById('eventDescription').value = info.event.extendedProps.description || '';
                    deleteEventBtn.classList.remove('d-none');
                    eventModal.show();
                },

                eventDidMount: function (info) {
                    var tooltipText = '<b>' + info.event.title + '</b>';
                    if (info.event.extendedProps.description) {
                        tooltipText += '<br>' + info.event.extendedProps.description;
                    }

                    $(info.el).tooltip({
                        title: tooltipText,
                        html: true,
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body'
                    });
                }
            });

            calendar.render();

            eventForm.addEventListener('submit', function (e) {
                e.preventDefault();

                const eventId = document.getElementById('eventId').value;
                const title = document.getElementById('eventTitle').value;
                const start = document.getElementById('eventStart').value;
                const end = document.getElementById('eventEnd').value;
                const description = document.getElementById('eventDescription').value;

                let url = '';
                let method = '';
                let data = {
                    _token: '{{ csrf_token() }}',
                    title: title,
                    start: start,
                    end: end,
                    description: description
                };

                if (eventId) {
                    url = '/calendar/' + eventId;
                    method = 'PUT';
                } else {
                    url = '{{ route("calendar.store") }}';
                    method = 'POST';
                }

                $.ajax({
                    url: url,
                    method: method,
                    data: data,
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
                            data: { _token: '{{ csrf_token() }}' },
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