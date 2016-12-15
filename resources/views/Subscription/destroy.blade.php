<form method="POST" action="{{route('subscription.destroy', ['id'=>$subscription_id])}}" class='inline'>
    {{csrf_field()}}
    {{method_field('DELETE')}}
    <input type='submit' value='Unsubscribe' class='navbar-btn btn-danger'/>
</form>
