@props(['name','type'=>'text'])

<div class="mb-3">
    <label for="{{$name}}" class="form-label">{{ucfirst($name)}}</label>
    <input type="{{$type}}" name="{{$name}}" value="{{old($name)}}" class="form-control" id="{{$name}}">
    <x-error name="{{$name}}" />
</div>