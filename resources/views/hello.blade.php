<html>
<head>
   <body>
      <h1>Hello {{ $name }}</h1>
      <script>
         // var app = <?php echo json_encode([1,2]); ?>;
         // var app = {{ Illuminate\Support\Js::from([1,2]) }};
         var app = {{ Js::from([1,2]) }};
         console.log(app);
      </script>
   </body>
</head>
</html>