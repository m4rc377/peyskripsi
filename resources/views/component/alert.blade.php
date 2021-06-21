@if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
    {{$message}}
  </div>
  @endif

  @if ($message = Session::get('info'))
  <div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-info"></i> Info!</h5>
    {{ $message }}
  </div>
  @endif


  @if ($message = Session::get('warning'))
  <div class="alert alert-warning alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-exclamation-triangle"></i> Peringatan!</h5>
    {{ $message }}
  </div>
  @endif
  @if ($message = Session::get('success'))
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5><i class="icon fas fa-check"></i> Sukses!</h5>
    {{ $message }}
  </div>
  @endif

@if ($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <ul>
        @if(is_array($errors->all()))
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        @else
        {{$errors->all()}}
        @endif
    </ul>
</div>
@endif
