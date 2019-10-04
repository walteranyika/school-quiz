<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>Quiz</title>
    <style>
        .container{
            background-color: #fff;
            color: #0c0e13;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <a class="navbar-brand" href="#">eMobilis Quiz</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        {{--<ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
        </ul>--}}
    </div>
</nav>
<br>


<div class="container">
    <div class="row justify-content-center">
        @if(isset($questions))
          <div class="col-sm-8 ">
           <h3>Fill In Your Info</h3>
            <form action="{{route('check')}}" method="post">

                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Name">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="phone" placeholder="Phone">
                </div>

                <div class="form-group">
                    <input type="text" class="form-control" name="school" placeholder="School">
                </div>

                <hr>

                <h3>Attempt All The Questions</h3>

                <input type="hidden" name="total" value="{{sizeof($questions)}}">
                @foreach($questions as $question)
                    <p>{{$loop->iteration}}.{{$question->title}}</p>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" value="A" name="q_{{$question->id}}">A. {{$question->option_1}}
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" value="B" name="q_{{$question->id}}">B. {{$question->option_2}}
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" value="C" name="q_{{$question->id}}">C. {{$question->option_3}}
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input" value="D" name="q_{{$question->id}}">D. {{$question->option_4}}
                        </label>
                    </div>
                    <hr>
                @endforeach

                <button class="btn btn-success">Submit</button>

            </form>
        </div>
        @elseif(isset($result))
           <div class="col-sm-8">
               <div class="card text-center">
                   <div class="card-header">Congrats {{$result->name}}</div>
                   <div class="card-body">
                       <h2>Your Score is {{$result->score*100}}%</h2>
                       <p>We will soon get back to you</p>
                   </div>
                   <div class="card-footer">Great Attempt</div>
               </div>
           </div>
        @endif
    </div>
</div>

</body>
</html>