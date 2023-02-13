<div class="card">
    <div class="card-body">
        <h1 class="card-title">Add Holiday</h1>
    <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-form-label">Date</label>
                    {{ Form::date('date',null,array('placeholder'=>'Holiday on','class'=>'form-control','wire:model'=>'date'))}}
                    @error('date') <span class="text-danger">{{ $message }}</span>@enderror                     
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="col-form-label">Description</label>
                    {{ Form::text('description',null,array('placeholder'=>'Holiday on','class'=>'form-control','wire:model'=>'description'))}}
                    @error('description') <span class="text-danger">{{ $message }}</span>@enderror                                        
                </div>
            </div>
            
        </div>                            
        <div class="submit-section">
            <button class="btn btn-primary submit-btn" wire:click="store()">Submit</button>
        </div>
    </div>
</div>