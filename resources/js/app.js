import './bootstrap';
import {Calendar} from "@fullcalendar/core";
import dayGridPlugin from '@fullcalendar/daygrid';
import interactionPlugin from '@fullcalendar/interaction';


window.FullCalendar = Calendar;
window.FullCalendarPlugins = [dayGridPlugin, interactionPlugin];
