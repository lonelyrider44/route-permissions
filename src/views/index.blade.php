<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Route permissions </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/route-permissions">Route permissions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="roles">Roles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="free-routes">Unasigned routes</a>
                        </li>
                    </ul>
                    <form class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </nav>
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
        <div class="row">
            <div class="offset-md-1 col-md-10">
                <ul class="nav nav-pills mb-3 mt-4" id="pills-tab" role="tablist">
                    @foreach($roles as $role)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-{{$role->name}}-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-{{$role->name}}" type="button" role="tab"
                            aria-controls="pills-{{$role->name}}" aria-selected="true">{{$role->name}}</button>
                    </li>
                    @endforeach
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    @foreach($roles as $role)
                    <div class="tab-pane fade" id="pills-{{$role->name}}" role="tabpanel"
                        aria-labelledby="pills-{{$role->name}}-tab">
                        <div class="row">
                            @foreach($permission_groups as $permission_group => $permissions)
                            <div class="col-md-4">
                                <div class="list-group m-2">
                                    @foreach($permissions as $permission)
                                    <label class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox" value="" @if($role->hasPermissionTo($permission['permission'])) checked @endif>
                                        {{$permission['permission']}}
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
        <!-- Content here -->
    </div>
</body>

</html>