<form method="POST" action="{{route('mob.store')}}">
    {{csrf_field()}}
    <input type='text' name='mobName' />
    <input type='submit' value='Create Mob' />
</form>
