<div>
<div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Holiday</h3>                        
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <button class="btn add-btn" wire:click="create()">
                            <i class="fa fa-plus"></i> Add Holiday
                        </button>
                    </div>
                </div>
            </div>
			<!-- /Page Header -->
            @if($insert_mode)
                @include('livewire.holiday.create_holiday')            
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($holiday as $h )
                                <tr>
                                    <td>{{ $h->date }}</td>
                                    <td>{{ $h->description }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
      
    </div>
</div>
