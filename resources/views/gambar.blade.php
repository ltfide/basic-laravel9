<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>File</title>
</head>
<body>
   <form action="/request/file" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="file" name="gambar">
      <button type="submit">TEST</button>
   </form>
</body>
</html>