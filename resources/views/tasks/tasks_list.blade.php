@extends('layouts.dashboard')

@section('title')
Tasks List
@endsection


@section('content')
    @livewire('task-list')
@endsection


@section('script')
<script>
    $('#dateRange').daterangepicker({
        // startDate:new Date(), // after open picker you'll see this dates as picked
        // endDate:new Date(),
        locale: {
        format: 'YYYY-MM-DD',
        },
        
       
    });
</script>
@endsection