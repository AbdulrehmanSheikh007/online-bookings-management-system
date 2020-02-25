<div>
    Link:
    <a href="{{$url . 'password-reset/' . Hashids::encode($user->id) . '/' . $user->_token}}"> {{ $url. 'password-reset/' . Hashids::encode($user->id) . '/' . $user->_token}}</a>
</div>