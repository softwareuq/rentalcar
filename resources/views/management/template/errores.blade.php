<br>
@if(count($errors) > 0)
  <div class="alert alert-danger" role="alert">
    <ul>
      @foreach($errors->all() as $error)
        {{$error}}
        <br>
      @endforeach
    </ul>
  </div>
@endif
