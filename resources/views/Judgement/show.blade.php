@if ($judgement==NULL)
    <span class='text-muted'>0 votes
@elseif ($judgement['swing']>0)
    <span class='text-success'>Yes ({{$judgement['degree']}}%)
@elseif ($judgement['swing']<0)
    <span class='text-danger'>No ({{$judgement['degree']}}%)
@elseif ($judgement['swing']==0)
    <span class='text-muted'>Tie
@endif
@if ($judgement!=NULL)
- {{$judgement['total']}} votes
@endif
</span>
