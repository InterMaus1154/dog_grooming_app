import './bootstrap';
import {Calendar} from "@fullcalendar/core";
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';
import timeGridPlugin from '@fullcalendar/timegrid';
import listPlugin from '@fullcalendar/list';

window.FullCalendar = Calendar;
window.FullCalendarPlugins = [dayGridPlugin, interactionPlugin, timeGridPlugin, listPlugin];
