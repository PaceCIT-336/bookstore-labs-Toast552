<!DOCTYPE html>
<html>
<head>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $("button").click(function() {
        $("p").text("jQuery is working!");
      });
    });
  </script>
</head>
<body>
  <button>Click me</button>
  <p></p>
</body>
</html>