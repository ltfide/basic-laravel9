<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Blade Controller</title>
</head>
<body>
   
   @isset($name)
      <h1>Hello {{ $name }}</h1>
   @endisset

   @empty($salah)
      <p>Empty</p>
   @endempty

   @hasSection ('userId')
      <p>Session Exists</p>
   @else
      <p>Session not exists yet</p>
   @endif

</body>
</html>