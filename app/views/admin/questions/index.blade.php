@extends('layouts.admin')

@section('content')
  <h2>Otázky pro diskuzi</h2>

  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Jméno</th>
          <th>Otázka</th>
          <th>Přidáno</th>
          <th>Stav</th>
          <th colspan="4">Akce</th>
        </tr>
      </thead>
      @foreach ($questions as $question)
      <tr class="{{{ ( $question->qstatus == 3 ) ? 'spam' : '' }}}">
        <td>{{{ $question->asker }}}</td>
        <td>{{ nl2br(e($question->question)) }}</td>
        <td>{{{ $question->created_at }}}</td>
        <td class="status
                   @if ($question->qstatus == 0) status--new
                   @elseif ($question->qstatus == 1) status--visible
                   @elseif ($question->qstatus == 2) status--done
                   @elseif ($question->qstatus == 4) status--pinned
                   @endif">
          @if ($question->qstatus == 0)
            <span class="glyphicon glyphicon-asterisk"></span>
          @elseif ($question->qstatus == 1)
            <span class="glyphicon glyphicon-eye-open"></span>
          @elseif ($question->qstatus == 2)
            <span class="glyphicon glyphicon-ok"></span>
          @elseif ($question->qstatus == 3)
            <span class="glyphicon glyphicon-trash"></span>
          @elseif ($question->qstatus == 4)
            <span class="glyphicon glyphicon-pushpin"></span>
          @else
            <span class="glyphicon glyphicon-question-sign"></span>
          @endif
        </td>
        <td class="actions">
          @if ($question->qstatus < 1 || $question->qstatus > 2 && $question->qstatus != 4 )
            <a href="{{ URL::route('questions.update', $question->id) }}" title="Zveřejnit otázku" data-method="PATCH" data-value="1">
          @endif
            <span class="glyphicon glyphicon-ok-circle"></span>
          @if ($question->qstatus < 1 || $question->qstatus > 2 && $question->qstatus != 4 )
          </a>
          @endif
        </td>
        <td class="actions">
          @if ($question->qstatus < 2 || $question->qstatus > 3 )
            <a href="{{ URL::route('questions.update', $question->id) }}" title="Zodpovězená" data-method="PATCH" data-value="2">
          @endif
            <span class="glyphicon glyphicon-ok"></span>
          @if ($question->qstatus < 2 || $question->qstatus > 3 )
            </a>
          @endif
        </td>
        <td class="actions">
          @if ($question->qstatus < 3)
            <a href="{{ URL::route('questions.update', $question->id) }}" title="Připnout" data-method="PATCH" data-value="4">
          @endif
            <span class="glyphicon glyphicon-pushpin"></span>
          @if ($question->qstatus < 3)
            </a>
          @endif
        </td>
        <td class="actions">
          @if ($question->qstatus < 3)
            <a href="{{ URL::route('questions.update', $question->id) }}" title="SPAM" data-method="PATCH" data-value="3">
          @endif
            <span class="glyphicon glyphicon-trash"></span>
          @if ($question->qstatus < 3)
            </a>
          @endif
        </td>
      </tr>
      @endforeach
    </table>
  </div>

@stop
