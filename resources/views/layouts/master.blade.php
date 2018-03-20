<html>
    <head>
        <title>Kings.Ge - @yield('title')</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous" />
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="margin: 50px 0;">
                    {{ link_to('questions', $title = 'შეკითხვის დამატება', $attributes = ['class' => 'btn btn-default']) }}
                    {{ link_to('testing', $title = 'ტესტირება', $attributes = ['class' => 'btn btn-default']) }}
                </div>
            </div>
        </div>

        @yield('content')
    </body>
</html>