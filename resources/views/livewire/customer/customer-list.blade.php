<div>
<div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Customer</h3>                        
                    </div>
                    <!-- <div class="col-auto float-right ml-auto">
                        <button class="btn add-btn">
                            <i class="fa fa-plus"></i> Add Employee
                        </button>
                    </div> -->
                </div>
            </div>
			<!-- /Page Header -->
            @if($updateMode)
                @include('livewire.customer.update_customer')
            @else
                @include('livewire.customer.create_customer')
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Address</th>
                                    <th class="text-right no-sort">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $items )
                                <tr>
                                    <td>{{ $items->name }}</td>
                                    <td>{{ $items->email }}</td>
                                    <td>{{ $items->phone_no }}</td>
                                    <td>{{ $items->address }}</td>
                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" wire:click="edit({{ $items->id }})"><i class="fa fa-pencil m-r-5"></i> Edit</a>                                                
                                            </div>
                                        </div>
                                    </td>
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
