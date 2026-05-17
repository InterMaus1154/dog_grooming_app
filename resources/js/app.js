import './bootstrap';
import {Calendar} from "@fullcalendar/core";
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';
import focus from '@alpinejs/focus';

document.addEventListener("alpine:init", () => {
    Alpine.plugin(focus);
});

window.FullCalendar = Calendar;
window.FullCalendarPlugins = [dayGridPlugin, interactionPlugin, timeGridPlugin, listPlugin];

