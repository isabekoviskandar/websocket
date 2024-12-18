<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @vite('resources/js/app.js')
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">
                <h1>Messages</h1>
                <form action="/message_store" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="message" placeholder="Enter the message.."><br>
                    <input type="file" name="image" placeholder="Enter photo">
                    <input type="submit" name="ok" class="btn btn-primary" value="Send">
                </form>
                <ul id="messageList">
                    @foreach ($messages as $message)
                    <li>
                        {{ $message->message }}
                        @if($message->image)
                            <div>
                                <img src="{{ asset('storage/' . $message->image) }}" alt="Uploaded Image" class="img-thumbnail" width="200">
                            </div>
                        @endif
                    </li>
                    @endforeach
                </ul>
                

            </div>
        </div>
    </div>
  </body>
</html>