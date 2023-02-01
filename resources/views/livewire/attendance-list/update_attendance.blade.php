<div class="card">
    <div class="card-body">
        <h1 class="card-title">Update Attendance</h1>
        <input type="hidden" wire:model="id">
    <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-form-label">Punch In</label>
                    <div class="row">
                        <div class="col-sm-1">
                            <label class="col-form-label">Hour</label>
                        </div>
                        <div class="col-sm-3">
                        <input type="number" min="0" max="23" class="form-control" wire:model="punch_in_hour">
                             @error('punch_in_hour') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="col-sm-1">
                            <label class="col-form-label">Min</label>
                        </div>
                        <div class="col-sm-3">
                        <input type="number" min="0" max="59" class="form-control" wire:model="punch_in_min">
                    @error('punch_in_min') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    
                    
                    
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-form-label">Punch Out</label>
                    <div class="row">
                        <div class="col-sm-1">
                                <label class="col-form-label">Hour</label>
                        </div>
                        <div class="col-sm-3">
                                <input type="number" min="0" max="23" class="form-control" wire:model="punch_out_hour">
                        @error('punch_out_hour') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        
                        <div class="col-sm-1">
                            <label class="col-form-label">Min</label>
                        </div>
                        <div class="col-sm-3">
                            <input type="number" min="0" max="59" class="form-control" wire:model="punch_out_min">
                        @error('punch_out_min') <span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    
                    
                    
                </div>
            </div>
            

    </div>
            
        </div>                            
        <div class="submit-section">
            <button class="btn btn-warning submit-btn" wire:click="update()">Update</button>
            <button class="btn btn-info submit-btn" wire:click="cancel()">Cancel</button>
        </div>
    </div>
</div>