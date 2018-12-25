<div class="panel panel-default">
    <div class="panel-body">
        @if(count($errors)>0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if($user)
            <div class="input-block">
                <form action="{{route('article.create')}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <p>Ваше имя:</p><input type="text" name="user_name" value="@if($user){{$user->name}}@endif">
                    <p>Email:</p><input type="text" name="email" value="@if($user){{$user->email}}@endif">
                    <p>Homepage:</p><input type="text" name="homepage" value="@if($user){{$user->homepage}}@endif">
                    <div class="text-container">
                        <p>Комментарий:</p>
                        <button type="button" class="tag-i"> [i]</button>
                        <button type="button" class="tag-strong"> [strong]</button>
                        <br>
                        <textarea class="text-area" name="text"></textarea>
                        <br>
                        <button type="button" class="preview">Предпросмотр</button>
                    </div>
                    <div class="preview-container"></div>

                    <p>Вставить картинку:<input type="file" name="file"></p>

                    <p>Капча</p><input type="text" name="captcha">
                    <p class="captcha-container">{!! captcha_img()!!}</p>
                    <button type="button" class="btn-refresh">Refresh</button>
                    <br><br>
                    <input type="submit">
                </form>
            </div>
        @else
            <p><a href="{{route('register')}}">Зарегистрируйтесь</a>,чтобы оставлять комментарии!</p>
            <p>Либо если у Вас уже есть учётная запись - <a href="{{route('login')}}">авторизуйтесь</a>!</p>
        @endif
    </div>
</div>