@extends('layouts.app')

@section('content')

<div class="container">
@include ('layouts.errors')
  <div class="panel panel-primary">
    <div class="panel-heading">
      <h3 class="panel-title"><strong>Notifications</strong></h3>
    </div>
    <div class="panel-body">
      <p>Discord or Slack webhooks can be used, mix and match as you want!
        <ul>
          <li><a href="https://support.discordapp.com/hc/en-us/articles/228383668-Intro-to-Webhooks" target="_blank">How-to create Discord Webhooks</a></li>
          <li><a href="https://get.slack.help/hc/en-us/articles/115005265063-Incoming-WebHooks-for-Slack" target="_blank">How-to create Slack Webhooks</a></li>
        </ul>
      </p>
      @if(isset($notifications) && count($notifications))
        @foreach($notifications as $notify)

      <div class="row">
      <div class="col-sm-8">
          <h3>{{str_replace('_', ' ', $notify->character_name)}}</h3>
          <form method="POST" action="{{ url('/webhook/delete') }}/{{$notify->char_id}}">
          <div class="form-group">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-danger btn-xs">Delete All</button>
          </div>
          </form>

          <form method="POST" action="{{ url('/webhook') }}/{{$notify->char_id}}">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="fuel_webhook">Low Fuel Webhook</label>
              <input type="text" class="form-control" name="fuel_webhook" id="fuel_webhook" value="{{$notify->fuel_webhook ?? ''}}">
            </div>
            <div class="form-check">
              <input name="fuel_ping_here" class="form-check-input" type="checkbox" value="True" id="fuel_ping_here" @if($notify->fuel_ping_here == True) checked @endif>
              <label class="form-check-label" for="fuel_ping_here">
                Ping @here for Fuel notifications
              </label>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success btn-xs">Update</button>
            </div>
          </form>
          <form method="POST" action="{{ url('/webhook') }}/{{$notify->char_id}}">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="state_webhook">Structure State Webhook</label>
              <input type="text" class="form-control" name="state_webhook" id="state_webhook" width="10" value="{{$notify->state_webhook ?? ''}}">
            </div>
            <div class="form-check">
              <input class="form-check-input" name="state_ping_here" type="checkbox" value="True" id="state_ping_here" @if($notify->state_ping_here == True) checked @endif>
              <label class="form-check-label" for="state_ping_here">
                Ping @here for State notifications
              </label>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success btn-xs">Update</button>
            </div>
          </form>
          <form method="POST" action="{{ url('/webhook') }}/{{$notify->char_id}}">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="unanchor_webhook">Anchor/Unanchor Webhook</label>
              <input type="text" class="form-control" name="unanchor_webhook" id="unanchor_webhook" width="10" value="{{$notify->unanchor_webhook ?? ''}}" >
            </div>
            <div class="form-check">
              <input class="form-check-input" name="anchor_ping_here" type="checkbox" value="True" id="anchor_ping_here" @if($notify->anchor_ping_here == True) checked @endif>
              <label class="form-check-label" for="anchor_ping_here">
                Ping @here for Anchor/Unanchor notifications
              </label>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-success btn-xs">Update</button>
            </div>
          </form>
          <form method="POST" action="{{ url('/webhook') }}/{{$notify->char_id}}">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="extraction_webhook">Extractions Webhook</label>
              <input type="text" class="form-control" name="extraction_webhook" id="extraction_webhook" width="10" value="{{$notify->extraction_webhook ?? ''}}" >
            </div>
            <div class="form-check">
              <input class="form-check-input" name="extraction_ping_here" type="checkbox" value="True" id="extraction_ping_here" @if($notify->extraction_ping_here == True) checked @endif>
              <label class="form-check-label" for="extraction_ping_here">
                Ping @here for Extraction notifications
              </label>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success btn-xs">Update</button>
            </div>
          </form>

      </div> <!-- close col-sm-8 -->
      <div class="col-sm-4">
        <form method="POST" action="{{ url('/webhook/test') }}/{{$notify->char_id}}">
        <div class="form-group">
          {{ csrf_field() }}
          <select class="form-control" name="webhook_test">
            @isset($notify->fuel_webhook)
              <option value="fuel_webhook">Low Fuel</option>
            @endisset
            @isset($notify->state_webhook)
              <option value="state_webhook">Structure State</option>
            @endisset
            @isset($notify->unanchor_webhook)
              <option value="unanchor_webhook">Anchor/Unanchor</option>
            @endisset
            @isset($notify->extraction_webhook)
              <option value="extraction_webhook">Extraction</option>
            @endisset
          </select>
          </div>
          <div class="form-group">
          <button type="submit" class="btn btn-primary btn-xs">Test</button>
        </div>
        </form>
      </div><!-- end col-sm-4 -->
      </div><!-- close row -->
      <hr>
        @endforeach
      @endif

  </div> <!-- close panelbody -->
  </div> <!-- close discord_webhook panel -->
</div> <!-- close container -->
@endsection

