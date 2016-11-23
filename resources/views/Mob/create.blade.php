<form method="POST" action="{{route('mob.create')}}">
    {{csrf_field()}}
    <input type='text' name='mobName' />
    <input type='submit' value='Create Mob' />
</form>
