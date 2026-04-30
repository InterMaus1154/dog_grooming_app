<div>
    <div id="calendar" ></div>
</div>


@script
<script type="text/javascript">

    const renderCalendar = () => {
        const calendarEl = document.querySelector("#calendar");
        const calendar = new window.FullCalendar(calendarEl, {
            initialView: 'dayGridMonth',
            plugins: window.FullCalendarPlugins,
            headerToolbar: {
                left: 'prev,next,today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },
            height: 500,
        });

        calendar.render();
    };


    document.addEventListener("livewire:initialized", () => {
        setTimeout(renderCalendar, 100); // need to defer for the layout to be computed, otherwise the calendar collapses
    });


</script>
@endscript
