<div>
    <div class="form-group row">
        <label for="line">Linea</label>
        <select name="line" class="form-control" >
            @foreach($lines as $line)
            <option value="{{$line->id}}" >{{$line->name}} </option>
            @endforeach
        </select>
    </div>
</div>
