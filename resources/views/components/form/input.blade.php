@props(['name','type'=>'text',"isShow" => false,"value" => ""])

<div class="mb-3">
    <label for="{{$name}}" class="form-label">{{ucfirst($name)}} {{$isShow ? "(Optional)" : ""}}</label>
    <input type="{{$type}}" name="{{$name}}" value="{{old($name,$value)}}" class="form-control" id="{{$name}}">
    <x-error name="{{$name}}" />
</div>