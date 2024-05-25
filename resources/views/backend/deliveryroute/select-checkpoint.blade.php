<div id='checkPointList-{{ $id }}'>
    <div class="row">
        <div class="col-3">
            <div class="input-group input-group-outline my-2">
                <select class="form-control" id='ch-{{ $id }}' onchange="addCheckPoindId(event)">
                    <option value="null">Select</option>
                    @foreach ($checkPoints as $checkPoint)
                        <option value="{{ $checkPoint->id }}" @if (isset($selectedCheckPoint) && $checkPoint->id == $selectedCheckPoint) selected @endif>{{ $checkPoint->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-1 my-2">
            <button type="button" class="btn btn-danger checkPointdelete btn-link" onclick="deleteCheckPoint({{ $id }})" id='checkPointdelete-{{ $id }}' data-original-title="" title="">
                <i class="material-icons">close</i>
                <div class="ripple-container"></div>
            </button>
        </div>
    </div>
</div>
