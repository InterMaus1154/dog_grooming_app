<div class="space-y-4">
    <x-table>
        <x-slot name="headers">
            <x-table.th sortField="id">#</x-table.th>
            <x-table.th sortField="log_name">Log Name</x-table.th>
            <x-table.th sortField="description">Description</x-table.th>
            <x-table.th sortField="subject_type">Subject Type</x-table.th>
            <x-table.th sortField="subject_id">Subject Id</x-table.th>
            <x-table.th sortField="event">Event</x-table.th>
            <x-table.th>Causer ID</x-table.th>
            <x-table.th>Properties</x-table.th>
            <x-table.th sortField="created_at">Created At</x-table.th>
        </x-slot>
        <x-slot>
            @foreach($logs as $log)
                <x-table.row wire:key="log - {{$log->id}}">
                    <x-table.cell>{{$log->id}}</x-table.cell>
                    <x-table.cell>{{$log->log_name}}</x-table.cell>
                    <x-table.cell>{{$log->description}}</x-table.cell>
                    <x-table.cell>{{$log->subject_type}}</x-table.cell>
                    <x-table.cell>{{$log->subject_id}}</x-table.cell>
                    <x-table.cell>{{$log->event}}</x-table.cell>
                    <x-table.cell>{{$log->causer_id}}</x-table.cell>
                    <x-table.cell>{{$log->properties}}</x-table.cell>
                    <x-table.cell>{{$log->created_at}}</x-table.cell>
                </x-table.row>
            @endforeach
        </x-slot>
        <x-slot name="pagination">
            <x-table.pagination :paginator="$logs" />
        </x-slot>
    </x-table>
</div>
