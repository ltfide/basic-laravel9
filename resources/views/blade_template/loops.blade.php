<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Loops</title>
</head>  
<body>
   
   @for ($i = 0; $i < 10; $i++)
      <p>{{ $i + 1 }}</p>
   @endfor

   <ul>
      @foreach ($users as $user)
         <li>Name : {{ $user['name'] }}</li>
         <li>Age : {{ $user['age'] }}</li>
      @endforeach
   </ul>

   @foreach ($users as $user)
      @if ($loop->first)
          This is the first iteration
      @endif
   @endforeach

</body>
</html>