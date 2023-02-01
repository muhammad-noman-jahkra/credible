<div class="card">
    <div class="card-body">
        <h1 class="card-title">Update Customer</h1>
        <input type="hidden" wire:model="id">
    <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-form-label">Full Name</label>
                    <input type="text" class="form-control"placeholder="Enter Name" wire:model="name">
                    @error('name') <span class="text-danger">{{ $message }}</span>@enderror
                    
                </div>
            </div>
        
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control"placeholder="Enter email" wire:model="email">
                    @error('email') <span class="text-danger">{{ $message }}</span>@enderror                                
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-form-label">Phone No</label>
                    {{ Form::text('phone_no',null,array('placeholder'=>'03XXXXXXXX','class'=>'form-control','wire:model'=>'phone_no'))}}
                    @error('phone_no') <span class="text-danger">{{ $message }}</span>@enderror                                        
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-form-label">Address</label>
                    {{ Form::text('address',null,array('placeholder'=>'Address','class'=>'form-control','wire:model'=>'address'))}}
                    @error('address') <span class="text-danger">{{ $message }}</span>@enderror                                     
                </div>
            </div>
            
        </div>                            
        <div class="submit-section">
            <button class="btn btn-warning submit-btn" wire:click="update()">Update</button>
            <button class="btn btn-info submit-btn" wire:click="cancel()">Cancel</button>
        </div>
    </div>
</div>