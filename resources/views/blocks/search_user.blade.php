{!! Form::open([
    'method' => 'get',
    'route' => $route
]) !!}
    <div class="col-md-6">
        <div class="input-group form-group">
            <input type="text" name="search" class="form-control" placeholder="Search for..." value="{!! $search !!}" pattern=".{3,}"   required title="3 characters minimum">
                <span class="input-group-btn">
                    <button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                </span>
        </div>
    </div>
{!! Form::close() !!}