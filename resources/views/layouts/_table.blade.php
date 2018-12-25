<div class="panel panel-default">
    <div class="panel-body">
        <table class="table">
            <thead>
            <tr>
                <th>
                    <a href="{{route('index',['order_by'=>'id','order'=> getOrderByTitle('id')])}}">ID</a>
                </th>
                <th>user_name</th>
                <th>ip</th>
                <th>browser</th>
                <th>
                    <a href="{{route('index',['order_by'=>'email','order'=> getOrderByTitle('email')])}}">email</a>
                </th>
                <th>homepage</th>
                <th>text</th>
                <th>IMG</th>
                <th>
                    <a href="{{route('index',['order_by'=>'created_at','order'=> getOrderByTitle('created_at')])}}">created_at</a>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($articles as $article)
                <tr class="table-content">
                    <th>{{$article->id}}</th>
                    <th>{{$article->user->name}}</th>
                    <th>{{$article->user->ip}}</th>
                    <th>{{$article->user->browser}}</th>
                    <th>{{$article->email}}</th>
                    <th>{{$article->homepage}}</th>
                    <th>{!!$article->text!!}</th>
                    <th><a class="expand" href="#" data-article-id="{{ $article->id }}" data-toggle="modal"
                           data-target="#content-modal">Посмотреть прикреплённый файл</a>
                    </th>
                    <th>{{$article->created_at}}</th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

{{ $articles->appends(['order_by' => request()->get('order_by'), 'order' => request()->get('order')])->links() }}