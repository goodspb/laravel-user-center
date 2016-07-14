@if (count($errorMessages = $errors->all()) > 0)
    @foreach($errorMessages as $errorMessage)
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4>{{ trans('auth.error') }}</h4>
            {{ $errorMessage }}
        </div>
    @endforeach
@endif

@if ($successMessage = Session::get('success'))
    <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ $successMessage }}
    </div>
@endif