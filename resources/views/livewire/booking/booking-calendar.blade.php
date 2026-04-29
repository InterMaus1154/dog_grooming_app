<div
    x-data="{
        calendar: null,
        init() {
            $nextTick(() => {
                this.calendar = new window.FullCalendar(this.$refs.calendar, {
                    plugins: window.FullCalendarPlugins,
                    initialView: window.innerWidth < 640 ? 'dayGridWeek' : 'dayGridMonth',
                    events: {{ Js::from($events) }},
                    headerToolbar: window.innerWidth < 640 ? {
                        left: 'prev,next',
                        center: 'title',
                        right: 'today'
                    } : {
                        left: 'prev,next,today',
                        center: 'title',
                        right: 'dayGridMonth,dayGridWeek'
                    },
                    height: 'auto',
                    windowResize: (view) => {
                        if (window.innerWidth < 640) {
                            this.calendar.changeView('dayGridWeek');
                        } else {
                            this.calendar.changeView('dayGridMonth');
                        }
                    }
                });
                this.calendar.render();
            });
        }
    }"
    x-init="init()"
>
    <div x-ref="calendar"></div>
</div>
