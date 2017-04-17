<div class="form-group{{ $errors->has('name') ? ' has-error' : ''}}">
    {!! Form::label('name', trans('user.name'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('email') ? ' has-error' : ''}}">
    {!! Form::label('email', trans('user.email'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@if(!isset($user))
<div class="form-group{{ $errors->has('password') ? ' has-error' : ''}}">
    {!! Form::label('password', trans('user.password'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::password('password', ['class' => 'form-control', 'pattern' => '(?=.*\d)(?=.*[a-z]).{6,}', 'title' => 'Debe contener al menos un numero, al menos una letra y mas de 6 caracteres', 'oninput' => 'checkUserPass(this)']) !!}
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group{{ $errors->has('password-confirm') ? ' has-error' : ''}}">
    {!! Form::label('password-confirm', trans('user.passconfirm'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::password('password-confirm', ['class' => 'form-control', 'oninput' => 'checkUserPass(this)']) !!}
        {!! $errors->first('password-confirm', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@endif
<div class="form-group{{ $errors->has('role') ? ' has-error' : ''}}">
    {!! Form::label('role', trans('user.role'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('role', $roles, isset($user_roles) ? $user_roles : [], ['id' => 'role', 'class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group{{ $errors->has('offices') ? ' has-error' : ''}}">
    {!! Form::label('offices', trans('user.offices'), ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('offices[]', $offices, isset($user_offices) ? $user_offices : [], ['id' => 'offices', 'class' => 'form-control', 'multiple' => true, 'required' => 'required']) !!}
    </div>
</div>
@if(isset($user))
<div class="form-group ">
    <div class="col-md-offset-4 col-md-6">
      @if($user->profile->active)
      <label class="radio-inline">
          <input checked="checked" name="active" type="radio" value="1">Activo
      </label>
      <label class="radio-inline">
          <input name="active" type="radio" value="0">Inactivo
      </label>
      @else
      <label class="radio-inline">
          <input name="active" type="radio" value="1">Activo
      </label>
      <label class="radio-inline">
          <input checked="checked" name="active" type="radio" value="0">Inactivo
      </label>
      @endif
  </div>
</div>
@endif
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Crear', ['class' => 'btn btn-success']) !!}
    </div>
</div>