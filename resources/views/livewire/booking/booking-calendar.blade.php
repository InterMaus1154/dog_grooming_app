<div>
    <div id="calendar"></div>
</div>


@script
<script type="text/javascript">

    const onCalendarSelect = info => {
        Livewire.dispatch('modal-open', {
            component: 'modal.booking-create',
            componentData: {
                dateTime: info.startStr
            }
        });
    };

    const onEventClick = info => {
        Livewire.dispatch('modal-open', {
            component: 'modal.booking-show',
            componentData: {
                bookingId: info.event.id
            }
        });
    };

    let calendar = null;
    const renderCalendar = () => {
        const calendarEl = document.querySelector("#calendar");
        calendar = new window.FullCalendar(calendarEl, {
            initialView: window.innerWidth < 640 ? 'timeGridDay' : 'timeGridWeek',
            plugins: window.FullCalendarPlugins,
            headerToolbar:
                window.innerWidth < 640 ? {
                        left: 'title',
                        right: 'prev,next,dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                    } :
                    {
                        left: 'prev,next,today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,listWeek,timeGridDay'
                    },
            height: 'auto',
            selectable: true,
            select: onCalendarSelect,
            events: '/bookings/calendar',
            timeZone: 'local',
            eventClick: onEventClick,
            slotMinTime: "08:00:00",
            slotMaxTime: "20:00:00",
            firstDay: 1,
            longPressDelay: 200,
            selectLongPressDelay: 200,
            expandRows: true,
            eventMinHeight: 60
        });

        calendar.render();
    };


    document.addEventListener("livewire:initialized", () => {
        setTimeout(renderCalendar, 100); // need to defer for the layout to be computed, otherwise the calendar collapses

        Livewire.on('refresh-bookings', () => {
            calendar.refetchEvents();
        });

        Livewire.on('refresh-dogs', () => {
           calendar.refetchEvents();
        });
    });


</script>
@endscript
