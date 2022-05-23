<!DOCTYPE html>
<html>
<head>
    <title>Create short url</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
   
<div class="container">
    <h1>Create short url</h1>
   
    <div class="card">
      <div class="card-header">
        <form method="POST" action="{{ url('store-link') }}">
            @csrf
            <div class=" mb-3">
              <input type="text" name="url" class="form-control " placeholder="Enter URL" aria-label="Recipient's username" aria-describedby="basic-addon2">
              <small style="color:red;">{{$errors->first('url')}}</small>
              <div class="input-group-append">
                <button class="btn btn-success mt-2" type="submit">Create short url</button>
              </div>
            </div>
        </form>
      </div>
      <div class="card-body">
   
            @if (Session::has('message'))
                {!! Session::get('message') !!}
            @endif
   
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Short Url</th>
                        <th>Full Url</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($shorturl as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td><a href="{{ URL::to('/').'/'.$row->hash_code }}" target="_blank">{{ URL::to('/').'/'.$row->hash_code }}</a></td>
                            <td>{{ $row->url }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3"><center> No Link found ....!</center></td></tr>
                    @endforelse
                </tbody>
            </table>
      </div>
    </div>
   
</div>
    
</body>
</html>