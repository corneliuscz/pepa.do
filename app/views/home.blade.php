@extends('layouts.default')

@section('content')
<div class="wrapper-diskuze">
  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <h2 class="text-center">Přispějte do diskuze svým dotazem</h2>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8 col-md-push-2">

        @if ($errors->has())
        <div class="alert alert-danger" role="alert">
            {{ $errors->first('asker', '<p>:message</p>'); }}
            {{ $errors->first('question', '<p>:message</p>'); }}
        </div>
        @endif

        {{ Form::open(array('route' => 'dotazy.store', 'class' => 'form-horizontal')) }}

        <div class="form-group @if ($errors->has('question')) has-error @endif">
          {{ Form::label('question', 'Otázka:', array('class' => 'col-sm-3 control-label')) }}
          <div class="col-sm-9">
            {{ Form::textarea('question', null, ['class' => 'form-control', 'placeholder' => 'Prostor pro vaši otázku']) }}
            @if ($errors->has('question')) <p class="help-block">{{ $errors->first('question') }}</p> @endif
          </div>
        </div>

        <div class="form-group @if ($errors->has('asker')) has-error @endif">
          {{ Form::label('asker', 'Autor dotazu:', array('class' => 'col-sm-3 control-label')) }}
          <div class="col-sm-9">
            {{ Form::text('asker', null, ['class' => 'form-control', 'placeholder' => 'Nepovinné']) }}
            @if ($errors->has('asker')) <p class="help-block">{{ $errors->first('asker') }}</p> @endif
          </div>
        </div>

        {{ Form::submit('Vložit dotaz', ['class' => 'btn btn-primary btn-lg center-block']) }}

        {{ Form::close() }}

      </div>
    </div>

  </div>
</div>
@stop
