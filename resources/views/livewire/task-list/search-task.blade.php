<div class="card">
            
    <div class="card-body">
    <h1 class="card-title">Filters</h1>
        <div class="row filter-row">
            <div class="col-sm-3">  
                <div class="form-group">
                <label class="col-form-label">Date </label>
                    <div class="cal-icon">
                        <input type="text" class="form-control floating"  id="dateRange"  wire:model="dateRange" onchange="this.dispatchEvent(new InputEvent('input'))">
                    </div>
                    
                </div>
            </div>
            @if(!Auth::user()->hasRole(['EMPLOYEE']))
            <div class="col-sm-3">
                <div class="form-group">
                    <label class="col-form-label">Emp Name </label>
                    {{ Form::select('empName',$empList,null,array('placeholder'=>'Select','class'=>'form-control','wire:model'=>"empName"))}}
                </div>
            </div>
            @endif
        </div>
    
        
    </div>
</div>