@extends('layouts.default')

@section('content')
<div class="wrapper-diskuze">
  <div class="container">

    <div class="row">
      <div class="col-md-12">
        <h2 class="text-center">Otázky pro diskutující</h2>
      </div>
    </div>

    <div class="row">
      <div class="col-md-6">
        <h3>Aktuální otázka</h3>
        <div id="pripnute">
        @foreach ($pinnedQuestions as $pinnedQuestion)
          @if (Auth::check()) <a href="{{ URL::route('dotazy.update', $pinnedQuestion->id) }}" title="Označit přečtené" data-method="PATCH" data-value="2"> @endif
          <blockquote>
            <p>{{ nl2br(e($pinnedQuestion->question)) }}</p>
            <footer><cite>{{{ ( $pinnedQuestion->asker != "" ) ?  $pinnedQuestion->asker : 'Anonymní dotaz' }}}</cite></footer>
          </blockquote>
           @if (Auth::check()) </a> @endif
        @endforeach
        </div>
      </div>
      <div class="col-md-6">
        <h3>Poslední dotazy</h3>
        <div id="otazky">
        @foreach ($questions as $question)
          @if (Auth::check()) <a href="{{ URL::route('dotazy.update', $question->id) }}" title="Připnout" data-method="PATCH" data-value="4"> @endif
          <blockquote>
            <p>{{ nl2br(e($question->question)) }}</p>
            <footer><cite>{{{ ( $question->asker != "" ) ?  $question->asker : 'Anonymní dotaz' }}}</cite></footer>
          </blockquote>
          @if (Auth::check()) </a> @endif
        @endforeach
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8 col-md-push-2">
          <p class="text-center">Své dotazy pro diskutující můžete posílat pomocí svých mobilních telefonů nebo počítačů z&nbsp;webu konference na&nbsp;adrese: <a href="/diskuze">/diskuze</a></p>
      </div>
    </div>

  </div>
</div>
@stop

@section('refreshscript')
    <script>
      $("document").ready( function() {
        restActions();
      });

      $("document").ready( function() {
        setInterval( function() {
            $.ajax({
                type: "GET",
                url : "nactiotazky",
                success : function(data) {
                  data = JSON.parse(data);
                  //console.log(data);

                  var otazky = '',
                      pripnute = '',
                      otazka = '',
                      tazatel = '';

                  for (var i in data) {
                    // Formátování otázky
                    otazka = data[i].question.replace(/\n/g, "<br />");
                    // Rozhodnutí co vepíšeme do autora dotazu
                    tazatel = ((data[i].asker !== "") ? data[i].asker : 'Anonymní dotaz')

                    if ( data[i].qstatus == 4 ) {
                      @if (Auth::check())
                        pripnute += "<a href='/dotazy/" + data[i].id + "' title='Označit přečtené' data-method='PATCH' data-value='2'>"; @endif
                      pripnute += "<blockquote><p>" + otazka + " </p> <footer><cite>" + tazatel + "</cite></footer></blockquote>";
                      @if (Auth::check()) pripnute+= "</a>" @endif
                    } else {
                      @if (Auth::check()) otazky+="<a href='/dotazy/" + data[i].id + "' title='Připnout' data-method='PATCH' data-value='4'>"; @endif
                      otazky+="<blockquote><p>" + otazka + " </p> <footer><cite>" + tazatel + "</cite></footer></blockquote>";
                      @if (Auth::check()) otazky+= "</a>" @endif
                    }
                  }
                  $('#otazky').html(otazky);
                  $('#pripnute').html(pripnute);

                  // Zprovozníme odkazy
                  restActions();
                }
              //failure :
            },"json");
        }, 5000);
      });//end of document ready function

    </script>
@stop
