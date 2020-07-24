<html>
    <body>
        <p>Verify your account by clicking on the <a href="{{ url('/verify/'.$token) }}">link</a></p>
        <p>localhost:8000/verify/{{ $token }}</p>
    </body>
</html>
