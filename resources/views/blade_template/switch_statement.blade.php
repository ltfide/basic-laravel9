<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Switch Statements</title>
</head>
<body>

   @switch($i)
       @case(1)
           <p>{{ $i }}</p>
           @break
       @case(2)
           <p>{{ $i }}</p>
           @break
       @default
           <p>Default</p>
   @endswitch
   
</body>
</html>