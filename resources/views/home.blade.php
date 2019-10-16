@extends('layouts.app')
@section('content')
<div class="container">
    <br>
    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Уменьшитель URL</h5>
                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    <form method="post" class="form-inline" action="/">
                        {{csrf_field()}}
                        <div class="form-group mx-md-4 mb-2">
                            <label for="inputUrl" class="sr-only">Password</label>
                            <input type="text" class="form-control" name="url" maxlength="50" placeholder="URL" required>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Уменьшить</button>&nbsp;
                        @if ($url != '') <a href="{{url('/' . $url)}}">{{url('/' . $url)}}</a>@endif
                    </form>
                </div>
            </div>
        </div>
    </div><br>

    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Баннер</h5>
                </div>
                <div class="card-body">
                    <p>Используется <a href="https://redis.io/" target="_blank">Redis</a>.</a></p>
                    <a href="#"><img src="/banner" alt="" border="0"></a>
                    <p>Количество хитов: {{$bannerHit ?? '1'}}</p>
                </div>
            </div>
        </div>
    </div><br>

    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Shell</h5>
                </div>
                <div class="card-body">
                    <p>Скрипт cleanup.sh</p>
                    <pre>
#!/bin/bash
while true;
do
    begin=`date +%s`
    php /home/user/public_html/website.com/test.php &
    end=`date +%s`
    if [ $(($end - $begin)) -lt 13 ]; then
         sleep $(($begin + 13 - $end))
    fi
done</pre>
                    <p>crontab</p>
                    <p>* * * * * flock -n /tmp/cleanup.lock cleanup.sh</p>
                </div>
            </div>
        </div>
     </div><br>

    <div class="row justify-content-md-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>Заливка цветом</h5>
                </div>
                <div class="card-body">
                    <div class="background-exaple" style="height: 100px"></div>
                </div>
            </div>
        </div>
    </div><br>
</div>
@endsection


